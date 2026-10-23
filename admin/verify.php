<?php
require_once __DIR__ . '/includes/session_start.php';
require_once __DIR__ . '/../includes/conn.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST['login'])) {
    $_SESSION['error'] = 'Please enter your administrator email and password.';
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
        'SELECT id, password, type, status
         FROM users
         WHERE email = :email
         LIMIT 1'
    );
    $stmt->execute(['email' => $email]);
    $row = $stmt->fetch();
    $pdo->close();

    // Only active administrator accounts can enter the admin panel.
    if (
        !$row ||
        (int) $row['type'] !== 1 ||
        (int) $row['status'] !== 1 ||
        !password_verify($password, $row['password'])
    ) {
        $_SESSION['error'] = 'Invalid administrator email or password.';
        header('Location: login.php');
        exit();
    }

    // Regenerate only the administrator session ID; the customer session
    // uses a different cookie/session and remains signed in independently.
    session_regenerate_id(true);
    $_SESSION['admin'] = (int) $row['id'];
    unset($_SESSION['error']);

    header('Location: home.php');
    exit();
} catch (PDOException $e) {
    error_log('Administrator sign-in failed: ' . $e->getMessage());
    if (isset($pdo)) {
        $pdo->close();
    }
    $_SESSION['error'] = 'Sign-in is temporarily unavailable. Please try again.';
    header('Location: login.php');
    exit();
}
?>
