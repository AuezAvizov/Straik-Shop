<?php

session_start();

include("includes/db.php");
include("functions.php");
include("includes/header.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Регестрация пользователя</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/responsive.css">
    <link rel="stylesheet" href="styles/bootstrap.min.css">
  <link rel="stylesheet" href="styles/backend.css">
  <link rel="stylesheet" href="styles/style.css">
</head>
<main>
    <div class="nero">
        <div class="nero__heading">
            <span class="nero__bold">Забыл</span> Пароль
        </div>
        <p class="nero__text"></p>
    </div>
</main>

<div id="content">
    <div class="container">
        <div class="col-md-12">
            <ul class="breadcrumb">
                <li><a href="index.php">Главная страница</a></li>
                <li>Регестрация</li>
            </ul>
        </div>

        <div class="col-md-12">
            <div class="box">
                <div class="box-header">
                    <center>
                        <h3>Введите свой адрес электронной почты ниже, мы вышлем вам ваш пароль</h3>
                    </center>
                </div>
                <div align="center">
                    <form action="" method="post">
                        <input type="text" class="form-control" name="c_email" placeholder="Enter Your Email">
                        <br>
                        <input type="submit" name="forgot_pass" class="btn btn-primary" value="Send My Password">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include("includes/footer.php");
?>
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>

</body>
</html>

<?php

if (isset($_POST['forgot_pass'])) {
    $c_email = $_POST['c_email'];

    $sel_c = "select * from customers where customer_email='$c_email'";
    $run_c = mysqli_query($con, $sel_c);
    $count_c = mysqli_num_rows($run_c);
    $row_c = mysqli_fetch_array($run_c);

    $c_name = $row_c['customer_name'];
    $c_pass = $row_c['customer_pass'];

    if ($count_c == 0) {
        echo "<script>alert('К сожалению, у нас нет вашего электронного адреса')</script>";
        exit();
    } else {
        $message = "
        <h1 align='center'>Your Password Has Been Sent To You</h1>
        <h2 align='center'>Dear $c_name</h2>
        <h3 align='center'>
            Your Password is: <span><b>$c_pass</b></span>
        </h3>
        <h3 align='center'>
            <a href='localhost/ecom_store/checkout.php'>Click Here To Login Your Account</a>
        </h3>
        ";

        $from = "sad.ahmed22224@gmail.com";
        $subject = "Your Password";
        $headers = "From: $from\r\n";
        $headers .= "Content-type: text/html\r\n";

        // Отправка email
        mail($c_email, $subject, $message, $headers);

        echo "<script>alert('Your Password has been sent to you, check your inbox')</script>";
        echo "<script>window.open('checkout.php','_self')</script>";
    }
}
?>