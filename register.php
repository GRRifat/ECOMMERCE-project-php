<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once __DIR__ . '/includes/session.php';

$requestHost = strtolower((string) parse_url('http://' . ($_SERVER['HTTP_HOST'] ?? ''), PHP_URL_HOST));
$isLocalhost = in_array($requestHost, ['localhost', '127.0.0.1', '::1'], true);

// This endpoint must be reached by submitting the registration form.
// Do not rely on the submit button's name: browsers may omit it when the
// form is submitted with the Enter key.
if (($_SERVER['REQUEST_METHOD'] ?? 'GET') !== 'POST') {
    $_SESSION['error'] = 'Please submit the registration form first.';
    header('Location: signup.php');
    exit();
}

$firstname = trim((string) ($_POST['firstname'] ?? ''));
$lastname  = trim((string) ($_POST['lastname'] ?? ''));
$email     = trim((string) ($_POST['email'] ?? ''));
$password  = (string) ($_POST['password'] ?? '');
$repassword = (string) ($_POST['repassword'] ?? '');

// Preserve non-sensitive form values when returning to the registration page.
$_SESSION['firstname'] = $firstname;
$_SESSION['lastname'] = $lastname;
$_SESSION['email'] = $email;

if ($firstname === '' || $lastname === '' || $email === '' || $password === '' || $repassword === '') {
    $_SESSION['error'] = 'Please fill in all required registration fields.';
    header('Location: signup.php');
    exit();
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $_SESSION['error'] = 'Please enter a valid email address.';
    header('Location: signup.php');
    exit();
}

if ($password !== $repassword) {
    $_SESSION['error'] = 'Passwords did not match.';
    header('Location: signup.php');
    exit();
}

// On a hosted site, email activation requires SMTP configuration.
// Local XAMPP registrations are activated immediately so development does
// not depend on external email credentials.
$smtpUsername = trim((string) getenv('ECOMMERCE_SMTP_USERNAME'));
$smtpPassword = (string) getenv('ECOMMERCE_SMTP_PASSWORD');
if (!$isLocalhost && ($smtpUsername === '' || $smtpPassword === '')) {
    $_SESSION['error'] = 'Registration email is not configured on this server. Please contact the site administrator.';
    header('Location: signup.php');
    exit();
}

// Keep reCAPTCHA enabled for hosted deployments, but skip it on local XAMPP.
if (isset($_SESSION['captcha']) && time() >= (int) $_SESSION['captcha']) {
    unset($_SESSION['captcha']);
}

if (!$isLocalhost && !isset($_SESSION['captcha'])) {
    $captchaResponse = trim((string) ($_POST['g-recaptcha-response'] ?? ''));
    if ($captchaResponse === '') {
        $_SESSION['error'] = 'Please complete the reCAPTCHA verification.';
        header('Location: signup.php');
        exit();
    }

    try {
        require_once __DIR__ . '/recaptcha/src/autoload.php';
        $recaptchaSecret = (string) (getenv('RECAPTCHA_SECRET_KEY') ?: '6LevO1IUAAAAAFCCiOHERRXjh3VrHa5oywciMKcw');
        $recaptcha = new \ReCaptcha\ReCaptcha($recaptchaSecret, new \ReCaptcha\RequestMethod\SocketPost());
        $captchaResult = $recaptcha->verify($captchaResponse, $_SERVER['REMOTE_ADDR'] ?? null);

        if (!$captchaResult->isSuccess()) {
            error_log('Registration reCAPTCHA verification failed: ' . implode(', ', $captchaResult->getErrorCodes()));
            $_SESSION['error'] = 'reCAPTCHA verification failed. Please refresh the page and try again.';
            header('Location: signup.php');
            exit();
        }

        $_SESSION['captcha'] = time() + (10 * 60);
    } catch (Throwable $e) {
        error_log('Registration reCAPTCHA error: ' . $e->getMessage());
        $_SESSION['error'] = 'reCAPTCHA could not be verified. Please try again later.';
        header('Location: signup.php');
        exit();
    }
}

