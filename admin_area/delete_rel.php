<?php

// Проверяем, установлена ли сессия с электронной почтой администратора
if (!isset($_SESSION['admin_email'])) {
    // Если сессия не установлена, перенаправляем на страницу входа
    echo "<script>window.open('login.php','_self')</script>";
} else {

    // Проверяем, установлен ли параметр 'delete_rel' в URL
    if (isset($_GET['delete_rel'])) {
        // Получаем ID отношения для удаления
        $delete_id = $_GET['delete_rel'];

        // Формируем запрос для удаления отношения из базы данных
        $delete_rel = "DELETE FROM bundle_product_relation WHERE rel_id='$delete_id'";

        // Выполняем запрос
        $run_delete = mysqli_query($con, $delete_rel);

        // Проверяем, выполнен ли запрос успешно
        if ($run_delete) {
            // Если успешно, выводим сообщение об удалении
            echo "<script>alert('Отношение было удалено')</script>";

            // Перенаправляем на страницу просмотра отношений
            echo "<script>window.open('index.php?view_rel','_self')</script>";
        }
    }
}
?>
