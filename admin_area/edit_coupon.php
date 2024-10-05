<?php

// Проверяем, установлена ли сессия администратора
if (!isset($_SESSION['admin_email'])) {

    // Если сессия не установлена, перенаправляем на страницу входа
    echo "<script>window.open('login.php', '_self')</script>";

} else {

?>

    <?php

    // Проверяем, установлен ли параметр 'edit_coupon' в URL
    if (isset($_GET['edit_coupon'])) {

        // Получаем идентификатор купона из параметра URL
        $edit_id = $_GET['edit_coupon'];

        // Запрашиваем данные купона из базы данных
        $edit_coupon = "SELECT * FROM coupons WHERE coupon_id='$edit_id'";
        $run_edit = mysqli_query($con, $edit_coupon);
        $row_edit = mysqli_fetch_array($run_edit);

        // Извлекаем данные купона
        $c_id = $row_edit['coupon_id'];
        $c_title = $row_edit['coupon_title'];
        $c_price = $row_edit['coupon_price'];
        $c_code = $row_edit['coupon_code'];
        $c_limit = $row_edit['coupon_limit'];
        $c_used = $row_edit['coupon_used'];
        $p_id = $row_edit['product_id'];

        // Запрашиваем данные продукта для купона
        $get_products = "SELECT * FROM products WHERE product_id='$p_id'";
        $run_products = mysqli_query($con, $get_products);
        $row_products = mysqli_fetch_array($run_products);

        $product_id = $row_products['product_id'];
        $product_title = $row_products['product_title'];
    }

    ?>

    <div class="row"><!-- 1 row Starts -->

        <div class="col-lg-12"><!-- col-lg-12 Starts -->

            <ol class="breadcrumb"><!-- breadcrumb Starts -->

                <li class="active">
                    <i class="fa fa-dashboard"></i> Dashboard / Edit Coupon
                </li>

            </ol><!-- breadcrumb Ends -->

        </div><!-- col-lg-12 Ends -->

    </div><!-- 1 row Ends -->

    <div class="row"><!-- 2 row Starts -->

        <div class="col-lg-12"><!-- col-lg-12 Starts -->

            <div class="panel panel-default"><!-- panel panel-default Starts -->

                <div class="panel-heading"><!-- panel-heading Starts -->

                    <h3 class="panel-title">
                        <i class="fa fa-money fa-fw"></i> Edit Coupon
                    </h3>

                </div><!-- panel-heading Ends -->

                <div class="panel-body"><!-- panel-body Starts -->

                    <!-- Форма редактирования купона -->
                    <form class="form-horizontal" method="post" action=""><!-- form-horizontal Starts -->

                        <div class="form-group"><!-- form-group Starts -->

                            <label class="col-md-3 control-label">Coupon Title</label>

                            <div class="col-md-6">
                                <input type="text" name="coupon_title" class="form-control" value="<?php echo $c_title; ?>">
                            </div>

                        </div><!-- form-group Ends -->

                        <div class="form-group"><!-- form-group Starts -->

                            <label class="col-md-3 control-label">Coupon Price</label>

                            <div class="col-md-6">
                                <input type="text" name="coupon_price" class="form-control" value="<?php echo $c_price; ?>">
                            </div>

                        </div><!-- form-group Ends -->

                        <div class="form-group"><!-- form-group Starts -->

                            <label class="col-md-3 control-label">Coupon Code</label>

                            <div class="col-md-6">
                                <input type="text" name="coupon_code" class="form-control" value="<?php echo $c_code; ?>">
                            </div>

                        </div><!-- form-group Ends -->

                        <div class="form-group"><!-- form-group Starts -->

                            <label class="col-md-3 control-label">Coupon Limit</label>

                            <div class="col-md-6">
                                <input type="number" name="coupon_limit" value="<?php echo $c_limit; ?>" class="form-control">
                            </div>

                        </div><!-- form-group Ends -->

                        <div class="form-group"><!-- form-group Starts -->

                            <label class="col-md-3 control-label">Select Coupon For Product or Bundle</label>

                            <div class="col-md-6">

                                <!-- Выпадающий список для выбора продукта или набора для купона -->
                                <select name="product_id" class="form-control">

                                    <!-- Выбранный продукт -->
                                    <option value="<?php echo $product_id; ?>"><?php echo $product_title; ?></option>

                                    <!-- Продукты -->
                                    <?php

                                    $get_p = "SELECT * FROM products WHERE status='product'";
                                    $run_p = mysqli_query($con, $get_p);

                                    while ($row_p = mysqli_fetch_array($run_p)) {
                                        $p_id = $row_p['product_id'];
                                        $p_title = $row_p['product_title'];
                                        echo "<option value='$p_id'> $p_title </option>";
                                    }

                                    ?>

                                    <option></option>
                                    <option>Select Coupon for bundle</option>
                                    <option></option>

                                    <!-- Наборы -->
                                    <?php

                                    $get_p = "SELECT * FROM products WHERE status='bundle'";
                                    $run_p = mysqli_query($con, $get_p);

                                    while ($row_p = mysqli_fetch_array($run_p)) {
                                        $p_id = $row_p['product_id'];
                                        $p_title = $row_p['product_title'];
                                        echo "<option value='$p_id'> $p_title </option>";
                                    }

                                    ?>

                                </select>

                            </div>

                        </div><!-- form-group Ends -->

                        <div class="form-group"><!-- form-group Starts -->

                            <label class="col-md-3 control-label"></label>

                            <div class="col-md-6">
                                <input type="submit" name="update" class="btn btn-primary form-control" value="Update Coupon">
                            </div>

                        </div><!-- form-group Ends -->

                    </form><!-- form-horizontal Ends -->

                </div><!-- panel-body Ends -->

            </div><!-- panel panel-default Ends -->

        </div><!-- col-lg-12 Ends -->

    </div><!-- 2 row Ends -->

    <?php

    // Обрабатываем данные из формы при отправке
    if (isset($_POST['update'])) {

        // Получаем данные из формы
        $coupon_title = $_POST['coupon_title'];
        $coupon_price = $_POST['coupon_price'];
        $coupon_code = $_POST['coupon_code'];
        $coupon_limit = $_POST['coupon_limit'];
        $product_id = $_POST['product_id'];

        // Обновляем данные купона в базе данных
        $update_coupon = "UPDATE coupons SET product_id='$product_id', coupon_title='$coupon_title', coupon_price='$coupon_price', coupon_code='$coupon_code', coupon_limit='$coupon_limit', coupon_used='$c_used' WHERE coupon_id='$c_id'";
        $run_coupon = mysqli_query($con, $update_coupon);

        // Проверяем успешность обновления и перенаправляем
        if ($run_coupon) {
            echo "<script>alert('One Coupon Has Been Updated')</script>";
            echo "<script>window.open('index.php?view_coupons', '_self')</script>";
        }
    }
}
?>