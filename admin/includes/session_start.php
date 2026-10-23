<?php
/**
 * Start an administrator-only session, separate from the storefront's
 * default PHP session. This allows a customer and an administrator to be
 * signed in at the same time in the same browser.
 */
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_name('ECOMMERCE_ADMIN_SESSID');

    // Limit the admin session cookie to the admin directory where possible.
    $scriptName = str_replace('\\', '/', (string) ($_SERVER['SCRIPT_NAME'] ?? '/admin/index.php'));
    $scriptDirectory = rtrim(str_replace('\\', '/', dirname($scriptName)), '/');
    if ($scriptDirectory === '' || $scriptDirectory === '.') {
        $scriptDirectory = '/admin';
    }
    $cookiePath = $scriptDirectory . '/';

    $cookieParams = session_get_cookie_params();
    session_set_cookie_params([
        'lifetime' => $cookieParams['lifetime'],
        'path' => $cookiePath,
        'domain' => $cookieParams['domain'],
        'secure' => $cookieParams['secure'],
        'httponly' => true,
        'samesite' => 'Lax',
    ]);

    session_start();
}
?>
