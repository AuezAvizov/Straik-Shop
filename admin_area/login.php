<?php
session_start();
include("includes/db.php");
?>
<!DOCTYPE HTML>
<html>
<head>
    <title>Вход Администратора</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/login.css">
</head>
<body>
    <div class="container">
        <form class="form-login" action="" method="post">
            <h2 class="form-login-heading">Вход Администратора</h2>
            <input type="text" class="form-control" name="admin_email" placeholder="Адрес электронной почты" required>
            <input type="password" class="form-control" name="admin_pass" placeholder="Пароль" required>
            <button class="btn btn-lg btn-primary btn-block" type="submit" name="admin_login">
                Войти
            </button>
        </form>
    </div>
</body>
</html>
<?php

if (isset($_POST['admin_login'])) {

    $admin_email = mysqli_real_escape_string($con, $_POST['admin_email']);
    $admin_pass = mysqli_real_escape_string($con, $_POST['admin_pass']);

    $get_admin = "SELECT * FROM admins WHERE admin_email='$admin_email' AND admin_pass='$admin_pass'";
    $run_admin = mysqli_query($con, $get_admin);
    $count = mysqli_num_rows($run_admin);

    if ($count == 1) {

        $_SESSION['admin_email'] = $admin_email;

        echo "<script>alert('Вы вошли в панель администратора')</script>";
        echo "<script>window.open('index.php?dashboard', '_self')</script>";

    } else {
        echo "<script>alert('Неверный email или пароль')</script>";
    }
}

?>
