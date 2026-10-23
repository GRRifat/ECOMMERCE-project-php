<?php
require_once __DIR__ . '/includes/session_start.php';

// Clear only the administrator session. The storefront customer session is
// stored under a different session name and is not affected by this logout.
$_SESSION = [];

if (ini_get('session.use_cookies')) {
    $params = session_get_cookie_params();
    setcookie(
        session_name(),
        '',
        time() - 42000,
        $params['path'],
        $params['domain'],
        $params['secure'],
        $params['httponly']
    );
}

session_destroy();

header('Location: login.php');
exit();
?>
