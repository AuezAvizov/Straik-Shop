<?php
// Проверяем, установлена ли сессия администратора
if (!isset($_SESSION['admin_email'])) {
    // Если сессия не установлена, перенаправляем на страницу входа
    echo "<script>window.open('login.php', '_self')</script>";
} else {
    // Если сессия установлена, продолжаем выполнение кода

    // Проверяем, есть ли параметр 'delete_term' в запросе
    if (isset($_GET['delete_term'])) {
        // Получаем идентификатор удаляемого термина из параметра запроса
        $delete_id = $_GET['delete_term'];

        // Формируем SQL-запрос для удаления записи из таблицы terms
        $delete_term = "DELETE FROM terms WHERE term_id='$delete_id'";

        // Выполняем запрос
        $run_term = mysqli_query($con, $delete_term);

        // Проверяем, успешно ли выполнен запрос
        if ($run_term) {
            // Если запрос успешен, показываем сообщение и перенаправляем на страницу со списком терминов
            echo "<script>alert('One Term Box Has Been Deleted')</script>";
            echo "<script>window.open('index.php?view_terms', '_self')</script>";
        }
    }
}
?>
