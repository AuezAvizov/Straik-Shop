<?php

// Проверяем, установлена ли сессия с электронной почтой администратора
if (!isset($_SESSION['admin_email'])) {
    // Если сессия не установлена, перенаправляем на страницу входа
    echo "<script>window.open('login.php','_self')</script>";
} else {

    // Проверяем, установлен ли параметр 'delete_product' в URL
    if (isset($_GET['delete_product'])) {
        // Получаем ID продукта для удаления
        $delete_id = $_GET['delete_product'];

        // Формируем запрос для удаления продукта из базы данных
        $delete_pro = "DELETE FROM products WHERE product_id='$delete_id'";

        // Выполняем запрос
        $run_delete = mysqli_query($con, $delete_pro);

        // Проверяем, выполнен ли запрос успешно
        if ($run_delete) {
            // Если успешно, выводим сообщение об удалении
            echo "<script>alert('Продукт был удален')</script>";

            // Перенаправляем на страницу просмотра продуктов
            echo "<script>window.open('index.php?view_products','_self')</script>";
        }
    }
}
?>
