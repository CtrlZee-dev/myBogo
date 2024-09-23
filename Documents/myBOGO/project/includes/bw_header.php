<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$is_logged_in = isset($_SESSION['user_id']);

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <title>Sign Up</title> -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=PT+Serif:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Mulish:ital,wght@0,200..1000;1,200..1000&family=PT+Serif:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">

    <link rel="icon" href="./images/logo_icon.png" type="image/x-icon">

    <link rel="preconnect" href="https://fonts.googleapis.com">

    <script src="./assests/cartMove.js"></script>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">


    <link href="https://fonts.googleapis.com/css2?family=PT+Serif:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">


    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>


    <link href="https://fonts.googleapis.com/css2?family=Mulish:ital,wght@0,200..1000;1,200..1000&family=PT+Serif:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">


    <script src="./assests/cart.js"></script>

    <link rel="icon" href="./images/logo_icon.png" type="image/x-icon">

    <style>
        /* Update the styles */
        .avatar {
            width: 50px;
            height: 40px;
        }

        #cart-items {
            gap: 10px;

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

        .card-body div {

            margin: 0;

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
            margin: 0;
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
            padding: 0 10px;

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
            padding-top: 60px;
            z-index: 100;
            /* Adjust as needed */

        }

        .side-pane {
            padding: 0 10px;
        }
    </style>

</head>

<body>


    <div class="header">
        <a href="index.php">
            <div class="logo" id="logo">
                <img src="./images/logo_b.png" class="logo-img " width="55px">
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
        <!-- Navigation Menu -->
        <div class="navigation-menu home-menu">
            <a href="ourStory.php" class="our-story-link">Our Story</a>
            <a href="whatWeDo.php" class="what-we-do-link">What We Do</a>
            <a href="getInvolved.php" id="get-involved-link">Get Involved</a>
            <a href="#" onclick="openCartPane()">
                <img src="./images/cart_w.png" class="cart-img" width="27px">
            </a>


            <!-- <button type="button">Shop </button> -->
            <a href="./logIn.php">
                <img src="./images/userr.png" id="userProfilePic" width="20px">
            </a>


        </div>
    </div>


    <?php include('./includes/cart.php'); ?>
    <!-- 


    <div id="cart-side-pane" class="side-pane ">
        <span id="close-btn" class="close-btn">&times;</span>
        <div class="side-pane-content">

            <h2>Your Cart</h2>
            <div id="cart-items" class="cart-item"></div>

            <p id="cart-total">Cart total: R0.00</p>
            <div class="cart-btns">

                <button type="button" class="btn btn-outline-warning">View bag</button>
                <button type="button" class="btn btn-outline-success">Check Out</button>
            </div>

        </div>

    </div> -->