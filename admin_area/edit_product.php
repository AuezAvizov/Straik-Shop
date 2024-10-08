<?php

// Проверяем, установлена ли сессия администратора
if (!isset($_SESSION['admin_email'])) {

    // Если сессия не установлена, перенаправляем на страницу входа
    echo "<script>window.open('login.php', '_self')</script>";

} else {

?>

    <?php

    // Проверяем, установлен ли параметр 'edit_product' в URL
    if (isset($_GET['edit_product'])) {

        // Получаем идентификатор продукта из параметра URL
        $edit_id = $_GET['edit_product'];

        // Запрашиваем данные о продукте из базы данных
        $get_p = "SELECT * FROM products WHERE product_id='$edit_id'";
        $run_edit = mysqli_query($con, $get_p);
        
        // Проверка на наличие результата
        if (mysqli_num_rows($run_edit) > 0) {
            $row_edit = mysqli_fetch_array($run_edit);

            // Извлекаем данные продукта
            $p_id = $row_edit['product_id'];
            $p_title = $row_edit['product_title'];
            $p_cat = $row_edit['p_cat_id'];
            $cat = $row_edit['cat_id'];
            $m_id = $row_edit['manufacturer_id'];
            $p_image1 = $row_edit['product_img1'];
            $p_image2 = $row_edit['product_img2'];
            $p_image3 = $row_edit['product_img3'];
            $new_p_image1 = $row_edit['product_img1'];
            $new_p_image2 = $row_edit['product_img2'];
            $new_p_image3 = $row_edit['product_img3'];
            $p_price = $row_edit['product_price'];
            $p_desc = $row_edit['product_desc'];
            $p_keywords = $row_edit['product_keywords'];
            $psp_price = $row_edit['product_psp_price'];
            $p_label = $row_edit['product_label'];
            $p_url = $row_edit['product_url'];
            $p_features = $row_edit['product_features'];
            $p_video = $row_edit['product_video'];

            // Запрашиваем данные о производителе
            $get_manufacturer = "SELECT * FROM manufacturers WHERE manufacturer_id='$m_id'";
            $run_manufacturer = mysqli_query($con, $get_manufacturer);
            $row_manufacturer = mysqli_fetch_array($run_manufacturer);
            $manufacturer_id = $row_manufacturer['manufacturer_id'];
            $manufacturer_title = $row_manufacturer['manufacturer_title'];

            // Запрашиваем данные о категории продукта
            $get_p_cat = "SELECT * FROM product_categories WHERE p_cat_id='$p_cat'";
            $run_p_cat = mysqli_query($con, $get_p_cat);
            $row_p_cat = mysqli_fetch_array($run_p_cat);
            $p_cat_title = $row_p_cat['p_cat_title'];

            // Запрашиваем данные о категории
            $get_cat = "SELECT * FROM categories WHERE cat_id='$cat'";
            $run_cat = mysqli_query($con, $get_cat);
            $row_cat = mysqli_fetch_array($run_cat);
            $cat_title = $row_cat['cat_title'];
        } else {
            // Обработка случая, когда продукт не найден
            echo "<script>alert('Product not found');</script>";
            echo "<script>window.open('index.php?view_products', '_self')</script>";
        }
    }

    ?>

    <!DOCTYPE html>
    <html>
    <head>
        <title>Edit Products</title>

        <!-- Подключаем TinyMCE для редактирования текста -->
        <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
        <script>
            tinymce.init({ selector: '#product_desc, #product_features' });
        </script>
    </head>
    <body>

    <div class="row"><!-- row Starts -->
        <div class="col-lg-12"><!-- col-lg-12 Starts -->
            <ol class="breadcrumb"><!-- breadcrumb Starts -->
                <li class="active">
                    <i class="fa fa-dashboard"></i> Dashboard / Edit Products
                </li>
            </ol><!-- breadcrumb Ends -->
        </div><!-- col-lg-12 Ends -->
    </div><!-- row Ends -->

    <div class="row"><!-- 2 row Starts -->
        <div class="col-lg-12"><!-- col-lg-12 Starts -->
            <div class="panel panel-default"><!-- panel panel-default Starts -->
                <div class="panel-heading"><!-- panel-heading Starts -->
                    <h3 class="panel-title">
                        <i class="fa fa-money fa-fw"></i> Edit Products
                    </h3>
                </div><!-- panel-heading Ends -->

                <div class="panel-body"><!-- panel-body Starts -->
                    <!-- Форма редактирования продукта -->
                    <form class="form-horizontal" method="post" enctype="multipart/form-data"><!-- form-horizontal Starts -->

                        <div class="form-group"><!-- form-group Starts -->
                            <label class="col-md-3 control-label">Product Title</label>
                            <div class="col-md-6">
                                <input type="text" name="product_title" class="form-control" required value="<?php echo $p_title; ?>">
                            </div>
                        </div><!-- form-group Ends -->

                        <div class="form-group"><!-- form-group Starts -->
                            <label class="col-md-3 control-label">Product URL</label>
                            <div class="col-md-6">
                                <input type="text" name="product_url" class="form-control" required value="<?php echo $p_url; ?>">
                                <br>
                                <p style="font-size:15px; font-weight:bold;">Product URL Example: navy-blue-t-shirt</p>
                            </div>
                        </div><!-- form-group Ends -->

                        <div class="form-group"><!-- form-group Starts -->
                            <label class="col-md-3 control-label">Select A Manufacturer</label>
                            <div class="col-md-6">
                                <select name="manufacturer" class="form-control">
                                    <option value="<?php echo $manufacturer_id; ?>"><?php echo $manufacturer_title; ?></option>
                                    <?php
                                    // Запрашиваем список производителей
                                    $get_manufacturer = "SELECT * FROM manufacturers";
                                    $run_manufacturer = mysqli_query($con, $get_manufacturer);
                                    while ($row_manufacturer = mysqli_fetch_array($run_manufacturer)) {
                                        $manufacturer_id = $row_manufacturer['manufacturer_id'];
                                        $manufacturer_title = $row_manufacturer['manufacturer_title'];
                                        echo "<option value='$manufacturer_id'>$manufacturer_title</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div><!-- form-group Ends -->

                        <div class="form-group"><!-- form-group Starts -->
                            <label class="col-md-3 control-label">Product Category</label>
                            <div class="col-md-6">
                                <select name="product_cat" class="form-control">
                                    <option value="<?php echo $p_cat; ?>"><?php echo $p_cat_title; ?></option>
                                    <?php
                                    // Запрашиваем список категорий продуктов
                                    $get_p_cats = "SELECT * FROM product_categories";
                                    $run_p_cats = mysqli_query($con, $get_p_cats);
                                    while ($row_p_cats = mysqli_fetch_array($run_p_cats)) {
                                        $p_cat_id = $row_p_cats['p_cat_id'];
                                        $p_cat_title = $row_p_cats['p_cat_title'];
                                        echo "<option value='$p_cat_id'>$p_cat_title</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div><!-- form-group Ends -->

                        <div class="form-group"><!-- form-group Starts -->
                            <label class="col-md-3 control-label">Category</label>
                            <div class="col-md-6">
                                <select name="cat" class="form-control">
                                    <option value="<?php echo $cat; ?>"><?php echo $cat_title; ?></option>
                                    <?php
                                    // Запрашиваем список категорий
                                    $get_cat = "SELECT * FROM categories";
                                    $run_cat = mysqli_query($con, $get_cat);
                                    while ($row_cat = mysqli_fetch_array($run_cat)) {
                                        $cat_id = $row_cat['cat_id'];
                                        $cat_title = $row_cat['cat_title'];
                                        echo "<option value='$cat_id'>$cat_title</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div><!-- form-group Ends -->

                        <div class="form-group"><!-- form-group Starts -->
                            <label class="col-md-3 control-label">Product Image 1</label>
                         <div class="col-md-6">
                              <input type="file" name="product_img1" class="form-control" accept=".jpg, .jpeg, .png">
                                 <br>
                                     <img src="product_images/<?php echo $p_image1; ?>" width="70" height="70">
                                        </div>
                                    </div><!-- form-group Ends -->

                        <div class="form-group"><!-- form-group Starts -->
                            <label class="col-md-3 control-label">Product Image 2</label>
                                <div class="col-md-6">
                                    <input type="file" name="product_img2" class="form-control" accept=".jpg, .jpeg, .png">
                                        <br>
                                        <img src="product_images/<?php echo $p_image2; ?>" width="70" height="70">
                                </div>
                            </div><!-- form-group Ends -->

                        <div class="form-group"><!-- form-group Starts -->
                                <label class="col-md-3 control-label">Product Image 3</label>
                            <div class="col-md-6">
                                <input type="file" name="product_img3" class="form-control" accept=".jpg, .jpeg, .png">
                            <br>
                        <img src="product_images/<?php echo $p_image3; ?>" width="70" height="70">
                                </div>
                        </div><!-- form-group Ends -->


                        <div class="form-group"><!-- form-group Starts -->
                            <label class="col-md-3 control-label">Product Price</label>
                            <div class="col-md-6">
                                <input type="text" name="product_price" class="form-control" required value="<?php echo $p_price; ?>">
                            </div>
                        </div><!-- form-group Ends -->

                        <div class="form-group"><!-- form-group Starts -->
                            <label class="col-md-3 control-label">Product Sale Price</label>
                            <div class="col-md-6">
                                <input type="text" name="psp_price" class="form-control" required value="<?php echo $psp_price; ?>">
                            </div>
                        </div><!-- form-group Ends -->

                        <div class="form-group"><!-- form-group Starts -->
                            <label class="col-md-3 control-label">Product Keywords</label>
                            <div class="col-md-6">
                                <input type="text" name="product_keywords" class="form-control" required value="<?php echo $p_keywords; ?>">
                            </div>
                        </div><!-- form-group Ends -->

                        <div class="form-group"><!-- form-group Starts -->
                            <label class="col-md-3 control-label">Product Tabs</label>
                            <div class="col-md-6">
                                <ul class="nav nav-tabs"><!-- nav nav-tabs Starts -->
                                    <li class="active"><a data-toggle="tab" href="#description">Product Description</a></li>
                                    <li><a data-toggle="tab" href="#features">Product Features</a></li>
                                    <li><a data-toggle="tab" href="#video">Sounds And Videos</a></li>
                                </ul><!-- nav nav-tabs Ends -->
                                <div class="tab-content"><!-- tab-content Starts -->
                                    <div id="description" class="tab-pane fade in active"><!-- description tab-pane fade in active Starts -->
                                        <br>
                                        <textarea name="product_desc" class="form-control" rows="15" id="product_desc"><?php echo $p_desc; ?></textarea>
                                    </div><!-- description tab-pane fade in active Ends -->
                                    <div id="features" class="tab-pane fade in"><!-- features tab-pane fade in Starts -->
                                        <br>
                                        <textarea name="product_features" class="form-control" rows="15" id="product_features"><?php echo $p_features; ?></textarea>
                                    </div><!-- features tab-pane fade in Ends -->
                                    <div id="video" class="tab-pane fade in"><!-- video tab-pane fade in Starts -->
                                        <br>
                                        <textarea name="product_video" class="form-control" rows="15"><?php echo $p_video; ?></textarea>
                                    </div><!-- video tab-pane fade in Ends -->
                                </div><!-- tab-content Ends -->
                            </div>
                        </div><!-- form-group Ends -->

                        <div class="form-group"><!-- form-group Starts -->
                            <label class="col-md-3 control-label">Product Label</label>
                            <div class="col-md-6">
                                <input type="text" name="product_label" class="form-control" required value="<?php echo $p_label; ?>">
                            </div>
                        </div><!-- form-group Ends -->

                        <div class="form-group"><!-- form-group Starts -->
                            <label class="col-md-3 control-label"></label>
                            <div class="col-md-6">
                                <input type="submit" name="update" value="Update Product" class="btn btn-primary form-control">
                            </div>
                        </div><!-- form-group Ends -->

                    </form><!-- form-horizontal Ends -->
                </div><!-- panel-body Ends -->
            </div><!-- panel panel-default Ends -->
        </div><!-- col-lg-12 Ends -->
    </div><!-- 2 row Ends -->

    </body>
    </html>

    <?php

    // Обработка формы после отправки
    if (isset($_POST['update'])) {
        $product_title = $_POST['product_title'];
        $product_cat = $_POST['product_cat'];
        $cat = $_POST['cat'];
        $manufacturer_id = $_POST['manufacturer'];
        $product_price = $_POST['product_price'];
        $product_desc = $_POST['product_desc'];
        $product_keywords = $_POST['product_keywords'];
        $psp_price = $_POST['psp_price'];
        $product_label = $_POST['product_label'];
        $product_url = $_POST['product_url'];
        $product_features = $_POST['product_features'];
        $product_video = $_POST['product_video'];
        $status = "product";

        // Обработка изображений
        $product_img1 = $_FILES['product_img1']['name'];
        $product_img2 = $_FILES['product_img2']['name'];
        $product_img3 = $_FILES['product_img3']['name'];
        $temp_name1 = $_FILES['product_img1']['tmp_name'];
        $temp_name2 = $_FILES['product_img2']['tmp_name'];
        $temp_name3 = $_FILES['product_img3']['tmp_name'];

        $allowed_types = ['image/jpeg', 'image/png'];
        $product_img1_type = $_FILES['product_img1']['type'];
        $product_img2_type = $_FILES['product_img2']['type'];
        $product_img3_type = $_FILES['product_img3']['type'];
        // Если изображение не было загружено, используем старое изображение
        if (empty($product_img1)) {
            $product_img1 = $new_p_image1;
        }
        if (empty($product_img2)) {
            $product_img2 = $new_p_image2;
        }
        if (empty($product_img3)) {
            $product_img3 = $new_p_image3;
        }
        if (!in_array($product_img1_type, $allowed_types) || !in_array($product_img2_type, $allowed_types) || !in_array($product_img3_type, $allowed_types)) {
            echo "<script>alert('Only JPG and PNG files are allowed.')</script>";
            echo "<script>window.open('index.php?view_products','_self')</script>";
            exit();
        }
        // Перемещаем загруженные файлы
        move_uploaded_file($temp_name1, "product_images/$product_img1");
        move_uploaded_file($temp_name2, "product_images/$product_img2");
        move_uploaded_file($temp_name3, "product_images/$product_img3");

        // Обновляем данные продукта в базе данных
        $update_product = "UPDATE products SET p_cat_id='$product_cat', cat_id='$cat', manufacturer_id='$manufacturer_id', date=NOW(), product_title='$product_title', product_url='$product_url', product_img1='$product_img1', product_img2='$product_img2', product_img3='$product_img3', product_price='$product_price', product_psp_price='$psp_price', product_desc='$product_desc', product_features='$product_features', product_video='$product_video', product_keywords='$product_keywords', product_label='$product_label', status='$status' WHERE product_id='$p_id'";
        $run_product = mysqli_query($con, $update_product);

        // Если обновление прошло успешно, отображаем сообщение
        if ($run_product) {
            echo "<script> alert('Product has been updated successfully') </script>";
            echo "<script>window.open('index.php?view_products', '_self')</script>";
        }
    }
    ?>
<?php } ?>
