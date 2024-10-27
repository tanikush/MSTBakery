<?php
// database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "your_database_name";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get data from the POST request
$data = json_decode(file_get_contents('php://input'), true);
$product = $data['product'];
$price = $data['price'];
$order_date = date('Y-m-d H:i:s');

// Insert order into database
$sql = "INSERT INTO orders (product, price, order_date) VALUES ('$product', '$price', '$order_date')";

if ($conn->query($sql) === TRUE) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'error' => $conn->error]);
}

$conn->close();
?>
