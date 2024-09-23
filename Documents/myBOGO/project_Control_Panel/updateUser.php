<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Retrieve form data
    $userId = $_POST["userId"];
    $updatedFirstName = $_POST["firstName"];
    $updatedLastName = $_POST["lastName"];
    $updatedStatus = $_POST["status"];

    // Perform database update operation
    // Assuming you have established a database connection

    // Example: Update user details in the users table
    $sql = "UPDATE users SET first_name = ?, last_name = ?, status = ? WHERE id = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("sssi", $updatedFirstName, $updatedLastName, $updatedStatus, $userId);

    if ($stmt->execute()) {
        // User updated successfully
        http_response_code(200);
        echo json_encode(["message" => "User updated successfully"]);
    } else {
        // Error occurred while updating user
        http_response_code(500);
        echo json_encode(["error" => "Error occurred while updating user"]);
    }

    // Close statement and database connection
    $stmt->close();
    $mysqli->close();
} else {
    // Invalid request method
    http_response_code(405); // Method Not Allowed
    echo json_encode(["error" => "Method Not Allowed"]);
}
