<?php
$mysqli = require __DIR__ . "/database.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $firstName = $mysqli->real_escape_string($_POST["firstName"]);
    $lastName = $mysqli->real_escape_string($_POST["lastName"]);
    $email = $mysqli->real_escape_string($_POST["email"]);
    $phone = $mysqli->real_escape_string($_POST["phone"]);
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
    $role = $mysqli->real_escape_string($_POST["role"]);

    $sql = "INSERT INTO user (username, lastName, email, phone_number, user_password, role) VALUES ('$firstName', '$lastName', '$email', '$phone', '$password', '$role')";

    if ($mysqli->query($sql)) {
        echo "User added successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . $mysqli->error;
    }
}
