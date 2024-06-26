<?php
$mysqli = require __DIR__ . "/database.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id = $mysqli->real_escape_string($_POST["editUserId"]);
    $firstName = $mysqli->real_escape_string($_POST["firstName"]);
    $lastName = $mysqli->real_escape_string($_POST["lastName"]);
    $email = $mysqli->real_escape_string($_POST["email"]);
    $phone = $mysqli->real_escape_string($_POST["phone"]);
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
    $role = $mysqli->real_escape_string($_POST["role"]);

    $sql = "UPDATE user SET username='$firstName', lastName='$lastName', email='$email', phone_number='$phone', user_password='$password', role='$role' WHERE id='$id'";

    if ($mysqli->query($sql)) {
        echo "User updated successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . $mysqli->error;
    }
}
