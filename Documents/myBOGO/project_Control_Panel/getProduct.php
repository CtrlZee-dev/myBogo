<?php
$mysqli = new mysqli("localhost", "root", "Fuck.you67", "login_db");

if ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET['id'])) {
    $productId = $mysqli->real_escape_string($_GET['id']);
    $sql = "SELECT * FROM products WHERE id = '$productId'";
    $result = $mysqli->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // Return product details as JSON
        header('Content-Type: application/json');
        echo json_encode($row);
    } else {
        http_response_code(404); // Not found
        echo json_encode(array("error" => "Product not found"));
    }
} else {
    http_response_code(400); // Bad request
    echo json_encode(array("error" => "Invalid request"));
}
