<?php

// Запускаем сессию
session_start();

// Подключаем файл с настройками базы данных
include("includes/db.php");

// Подключаем файл с функциями
include("functions.php");

?>

<?php
// Получаем реальный IP-адрес пользователя
$ip_add = getRealUserIp();

// Проверяем, был ли отправлен запрос с ID
if (isset($_POST['id'])) {

    // Получаем ID товара и количество из POST-запроса
    $id = $_POST['id'];
    $qty = $_POST['quantity'];

    // Формируем SQL-запрос для обновления количества товара в корзине
    $change_qty = "UPDATE cart SET qty='$qty' WHERE p_id='$id' AND ip_add='$ip_add'";

    // Выполняем SQL-запрос
    $run_qty = mysqli_query($con, $change_qty);
}
?>