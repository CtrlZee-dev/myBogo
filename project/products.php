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
            display: block;
        }

        #addBtn {
            display: flex;
            align-self: flex-end;
            padding: 8px;
            color: #3c3333;
            font-family: "PT Serif", serif;

            background-color: transparent;
            border: 1px solid #3c3333;
            border-radius: 20px;

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
                            <img src="<?php echo '../project_Control_Panel/uploads/' . $product['image']; ?>" width="200px" height="200px" alt="Product Image">
                            <a href="product_view.php?id=<?php echo $product['id']; ?>">
                                <img src="./images/eye.png" class="eye1" width="25px">
                            </a>
                            <p class="productCategory-name"><?php echo $product['category']; ?></p>
                            <p class="productName"><?php echo $product['name']; ?></p>
                            <div class="add-product">
                                <p class="product-price">R<?php echo $product['price']; ?></p>
                                <input type="submit" name="add_to_cart" class="add-to-cart " id="addBtn" value="Add to Cart">
                            </div>


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
    </script>
</body>

</html>