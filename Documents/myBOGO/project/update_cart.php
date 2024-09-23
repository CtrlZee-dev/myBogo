<?php
// Update cart items in local storage based on received data
$newCartItems = $_POST['cartItems'] ?? [];
setcookie('cartItems', json_encode($newCartItems), time() + (86400 * 30), "/"); // 30 days expiration
