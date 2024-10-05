<?php
// Проверяем, установлена ли сессия администратора
if (!isset($_SESSION['admin_email'])) {
    // Если сессия не установлена, перенаправляем на страницу входа
    echo "<script>window.open('login.php', '_self')</script>";
} else {
    // Если сессия установлена, продолжаем выполнение кода

    // Проверяем, есть ли параметр 'delete_store' в запросе
    if (isset($_GET['delete_store'])) {
        // Получаем идентификатор удаляемого магазина из параметра запроса
        $delete_id = $_GET['delete_store'];

        // Формируем SQL-запрос для удаления записи из таблицы store
        $delete_store = "DELETE FROM store WHERE store_id='$delete_id'";

        // Выполняем запрос
        $run_delete = mysqli_query($con, $delete_store);

        // Проверяем, успешно ли выполнен запрос
        if ($run_delete) {
            // Если запрос успешен, показываем сообщение и перенаправляем на страницу со списком магазинов
            echo "<script>alert('Один магазин был удален')</script>";
            echo "<script>window.open('index.php?view_store', '_self')</script>";
        }
    }
}
?>
