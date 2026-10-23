<?php
require_once __DIR__ . '/conn.php';

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

// Customer pages use the default PHP session. The admin panel uses a
// separate session name and cookie, so both accounts can stay signed in.
// Remove a legacy admin key left by the earlier shared-session implementation.
unset($_SESSION['admin']);

if (!empty($_SESSION['user'])) {
    try {
        $conn = $pdo->open();
        $stmt = $conn->prepare(
            'SELECT * FROM users WHERE id = :id AND type = 0 AND status = 1 LIMIT 1'
        );
        $stmt->execute(['id' => (int) $_SESSION['user']]);
        $user = $stmt->fetch();

        $pdo->close();

        // Invalidate a stale session if the account was disabled or its role changed.
        if (!$user) {
            unset($_SESSION['user']);
        }
    } catch (PDOException $e) {
        error_log('Customer session lookup failed: ' . $e->getMessage());
        $user = null;
    }
}
?>
