<?php
// Include database connection
$mysqli = require __DIR__ . "/database.php";

// Check if userId is provided in the request
if (isset($_GET['id'])) {
    $userId = $_GET['id'];

    // Fetch user details from the database
    $sql = "SELECT * FROM user WHERE id = $userId";
    $result = $mysqli->query($sql);

    // Check if user exists
    if ($result->num_rows > 0) {
        // Fetch user data
        $userData = $result->fetch_assoc();

        // Return user data as JSON response
        header('Content-Type: application/json');

        // Ensure that all necessary fields are present in the user data
        if (isset($userData['firstName']) && isset($userData['lastName']) && isset($userData['email']) && isset($userData['phone_number']) && isset($userData['user_password']) && isset($userData['role'])) {
            echo json_encode($userData);
        } else {
            // If any necessary field is missing, return an error
            http_response_code(500); // Internal Server Error
            echo json_encode(array('message' => 'User data is incomplete.'));
        }
    } else {
        // User not found
        http_response_code(404);
        echo json_encode(array('message' => 'User not found.'));
    }
} else {
    // userId not provided
    http_response_code(400);
    echo json_encode(array('message' => 'User ID is required.'));
}
