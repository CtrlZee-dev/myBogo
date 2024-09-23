

<?php
$mysqli = require __DIR__ . "/database.php";


if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Ensure all necessary POST variables are set
    if (isset($_POST["editProductId"], $_POST["editName"], $_POST["editCategory"], $_POST["editQuantity"], $_POST["editPrice"], $_POST["editDescription"])) {
        $id = $mysqli->real_escape_string($_POST["editProductId"]);
        $product_name = $mysqli->real_escape_string($_POST["editName"]);
        $category = $mysqli->real_escape_string($_POST["editCategory"]);
        $quantity = $mysqli->real_escape_string($_POST["editQuantity"]);
        $price = $mysqli->real_escape_string($_POST["editPrice"]);
        $description = $mysqli->real_escape_string($_POST["editDescription"]);

        $image = '';
        if (isset($_FILES["editImage"]) && $_FILES["editImage"]["error"] === UPLOAD_ERR_OK) {
            $image = $mysqli->real_escape_string($_FILES["editImage"]["name"]);
            $target_dir = "uploads/";
            $target_file = $target_dir . basename($image);
            if (!move_uploaded_file($_FILES["editImage"]["tmp_name"], $target_file)) {
                echo "Error uploading image.";
                exit;
            }
        }

        $sql = "UPDATE products SET name='$product_name', category='$category', quantity='$quantity', price='$price', description='$description'";
        if ($image !== '') {
            $sql .= ", image='$image'";
        }
        $sql .= " WHERE id='$id'";

        if ($mysqli->query($sql)) {
            header("Location: inventory.php?update=success");
            exit;
        } else {
            echo "Error: " . $sql . "<br>" . $mysqli->error;
        }
    } else {
        echo "Error: Missing required fields.";
    }
}
