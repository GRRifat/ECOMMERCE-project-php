<?php
require_once __DIR__ . '/includes/session_start.php';

if (!empty($_SESSION['admin'])) {
    header('Location: home.php');
    exit();
}
?>
<?php include __DIR__ . '/includes/header.php'; ?>
<body class="hold-transition login-page">
<div class="login-box">
    <div class="login-logo">
        <a href="../index.php"><b>The Casualists</b><br><small>Admin Panel</small></a>
    </div>

    <?php
    if (isset($_SESSION['error'])) {
        echo '<div class="callout callout-danger text-center"><p>'
            . htmlspecialchars((string) $_SESSION['error'], ENT_QUOTES, 'UTF-8')
            . '</p></div>';
        unset($_SESSION['error']);
    }

    if (isset($_SESSION['success'])) {
        echo '<div class="callout callout-success text-center"><p>'
            . htmlspecialchars((string) $_SESSION['success'], ENT_QUOTES, 'UTF-8')
            . '</p></div>';
        unset($_SESSION['success']);
    }
    ?>

    <div class="login-box-body">
        <p class="login-box-msg">Sign in to the administration panel</p>

        <form action="verify.php" method="POST" autocomplete="on">
            <div class="form-group has-feedback">
                <input type="email" class="form-control" name="email"
                       placeholder="Administrator email" autocomplete="username" required>
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            </div>

            <div class="form-group has-feedback">
                <input type="password" class="form-control" name="password"
                       placeholder="Password" autocomplete="current-password" required>
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>

            <div class="row">
                <div class="col-xs-6">
                    <button type="submit" class="btn btn-primary btn-block btn-flat" name="login">
                        <i class="fa fa-sign-in"></i> Admin Sign In
                    </button>
                </div>
            </div>
        </form>

        <br>
        <a href="../login.php">Customer sign in</a><br>
        <a href="../index.php"><i class="fa fa-home"></i> Back to store</a>
    </div>
</div>

<?php include __DIR__ . '/includes/scripts.php'; ?>
</body>
</html>
