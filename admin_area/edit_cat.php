<?php

// Проверяем, установлена ли сессия администратора
if (!isset($_SESSION['admin_email'])) {

    // Если сессия не установлена, перенаправляем на страницу входа
    echo "<script>window.open('login.php', '_self')</script>";

} else {

    // Проверяем, есть ли параметр 'edit_cat' в запросе
    if (isset($_GET['edit_cat'])) {

        // Получаем ID категории из запроса
        $edit_id = $_GET['edit_cat'];

        // Запрашиваем данные о категории из базы данных
        $edit_cat = "SELECT * FROM categories WHERE cat_id='$edit_id'";
        $run_edit = mysqli_query($con, $edit_cat);
        $row_edit = mysqli_fetch_array($run_edit);

        // Извлекаем данные категории
        $c_id = $row_edit['cat_id'];
        $c_title = $row_edit['cat_title'];
        $c_top = $row_edit['cat_top'];
        $c_image = $row_edit['cat_image'];

        // Сохраняем текущее изображение категории для использования, если новое не загружено
        $new_c_image = $row_edit['cat_image'];
    }
?>

    <div class="row"><!-- 1 row Starts -->

        <div class="col-lg-12"><!-- col-lg-12 Starts -->

            <ol class="breadcrumb"><!-- breadcrumb Starts -->

                <li>
                    <i class="fa fa-dashboard"></i> Dashboard / Edit Category
                </li>

            </ol><!-- breadcrumb Ends -->

        </div><!-- col-lg-12 Ends -->

    </div><!-- 1 row Ends -->


    <div class="row"><!-- 2 row Starts -->

        <div class="col-lg-12"><!-- col-lg-12 Starts -->

            <div class="panel panel-default"><!-- panel panel-default Starts -->

                <div class="panel-heading"><!-- panel-heading Starts -->

                    <h3 class="panel-title"><!-- panel-title Starts -->
                        <i class="fa fa-money fa-fw"></i> Edit Category
                    </h3><!-- panel-title Ends -->

                </div><!-- panel-heading Ends -->

                <div class="panel-body"><!-- panel-body Starts -->

                    <!-- Форма редактирования категории -->
                    <form class="form-horizontal" action="" method="post" enctype="multipart/form-data"><!-- form-horizontal Starts -->

                        <div class="form-group"><!-- form-group Starts -->

                            <label class="col-md-3 control-label">Category Title</label>

                            <div class="col-md-6">
                                <input type="text" name="cat_title" class="form-control" value="<?php echo $c_title; ?>">
                            </div>

                        </div><!-- form-group Ends -->

                        <div class="form-group"><!-- form-group Starts -->

                            <label class="col-md-3 control-label">Show as Category Top</label>

                            <div class="col-md-6">
                                <input type="radio" name="cat_top" value="yes" 
                                    <?php if ($c_top == 'no') {} else { echo "checked='checked'"; } ?>>
                                <label>Yes</label>

                                <input type="radio" name="cat_top" value="no" 
                                    <?php if ($c_top == 'no') { echo "checked='checked'"; } else {} ?>>
                                <label>No</label>
                            </div>

                        </div><!-- form-group Ends -->

                        <div class="form-group"><!-- form-group Starts -->

                            <label class="col-md-3 control-label">Select Category Image</label>

                            <div class="col-md-6">
                                <input type="file" name="cat_image" class="form-control">
                                <br>
                                <!-- Отображаем текущее изображение категории -->
                                <img src="other_images/<?php echo $c_image; ?>" width="70" height="70">
                            </div>

                        </div><!-- form-group Ends -->

                        <div class="form-group"><!-- form-group Starts -->

                            <label class="col-md-3 control-label"></label>

                            <div class="col-md-6">
                                <input type="submit" name="update" value="Update Category" class="btn btn-primary form-control">
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
        $cat_title = $_POST['cat_title'];
        $cat_top = $_POST['cat_top'];

        // Получаем данные о загруженном изображении
        $cat_image = $_FILES['cat_image']['name'];
        $temp_name = $_FILES['cat_image']['tmp_name'];

        // Загружаем изображение на сервер
        move_uploaded_file($temp_name, "other_images/$cat_image");

        // Если новое изображение не загружено, сохраняем старое
        if (empty($cat_image)) {
            $cat_image = $new_c_image;
        }

        // Обновляем данные категории в базе данных
        $update_cat = "UPDATE categories SET cat_title='$cat_title', cat_top='$cat_top', cat_image='$cat_image' WHERE cat_id='$c_id'";
        $run_cat = mysqli_query($con, $update_cat);

        // Сообщаем об успешном обновлении и перенаправляем
        if ($run_cat) {
            echo "<script>alert('One Category Has Been Updated')</script>";
            echo "<script>window.open('index.php?view_cats', '_self')</script>";
        }
    }
}
?>
