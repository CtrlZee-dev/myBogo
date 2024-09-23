<?php
session_start();
if (isset($_SESSION['user_id'])) {
    $userId = $_SESSION['user_id'];

    // Connect to your database
    $conn = new mysqli('localhost', 'root', 'Fuck.you67', 'login_db');
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Fetch the cart items for the user
    $stmt = $conn->prepare("SELECT product_id, product_name, product_price, product_image, quantity FROM cart WHERE user_id = ?");
    $stmt->bind_param('i', $userId);
    $stmt->execute();
    $stmt->bind_result($productId, $productName, $productPrice, $productImage, $quantity);

    $cartItems = array();
    while ($stmt->fetch()) {
        $cartItems[] = array(
            'id' => $productId,
            'name' => $productName,
            'price' => $productPrice,
            'image' => $productImage,
            'quantity' => $quantity
        );
    }

    $stmt->close();
    $conn->close();

    echo json_encode($cartItems);
} else {
    echo json_encode(array());
}
