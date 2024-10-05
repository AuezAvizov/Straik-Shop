<?php
header('Content-Type: application/json');

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "airsoft_store";

// Создание соединения с базой данных
$conn = new mysqli($servername, $username, $password, $dbname);

// Проверка соединения
if ($conn->connect_error) {
    $response = array("status" => "error", "message" => "Connection failed: " . $conn->connect_error);
    echo json_encode($response, JSON_PRETTY_PRINT);
    exit;
}

// SQL-запрос для получения всех товаров
$sql = "SELECT product_id, p_cat_id, cat_id, manufacturer_id, date, product_title, product_url, 
               product_img1, product_img2, product_img3, product_price, product_psp_price, product_desc, 
               product_features, product_video, product_keywords, product_label, status 
        FROM products";

$result = $conn->query($sql);

// Проверка, есть ли результаты2
if ($result->num_rows > 0) {
    $products = array();

    // Цикл по результатам и добавление каждого товара в массив
    while($row = $result->fetch_assoc()) {
        $products[] = $row;
    }

    // Возвращаем ответ в формате JSON
    echo json_encode(array("status" => "success", "products" => $products), JSON_PRETTY_PRINT);
} else {
    // Если товаров нет
    $response = array("status" => "error", "message" => "No products found");
    echo json_encode($response, JSON_PRETTY_PRINT);
}

// Закрываем соединение с базой данных
$conn->close();
?>