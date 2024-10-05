<?php
error_reporting(E_ERROR | E_PARSE);
ini_set('display_errors', 0);

include("includes/db.php");
include("functions.php");
include("includes/main.php");

?>
<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="styles/bootstrap.min.css">
  <link rel="stylesheet" href="styles/backend.css">
  <link rel="stylesheet" href="styles/style.css">
  <title>Главная страница</title>
</head>
<body>
  <main>
    <div class="hero">
      <a href="shop.php" class="btn1">Посмотреть все товары</a>
    </div>
    <div class="wrapper">
      <h1>Товары<h1>
    </div>
    <div id="content" class="container">
      <div class="row">
      <?php
      getPro();
      error_reporting(0);

      ?>

      </div>
    </div>

    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <?php include("includes/footer.php") ?>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>
