<?php
// Include database connection
$mysqli = require __DIR__ . "/database.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Check if all required fields are set
    if (isset($_POST["name"], $_POST["email"], $_POST["message"])) {
        // Sanitize and escape form inputs
        $name = $mysqli->real_escape_string($_POST["name"]);
        $email = $mysqli->real_escape_string($_POST["email"]);
        $phone = isset($_POST["number"]) ? $mysqli->real_escape_string($_POST["number"]) : '';
        $message = $mysqli->real_escape_string($_POST["message"]);

        // Insert the data into the database
        $sql = "INSERT INTO contactUs (name, email, phone, message, received_at) 
                VALUES ('$name', '$email', '$phone', '$message', NOW())"; // Use NOW() to get the current timestamp

        if ($mysqli->query($sql)) {
            // Message saved successfully
            // You can redirect the user to a thank you page or display a success message here
            echo "Message sent successfully.";
        } else {
            // Error occurred while saving the message
            echo "Error: " . $mysqli->error;
        }
    } else {
        // Some required fields are missing
        echo "Error: Please fill out all required fields.";
    }
} else {
    // Invalid request method
    echo "Error: Invalid request method.";
}
