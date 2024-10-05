<?php

// Проверяем, установлена ли сессия с электронной почтой администратора
if (!isset($_SESSION['admin_email'])) {
    // Если сессия не установлена, перенаправляем на страницу входа
    echo "<script>window.open('login.php','_self')</script>";
} else {

    // Проверяем, установлен ли параметр 'delete_p_cat' в URL
    if (isset($_GET['delete_p_cat'])) {
        // Получаем ID категории продукта для удаления
        $delete_p_cat_id = $_GET['delete_p_cat'];

        // Запрос на удаление категории продукта из базы данных
        $delete_p_cat = "DELETE FROM product_categories WHERE p_cat_id='$delete_p_cat_id'";

        // Выполняем запрос
        $run_delete = mysqli_query($con, $delete_p_cat);

        // Проверяем, выполнен ли запрос успешно
        if ($run_delete) {
            // Если успешно, выводим сообщение об успешном удалении
            echo "<script>alert('Одна категория продукта была удалена')</script>";

            // Перенаправляем на страницу просмотра категорий продуктов
            echo "<script>window.open('index.php?view_p_cats','_self')</script>";
        }
    }
}
?>
