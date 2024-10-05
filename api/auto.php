<?php
header('Content-Type: application/json');

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "airsoft_store";

// Создание соединения
$conn = new mysqli($servername, $username, $password, $dbname);

// Проверка соединения
if ($conn->connect_error) {
    $response = array("status" => "error", "message" => "Connection failed: " . $conn->connect_error);
    echo json_encode($response, JSON_PRETTY_PRINT);
    exit;
}

// Получение данных из запроса 
$customer_email = $_POST['customer_email'];
$customer_pass = $_POST['customer_pass'];

// Проверка на существование пользователя
$sql = "SELECT * FROM customers WHERE customer_email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $customer_email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();

    // Проверка пароля
    if (password_verify($customer_pass, $user['customer_pass'])) {
        // Возвращаем только нужные данные
        $response = array(
            "status" => "success",
            "message" => "Login successful",
            "customer" => array(
                "customer_name" => $user['customer_name'],
                "customer_email" => $user['customer_email'],
                "customer_contact" => $user['customer_contact'],
                "customer_address" => $user['customer_address'],
                "customer_city" => $user['customer_city']
            )
        );
    } else {
        $response = array("status" => "error", "message" => "Invalid password");
    }
} else {
    $response = array("status" => "error", "message" => "User not found");
}

// Закрываем соединение с базой данных
$stmt->close();
$conn->close();

// Возвращаем ответ в формате JSON с форматированием
echo json_encode($response, JSON_PRETTY_PRINT);
?>