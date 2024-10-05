<?php

if (!isset($_SESSION['admin_email'])) {

    echo "<script>window.open('login.php','_self')</script>";
} else {

    if (isset($_GET['delete_manufacturer'])) {
        // Получаем ID производителя для удаления
        $delete_id = $_GET['delete_manufacturer'];

        $delete_manufacturer = "DELETE FROM manufacturers WHERE manufacturer_id='$delete_id'";

        // Выполняем запрос
        $run_manufacturer = mysqli_query($con, $delete_manufacturer);

        if ($run_manufacturer) {

            echo "<script>alert('Один производитель был удален')</script>";

            echo "<script>window.open('index.php?view_manufacturers','_self')</script>";
        }
    }
}
?>
