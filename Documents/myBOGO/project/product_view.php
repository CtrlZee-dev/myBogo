<?php
include('./includes/b_header.php');

$currentFile = basename(__FILE__);
if ($currentFile == 'product_view.php') {
    echo '<title>Product Details</title>';
}

// Database connection
$mysqli = new mysqli("localhost", "root", "Fuck.you67", "login_db");

// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

$productID = isset($_GET['id']) ? (int)$_GET['id'] : null;
$product = null;



if ($productID) {
    $stmt = $mysqli->prepare("SELECT * FROM products WHERE id = ?");
    $stmt->bind_param("i", $productID);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $product = $result->fetch_assoc();
    } else {
        echo "<p>Product not found.</p>";
    }

    $stmt->close(); // Close statement
}

?>

<?php if ($product) : ?>
    <style>
        .prod-container {
            display: grid;
            grid-template-columns: 1.1fr 1fr;
            gap: 5px;
            align-items: center;
            margin-bottom: 20px;
        }

        .prod-container img {
            margin-left: 40px;
            border-radius: 10px;
            grid-area: 1 / 1 / 2 / 2;
            align-self: center;
            border: 4px solid #f6f1ee;
        }

        .prod-details {
            grid-area: 1 / 2 / 2 / 3;
        }

        .productType {
            color: #5e6aad;
            font-size: 1.2rem;
            font-family: "Mulish", sans-serif;
        }

        .product-info h2 {
            font-family: "PT Serif", serif;
            font-size: 3.2rem;
            color: #e0a533;
        }

        .product-info p {
            margin-top: 30px;
            font-family: "Mulish", sans-serif;
            font-size: 1.8rem;
        }

        .price {
            margin-top: 25px;
            flex-direction: column;
            display: flex;
        }

        .price input {
            width: 120px;
            height: 45px;
            margin: 16px 0;
            display: flex;
        }

        .amount #quantity {
            width: 90px;
            height: 35px;
            margin: 16px 0;
            display: flex;
        }

        .new {
            margin-right: 40px;
            font-family: "PT Serif", serif;
            font-size: 2.4rem;
            color: pink;
            font-weight: 100;
        }

        /* 
        button {
            display: block;
            background-color: transparent;
            border: 1px solid #c6488c;
            padding: auto;
            color: #c6488c;
            width: 100%;
            border-radius: 10px;
        } */

        .addBtn_pv {
            display: flex;

            color: #3c3333;
            font-family: "PT Serif", serif;
            background-color: transparent;
            border: 1px solid #3c3333;
            justify-content: center;
            align-items: center;
            border-radius: 15px;
            cursor: pointer;
            padding: auto;


            font-size: 1rem;
        }

        /* Hover effect */
        .addBtn_pv:hover {
            background-color: lavender;
            color: black;
            font-weight: bold;
            color: black;
        }

        /* Click effect */
        .addBtn_pv:active {
            background-color: palevioletred;
            color: black;
            font-weight: bold;
        }

        .amount {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-top: 10px;
            gap: 15px;
        }
    </style>

    <section>
        <div class="prod-container">
            <img src="../project_Control_Panel/uploads/<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>" width="400">
            <div class="prod-details">
                <div class="productType">
                    <p><?php echo $product['category']; ?></p>
                </div>
                <div class="product-info">
                    <h2><?php echo $product['name']; ?></h2>
                    <p><?php echo $product['description']; ?></p>
                </div>
                <div class="price">
                    <h2 class="new"><?php echo $product['price']; ?></h2>

                    <!-- Form to add product to cart -->
                    <?php if (isset($_SESSION['user_id'])) : ?>
                        <form method="post" action="./includes/addToCart.php">
                            <!-- Input fields for product details -->
                            <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                            <input type="hidden" name="product_name" value="<?php echo $product['name']; ?>">


                            <input type="hidden" name="product_price" value=" <?php echo $product['price']; ?>">
                            <input type="hidden" name="product_image" value="<?php echo $product['image']; ?>">



                            <!-- <label for="quantity">Quantity:</label> -->
                            <div class="amount">
                                <input type="number" id="quantity" name="quantity" value="1" min="1">
                                <input type="submit" name="add_to_cart" class="addBtn_pv" value="Add to Cart">

                            </div>


                        </form>
                        <?php if (isset($_GET['added']) && $_GET['added'] === 'true') : ?>
                            <script>
                                alert("Product added to cart successfully.");
                            </script>
                        <?php elseif (isset($_GET['added']) && $_GET['added'] === 'false') : ?>
                            <script>
                                alert("An error occurred. Please try again.");
                            </script>
                        <?php endif; ?>
                    <?php else : ?>
                        <p>Please <a href="login.php" style="color: blue;">login</a> to add this product to your cart.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>

<?php else : ?>
    <p>Product not found.</p>
<?php endif; ?>