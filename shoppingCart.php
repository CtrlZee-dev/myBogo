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

// Function to add item to the cart
function addToCart($productId, $productName, $productPrice, $productImage)
{
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = array();
    }

    // Check if item is already in the cart
    foreach ($_SESSION['cart'] as $key => $item) {
        if ($item['id'] == $productId) {
            // Item already in cart, update quantity
            $_SESSION['cart'][$key]['quantity'] += 1;
            return;
        }
    }

    // Item not in cart, add it
    $_SESSION['cart'][] = array(
        'id' => $productId,
        'name' => $productName,
        'price' => $productPrice,
        'image' => $productImage,
        'quantity' => 1
    );
}

// Handle addition of item to cart if AJAX request
if (isset($_POST['add_to_cart'])) {
    if (isset($_SESSION['user_id'])) {
        // Add item to cart
        $productId = $_POST['product_id'];
        $productName = $_POST['product_name'];
        $productPrice = $_POST['product_price'];
        $productImage = $_POST['product_image'];
        addToCart($productId, $productName, $productPrice, $productImage);
        // Display alert message
        echo "<script>alert('Product added to cart successfully.');</script>";
    } else {
        // Redirect to login page with alert
        echo "<script>alert('Please log in to add products to your cart.');</script>";
        echo "<script>window.location.href='login.php';</script>";
        exit;
    }
}

// Remove item from cart
if (isset($_GET['remove'])) {
    $remove_id = $_GET['remove'];
    $_SESSION['cart'] = array_filter($_SESSION['cart'], function ($item) use ($remove_id) {
        return $item['id'] != $remove_id;
    });
    echo "<script>alert('Item removed from cart successfully.');</script>";
    echo "<script>window.location.href='shoppingCart.php';</script>";
    exit; // Make sure to exit after redirect
    exit;
}



// Clear all items from cart
if (isset($_GET['delete_all'])) {
    $_SESSION['cart'] = array();
    echo "<script>alert('Cart cleared successfully.');</script>";
    echo "<script>window.location.href='shoppingCart.php';</script>";
    exit;
}

// Simulating cart items (Replace with actual session cart data)
$cartItems = isset($_SESSION['cart']) ? $_SESSION['cart'] : array();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/5.3.45/css/materialdesignicons.css" integrity="sha256-NAxhqDvtY0l4xn+YVa6WjAcmd94NNfttjNsDmNatFVc=" crossorigin="anonymous" />
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="styles1.css">
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
            <a href="index.php">
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

    <div class="container ">
        <div class="row">
            <div class="col-md-8">
                <div class="card border shadow-none">
                    <div class="card-header bg-transparent border-bottom py-3 px-4">
                        <h5 class="font-size-16 mb-0">My Shopping Cart <span class="float-end"> (
                                <?php echo isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0; ?> Items)
                            </span></h5>
                    </div>
                    <div class="card-body">
                        <?php
                        if (!empty($cartItems)) {
                            foreach ($cartItems as $item) {
                        ?>
                                <div class="card mb-3">
                                    <div class="row g-0">
                                        <div class="col-md-4">
                                            <img src="<?php echo '../project_Control_Panel/uploads/' . $item['image']; ?>" alt="Product Image" class="avatar-lg rounded">
                                        </div>
                                        <div class="col-md-8">
                                            <div class="card-body">
                                                <h5 class="card-title"><?php echo $item['name']; ?></h5>
                                                <p class="card-text">Price: R<?php echo $item['price']; ?></p>
                                                <div class="d-flex">
                                                    <form action="" method="post" class="me-3">
                                                        <input type="hidden" name="update_quantity_id" value="<?php echo $item['id']; ?>">
                                                        <select class="form-select form-select-sm w-auto" name="update_quantity" onchange="this.form.submit()">
                                                            <?php for ($i = 1; $i <= 8; $i++) : ?>
                                                                <option value="<?php echo $i; ?>" <?php echo ($i == $item['quantity']) ? 'selected' : ''; ?>><?php echo $i; ?></option>
                                                            <?php endfor; ?>
                                                        </select>
                                                    </form>
                                                    <a href="./shoppingCart.php?remove=<?php echo $item['id']; ?>" class="btn btn-outline-danger">Remove</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        <?php
                            }
                        } else {
                            echo "<p>Your cart is empty.</p>";
                        }
                        ?>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="mt-5 mt-lg-0">
                    <div class="card border shadow-none">
                        <div class="card-header bg-transparent border-bottom py-3 px-4">
                            <h5 class="font-size-16 mb-0">Order Sub Total: <span class="float-end">R<?php echo calculateSubtotal($cartItems); ?></span></h5>
                        </div>
                        <div class="card-body">
                            <!-- Additional details or actions -->
                            <div class="d-grid gap-2">
                                <a href="./ShoppingCart.php?delete_all=1" class="btn btn-outline-danger">Clear Cart</a>
                                <!-- <a href="shoppingCart.php" class="btn btn-outline-primary">View Bag</a> -->
                                <!-- Add checkout button or link -->
                                <div class="row my-4">
                                    <div class="col-sm-6">
                                        <a href="products.php" class="btn btn-link text-muted">
                                            <i class="mdi mdi-arrow-left me-1"></i> Continue Shopping </a>
                                    </div> <!-- end col -->
                                    <div class="col-sm-6">
                                        <div class="text-sm-end mt-2 mt-sm-0">
                                            <a href="checkOut.php" class="btn btn-success">
                                                <i class="mdi mdi-cart-outline me-1"></i> Checkout </a>
                                        </div>
                                    </div> <!-- end col -->
                                </div> <!-- end row-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>