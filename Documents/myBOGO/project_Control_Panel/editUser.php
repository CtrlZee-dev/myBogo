<?php
$mysqli = require __DIR__ . "/database.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Ensure all necessary POST variables are set
    if (isset($_POST["editUserId"], $_POST["editFirstName"], $_POST["editLastName"], $_POST["editEmail"], $_POST["editPhone"], $_POST["editPassword"], $_POST["editRole"])) {
        $id = $mysqli->real_escape_string($_POST["editUserId"]);
        $firstName = $mysqli->real_escape_string($_POST["editFirstName"]);
        $lastName = $mysqli->real_escape_string($_POST["editLastName"]);
        $email = $mysqli->real_escape_string($_POST["editEmail"]);
        $phone = $mysqli->real_escape_string($_POST["editPhone"]);
        $password = password_hash($_POST["editPassword"], PASSWORD_DEFAULT);
        $role = $mysqli->real_escape_string($_POST["editRole"]);

        $sql = "UPDATE user SET username='$firstName', lastName='$lastName', email='$email', phone_number='$phone', user_password='$password', role='$role' WHERE id='$id'";

        if ($mysqli->query($sql)) {
            header("Location: customers.php?update=success");
            exit;
        } else {
            echo "Error: " . $sql . "<br>" . $mysqli->error;
        }
    } else {
        echo "Error: Missing required fields.";
    }
}
