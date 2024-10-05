<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "airsoft_store";

// Создание соединения
$conn = new mysqli($servername, $username, $password, $dbname);

// Проверка соединения
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Получение данных из запроса
$customer_name = $_POST['customer_name'];
$customer_email = $_POST['customer_email'];
$customer_pass = $_POST['customer_pass'];
$customer_country = $_POST['customer_country'];
$customer_city = $_POST['customer_city'];
$customer_contact = $_POST['customer_contact'];
$customer_address = $_POST['customer_address'];
$customer_image = $_POST['customer_image'];
$customer_ip = $_POST['customer_ip'];
$customer_confirm_code = $_POST['customer_confirm_code'];

// Проверка на существование пользователя с таким же email
$sql = "SELECT * FROM customers WHERE customer_email='$customer_email'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo json_encode(array("status" => "error", "message" => "Email already exists"));
} else {
    // Хеширование пароля для безопасности
    $hashed_password = password_hash($customer_pass, PASSWORD_BCRYPT);
    
    // Вставка данных пользователя в базу данных
    $sql = "INSERT INTO customers (customer_name, customer_email, customer_pass, customer_country, customer_city, customer_contact, customer_address, customer_image, customer_ip, customer_confirm_code) 
            VALUES ('$customer_name', '$customer_email', '$hashed_password', '$customer_country', '$customer_city', '$customer_contact', '$customer_address', '$customer_image', '$customer_ip', '$customer_confirm_code')";
    
    if ($conn->query($sql) === TRUE) {
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
        echo json_encode(array("status" => "success", "message" => "User registered successfully", "customers" => $customers));
    } else {
        echo json_encode(array("status" => "error", "message" => "Error: " . $conn->error));
    }
}

$conn->close();
?>
