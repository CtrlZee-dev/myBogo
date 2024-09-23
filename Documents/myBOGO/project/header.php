<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>


    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=PT+Serif:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Mulish:ital,wght@0,200..1000;1,200..1000&family=PT+Serif:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">


    <link rel="stylesheet" href="styles.css">
    <script src="./assests/cart.js"></script>

    <script src="./assests/cartMove.js"></script>

    <link rel="icon" href="./images/logo_icon.png" type="image/x-icon">

    <style>
        /* Side pane container */
        .side-pane {
            margin: 0;
            padding: 0;
            height: 100%;
            width: 600px;
            position: fixed;
            z-index: 1000;
            top: 0;
            right: 0;
            background-color: #e1ddd8;
            overflow-x: hidden;
            transition: 0.5s;
            box-shadow: -2px 0 5px rgba(0, 0, 0, 0.5);
        }

        /* .side-pane {
    height: 100%;
    width: 0;
    position: fixed;
    z-index: 1;
    top: 0;
    left: 0;
    background-color:#e1ddd8;
    overflow-x: hidden;
    transition: 0.5s;
    padding-top: 60px;
} */


        /* Side pane content */
        .side-pane-content {
            margin: 0;
            padding: 0 10px;
            padding-top: 0px;
            position: block;
            width: 500px;
            height: 100%;
            /* background-color:transparent; */
            top: 0;
            right: 0;
            /* Adjust as needed */
            overflow-x: hidden;
            transition: 0.3s;
            z-index: 100;

            /* Adjust as needed */
        }

        #cart-items {
            gap: 10px;

        }

        .side-pane-content h2 {
            margin-left: 7px;
        }

        .close-btn {
            position: absolute;
            top: 10px;
            left: 10px;
            cursor: pointer;
            font-size: 30px;
            color: #000;
            z-index: 1;
        }

        .cart-btns {
            display: flex;
        }

        /* Example cart button in the header */
        .cart-img {
            cursor: pointer;
        }

        .side-pane {
            display: none;
            /* other styles */
        }

        .side-pane.open {
            width: 600px;
            padding: 0 10px;
            display: block;
            /* other styles to make it visible */
        }

        .cart-button {
            position: fixed;
            top: 20px;
            right: 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            font-size: 16px;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }





        .cart-btns a {
            margin-right: 15px;
        }

        .btn-outline-warning,
        .btn-outline-success {
            display: block;
            flex-direction: row;
            width: 100%;
            margin-top: 10px;
        }

        #cart-side-pane {
            margin: 0px;
            padding: 0 18px;

            width: 500px;

            height: 100%;
            position: block;
            width: 500px;
            height: 100%;
            background-color: #e1ddd8;
            top: 0;
            right: 0;
            /* Adjust as needed */
            overflow-x: hidden;
            transition: 0.3s;
            padding-top: 14px;
            z-index: 100;
            /* Adjust as needed */

        }

        .side-pane {
            padding: 0 10px;
        }


        /* Update the styles */
        .avatar {
            width: 50px;
            height: 40px;
        }

        .font-size-14 {
            font-size: 12px;
        }

        .w-xs {
            width: 40px;
        }

        .card-body {
            height: 120px;
            overflow: hidden;
            display: grid;
            grid-template-columns: 1fr 0.2fr;
            padding: 7px;
        }

        .card-body h5,
        .card-body p {
            margin: 0;
            font-size: 10px;
        }

        .list-inline {
            padding-left: 0;
            margin-bottom: 0;
        }

        .list-inline-item {
            display: inline-block;
            margin-right: 5px;
        }

        #itemQuantity {
            margin: 0;
        }

        .card-body {
            margin-bottom: 10px;
        }

        #quanty select {
            width: 40px;
            margin-left: 10px;
        }

        #quanty {
            display: flex;
        }

        #price1 {
            margin-bottom: 0;
        }

        #see1,
        #see2 {
            display: flex;
            margin: 0px;
            padding-bottom: 0;
        }
    </style>

</head>

<body>

    <div class="who-we-are-header ">
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
            <a href="ourStory.php" class="our-story-link">Our Story</a>
            <a href="whatWeDo.php" class="what-we-do-link">What We Do</a>
            <a href="getInvolved.php" id="get-involved-link">Get Involved</a>

            <a href="#" onclick="openCartPane()">
                <img src="./images/c1.png" class="cart-img" width="30px">
            </a>

            <a href="products.php">
                <button type="button">Shop </button>
            </a>



        </div>
    </div>


    <?php include('./includes/cart.php'); ?>
</body>

</html>