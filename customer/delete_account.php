<?php
// Старт сессии и подключение необходимых файлов
include("../includes/db.php");

if (!isset($_SESSION['customer_email'])) {
    echo "<script>alert('You cannot delete an account because you are not logged in.');</script>";
    echo "<script>window.open('../index.php','_self')</script>";
    exit();
}

$c_email = $_SESSION['customer_email'];

// Проверка, существует ли клиент с таким email
$get_customer = "select customer_id from customers where customer_email='$c_email'";
$run_customer = mysqli_query($con, $get_customer);
$row_customer = mysqli_fetch_array($run_customer);

if (!$row_customer) {
    // Если клиент с таким email не найден
    echo "<script>alert('You cannot delete an account because it does not exist.');</script>";
    echo "<script>window.open('../index.php','_self')</script>";
    exit();
}

$customer_id = $row_customer['customer_id'];

// Проверка наличия активных заказов
$get_orders = "select * from customer_orders where customer_id='$customer_id' and order_status='pending'";
$run_orders = mysqli_query($con, $get_orders);
$active_orders_count = mysqli_num_rows($run_orders);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Account</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <center>
        <h1>Do You Really Want To Delete Your Account!</h1>
        <?php if ($active_orders_count > 0): ?>
            <p class="text-danger">You have active orders. You cannot delete your account until all orders are completed.</p>
            <form action="" method="post">
                <input class="btn btn-primary" type="submit" name="back" value="Back to My Account">
            </form>
        <?php else: ?>
            <form action="" method="post">
                <input class="btn btn-danger" type="submit" name="yes" value="Yes, I want to delete">
                <input class="btn btn-primary" type="submit" name="no" value="No, I don't want to delete">
            </form>
        <?php endif; ?>
    </center>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

<?php
if (isset($_POST['yes'])) {
    $delete_customer = "delete from customers where customer_id='$customer_id'";
    $run_delete = mysqli_query($con, $delete_customer);
    
    if ($run_delete) {
        session_destroy();
        echo "<script>alert('Your Account Has Been Deleted! Goodbye')</script>";
        echo "<script>window.open('../index.php','_self')</script>";
    }
}

if (isset($_POST['no']) || isset($_POST['back'])) {
    echo "<script>window.open('my_account.php?my_orders','_self')</script>";
}
?>