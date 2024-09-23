<?php
// Start session if not already started
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

// Database connection (if needed)
$mysqli = new mysqli("localhost", "root", "Fuck.you67", "login_db");
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}
// Function to add item to the cart
function addToCart($productId, $productName, $productPrice, $productImage, $quantity)
{
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = array();
    }

    // Check if item is already in the cart
    foreach ($_SESSION['cart'] as $key => $item) {
        if ($item['id'] == $productId) {
            // Item already in cart, update quantity
            $_SESSION['cart'][$key]['quantity'] += $quantity;
            return 'exists'; // Product already exists in cart
        }
    }

    // Item not in cart, add it
    $_SESSION['cart'][] = array(
        'id' => $productId,
        'name' => $productName,
        'price' => $productPrice,
        'image' => $productImage,
        'quantity' => $quantity
    );

    return 'added'; // Product added to cart
}

// Handle addition of item to cart if POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['add_to_cart'])) {
        if (isset($_SESSION['user_id'])) {
            // Add item to cart
            $productId = $_POST['product_id'];
            $productName = $_POST['product_name'];
            $productPrice = $_POST['product_price'];
            $productImage = $_POST['product_image'];
            $quantity = isset($_POST['quantity']) ? intval($_POST['quantity']) : 1; // Default to 1 if quantity is not set or invalid
            $status = addToCart($productId, $productName, $productPrice, $productImage, $quantity);

            // Redirect back to product_view.php after adding to cart
            if ($status === 'added') {
                header("Location: ../product_view.php?id={$productId}&added=true");
                exit;
            } else {
                header("Location: ../product_view.php?id={$productId}&added=false");
                exit;
            }
        } else {
            // Redirect to login page if user is not logged in
            header("Location: ../login.php");
            exit;
        }
    }
}
