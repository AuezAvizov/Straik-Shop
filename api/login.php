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
        // Запрос на получение всех пользователей
        $sql = "SELECT customer_id, customer_name, customer_email, customer_pass, customer_country, customer_city, customer_contact, customer_address, customer_image, customer_ip, customer_confirm_code FROM customers";
        $customers_result = $conn->query($sql);

        // Создание массива пользователей
        $customers = array();
        if ($customers_result->num_rows > 0) {
            while ($row = $customers_result->fetch_assoc()) {
                $customers[] = $row;
            }
        }

        // Отправка ответа с массивом пользователей
        $response = array("status" => "success", "message" => "Login successful", "customers" => $customers);
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