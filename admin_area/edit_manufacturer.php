<?php

// Проверяем, установлена ли сессия администратора
if (!isset($_SESSION['admin_email'])) {

    // Если сессия не установлена, перенаправляем на страницу входа
    echo "<script>window.open('login.php', '_self')</script>";

} else {

?>

    <?php

    // Проверяем, установлен ли параметр 'edit_manufacturer' в URL
    if (isset($_GET['edit_manufacturer'])) {

        // Получаем идентификатор производителя из параметра URL
        $edit_manufacturer = $_GET['edit_manufacturer'];

        // Запрашиваем данные производителя из базы данных
        $get_manufacturer = "SELECT * FROM manufacturers WHERE manufacturer_id='$edit_manufacturer'";
        $run_manufacturer = mysqli_query($con, $get_manufacturer);
        $row_manufacturer = mysqli_fetch_array($run_manufacturer);

        // Извлекаем данные производителя
        $m_id = $row_manufacturer['manufacturer_id'];
        $m_title = $row_manufacturer['manufacturer_title'];
        $m_top = $row_manufacturer['manufacturer_top'];
        $m_image = $row_manufacturer['manufacturer_image'];
        $new_m_image = $row_manufacturer['manufacturer_image'];
    }

    ?>

    <div class="row"><!-- 1 row Starts -->

        <div class="col-lg-12"><!-- col-lg-12 Starts -->

            <ol class="breadcrumb"><!-- breadcrumb Starts -->

                <li class="active">
                    <i class="fa fa-dashboard"></i> Dashboard / Edit Manufacturer
                </li>

            </ol><!-- breadcrumb Ends -->

        </div><!-- col-lg-12 Ends -->

    </div><!-- 1 row Ends -->

    <div class="row"><!-- 2 row Starts -->

        <div class="col-lg-12"><!-- col-lg-12 Starts -->

            <div class="panel panel-default"><!-- panel panel-default Starts -->

                <div class="panel-heading"><!-- panel-heading Starts -->

                    <h3 class="panel-title"><!-- panel-title Starts -->
                        <i class="fa fa-money fa-fw"></i> Edit Manufacturer
                    </h3><!-- panel-title Ends -->

                </div><!-- panel-heading Ends -->

                <div class="panel-body"><!-- panel-body Starts -->

                    <!-- Форма редактирования производителя -->
                    <form class="form-horizontal" action="" method="post" enctype="multipart/form-data"><!-- form-horizontal Starts -->

                        <div class="form-group"><!-- form-group Starts -->

                            <label class="col-md-3 control-label">Manufacturer Name</label>

                            <div class="col-md-6">
                                <input type="text" name="manufacturer_name" class="form-control" value="<?php echo $m_title; ?>">
                            </div>

                        </div><!-- form-group Ends -->

                        <div class="form-group"><!-- form-group Starts -->

                            <label class="col-md-3 control-label">Show as Top Manufacturers</label>

                            <div class="col-md-6">
                                <input type="radio" name="manufacturer_top" value="yes" 
                                    <?php if ($m_top == 'no') {} else { echo "checked='checked'"; } ?> >
                                <label>Yes</label>

                                <input type="radio" name="manufacturer_top" value="no" 
                                    <?php if ($m_top == 'no') { echo "checked='checked'"; } else {} ?> >
                                <label>No</label>
                            </div>

                        </div><!-- form-group Ends -->

                        <div class="form-group"><!-- form-group Starts -->

                            <label class="col-md-3 control-label">Select Manufacturer Image</label>

                            <div class="col-md-6">
                                <input type="file" name="manufacturer_image" class="form-control">
                                <br>
                                <img src="other_images/<?php echo $m_image; ?>" width="70" height="70">
                            </div>

                        </div><!-- form-group Ends -->

                        <div class="form-group"><!-- form-group Starts -->

                            <label class="col-md-3 control-label"></label>

                            <div class="col-md-6">
                                <input type="submit" name="update" class="form-control btn btn-primary" value="Update Manufacturer">
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
        $manufacturer_name = $_POST['manufacturer_name'];
        $manufacturer_top = $_POST['manufacturer_top'];
        $manufacturer_image = $_FILES['manufacturer_image']['name'];
        $tmp_name = $_FILES['manufacturer_image']['tmp_name'];

        // Загружаем новое изображение, если оно есть
        move_uploaded_file($tmp_name, "other_images/$manufacturer_image");

        // Если изображение не было выбрано, используем старое изображение
        if (empty($manufacturer_image)) {
            $manufacturer_image = $new_m_image;
        }

        // Обновляем данные производителя в базе данных
        $update_manufacturer = "UPDATE manufacturers SET manufacturer_title='$manufacturer_name', manufacturer_top='$manufacturer_top', manufacturer_image='$manufacturer_image' WHERE manufacturer_id='$m_id'";
        $run_manufacturer = mysqli_query($con, $update_manufacturer);

        // Проверяем успешность обновления и перенаправляем
        if ($run_manufacturer) {
            echo "<script>alert('Manufacturer Has Been Updated')</script>";
            echo "<script>window.open('index.php?view_manufacturers', '_self')</script>";
        }
    }

}

?>
