<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ERROR | E_PARSE);
error_reporting(0); // Отключаем все виды ошибок
ini_set('display_errors', 0); // Отключаем отображение ошибок

include("includes/db.php");
include("includes/header.php");
include("functions.php");
include("includes/main.php");

// Получение ID продукта
$product_id = @$_GET['pro_id'];

// Запрос на получение данных продукта
$get_product = "select * from products where product_url='$product_id'";
$run_product = mysqli_query($con, $get_product);
$check_product = mysqli_num_rows($run_product);

// Проверка наличия продукта
if ($check_product == 0) {
    echo "<script> window.open('index.php','_self') </script>";
} else {
    // Получение данных продукта
    $row_product = mysqli_fetch_array($run_product);

    $p_cat_id = $row_product['p_cat_id'];
    $pro_id = $row_product['product_id'];
    $pro_title = $row_product['product_title'];
    $pro_price = $row_product['product_price'];
    $pro_desc = $row_product['product_desc'];
    $pro_img1 = $row_product['product_img1'];
    $pro_img2 = $row_product['product_img2'];
    $pro_img3 = $row_product['product_img3'];
    $pro_label = $row_product['product_label'];
    $pro_psp_price = $row_product['product_psp_price'];
    $pro_features = $row_product['product_features'];
    $pro_video = $row_product['product_video'];
    $status = $row_product['status'];
    $pro_url = $row_product['product_url'];


    $product_label = "";
    if (!empty($pro_label)) {
        $product_label = "
        <a class='label sale' href='#' style='color:black;'>
        <div class='thelabel'>$pro_label</div>
        <div class='label-background'> </div>
        </a>
        ";
    }

    // Запрос на получение данных категории продукта
    $get_p_cat = "select * from product_categories where p_cat_id='$p_cat_id'";
    $run_p_cat = mysqli_query($con, $get_p_cat);
    $row_p_cat = mysqli_fetch_array($run_p_cat);
    $p_cat_title = $row_p_cat['p_cat_title'];
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Details</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/responsive.css">
    <link rel="stylesheet" href="styles/bootstrap.min.css">
    <link rel="stylesheet" href="styles/backend.css">
    <link rel="stylesheet" href="styles/style.css">
</head>
<body>

<main>
    <div class="nero">
        <div class="nero__heading">
            <span class="nero__bold">Просмотр</span> товара
        </div>
        <p class="nero__text"></p>
    </div>
</main>

<div id="content">
    <div class="container">
        <div class="col-md-12">
            <div class="row" id="productMain">
                <div class="col-sm-6">
                    <div id="mainImage">
                        <div id="myCarousel" class="carousel slide" data-ride="carousel">
                            <ol class="carousel-indicators">
                                <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                                <li data-target="#myCarousel" data-slide-to="1"></li>
                                <li data-target="#myCarousel" data-slide-to="2"></li>
                            </ol>
                            <div class="carousel-inner">
                                <div class="item active">
                                    <center>
                                        <img src="admin_area/product_images/<?php echo $pro_img1; ?>" class="img-responsive">
                                    </center>
                                </div>
                                <div class="item">
                                    <center>
                                        <img src="admin_area/product_images/<?php echo $pro_img2; ?>" class="img-responsive">
                                    </center>
                                </div>
                                <div class="item">
                                    <center>
                                        <img src="admin_area/product_images/<?php echo $pro_img3; ?>" class="img-responsive">
                                    </center>
                                </div>
                            </div>
                            <a href="#myCarousel" class="left carousel-control" data-slide="prev">
                                <span class="glyphicon glyphicon-chevron-left"> </span>
                                <span class="sr-only"> Назад </span>
                            </a>
                            <a class="right carousel-control" href="#myCarousel" data-slide="next">
                                <span class="glyphicon glyphicon-chevron-right"> </span>
                                <span class="sr-only"> Вперед </span>
                            </a>
                        </div>
                    </div>
                    <?php echo $product_label; ?>
                </div>

                <div class="col-sm-6">
                    <div class="box">
                        <h1 class="text-center"><?php echo $pro_title; ?></h1>

                        <?php
                        if (isset($_POST['add_cart'])) {
                            $ip_add = getRealUserIp();
                            $p_id = $pro_id;
                            $product_qty = $_POST['product_qty'];
                            $product_size = $_POST['product_size'];

                            if ($product_size == "") {
                                echo "<script>alert('Пожалуйста, выберите размер перед заказом.');</script>";
                                echo "<script>window.open('$pro_url','_self')</script>";
                                exit();
                            }

                            $check_product = "select * from cart where ip_add='$ip_add' AND p_id='$p_id'";
                            $run_check = mysqli_query($con, $check_product);

                            if (mysqli_num_rows($run_check) > 0) {
                                echo "<script>alert('Этот товар уже добавлен в корзину')</script>";
                                echo "<script>window.open('$pro_url','_self')</script>";
                            } else {
                                $get_price = "select * from products where product_id='$p_id'";
                                $run_price = mysqli_query($con, $get_price);
                                $row_price = mysqli_fetch_array($run_price);
                                $pro_price = $row_price['product_price'];
                                $pro_psp_price = $row_price['product_psp_price'];
                                $pro_label = $row_price['product_label'];

                                if ($pro_label == "Sale" or $pro_label == "Gift") {
                                    $product_price = $pro_psp_price;
                                } else {
                                    $product_price = $pro_price;
                                }

                                $query = "insert into cart (p_id, ip_add, qty, p_price, size) values ('$p_id', '$ip_add', '$product_qty', '$product_price', '$product_size')";
                                $run_query = mysqli_query($db, $query);

                                echo "<script>window.open('$pro_url','_self')</script>";
                            }
                        }

                        if (isset($_POST['add_wishlist'])) {
                            if (!isset($_SESSION['customer_email'])) {
                                echo "<script>alert('Вы должны войти в систему, чтобы добавить товар в избранное')</script>";
                                echo "<script>window.open('checkout.php','_self')</script>";
                            } else {
                                $customer_session = $_SESSION['customer_email'];
                                $get_customer = "select * from customers where customer_email='$customer_session'";
                                $run_customer = mysqli_query($con, $get_customer);
                                $row_customer = mysqli_fetch_array($run_customer);
                                $customer_id = $row_customer['customer_id'];

                                $select_wishlist = "select * from wishlist where customer_id='$customer_id' AND product_id='$pro_id'";
                                $run_wishlist = mysqli_query($con, $select_wishlist);
                                $check_wishlist = mysqli_num_rows($run_wishlist);

                                if ($check_wishlist == 1) {
                                    echo "<script>alert('Этот товар уже добавлен в избранное')</script>";
                                    echo "<script>window.open('$pro_url','_self')</script>";
                                } else {
                                    $insert_wishlist = "insert into wishlist (customer_id, product_id) values ('$customer_id','$pro_id')";
                                    $run_wishlist = mysqli_query($con, $insert_wishlist);

                                    if ($run_wishlist) {
                                        echo "<script>alert('Товар добавлен в избранное')</script>";
                                        echo "<script>window.open('$pro_url','_self')</script>";
                                    }
                                }
                            }
                        }
                        ?>

                        <form action="" method="post" class="form-horizontal" onsubmit="return validateForm()">

                            <?php
                            if ($status == "product") {
                            ?>

                                <div class="form-group">
                                    <label class="col-md-5 control-label">Количество</label>
                                    <div class="col-md-7">
                                        <select name="product_qty" class="form-control">
                                            <option value="">Выберите количество</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-5 control-label">Размер</label>
                                    <div class="col-md-7">
                                        <select name="product_size" class="form-control">
                                            <option value="">Выберите размер</option>
                                            <option value="Small">S</option>
                                            <option value="Medium">L</option>
                                            <option value="Large">XL</option>
                                        </select>
                                    </div>
                                </div>

                            <?php } else { ?>

                                <div class="form-group">
                                    <label class="col-md-5 control-label">Количество набора</label>
                                    <div class="col-md-7">
                                        <select name="product_qty" class="form-control">
                                            <option value="">Выберите количество</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-5 control-label">Размер набора</label>
                                    <div class="col-md-7">
                                        <select name="product_size" class="form-control">
                                            <option value="">Выберите размер</option>
                                            <option value="Small">Маленький</option>
                                            <option value="Medium">Средний</option>
                                            <option value="Large">Большой</option>
                                        </select>
                                    </div>
                                </div>

                            <?php } ?>

                            <p class="text-center buttons">
                                <button class="btn btn-danger" type="submit" name="add_cart">
                                    <i class="fa fa-shopping-cart"></i> Добавить в корзину
                                </button>

                                <button class="btn btn-warning" type="submit" name="add_wishlist">
                                    <i class="fa fa-heart"></i> Добавить в избранное
                                </button>
                            </p>

                        </form>

                    </div>

                    <div class="row" id="thumbs">
                        <div class="col-xs-4">
                            <a href="#" class="thumb">
                                <img src="admin_area/product_images/<?php echo $pro_img1; ?>" class="img-responsive">
                            </a>
                        </div>

                        <div class="col-xs-4">
                            <a href="#" class="thumb">
                                <img src="admin_area/product_images/<?php echo $pro_img2; ?>" class="img-responsive">
                            </a>
                        </div>

                        <div class="col-xs-4">
                            <a href="#" class="thumb">
                                <img src="admin_area/product_images/<?php echo $pro_img3; ?>" class="img-responsive">
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="box" id="details">
                <a class="btn btn-info tab" style="margin-bottom:10px;" href="#description" data-toggle="tab">
                    <?php
                    if ($status == "product") {
                        echo "Описание товара";
                    } else {
                        echo "Описание набора";
                    }
                    ?>
                </a>

                <a class="btn btn-info tab" style="margin-bottom:10px;" href="#features" data-toggle="tab">
                    Характеристики
                </a>

                <a class="btn btn-info tab" style="margin-bottom:10px;" href="#video" data-toggle="tab">
                    Видео и Звуки
                </a>

                <hr style="margin-top:0px;">

                <div class="tab-content">
                    <div id="description" class="tab-pane fade in active" style="margin-top:7px;">
                        <?php echo $pro_desc; ?>
                    </div>

                    <div id="features" class="tab-pane fade in" style="margin-top:7px;">
                        <?php echo $pro_features; ?>
                    </div>

                    <div id="video" class="tab-pane fade in" style="margin-top:7px;">
                        <?php echo $pro_video; ?>
                    </div>
                </div>
            </div>

            <div id="row same-height-row">
                <?php
                if ($status == "product") {
                ?>
                    <div class="col-md-3 col-sm-6">
                        <div class="box same-height headline">
                            <h3 class="text-center">Вам также могут понравиться эти продукты: Мы предлагаем вам 3 лучших товара.</h3>
                        </div>
                    </div>

                    <?php
                    $get_products = "select * from products order by rand() LIMIT 0,3";
                    $run_products = mysqli_query($con, $get_products);

                    while ($row_products = mysqli_fetch_array($run_products)) {
                        $pro_id = $row_products['product_id'];
                        $pro_title = $row_products['product_title'];
                        $pro_price = $row_products['product_price'];
                        $pro_img1 = $row_products['product_img1'];
                        $pro_label = $row_products['product_label'];
                        $manufacturer_id = $row_products['manufacturer_id'];

                        $get_manufacturer = "select * from manufacturers where manufacturer_id='$manufacturer_id'";
                        $run_manufacturer = mysqli_query($db, $get_manufacturer);
                        $row_manufacturer = mysqli_fetch_array($run_manufacturer);
                        $manufacturer_name = $row_manufacturer['manufacturer_title'];
                        $pro_psp_price = $row_products['product_psp_price'];
                        $pro_url = $row_products['product_url'];
                        $pro_title = $row_product['product_title'] ?? 'Название не указано';
                        if (isset($row_product['product_title'])) {
                            $pro_title = $row_product['product_title'];
                        } else {
                            $pro_title = 'Название не указано';
                        }
                        
                        
                        if ($pro_label == "Sale" or $pro_label == "Gift") {
                            $product_price = "<del> $$pro_price </del>";
                            $product_psp_price = "| $$pro_psp_price";
                        } else {
                            $product_psp_price = "";
                            $product_price = "$$pro_price";
                        }

                        if ($pro_label == "") {
                        } else {
                            $product_label = "
                            <a class='label sale' href='#' style='color:black;'>
                            <div class='thelabel'>$pro_label</div>
                            <div class='label-background'> </div>
                            </a>
                            ";
                        }

                        echo "
                        <div class='col-md-3 col-sm-6 center-responsive'>
                        <div class='product'>
                        <a href='$pro_url'>
                        <img src='admin_area/product_images/$pro_img1' class='img-responsive'>
                        </a>
                        <div class='text'>
                        <center>
                        <p class='btn btn-warning'>$manufacturer_name</p>
                        </center>
                        <hr>
                        <h3><a href='$pro_url'>$pro_title</a></h3>
                        <p class='price'>$product_price $product_psp_price</p>
                        <p class='buttons'>
                        <a href='$pro_url' class='btn btn-default'>Подробнее</a>
                        <a href='$pro_url' class='btn btn-danger'>
                        <i class='fa fa-shopping-cart'></i> Добавить в корзину
                        </a>
                        </p>
                        </div>
                        $product_label
                        </div>
                        </div>
                        ";
                    }
                    ?>
                <?php } else { ?>
                    <div class="box same-height">
                        <h3 class="text-center">Набор продуктов</h3>
                    </div>

                    <?php
                    $get_bundle_product_relation = "select * from bundle_product_relation where bundle_id='$pro_id'";
                    $run_bundle_product_relation = mysqli_query($con, $get_bundle_product_relation);

                    while ($row_bundle_product_relation = mysqli_fetch_array($run_bundle_product_relation)) {
                        $bundle_product_relation_product_id = $row_bundle_product_relation['product_id'];
                        $get_products = "select * from products where product_id='$bundle_product_relation_product_id'";
                        $run_products = mysqli_query($con, $get_products);

                        while ($row_products = mysqli_fetch_array($run_products)) {
                            $pro_id = $row_products['product_id'];
                            $pro_title = $row_products['product_title'];
                            $pro_price = $row_products['product_price'];
                            $pro_img1 = $row_products['product_img1'];
                            $pro_label = $row_products['product_label'];
                            $manufacturer_id = $row_products['manufacturer_id'];

                            $get_manufacturer = "select * from manufacturers where manufacturer_id='$manufacturer_id'";
                            $run_manufacturer = mysqli_query($db, $get_manufacturer);
                            $row_manufacturer = mysqli_fetch_array($run_manufacturer);
                            $manufacturer_name = $row_manufacturer['manufacturer_title'];
                            $pro_psp_price = $row_products['product_psp_price'];
                            $pro_url = $row_products['product_url'];

                            if ($pro_label == "Sale" or $pro_label == "Gift") {
                                $product_price = "<del> $$pro_price </del>";
                                $product_psp_price = "| $$pro_psp_price";
                            } else {
                                $product_psp_price = "";
                                $product_price = "$$pro_price";
                            }

                            if ($pro_label == "") {
                            } else {
                                $product_label = "
                                <a class='label sale' href='#' style='color:black;'>
                                <div class='thelabel'>$pro_label</div>
                                <div class='label-background'> </div>
                                </a>
                                ";
                            }

                            echo "
                            <div class='col-md-3 col-sm-6 center-responsive'>
                            <div class='product'>
                            <a href='$pro_url'>
                            <img src='admin_area/product_images/$pro_img1' class='img-responsive'>
                            </a>
                            <div class='text'>
                            <center>
                            <p class='btn btn-primary'>$manufacturer_name</p>
                            </center>
                            <hr>
                            <h3><a href='$pro_url'>$pro_title</a></h3>
                            <p class='price'>$product_price $product_psp_price</p>
                            <p class='buttons'>
                            <a href='$pro_url' class='btn btn-default'>Подробнее</a>
                            <a href='$pro_url' class='btn btn-primary'>
                            <i class='fa fa-shopping-cart'></i> Добавить в корзину
                            </a>
                            </p>
                            </div>
                            $product_label
                            </div>
                            </div>
                            ";
                        }
                    }
                    ?>
                <?php } ?>
            </div>
        </div>
    </div>
</div>

<?php
include("includes/footer.php");
?>

<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script>
function validateForm() {
    var size = document.querySelector('select[name="product_size"]').value;
    if (size == "") {
        alert("Пожалуйста, выберите размер перед заказом.");
        return false;
    }
    return true;
}
</script>
</body>
</html>

<?php } ?>