$conn = null;
try {
    $conn = $pdo->open();
    if (!$conn instanceof PDO) {
        throw new RuntimeException('Database connection was not established.');
    }

    $stmt = $conn->prepare('SELECT COUNT(*) FROM users WHERE email = :email');
    $stmt->execute(['email' => $email]);
    if ((int) $stmt->fetchColumn() > 0) {
        $pdo->close();
        $_SESSION['error'] = 'Email already taken. Please use a different email address.';
        header('Location: signup.php');
        exit();
    }

    $createdOn = date('Y-m-d');
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $activationCode = bin2hex(random_bytes(6));
    $accountStatus = $isLocalhost ? 1 : 0;

    // Explicitly supply every required users-table column. The original INSERT
    // omitted NOT NULL columns such as type, status, address, and reset_code.
    $stmt = $conn->prepare(
        'INSERT INTO users
            (email, password, type, firstname, lastname, address, contact_info, photo, status, activate_code, reset_code, created_on)
         VALUES
            (:email, :password, 0, :firstname, :lastname, :address, :contact_info, :photo, :status, :activate_code, :reset_code, :created_on)'
    );
    $stmt->execute([
        'email' => $email,
        'password' => $hashedPassword,
        'firstname' => $firstname,
        'lastname' => $lastname,
        'address' => '',
        'contact_info' => '',
        'photo' => 'male2.png',
        'status' => $accountStatus,
        'activate_code' => $activationCode,
        'reset_code' => '',
        'created_on' => $createdOn,
    ]);

    $userId = (int) $conn->lastInsertId();
    $pdo->close();
    $conn = null;

    unset($_SESSION['firstname'], $_SESSION['lastname'], $_SESSION['email']);

    if ($isLocalhost) {
        $_SESSION['success'] = 'Registration successful. You can now sign in with your new account.';
        header('Location: signup.php');
        exit();
    }

    $https = (!empty($_SERVER['HTTPS']) && strtolower((string) $_SERVER['HTTPS']) !== 'off');
    $scheme = $https ? 'https' : 'http';
    $host = $_SERVER['HTTP_HOST'] ?? '';
    $basePath = rtrim(str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'] ?? '/')), '/');
    $activationUrl = $scheme . '://' . $host . $basePath . '/activate.php?code=' . rawurlencode($activationCode) . '&user=' . $userId;

    require_once __DIR__ . '/vendor/autoload.php';
    $mail = new PHPMailer(true);
    $mail->isSMTP();
    $mail->Host = (string) (getenv('ECOMMERCE_SMTP_HOST') ?: 'smtp.gmail.com');
    $mail->SMTPAuth = true;
    $mail->Username = $smtpUsername;
    $mail->Password = $smtpPassword;
    $mail->SMTPSecure = (string) (getenv('ECOMMERCE_SMTP_SECURE') ?: 'ssl');
    $mail->Port = (int) (getenv('ECOMMERCE_SMTP_PORT') ?: 465);
    $mail->setFrom($smtpUsername, 'ECommerce Site');
    $mail->addAddress($email);
    $mail->isHTML(true);
    $mail->Subject = 'Activate your ECommerce account';
    $safeEmail = htmlspecialchars($email, ENT_QUOTES, 'UTF-8');
    $safeActivationUrl = htmlspecialchars($activationUrl, ENT_QUOTES, 'UTF-8');
    $mail->Body = '<h2>Thank you for registering.</h2>'
        . '<p>Your account email is: ' . $safeEmail . '</p>'
        . '<p>Activate your account using the link below:</p>'
        . '<p><a href="' . $safeActivationUrl . '">Activate Account</a></p>';
    $mail->AltBody = "Thank you for registering. Activate your account here: " . $activationUrl;
    $mail->send();

    $_SESSION['success'] = 'Account created. Please check your email to activate it.';
    header('Location: signup.php');
    exit();
} catch (Throwable $e) {
    if (isset($pdo)) {
        $pdo->close();
    }
    error_log('Registration failed: ' . $e->getMessage());
    $_SESSION['error'] = 'Registration could not be completed. Please check the details and try again. If the problem continues, contact the site administrator.';
    header('Location: signup.php');
    exit();
}
?>
