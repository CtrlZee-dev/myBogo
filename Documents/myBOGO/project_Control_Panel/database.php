<?php

$host = "localhost";
$dbname = "login_db";
$username = "root";
$password = "Fuck.you67";

$mysqli = new mysqli($host, $username, $password, $dbname);

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

return $mysqli;
