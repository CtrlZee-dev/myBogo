<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

// Function to calculate subtotal
function calculateSubtotal($cart)
{
    $subtotal = 0;
    foreach ($cart as $item) {
        $subtotal += $item['price'] * $item['quantity'];
    }
    return $subtotal;
}

// Generate a unique order ID
function generateOrderID()
{
    return 'ORD-' . uniqid();
}

// Replace with your database connection details
$servername = "localhost";
$username = "root";
$password = "Fuck.you67"; // Replace with your actual password
$dbname = "login_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Simulating cart items (Replace with actual session cart data)
$cartItems = isset($_SESSION['cart']) ? $_SESSION['cart'] : array();

// Calculate subtotal, shipping, and total
$subtotal = calculateSubtotal($cartItems);
$shipping = 105; // Fixed shipping cost
$total = $subtotal + $shipping;

// Insert order details into the orders table
$orderID = generateOrderID();
$orderDate = date('Y-m-d');
$orderStatus = 'pending';

// Replace with actual logged-in user's information (fetch from session or database)
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];

    // Fetch user details from the database
    $sql = "SELECT id, username FROM user WHERE id = '$user_id'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $customerID = $row['id'];
        $customerName = $row['username']; // Assuming 'username' is the column name for customer's name
    } else {
        // Handle case where user is not found
        $customerID = '';
        $customerName = '';
    }
} else {
    // Handle case where user is not logged in
    $customerID = '';
    $customerName = '';
}

// Retrieve shipping information from the form
$shippingAddress = isset($_POST['shipping-address']) ? $_POST['shipping-address'] : '';
$shippingProvince = isset($_POST['shipping-province']) ? $_POST['shipping-province'] : '';
$shippingPostalCode = isset($_POST['shipping-postalcode']) ? $_POST['shipping-postalcode'] : '';

// Fetch billing information from form
$billingAddress = isset($_POST['billing-address']) ? $_POST['billing-address'] : '';
$billingProvince = isset($_POST['billing-province']) ? $_POST['billing-province'] : '';
$billingPostalCode = isset($_POST['billing-postalcode']) ? $_POST['billing-postalcode'] : '';
$paymentMethod = isset($_POST['payment-method']) ? $_POST['payment-method'] : '';
$cardNumber = isset($_POST['card-number']) ? $_POST['card-number'] : '';
$cvcNumber = isset($_POST['cvc-number']) ? $_POST['cvc-number'] : '';
$paypalEmail = isset($_POST['paypal-email']) ? $_POST['paypal-email'] : '';

// Determine if billing address should be same as shipping address
$billingSameAsShipping = isset($_POST['billing-same-as-shipping']) && $_POST['billing-same-as-shipping'] == 'on';

if ($billingSameAsShipping) {
    // Use shipping address for billing
    $billingAddress = $shippingAddress;
    $billingProvince = $shippingProvince;
    $billingPostalCode = $shippingPostalCode;
}

// Insert order details into the orders table
$orderSQL = "INSERT INTO orders (orderID, orderDate, orderStatus, customerID, customerName, shippingAddress, province, postalCode, totalAmount)
             VALUES ('$orderID', '$orderDate', '$orderStatus', '$customerID', '$customerName', '$shippingAddress', '$shippingProvince', '$shippingPostalCode', '$total')";

if ($conn->query($orderSQL) === TRUE) {
    // Insert billing information into the billing_info table
    $billingSQL = "INSERT INTO billing_info (customerID, billingAddress, paymentMethod, cardNumber, cvcNumber, paypalEmail)
                   VALUES ('$customerID', '$billingAddress', '$paymentMethod', '$cardNumber', '$cvcNumber', '$paypalEmail')";

    if ($conn->query($billingSQL) === TRUE) {
        // Insert order items into the order_items table
        foreach ($cartItems as $item) {
            $itemTotal = $item['price'] * $item['quantity'];
            $itemSQL = "INSERT INTO order_items (orderID, productName, quantity, price, total)
                        VALUES ('$orderID', '{$item['name']}', '{$item['quantity']}', '{$item['price']}', '$itemTotal')";
            $conn->query($itemSQL);
        }
        // Clear the cart after successful order placement
        unset($_SESSION['cart']);
        echo "Order placed successfully!";
    } else {
        echo "Error: " . $billingSQL . "<br>" . $conn->error;
    }
} else {
    echo "Error: " . $orderSQL . "<br>" . $conn->error;
}

$conn->close();
