<?php
require_once __DIR__ . '/session_start.php';
require_once __DIR__ . '/../../includes/conn.php';

if (empty($_SESSION['admin'])) {
    header('Location: login.php');
    exit();
}

try {
    $conn = $pdo->open();
    $stmt = $conn->prepare(
        'SELECT * FROM users
         WHERE id = :id AND type = 1 AND status = 1
         LIMIT 1'
    );
    $stmt->execute(['id' => (int) $_SESSION['admin']]);
    $admin = $stmt->fetch();
    $pdo->close();

    if (!$admin) {
        unset($_SESSION['admin']);
        header('Location: login.php');
        exit();
    }
} catch (PDOException $e) {
    error_log('Administrator session lookup failed: ' . $e->getMessage());
    unset($_SESSION['admin']);
    header('Location: login.php');
    exit();
}
?>
