<?php

if(!isset($_SESSION['admin_email'])){
    echo "<script>window.open('login.php','_self')</script>";
} else {

?>

<div class="row">
    <div class="col-lg-12">
        <ol class="breadcrumb">
            <li>
                <i class="fa fa-dashboard"></i> Панель управления / Добавить категорию продукта
            </li>
        </ol>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">
                    <i class="fa fa-money fa-fw"></i> Добавить категорию продукта
                </h3>
            </div>
            <div class="panel-body">
                <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label class="col-md-3 control-label">Название категории продукта</label>
                        <div class="col-md-6">
                            <input type="text" name="p_cat_title" class="form-control">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label">Показывать как главную категорию?</label>
                        <div class="col-md-6">
                            <input type="radio" name="p_cat_top" value="yes"> <label> Да </label>
                            <input type="radio" name="p_cat_top" value="no"> <label> Нет </label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label">Выбрать изображение категории</label>
                        <div class="col-md-6">
                            <input type="file" name="p_cat_image" class="form-control">
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

if(isset($_POST['submit'])){

    $p_cat_title = $_POST['p_cat_title'];
    $p_cat_top = $_POST['p_cat_top'];
    $p_cat_image = $_FILES['p_cat_image']['name'];
    $temp_name = $_FILES['p_cat_image']['tmp_name'];

    move_uploaded_file($temp_name, "other_images/$p_cat_image");

    $insert_p_cat = "INSERT INTO product_categories (p_cat_title, p_cat_top, p_cat_image) VALUES ('$p_cat_title', '$p_cat_top', '$p_cat_image')";

    $run_p_cat = mysqli_query($con, $insert_p_cat);

    if($run_p_cat){

        echo "<script>alert('Новая категория продукта была добавлена')</script>";
        echo "<script>window.open('index.php?view_p_cats','_self')</script>";
    }

}
?>

<?php } ?>
