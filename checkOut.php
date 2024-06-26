<?php

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

// Simulating cart items (Replace with actual session cart data)
$cartItems = isset($_SESSION['cart']) ? $_SESSION['cart'] : array();

// Function to calculate subtotal
function calculateSubtotal($cart)
{
    $subtotal = 0;
    foreach ($cart as $item) {
        $subtotal += $item['price'] * $item['quantity'];
    }
    return $subtotal;
}

// Calculate subtotal
$subtotal = calculateSubtotal($cartItems);
$shipping = 105; // Fixed shipping cost
$total = $subtotal + $shipping;


// Generate a unique order ID
function generateOrderID()
{
    return 'ORD-' . uniqid();
}
// Replace with actual logged-in user's information (fetch from session or database)
if (isset($_SESSION['user_id'])) {
    // Replace with your database connection details
    $servername = "localhost";
    $username = "root";
    $password = "Fuck.you67"; // Replace with your database password
    $dbname = "login_db";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $user_id = $_SESSION['user_id'];

    // Fetch user details from the database
    $sql = "SELECT id, username FROM user WHERE id = '$user_id'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $customerID = $row['id'];
        $customerName = $row['username']; // Assuming 'fullname' is the column name for customer's name
    } else {
        // Handle case where user is not found
        $customerID = '';
        $customerName = '';
    }

    $conn->close();
} else {
    // Handle case where user is not logged in
    $customerID = '';
    $customerName = '';
}
// Insert order details into the database
$conn = new mysqli('localhost', 'root', 'Fuck.you67', 'login_db'); // Update with your database connection details

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$orderID = generateOrderID();
$orderDate = date('Y-m-d');
$orderStatus = 'pending';


?>

