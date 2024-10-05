<?php

if (!isset($_SESSION['admin_email'])) {
    echo "<script>window.open('login.php','_self')</script>";
} else {

?>

<div class="row">
    <div class="col-lg-12">
        <ol class="breadcrumb">
            <li>
                <i class="fa fa-dashboard"></i> Панель управления / Добавить категорию
            </li>
        </ol>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">
                    <i class="fa fa-money fa-fw"></i> Добавить категорию
                </h3>
            </div>

            <div class="panel-body">
                <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label class="col-md-3 control-label"> Название категории </label>
                        <div class="col-md-6">
                            <input type="text" name="cat_title" class="form-control">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label"> Показать как главную категорию </label>
                        <div class="col-md-6">
                            <input type="radio" name="cat_top" value="yes">
                            <label>Да</label>
                            <input type="radio" name="cat_top" value="no">
                            <label>Нет</label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label"> Выберите изображение категории </label>
                        <div class="col-md-6">
                            <input type="file" name="cat_image" class="form-control">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label"></label>
                        <div class="col-md-6">
                            <input type="submit" name="submit" value="Добавить категорию" class="btn btn-primary form-control">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php

if (isset($_POST['submit'])) {
    $cat_title = $_POST['cat_title'];
    $cat_top = $_POST['cat_top'];
    $cat_image = $_FILES['cat_image']['name'];
    $temp_name = $_FILES['cat_image']['tmp_name'];

    move_uploaded_file($temp_name, "other_images/$cat_image");

    $insert_cat = "insert into categories (cat_title,cat_top,cat_image) values ('$cat_title','$cat_top','$cat_image')";
    $run_cat = mysqli_query($con, $insert_cat);

    if ($run_cat) {
        echo "<script> alert('Новая категория была добавлена')</script>";
        echo "<script> window.open('index.php?view_cats','_self') </script>";
    }
}

?>

<?php } ?>
