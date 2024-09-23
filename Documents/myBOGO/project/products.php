<?php
// Start the session at the beginning of the script

// Include the header file
include('./includes/b_header.php');

// Database connection
$mysqli = new mysqli("localhost", "root", "Fuck.you67", "login_db");
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Fetch all products
$products = [];
$result = $mysqli->query("SELECT * FROM products");
if ($result->num_rows > 0) {
    while ($product = $result->fetch_assoc()) {
        $products[] = $product;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
    <link href="styles.css" rel="stylesheet">
    <style>
        /* Update the styles */
        .avatar {
            width: 50px;
            height: 40px;
        }

        .btn-category {
            border: 1px solid #c6488c;
            background-color: transparent;
            font-family: "PT Serif", serif;
            padding: 14px;
            border-radius: 30px;
        }

        .btn-category.active {
            border: 1px solid #c6488c;
            background-color: lightpink;
            font-family: "PT Serif", serif;
            padding: 14px;
            border-radius: 30px;

        }

        .product-container {
            display: none;
        }

        .product-container.visible {
            display: flex;
            justify-content: baseline;
            align-items: baseline;
            /* transition: background-color 0.3s ease, transform 0.3s ease; */
            transition: all 0.3s ease-in-out;

        }

        .product-container:hover {
            /* border: 5px solid #dbd8ce; */
            /* Change this to your desired color */
            transform: scale(1.05);
            /* Slightly increase the size for a zoom effect */

            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);

            /* transform: translateY(-5px); */
        }

        #p-container {
            display: flex;
            flex-direction: column;
            justify-content: baseline;
            align-items: baseline;
        }

        .productName {
            margin-bottom: 0;
        }



        #addBtn {
            display: inline-block;
            padding: 8px 16px;
            color: #3c3333;
            font-family: "PT Serif", serif;
            background-color: transparent;
            border: 1px solid #3c3333;
            border-radius: 20px;
            cursor: pointer;

        }

        /* Hover effect */
        #addBtn:hover {
            background-color: lavender;
            color: black;
            font-weight: bold;
            color: black;
        }

        /* Click effect */
        #addBtn:active {
            background-color: palevioletred;
            color: black;
            font-weight: bold;
        }

        #add-products {
            display: grid;
            grid-template-columns: 1fr 1fr;
        }

        .add-products {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-top: 10px;
            gap: 33px;
        }

        /* .add-products .product-price {
            margin-right: 10px;
         
        } */



        .addBtn {
            display: inline-block;
            padding: 8px 14px;
            color: #3c3333;
            font-family: "PT Serif", serif;
            background-color: transparent;
            border: 1px solid #3c3333;
            border-radius: 15px;
            font-size: 0.9rem;
            cursor: pointer;
        }

        .addBtn:hover {
            background-color: lavender;
            color: black;
            font-weight: bold;
        }

        .addBtn:active {
            background-color: palevioletred;
            color: black;
            font-weight: bold;
        }

        .products-container {
            padding-bottom: 50px;
        }
    </style>
</head>

<body>


    <section id="products">
        <div class="products-container">
            <div class="item-category">
                <div class="btn-category active" data-category="All">All</div>
                <?php foreach (array_unique(array_column($products, 'category')) as $category) : ?>
                    <div class="btn-category" data-category="<?php echo $category; ?>"><?php echo $category; ?></div>
                <?php endforeach; ?>
            </div>
            <div class="product-category">
                <?php if (!empty($products)) : ?>
                    <?php foreach ($products as $product) : ?>
                        <div class="product-container" data-category="<?php echo $product['category']; ?>">
                            <form method="post" action="./includes/cart.php" class="add-product">
                                <div id="p-container">
                                    <img src="<?php echo '../project_Control_Panel/uploads/' . $product['image']; ?>" width="200px" height="200px" alt="Product Image">
                                    <a href="product_view.php?id=<?php echo $product['id']; ?>">
                                        <img src="./images/eye.png" class="eye1" width="25px">
                                    </a>
                                    <p class="productCategory-name"><?php echo $product['category']; ?></p>
                                    <p class="productName"><?php echo $product['name']; ?></p>
                                    <!-- <p class="product-price">R<?php echo $product['price']; ?></p> -->

                                    <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                                    <input type="hidden" name="product_name" value="<?php echo $product['name']; ?>">

                                    <input type="hidden" name="product_image" value="<?php echo $product['image']; ?>">
                                    <div class="add-products">
                                        <p class="product-price">R<?php echo $product['price']; ?></p>
                                        <input type="hidden" name="product_price" value="<?php echo $product['price']; ?>">
                                        <input type="submit" name="add_to_cart" class="add-to-cart addBtn" value="Add to Cart">
                                    </div>


                                </div>
                            </form>
                        </div>
                    <?php endforeach; ?>
                <?php else : ?>
                    <p>No products found.</p>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            function filterProducts(category) {
                if (category === 'All') {
                    $('.product-container').addClass('visible');
                } else {
                    $('.product-container').each(function() {
                        if ($(this).data('category') === category) {
                            $(this).addClass('visible');
                        } else {
                            $(this).removeClass('visible');
                        }
                    });
                }
            }

            $('.btn-category').on('click', function() {
                var category = $(this).data('category');

                // Highlight the clicked category button
                $('.btn-category').removeClass('active');
                $(this).addClass('active');

                // Filter products based on category
                filterProducts(category);
            });

            // Initially display all products
            filterProducts('All');
        });

        // JavaScript to handle the click effect
        document.getElementsByName('add_to_cart').addEventListener('click', function() {
            this.style.backgroundColor = 'royalpink';
            this.style.color = 'lavender';
            this.style.fontWeight = 'bold';
        });



        $(document).ready(function() {
            function filterProducts(category) {
                if (category === 'All') {
                    $('.product-container').addClass('visible');
                } else {
                    $('.product-container').each(function() {
                        if ($(this).data('category') === category) {
                            $(this).addClass('visible');
                        } else {
                            $(this).removeClass('visible');
                        }
                    });
                }
            }

            $('.btn-category').on('click', function() {
                var category = $(this).data('category');
                $('.btn-category').removeClass('active');
                $(this).addClass('active');
                filterProducts(category);
            });

            // Event listeners for "Shop now" buttons in the discover section
            $('#btnShop-serums').on('click', function() {
                filterProducts('Serums & Treatments');
                $('html, body').animate({
                    scrollTop: $("#products").offset().top
                }, 500);
            });

            $('#btnShop-makeUp').on('click', function() {
                filterProducts('Make Up');
                $('html, body').animate({
                    scrollTop: $("#products").offset().top
                }, 500);
            });

            $('#btnShop-moisturiser').on('click', function() {
                filterProducts('Moisturiser & Scrubs');
                $('html, body').animate({
                    scrollTop: $("#products").offset().top
                }, 500);
            });

            $('#btnShop-accessories').on('click', function() {
                filterProducts('Accessories');
                $('html, body').animate({
                    scrollTop: $("#products").offset().top
                }, 500);
            });

            filterProducts('All');
        });
    </script>
</body>

</html>