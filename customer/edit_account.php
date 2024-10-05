<?php
// Запуск сессии
// Проверка, авторизован ли пользователь
if (!isset($_SESSION['customer_email'])) {
    echo "<script>window.open('../checkout.php','_self')</script>";
    exit(); // Остановить дальнейшее выполнение кода
}

include("includes/db.php");

// Получение данных пользователя из базы данных
$customer_session = $_SESSION['customer_email'];

$get_customer = "select * from customers where customer_email='$customer_session'";
$run_customer = mysqli_query($con, $get_customer);
$row_customer = mysqli_fetch_array($run_customer);

$customer_id = $row_customer['customer_id'];
$customer_name = $row_customer['customer_name'];
$customer_email = $row_customer['customer_email'];
$customer_country = $row_customer['customer_country'];
$customer_city = $row_customer['customer_city'];
$customer_contact = $row_customer['customer_contact'];
$customer_address = $row_customer['customer_address'];
$customer_image = $row_customer['customer_image'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Your Account</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="styles/backend.css">
    <link rel="stylesheet" href="styles/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1 align="center">Edit Your Account</h1>

        <form action="" method="post" enctype="multipart/form-data"><!-- form Starts -->

            <div class="form-group"><!-- form-group Starts -->
                <label>Customer Name:</label>
                <input type="text" name="c_name" class="form-control" required value="<?php echo $customer_name; ?>">
            </div><!-- form-group Ends -->

            <div class="form-group"><!-- form-group Starts -->
                <label>Customer Email:</label>
                <input type="email" name="c_email" class="form-control" required value="<?php echo $customer_email; ?>">
            </div><!-- form-group Ends -->

            <div class="form-group"><!-- form-group Starts -->
                <label>Customer Country:</label>
                <input type="text" name="c_country" class="form-control" required value="<?php echo $customer_country; ?>">
            </div><!-- form-group Ends -->

            <div class="form-group"><!-- form-group Starts -->
                <label>Customer City:</label>
                <input type="text" name="c_city" class="form-control" required value="<?php echo $customer_city; ?>">
            </div><!-- form-group Ends -->

            <div class="form-group"><!-- form-group Starts -->
                <label>Customer Contact:</label>
                <input type="text" name="c_contact" class="form-control" required value="<?php echo $customer_contact; ?>">
            </div><!-- form-group Ends -->

            <div class="form-group"><!-- form-group Starts -->
                <label>Customer Address:</label>
                <input type="text" name="c_address" class="form-control" required value="<?php echo $customer_address; ?>">
            </div><!-- form-group Ends -->

            <div class="form-group"><!-- form-group Starts -->
                <label>Customer Image:</label>
                <input type="file" name="c_image" class="form-control" required><br>
                <img src="customer_images/<?php echo $customer_image; ?>" width="100" height="100" class="img-responsive">
            </div><!-- form-group Ends -->

            <div class="text-center"><!-- text-center Starts -->
                <button name="update" class="btn btn-primary">
                    <i class="fa fa-user-md"></i> Update Now
                </button>
            </div><!-- text-center Ends -->

        </form><!-- form Ends -->
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

<?php
if (isset($_POST['update'])) {

    $update_id = $customer_id;

    $c_name = $_POST['c_name'];
    $c_email = $_POST['c_email'];
    $c_country = $_POST['c_country'];
    $c_city = $_POST['c_city'];
    $c_contact = $_POST['c_contact'];
    $c_address = $_POST['c_address'];
    $c_image = $_FILES['c_image']['name'];
    $c_image_tmp = $_FILES['c_image']['tmp_name'];

    move_uploaded_file($c_image_tmp, "customer_images/$c_image");

    $update_customer = "update customers set 
        customer_name='$c_name', 
        customer_email='$c_email', 
        customer_country='$c_country', 
        customer_city='$c_city', 
        customer_contact='$c_contact', 
        customer_address='$c_address', 
        customer_image='$c_image' 
        where customer_id='$update_id'";

    $run_customer = mysqli_query($con, $update_customer);

    if ($run_customer) {
        echo "<script>alert('Your account has been updated, please login again')</script>";
        echo "<script>window.open('logout.php','_self')</script>";
    }
}
?>
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>