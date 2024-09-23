<?php
session_start(); // Start the session

// Clear session cart
if (isset($_SESSION['cart'])) {
    unset($_SESSION['cart']);
}

// Clear cart items from local storage
if (isset($_COOKIE['cartItems'])) {
    unset($_COOKIE['cartItems']);
    setcookie('cartItems', '', time() - 3600, '/'); // set the cookie to expire in the past
}

echo "Cart cleared.";
