<?php
include('./includes/header.php');
$mysqli = new mysqli("localhost", "root", "Fuck.you67", "login_db");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = $mysqli->real_escape_string($_POST["name"]);
    $category = $mysqli->real_escape_string($_POST["category"]);
    $quantity = intval($_POST["quantity"]);
    $price = floatval($_POST["price"]);
    $image = $_FILES["image"]["name"];
    $description = $mysqli->real_escape_string($_POST["description"]);

    // Handle file upload
    $source_dir = "product_imgs/"; // Source directory
    $target_dir = "uploads/"; // Target directory for storing uploaded images

    // Check if file exists in temporary location
    if (isset($_FILES["image"]) && $_FILES["image"]["error"] === UPLOAD_ERR_OK) {
        $tmp_name = $_FILES["image"]["tmp_name"];
        $destination = $target_dir . $image;

        // Move uploaded file from temporary to target directory
        if (move_uploaded_file($tmp_name, $destination)) {
            // Insert product details into database
            $sql = "INSERT INTO products (name, category, quantity, price, image, description) 
                    VALUES ('$name', '$category', $quantity, $price, '$image', '$description')";

            if ($mysqli->query($sql)) {
                echo "Product added successfully.";
            } else {
                echo "Error inserting product: " . $mysqli->error;
            }
        } else {
            echo "Error moving uploaded file.";
        }
    } else {
        echo "Failed to upload image or image not found.";
    }
} else {
    echo "Invalid request method.";
}

$mysqli->close();
