<?php
include('./includes/header.php');
$mysqli = new mysqli("localhost", "root", "Fuck.you67", "login_db");

if ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET['id'])) {
    $productId = $mysqli->real_escape_string($_GET['id']);

    // Fetch product details based on product ID
    $sql = "SELECT * FROM products WHERE id = '$productId'";
    $result = $mysqli->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $name = $row['name'];
        $category = $row['category'];
        $quantity = $row['quantity'];
        $price = $row['price'];
        $description = $row['description'];
        // You can add more fields as needed
        echo json_encode([
            'name' => $name,
            'category' => $category,
            'quantity' => $quantity,
            'price' => $price,
            'description' => $description
            // Add more fields if necessary
        ]);
    } else {
        echo "Product not found.";
    }
    exit; // Stop further execution
}

// Update product details based on form submission
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $productId = $mysqli->real_escape_string($_POST["id"]);
    $name = $mysqli->real_escape_string($_POST["name"]);
    $category = $mysqli->real_escape_string($_POST["category"]);
    $quantity = intval($_POST["quantity"]);
    $price = floatval($_POST["price"]);
    $description = $mysqli->real_escape_string($_POST["description"]);
    // Handle image upload if needed

    $sql = "UPDATE products SET name='$name', category='$category', quantity=$quantity, price=$price, description='$description' WHERE id='$productId'";

    if ($mysqli->query($sql)) {
        echo "Product updated successfully.";
    } else {
        echo "Error updating product: " . $mysqli->error;
    }
}