<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/5.3.45/css/materialdesign.css" integrity="sha256-NAxhqDvtY0l4xn+YVa6WjAcmd94NNfttjNsDmNatFVc=" crossorigin="anonymous" />
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="check.css">
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css'>
    <script src='https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js'></script>
    <style>
        /* Custom styles */
        .avatar-lg {
            width: 80px;
            height: 80px;
            object-fit: cover;
        }

        .custom-margin {
            margin-bottom: 10px;
        }


        .who-we-are-header .logo-img {
            content: url('./images/logo_b.png');
            width: 55px;
        }

        .slogan {
            font-size: 0.4rem;
            text-align: center;
        }

        .color-o1 {
            color: #c6488c;
            font-weight: 400;
        }

        .color-g {
            color: #e0a533;
            font-weight: 400;
        }

        .color-o2 {
            color: #3282f6;
            font-weight: 400;
        }

        .spaced {
            letter-spacing: 5px;
        }

        .color-b {
            color: #878937;
            font-weight: 400;
        }

        .logo {
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
            align-items: flex-start;
        }

        .logo-text {
            margin: 0;
            font-family: "PT Serif", serif;
            font-size: 0.6rem;
            color: #fff;
        }

        a {
            text-align: center;
            text-decoration: none;
            color: inherit;

        }


        .navigation-menu {
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .navigation-menu a {
            margin: 0;

            font-family: "Mulish", sans-serif;
            font-size: 1.3rem;
        }

        .navigation-menu button {
            padding: 10px 15px;
            background-color: transparent;
            margin-right: 30px;
            color: white;
            border: 1px solid;
            border-radius: 7px;
            cursor: pointer;
            font-family: "PT Serif", serif;
            font-size: 0.9rem;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px;
            position: static;
            width: 100%;
            top: 0;
            background: transparent;
            /* i need it-transparent background, my G! */
            z-index: 1000;
            /* watchu you mean?? */

        }
    </style>
</head>

<body>
    <div class="header">
        <div class="who-we-are-header  header">
            <a href="index.html">
                <div class="logo">
                    <img src="./images/thh.png" class="logo-img " width="55px">

                    <p class="spaced logo-text">
                        <span class="color-b">B</span>
                        <span class="color-o1">O</span>
                        <span class="color-g">G</span>
                        <span class="color-o2">O</span>



                    </p>
                    <p class="slogan logo-text"> BEAUTY SKINCARE</p>
                </div>
            </a>
            <!-- Navigation Menu -->
            <div class="navigation-menu">
                <a href="ourStory.php" class="our-story-link" style="color: black;"> Our Story</a>
                <a href="whatWeDo.php" class="what-we-do-link" style="color: black;">What We Do</a>
                <a href="getInvolved.php" style="color: black;" id="get-involved-link" tyle="color: black;">Get Involved</a>

                <a href="#" onclick="openCartPane()">
                    <img src="./images/cart_b.png" class="cart-img" width="23px">
                </a>

                <a href="products.php">
                    <button type="button">Shop </button>
                </a>



            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-xl-4">
                <div class="card checkout-order-summary">
                    <div class="card-body">
                        <div class="p-3 bg-light mb-3">
                            <h5 class="font-size-16 mb-0">Order Summary <span class="float-end ms-2">#<?= $orderID ?></span></h5>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-centered mb-0 table-nowrap">
                                <thead>
                                    <tr>
                                        <th class="border-top-0" style="width: 110px;" scope="col">Product</th>
                                        <th class="border-top-0" scope="col">Product Desc</th>
                                        <th class="border-top-0" scope="col">Price</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (!empty($cartItems)) {
                                        foreach ($cartItems as $item) {
                                            $itemTotal = $item['price'] * $item['quantity'];
                                            echo "<tr>
                                                <th scope='row'><img src='../project_Control_Panel/uploads/{$item['image']}' alt='product-img' title='product-img' class='avatar-lg rounded'></th>
                                                <td>
                                                    <h5 class='font-size-16 text-truncate productName'><a href='#' class='text-dark'>{$item['name']}</a></h5>
                                                    <p class='text-muted mb-0 mt-1 productQuantity'>R{$item['price']} x {$item['quantity']}</p>
                                                </td>
                                                <td class='productPrice'>R{$itemTotal}</td>
                                            </tr>";
                                        }
                                        echo "<tr>
                                            <td colspan='2'>
                                                <h5 class='font-size-14 m-0'>Sub Total :</h5>
                                            </td>
                                            <td>R{$subtotal}</td>
                                        </tr>
                                        <tr>
                                            <td colspan='2'>
                                                <h5 class='font-size-14 m-0'>Standard Shipping Charge :</h5>
                                            </td>
                                            <td>R{$shipping}</td>
                                        </tr>
                                        <tr class='bg-light'>
                                            <td colspan='2'>
                                                <h5 class='font-size-14 m-0'>Total:</h5>
                                            </td>
                                            <td>R{$total}</td>
                                        </tr>";
                                    } else {
                                        echo "<tr><td colspan='3'>Your cart is empty.</td></tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-8">
                <div class="card">
                    <div class="card-body">
                        <ol class="activity-checkout mb-0 px-4 mt-3">
                            <li class="checkout-item">
                                <div class="avatar checkout-icon p-1">
                                    <div class="avatar-title rounded-circle bg-primary">
                                        <i class="bx bxs-receipt text-white font-size-20"></i>
                                    </div>
                                </div>
                                <div class="feed-item-list">
                                    <div>
                                        <h5 class="font-size-16 mb-1">Billing Info</h5>
                                        <p class="text-muted text-truncate mb-4">Billing Address</p>
                                        <form action="processOrder.php" method="POST">
                                            <div>
                                                <div class="row">

                                                    <div class="col-lg-4">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="billing-phone">Phone</label>
                                                            <input type="text" class="form-control" id="billing-phone" placeholder="Enter Phone no.">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label" for="billing-address">Address</label>
                                                    <textarea class="form-control" id="billing-address" rows="3" placeholder="Enter full address"></textarea>
                                                </div>
                                                <div class="row">

                                                    <div class="col-lg-4">
                                                        <div class="mb-4 mb-lg-0">
                                                            <label class="form-label" for="billing-city">Province</label>
                                                            <input type="text" class="form-control" id="billing-province" placeholder="Enter province">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="mb-0">
                                                            <label class="form-label" for="zip-code">Zip / Postal code</label>
                                                            <input type="text" class="form-control" id="zip-code" placeholder="Enter Postal code">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                    </div>
                    </li>
                    <li class="checkout-item">
                        <div class="avatar checkout-icon p-1">
                            <div class="avatar-title rounded-circle bg-primary">
                                <i class="bx bxs-truck text-white font-size-20"></i>
                            </div>
                        </div>
                        <div class="feed-item-list">
                            <div>
                                <h5 class="font-size-16 mb-1">Shipping Info</h5>
                                <p class="text-muted text-truncate mb-4">Shipping Address</p>
                                <div class="mb-3">

                                    <form action="processOrder.php" method="POST">
                                        <div>
                                            <div class="col-lg-4 col-sm-6" id="sameAS">
                                                <div data-bs-toggle="collapse">
                                                    <label class="card-radio-label mb-0">
                                                        <input type="radio" name="address" id="info-address1" class="card-radio-input" checked="">
                                                        <div class="card-radio text-truncate p-3">
                                                            <span class="fs-14 mb-4 d-block">Same As Shipping address </span>

                                                        </div>
                                                    </label>
                                                    <div class="edit-btn bg-light  rounded">
                                                        <a href="#" data-bs-toggle="tooltip" data-placement="top" title="" data-bs-original-title="Edit" id="edit-shipping-btn">
                                                            <i class="bx bx-pencil font-size-16"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>



                                            <div class="row" id="addShippAddy" style="display: none;">
                                                <div class="mb-3">
                                                    <label class="form-label" for="shipping-address">Address</label>
                                                    <textarea class="form-control" id="shipping-address" rows="3" placeholder="Enter full address"></textarea>
                                                </div>

                                                <div class="col-lg-4">
                                                    <div class="mb-4 mb-lg-0">
                                                        <label class="form-label" for="shipping-city">Povince</label>
                                                        <input type="text" class="form-control" id="shipping-province" placeholder="Enter province">
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="mb-0">
                                                        <label class="form-label" for="shipping-zip-code">Zip / Postal code</label>
                                                        <input type="text" class="form-control" id="shipping-zip-code" placeholder="Enter Postal code">
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="checkout-item">
                        <div class="avatar checkout-icon p-1">
                            <div class="avatar-title rounded-circle bg-primary">
                                <i class="bx bxs-badge-check text-white font-size-20"></i>
                            </div>
                        </div>
                        <div class="feed-item-list">
                            <div>
                                <h5 class="font-size-16 mb-1">Payment Info</h5>
                                <p class="text-muted text-truncate mb-4">Payment Options</p>
                                <div class="row weird">
                                    <div class="col-lg-4" id="paymentOption1">
                                        <div data-bs-toggle="collapse">
                                            <label class="card-radio-label">
                                                <input type="radio" name="pay-method" id="pay-methodoption1" class="card-radio-input">
                                                <span class="card-radio py-3 text-center text-truncate">
                                                    <i class="bx bx-credit-card d-block h2 mb-3"></i>
                                                    Credit / Debit Card
                                                </span>

                                            </label>

                                        </div>
                                    </div>

                                    <div class="col-lg-4" id="paymentOption2">
                                        <div data-bs-toggle="collapse">
                                            <label class="card-radio-label">
                                                <input type="radio" name="pay-method" id="pay-methodoption2" class="card-radio-input">
                                                <span class="card-radio py-3 text-center text-truncate">
                                                    <i class="bx bxl-paypal d-block h2 mb-3"></i>
                                                    Paypal
                                                </span>

                                            </label>

                                        </div>
                                    </div>






                                </div>

                                <div id="creditcardPayment" class="d-none ">
                                    <div class="col-lg-4 ">
                                        <p>proceed with making credit card payment</p>
                                    </div>

                                    <div class="accordion">
                                        <!-- Credit card -->
                                        <div class="accordion-item mb-3">
                                            <h2 class="h5 px-4 py-3 accordion-header d-flex justify-content-between align-items-center mii">
                                                <div>
                                                    <!-- <input class="form-check-input" type="radio" name="payment" id="payment1"> -->
                                                    <label class="form-check-label pt-1" for="payment1">
                                                        Credit Card
                                                    </label>
                                                </div>
                                                <span>
                                                    <svg width="34" height="25" xmlns="http://www.w3.org/2000/svg">
                                                        <g fill-rule="nonzero" fill="#333840">
                                                            <path d="M29.418 2.083c1.16 0 2.101.933 2.101 2.084v16.666c0 1.15-.94 2.084-2.1 2.084H4.202A2.092 2.092 0 0 1 2.1 20.833V4.167c0-1.15.941-2.084 2.102-2.084h25.215ZM4.203 0C1.882 0 0 1.865 0 4.167v16.666C0 23.135 1.882 25 4.203 25h25.215c2.321 0 4.203-1.865 4.203-4.167V4.167C33.62 1.865 31.739 0 29.418 0H4.203Z"></path>
                                                            <path d="M4.203 7.292c0-.576.47-1.042 1.05-1.042h4.203c.58 0 1.05.466 1.05 1.042v2.083c0 .575-.47 1.042-1.05 1.042H5.253c-.58 0-1.05-.467-1.05-1.042V7.292Zm0 6.25c0-.576.47-1.042 1.05-1.042H15.76c.58 0 1.05.466 1.05 1.042 0 .575-.47 1.041-1.05 1.041H5.253c-.58 0-1.05-.466-1.05-1.041Zm0 4.166c0-.575.47-1.041 1.05-1.041h2.102c.58 0 1.05.466 1.05 1.041 0 .576-.47 1.042-1.05 1.042H5.253c-.58 0-1.05-.466-1.05-1.042Zm6.303 0c0-.575.47-1.041 1.051-1.041h2.101c.58 0 1.051.466 1.051 1.041 0 .576-.47 1.042-1.05 1.042h-2.102c-.58 0-1.05-.466-1.05-1.042Zm6.304 0c0-.575.47-1.041 1.051-1.041h2.101c.58 0 1.05.466 1.05 1.041 0 .576-.47 1.042-1.05 1.042h-2.101c-.58 0-1.05-.466-1.05-1.042Zm6.304 0c0-.575.47-1.041 1.05-1.041h2.102c.58 0 1.05.466 1.05 1.041 0 .576-.47 1.042-1.05 1.042h-2.101c-.58 0-1.05-.466-1.05-1.042Z"></path>
                                                        </g>
                                                    </svg>
                                                </span>
                                            </h2>
                                            <div id="collapseCC" class="accordion-collapse collapse show" data-bs-parent="#accordionPayment" styles="">
                                                <div class="accordion-body">
                                                    <div class="mb-3">
                                                        <label class="form-label">Card Number</label>
                                                        <input type="text" class="form-control" placeholder="">
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="mb-3">
                                                                <label class="form-label">Name on card</label>
                                                                <input type="text" class="form-control" placeholder="">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <div class="mb-3">
                                                                <label class="form-label">Expiry date</label>
                                                                <input type="text" class="form-control" placeholder="MM/YY">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <div class="mb-3">
                                                                <label class="form-label">CVV Code</label>
                                                                <input type="password" class="form-control">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="payPalPayment" class="d-none ">
                                    <div class="col-lg-4 ">
                                        <p>proceed with PayPal payment</p>
                                    </div>

                                    <div class="accordion">

                                        <div class="accordion-item mb-3 border ">
                                            <h2 class="h5 px-4 py-3 accordion-header d-flex justify-content-between align-items-center">
                                                <div>
                                                    <!-- <input class="form-check-input" type="radio" name="payment" id="payment2"> -->
                                                    <label class="form-check-label pt-1" for="payment2">
                                                        PayPal
                                                    </label>
                                                </div>


                                                <span>
                                                    <svg width="103" height="25" xmlns="http://www.w3.org/2000/svg">
                                                        <g fill="none" fill-rule="evenodd">
                                                            <path d="M8.962 5.857h7.018c3.768 0 5.187 1.907 4.967 4.71-.362 4.627-3.159 7.187-6.87 7.187h-1.872c-.51 0-.852.337-.99 1.25l-.795 5.308c-.052.344-.233.543-.505.57h-4.41c-.414 0-.561-.317-.452-1.003L7.74 6.862c.105-.68.478-1.005 1.221-1.005Z" fill="#009EE3"></path>
                                                            <path d="M39.431 5.542c2.368 0 4.553 1.284 4.254 4.485-.363 3.805-2.4 5.91-5.616 5.919h-2.81c-.404 0-.6.33-.705 1.005l-.543 3.455c-.082.522-.35.779-.745.779h-2.614c-.416 0-.561-.267-.469-.863l2.158-13.846c.106-.68.362-.934.827-.934h6.263Zm-4.257 7.413h2.129c1.331-.051 2.215-.973 2.304-2.636.054-1.027-.64-1.763-1.743-1.757l-2.003.009-.687 4.384Zm15.618 7.17c.239-.217.482-.33.447-.062l-.085.642c-.043.335.089.512.4.512h2.323c.391 0 .581-.157.677-.762l1.432-8.982c.072-.451-.039-.672-.38-.672H53.05c-.23 0-.343.128-.402.48l-.095.552c-.049.288-.18.34-.304.05-.433-1.026-1.538-1.486-3.08-1.45-3.581.074-5.996 2.793-6.255 6.279-.2 2.696 1.732 4.813 4.279 4.813 1.848 0 2.674-.543 3.605-1.395l-.007-.005Zm-1.946-1.382c-1.542 0-2.616-1.23-2.393-2.738.223-1.507 1.665-2.737 3.206-2.737 1.542 0 2.616 1.23 2.394 2.737-.223 1.508-1.664 2.738-3.207 2.738Zm11.685-7.971h-2.355c-.486 0-.683.362-.53.808l2.925 8.561-2.868 4.075c-.241.34-.054.65.284.65h2.647a.81.81 0 0 0 .786-.386l8.993-12.898c.277-.397.147-.814-.308-.814H67.6c-.43 0-.602.17-.848.527l-3.75 5.435-1.676-5.447c-.098-.33-.342-.511-.793-.511h-.002Z" fill="#113984"></path>
                                                            <path d="M79.768 5.542c2.368 0 4.553 1.284 4.254 4.485-.363 3.805-2.4 5.91-5.616 5.919h-2.808c-.404 0-.6.33-.705 1.005l-.543 3.455c-.082.522-.35.779-.745.779h-2.614c-.417 0-.562-.267-.47-.863l2.162-13.85c.107-.68.362-.934.828-.934h6.257v.004Zm-4.257 7.413h2.128c1.332-.051 2.216-.973 2.305-2.636.054-1.027-.64-1.763-1.743-1.757l-2.004.009-.686 4.384Zm15.618 7.17c.239-.217.482-.33.447-.062l-.085.642c-.044.335.089.512.4.512h2.323c.391 0 .581-.157.677-.762l1.431-8.982c.073-.451-.038-.672-.38-.672h-2.55c-.23 0-.343.128-.403.48l-.094.552c-.049.288-.181.34-.304.05-.433-1.026-1.538-1.486-3.08-1.45-3.582.074-5.997 2.793-6.256 6.279-.199 2.696 1.732 4.813 4.28 4.813 1.847 0 2.673-.543 3.604-1.395l-.01-.005Zm-1.944-1.382c-1.542 0-2.616-1.23-2.393-2.738.222-1.507 1.665-2.737 3.206-2.737 1.542 0 2.616 1.23 2.393 2.737-.223 1.508-1.665 2.738-3.206 2.738Zm10.712 2.489h-2.681a.317.317 0 0 1-.328-.362l2.355-14.92a.462.462 0 0 1 .445-.363h2.682a.317.317 0 0 1 .327.362l-2.355 14.92a.462.462 0 0 1-.445.367v-.004Z" fill="#009EE3"></path>
                                                            <path d="M4.572 0h7.026c1.978 0 4.326.063 5.895 1.45 1.049.925 1.6 2.398 1.473 3.985-.432 5.364-3.64 8.37-7.944 8.37H7.558c-.59 0-.98.39-1.147 1.449l-.967 6.159c-.064.399-.236.634-.544.663H.565c-.48 0-.65-.362-.525-1.163L3.156 1.17C3.28.377 3.717 0 4.572 0Z" fill="#113984"></path>
                                                            <path d="m6.513 14.629 1.226-7.767c.107-.68.48-1.007 1.223-1.007h7.018c1.161 0 2.102.181 2.837.516-.705 4.776-3.793 7.428-7.837 7.428H7.522c-.464.002-.805.234-1.01.83Z" fill="#172C70"></path>
                                                        </g>
                                                    </svg>
                                                </span>
                                            </h2>
                                            <div id="collapseCC" class="accordion-collapse collapse show" data-bs-parent="#accordionPayment" styles="">
                                                <div class="accordion-body">
                                                    <div class="accordion-body">
                                                        <div class="px-2 col-lg-6 mb-3">
                                                            <label class="form-label">Email address</label>
                                                            <input type="email" class="form-control">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                </div>

                                <div class="mt-3 text-end">
                                    <a href="processOrder.php"> <button type="submit" class="btn btn-primary">Complete Order</button></a>

                                </div>

                            </div>

                    </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    </div>

    <script>
        document.getElementById('paymentOption1').addEventListener('click', function() {
            document.getElementById('creditcardPayment').classList.remove('d-none');
            document.getElementById('payPalPayment').classList.add('d-none');
        });
        document.getElementById('paymentOption2').addEventListener('click', function() {
            document.getElementById('payPalPayment').classList.remove('d-none');
            document.getElementById('creditcardPayment').classList.add('d-none');
        });
        document.getElementById('paymentOption3').addEventListener('click', function() {
            document.getElementById('creditcardPayment').classList.add('d-none');
            document.getElementById('payPalPayment').classList.add('d-none');
        });

        document.getElementById("edit-shipping-btn").addEventListener("click", function(event) {
            event.preventDefault(); // Prevent default link behavior
            document.getElementById("sameAS").style.display = "none";
            document.getElementById("addShippAddy").style.display = "block";
        });
    </script>
</body>

</html>
