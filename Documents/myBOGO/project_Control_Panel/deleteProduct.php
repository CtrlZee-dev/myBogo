<?php
// Ensure delete_id is set and numeric
if (isset($_POST['delete_id']) && is_numeric($_POST['delete_id'])) {
    $productId = $_POST['delete_id'];

    // Connect to your database (example using mysqli)
    $mysqli = new mysqli("localhost", "username", "password", "your_database");

    // Check connection
    if ($mysqli->connect_error) {
        die("Connection failed: " . $mysqli->connect_error);
    }

    // Prepare SQL statement to delete product
    $sql = "DELETE FROM products WHERE id = ?";
    $stmt = $mysqli->prepare($sql);

    if ($stmt === false) {
        echo "Error preparing statement: " . $mysqli->error;
    } else {
        // Bind the product ID parameter
        $stmt->bind_param("i", $productId);

        // Execute the statement
        if ($stmt->execute()) {
            echo "Product deleted successfully.";
        } else {
            echo "Error deleting product: " . $stmt->error;
        }

        // Close statement
        $stmt->close();
    }

    // Close connection
    $mysqli->close();
} else {
    echo "Invalid product ID.";
}
