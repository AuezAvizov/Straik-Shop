<?php
session_start();
include("includes/db.php");
include("functions.php");
include("includes/header.php");
include("includes/main.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Проверка</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/responsive.css">
    <link rel="stylesheet" href="styles/bootstrap.min.css">
    <link rel="stylesheet" href="styles/backend.css">
</head>
<body>


<div id="content" ><!-- content Starts -->
<div class="container" ><!-- container Starts -->




<div class="col-md-12" ><!-- col-md-12 Starts -->

<?php
if(!isset($_SESSION['customer_email'])){
include("customer/customer_login.php");
}else{
include("payment_options.php");
}
?>


</div><!-- col-md-12 Ends -->


</div><!-- container Ends -->
</div><!-- content Ends -->

  <?php include("includes/footer.php"); ?>

  <script src="js/jquery.min.js"></script>
  <script src="js/bootstrap.min.js"></script>

</body>
</html>
