<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

// Database connection
$mysqli = new mysqli("localhost", "root", "Fuck.you67", "login_db");
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}


// Function to add item to the cart

if (!function_exists('addToCart')) {
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

// Handle addition of item to the cart
if (isset($_POST['add_to_cart'], $_POST['product_id'], $_POST['quantity'])) {
    $productId = intval($_POST['product_id']);
    $quantity = intval($_POST['quantity']);

    // Fetch product details from database (you may need to adjust your query)
    $stmt = $mysqli->prepare("SELECT * FROM products WHERE id = ?");
    $stmt->bind_param("i", $productId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $product = $result->fetch_assoc();

        // Add item to cart session
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = array();
        }

        // Check if item already exists in cart, update quantity if so
        $itemInCart = false;
        foreach ($_SESSION['cart'] as &$item) {
            if ($item['id'] === $productId) {
                $item['quantity'] += $quantity;
                $itemInCart = true;
                break;
            }
        }

        // If item is not already in cart, add it
        if (!$itemInCart) {
            $_SESSION['cart'][] = array(
                'id' => $productId,
                'name' => $product['name'],
                'price' => $product['price'],
                'image' => $product['image'],
                'quantity' => $quantity
            );
        }

        // Return success message (you may customize this as needed)
        echo "Product added to cart successfully.";
    } else {
        // Return error message if product not found
        echo "Product not found.";
    }

    $stmt->close();
    exit;
}
// Remove item from cart if 'remove' parameter is set
if (isset($_GET['remove'])) {
    $remove_id = $_GET['remove'];
    $_SESSION['cart'] = array_values(array_filter($_SESSION['cart'], function ($item) use ($remove_id) {
        return $item['id'] != $remove_id;
    }));
    // Display alert and redirect to product page
    echo "<script>alert('Item removed from cart successfully.');</script>";
    echo "<script>window.location.href='../products.php?id={$remove_id}';</script>";
    exit; // Make sure to exit after redirect
}



if (isset($_GET['delete_all'])) {
    $_SESSION['cart'] = array();
    header('location:cart.php');
    exit; // Make sure to exit after redirect
}
// Redirect back to the products page
// header('Location: products.php');
// exit;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <!-- Add your CSS file link here -->
    <link rel="stylesheet" href="cart.css">
    <style>
        * {
            margin: 0;
            padding: 0;
        }

        .card-body {
            height: 120px;
            width: 500px;
            overflow: hidden;
            display: grid;
            grid-template-columns: 80px 1fr 1fr;
            padding: 7px;
        }

        .avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .avatar {
            width: 80px;
            height: 80px;
        }

        .card-body h5,
        .card-body p {
            margin: 0;
            font-size: 14px;
        }

        .card-body .actions {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .form-select {
            font-size: 12px;
            padding: 4px;
            width: 60px;
        }

        .delete-btn {
            font-size: 12px;
            color: red;
            cursor: pointer;
            text-decoration: none;
        }
    </style>
</head>

<body>
    <div id="cart-side-pane" class="side-pane">
        <span id="close-btn" class="close-btn">&times;</span>
        <div class="side-pane-content">
            <h2>Your Cart</h2>
            <div id="cart-items" class="cart-item">
                <?php
                // Check if cart is empty
                if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
                    foreach ($_SESSION['cart'] as $item) {
                ?>
                        <div class="card border shadow-none">
                            <div class="card-body">
                                <div class="avatar">
                                    <img src="<?php echo '../project_Control_Panel/uploads/' . $item['image']; ?>" alt="Product Image">
                                </div>

                                <div>
                                    <h5 class="text-truncate font-size-18"><a href="#" class="text-dark"><?php echo $item['name']; ?></a></h5>
                                    <p class="text-muted mb-2">Price: R<?php echo $item['price']; ?></p>
                                    <p class="text-muted mb-2">Total: R<?php echo $item['price'] * $item['quantity']; ?></p>
                                </div>

                                <div class="actions">
                                    <form action="" method="post">
                                        <input type="hidden" name="update_quantity_id" value="<?php echo $item['id']; ?>">
                                        <select class="form-select form-select-sm w-xl" name="update_quantity" onchange="this.form.submit()">
                                            <?php for ($i = 1; $i <= 8; $i++) : ?>
                                                <option value="<?php echo $i; ?>" <?php echo ($i == $item['quantity']) ? 'selected' : ''; ?>><?php echo $i; ?></option>
                                            <?php endfor; ?>
                                        </select>
                                    </form>
                                    <a href="./includes/cart.php?remove=<?php echo $item['id']; ?>" class="delete-btn" onclick="return confirm('Remove item from cart?')"><i class="fas fa-trash"></i> remove</a>
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

            <?php
            // Calculate cart total
            $cartTotal = 0;
            if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
                foreach ($_SESSION['cart'] as $item) {
                    $cartTotal += $item['price'] * $item['quantity'];
                }
            }
            ?>
            <p id="cart-total">Cart total: R<?php echo number_format($cartTotal, 2); ?></p>
            <div class="cart-btns">
                <a href="./shoppingCart.php"> <button type="button" class="btn btn-outline-warning">View Bag</button></a>
                <a><button type="button" class="btn btn-outline-success">Check Out</button></a>

            </div>
        </div>
    </div>

</body>

</html>