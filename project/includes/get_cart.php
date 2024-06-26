<?php
session_start();

$response = [
    'cart' => isset($_SESSION['cart']) ? $_SESSION['cart'] : []
];

echo json_encode($response);
