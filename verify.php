<?php
require_once __DIR__ . '/includes/session.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST['login'])) {
    $_SESSION['error'] = 'Please enter your email and password to sign in.';
    header('Location: login.php');
    exit();
}

$email = trim((string) ($_POST['email'] ?? ''));
$password = (string) ($_POST['password'] ?? '');

if ($email === '' || $password === '') {
    $_SESSION['error'] = 'Please enter both your email and password.';
    header('Location: login.php');
    exit();
}

try {
    $conn = $pdo->open();
    $stmt = $conn->prepare(
        'SELECT id, email, password, type, status
         FROM users
         WHERE email = :email
         LIMIT 1'
    );
    $stmt->execute(['email' => $email]);
    $row = $stmt->fetch();
    $pdo->close();

    // Do not disclose whether an arbitrary email address is registered.
    if (!$row || !password_verify($password, $row['password'])) {
        $_SESSION['error'] = 'Incorrect email or password.';
        header('Location: login.php');
        exit();
    }

    if ((int) $row['status'] !== 1) {
        $_SESSION['error'] = 'Your account is not activated yet.';
        header('Location: login.php');
        exit();
    }

    // Administrators must use the dedicated administrator sign-in page.
    if ((int) $row['type'] === 1) {
        $_SESSION['error'] = 'This is an administrator account. Please sign in through the Admin Sign In page.';
        header('Location: admin/login.php');
        exit();
    }

    if ((int) $row['type'] !== 0) {
        $_SESSION['error'] = 'This account is not permitted to sign in here.';
        header('Location: login.php');
        exit();
    }

    // Regenerate the customer session ID. The admin panel has a separate
    // session cookie, so an administrator can remain signed in at the same time.
    session_regenerate_id(true);
    $_SESSION['user'] = (int) $row['id'];
    unset($_SESSION['error']);

    header('Location: index.php');
    exit();
} catch (PDOException $e) {
    error_log('Customer sign-in failed: ' . $e->getMessage());
    if (isset($pdo)) {
        $pdo->close();
    }
    $_SESSION['error'] = 'Sign-in is temporarily unavailable. Please try again.';
    header('Location: login.php');
    exit();
}
?>
