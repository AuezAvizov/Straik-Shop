<?php
error_reporting(0);
ini_set('display_errors', 0);
session_start();

include("includes/db.php");
include("functions.php");
include("includes/main.php");
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Корзина покупок</title>
    <link rel="stylesheet" href="styles/bootstrap.min.css">
    <link rel="stylesheet" href="styles/backend.css">
    <link rel="stylesheet" href="styles/style.css">
</head>
<body>

<div class="nero">
    <div class="nero__heading">
        <span class="nero__bold">МАГАЗИН</span> Корзина
    </div>
</div>

<div id="content">
    <div class="container">
        <div class="col-md-9" id="cart">
            <div class="box">
                <form action="cart.php" method="post" enctype="multipart/form-data">
                    <h1>Корзина покупок</h1>

                    <?php
                    $ip_add = getRealUserIp();
                    $select_cart = "SELECT * FROM cart WHERE ip_add='$ip_add'";
                    $run_cart = mysqli_query($con, $select_cart);
                    $count = mysqli_num_rows($run_cart);
                    ?>

                    <p class="text-muted">В вашей корзине сейчас <?php echo $count; ?> товар(ов).</p>

                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th colspan="2">Товар</th>
                                    <th>Количество</th>
                                    <th>Цена за единицу</th>
                                    <th>Размер</th>
                                    <th>Удалить</th>
                                    <th colspan="2">Промежуточный итог</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $total = 0;

                                while ($row_cart = mysqli_fetch_array($run_cart)) {

                                    $pro_id = $row_cart['p_id'];
                                    $pro_size = $row_cart['size'];
                                    $pro_qty = $row_cart['qty'];
                                    $only_price = $row_cart['p_price'];

                                    $get_products = "SELECT * FROM products WHERE product_id='$pro_id'";
                                    $run_products = mysqli_query($con, $get_products);

                                    while ($row_products = mysqli_fetch_array($run_products)) {

                                        $product_title = $row_products['product_title'];
                                        $product_img1 = $row_products['product_img1'];
                                        $sub_total = $only_price * $pro_qty;
                                        $_SESSION['pro_qty'] = $pro_qty;
                                        $total += $sub_total;
                                ?>
                                <tr>
                                    <td><img src="admin_area/product_images/<?php echo $product_img1; ?>"></td>
                                    <td><a href="#"><?php echo $product_title; ?></a></td>
                                    <td>
                                        <input type="text" name="quantity" value="<?php echo $_SESSION['pro_qty']; ?>" data-product_id="<?php echo $pro_id; ?>" class="quantity form-control">
                                    </td>
                                    <td>$<?php echo $only_price; ?>.00</td>
                                    <td><?php echo $pro_size; ?></td>
                                    <td><input type="checkbox" name="remove[]" value="<?php echo $pro_id; ?>"></td>
                                    <td>$<?php echo $sub_total; ?>.00</td>
                                </tr>
                                <?php }
                                } ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="5">Итого</th>
                                    <th colspan="2">$<?php echo $total; ?>.00</th>
                                </tr>
                            </tfoot>
                        </table>

                        <div class="form-inline pull-right">
                            <div class="form-group">
                                <label>Промокод :</label>
                                <input type="text" name="code" class="form-control">
                            </div>
                            <input class="btn btn-primary" type="submit" name="apply_coupon" value="Применить Промокод">
                        </div>

                    </div>

                    <div class="box-footer">
                        <div class="pull-left">
                            <a href="index.php" class="btn btn-default">
                                <i class="fa fa-chevron-left"></i> Продолжить покупки
                            </a>
                        </div>

                        <div class="pull-right">
                            <button class="btn btn-info" type="submit" name="update" value="Обновить корзину">
                                <i class="fa fa-refresh"></i> Обновить корзину
                            </button>
                            <a href="checkout.php" class="btn btn-success">
                                Перейти к оформлению <i class="fa fa-chevron-right"></i>
                            </a>
                        </div>
                    </div>

                </form>

                <?php
                if (isset($_POST['apply_coupon'])) {
                    $code = $_POST['code'];

                    if ($code == "") {
                    } else {
                        $get_coupons = "SELECT * FROM coupons WHERE coupon_code='$code'";
                        $run_coupons = mysqli_query($con, $get_coupons);
                        $check_coupons = mysqli_num_rows($run_coupons);

                        if ($check_coupons == 1) {
                            $row_coupons = mysqli_fetch_array($run_coupons);
                            $coupon_pro = $row_coupons['product_id'];
                            $coupon_price = $row_coupons['coupon_price'];
                            $coupon_limit = $row_coupons['coupon_limit'];
                            $coupon_used = $row_coupons['coupon_used'];

                            if ($coupon_limit == $coupon_used) {
                                echo "<script>alert('Ваш промокод истек')</script>";
                            } else {
                                $get_cart = "SELECT * FROM cart WHERE p_id='$coupon_pro' AND ip_add='$ip_add'";
                                $run_cart = mysqli_query($con, $get_cart);
                                $check_cart = mysqli_num_rows($run_cart);

                                if ($check_cart == 1) {
                                    $add_used = "UPDATE coupons SET coupon_used=coupon_used+1 WHERE coupon_code='$code'";
                                    $run_used = mysqli_query($con, $add_used);
                                    $update_cart = "UPDATE cart SET p_price='$coupon_price' WHERE p_id='$coupon_pro' AND ip_add='$ip_add'";
                                    $run_update = mysqli_query($con, $update_cart);
                                    echo "<script>alert('Ваш промокод применен')</script>";
                                    echo "<script>window.open('cart.php','_self')</script>";
                                } else {
                                    echo "<script>alert('Товар не найден в корзине')</script>";
                                }
                            }
                        } else {
                            echo "<script>alert('Ваш промокод недействителен')</script>";
                        }
                    }
                }

                function update_cart() {
                    global $con;

                    if (isset($_POST['update'])) {
                        foreach ($_POST['remove'] as $remove_id) {
                            $delete_product = "DELETE FROM cart WHERE p_id='$remove_id'";
                            $run_delete = mysqli_query($con, $delete_product);

                            if ($run_delete) {
                                echo "<script>window.open('cart.php','_self')</script>";
                            }
                        }
                    }
                }

                echo @$up_cart = update_cart();
                ?>
                
                <div id="row same-height-row">
                    <div class="col-md-3 col-sm-6">
                        <div class="box same-height headline">
                            <h3 class="text-center">Вам могут понравиться эти товары</h3>
                        </div>
                    </div>

                    <?php
                    $get_products = "SELECT * FROM products ORDER BY RAND() LIMIT 0,3";
                    $run_products = mysqli_query($con, $get_products);

                    while ($row_products = mysqli_fetch_array($run_products)) {
                        $pro_id = $row_products['product_id'];
                        $pro_title = $row_products['product_title'];
                        $pro_price = $row_products['product_price'];
                        $pro_img1 = $row_products['product_img1'];
                        $pro_label = $row_products['product_label'];
                        $manufacturer_id = $row_products['manufacturer_id'];

                        $get_manufacturer = "SELECT * FROM manufacturers WHERE manufacturer_id='$manufacturer_id'";
                        $run_manufacturer = mysqli_query($con, $get_manufacturer);
                        $row_manufacturer = mysqli_fetch_array($run_manufacturer);
                        $manufacturer_name = $row_manufacturer['manufacturer_title'];
                        $pro_psp_price = $row_products['product_psp_price'];
                        $pro_url = $row_products['product_url'];

                        if ($pro_label == "Sale" || $pro_label == "Gift") {
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
                                <div class='label-background'></div>
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
                                        <p class='btn btn-primary'> $manufacturer_name </p>
                                    </center>
                                    <h3><a href='$pro_url'> $pro_title </a></h3>
                                    <p class='price'> $product_price $product_psp_price </p>
                                    <p class='buttons'>
                                        <a href='$pro_url' class='btn btn-default'>Посмотреть</a>
                                        <a href='$pro_url' class='btn btn-primary'>
                                            <i class='fa fa-shopping-cart'></i> В корзину
                                        </a>
                                    </p>
                                </div>
                                $product_label
                            </div>
                        </div>
                        ";
                    }
                    ?>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div id="order-summary" class="box">
                <div class="box-header">
                    <h3>Итоги заказа</h3>
                </div>

                <p class="text-muted">Доставка и дополнительные расходы рассчитываются исходя из вашего региона доставки.</p>

                <div class="table-responsive">
                    <table class="table">
                        <tbody>
                            <tr>
                                <td>Итого товаров</td>
                                <th>$<?php echo $total; ?>.00</th>
                            </tr>
                            <tr>
                                <td>Доставка</td>
                                <th>$0.00</th>
                            </tr>
                            <tr>
                                <td>Налог</td>
                                <th>$0.00</th>
                            </tr>
                            <tr class="total">
                                <td>Общая сумма</td>
                                <th>$<?php echo $total; ?>.00</th>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include("includes/footer.php"); ?>
<script src="js/jquery-2.2.4.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/main.js"></script>

</body>
</html>
