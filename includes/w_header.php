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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>BOGO Home pg</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">

    <script src="./assests/cartMove.js"></script>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">


    <link href="https://fonts.googleapis.com/css2?family=PT+Serif:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">


    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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

        /* Extra small devices (phones, 600px and down) */
        @media only screen and (max-width: 600px) {



            /* Dropdown Button */
            .dropbtn {
                background-color: #04AA6D;
                color: white;
                padding: 16px;
                font-size: 16px;
                border: none;
            }

            /* The container <div> - needed to position the dropdown content */
            .dropdown {
                position: relative;
                display: inline-block;
            }

            /* Dropdown Content (Hidden by Default) */
            .dropdown-content {
                display: none;
                position: absolute;
                background-color: #f1f1f1;
                min-width: 160px;
                box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
                z-index: 1;
            }

            /* Links inside the dropdown */
            .dropdown-content a {
                color: black;
                padding: 12px 16px;
                text-decoration: none;
                display: block;
            }

            /* Change color of dropdown links on hover */
            .dropdown-content a:hover {
                background-color: #ddd;
            }

            /* Show the dropdown menu on hover */
            .dropdown:hover .dropdown-content {
                display: block;
            }

            /* Change the background color of the dropdown button when the dropdown content is shown */
            .dropdown:hover .dropbtn {
                background-color: #3e8e41;
            }

            #menu-img {
                display: block;
            }

            .menu {
                display: flex;
            }

            #home-pg {
                min-height: 100vh;
                background-image: url('./images/home.jpg');

                width: 100%;


            }

            .navbar {
                overflow: hidden;
                background-color: #333;
            }

            .navbar a {
                float: left;
                font-size: 16px;
                color: white;
                text-align: center;
                padding: 14px 16px;
                text-decoration: none;
            }

            .dropdown {
                float: left;
                overflow: hidden;
            }

            .dropdown .dropbtn {
                font-size: 16px;
                border: none;
                outline: none;
                color: white;
                padding: 14px 16px;
                background-color: inherit;
                font-family: inherit;
                margin: 0;
            }

            /* .navbar a:hover, .dropdown:hover .dropbtn {
  background-color: red;
} */

            .dropdown-content {
                display: none;
                position: absolute;
                background-color: #f9f9f9;
                min-width: 160px;
                box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
                z-index: 1;
            }

            .dropdown-content a {
                float: none;
                color: black;
                padding: 12px 16px;
                text-decoration: none;
                display: block;
                text-align: left;
            }

            .dropdown-content a:hover {
                background-color: #ddd;
            }

            .dropdown:hover .dropdown-content {
                display: block;
            }

            #nav-menu-bar {
                display: block;
                width: 60px;
            }


            .navigation-menu {
                display: none;
            }

            .home-headline {
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
                text-align: center;
                margin: auto;
                padding-top: 50px;
            }

            .heading {
                color: white;
                font-family: "PT Serif", serif;
                font-style: italic;
                font-weight: 100;
                margin-bottom: 10px;
                font-size: 2rem;
            }


            .subheading {
                color: white;
                font-family: "Mulish", sans-serif;
                font-size: 1rem;
                margin-bottom: 15px;
            }

            section {

                justify-content: center;
                align-items: center;
                min-height: 100vh;
                width: 100%;

            }

            .home-headline button {
                margin-top: 25px;
                padding: 10px 15px;
                background-color: transparent;
                color: white;
                border: 1px solid;
                border-radius: 7px;
                cursor: pointer;
                font-family: "PT Serif", serif;
                font-size: 0.9rem;

            }
        }
    </style>

</head>

<body>

    <!--HOME PAGE-->
    <div class="header container-fluid">
        <a href="index.php">
            <div class="logo" id="logo">
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



        <!-- <a href="#" onclick="openCartPane()">
                <img src="./images/cart_w.png" class="cart-img" width="27px">
            </a>
 -->

        <!-- Navigation Menu -->
        <div class="dropdown menu" id="menu-img" style="display: none;"> <button type="button" class="dropbtn"> hey </button>

            <div class="dropdown-content">
                <a href="#">Link 1</a>
                <a href="#">Link 2</a>
                <a href="#">Link 3</a>
            </div>
        </div>


        <div class="navigation-menu home-menu">
            <a href="ourStory.php" class="our-story-link">Our Story</a>
            <a href="whatWeDo.php" class="what-we-do-link">What We Do</a>
            <a href="getInvolved.php" id="get-involved-link">Get Involved</a>

            <a href="#" onclick="openCartPane()">
                <img src="./images/cart_w.png" class="cart-img" width="27px">
            </a>


            <?php if ($is_logged_in) : ?>
                <a href="./userProfile.php">
                    <img src="./images/userr.png" id="userProfilePic" width="20px">
                </a>

                <a href="./logOut.php" class="btn-logout">
                    <button type="button">Log out</button>
                </a>

            <?php else : ?>
                <a href="./logIn.php">
                    <img src="./images/userr.png" id="userProfilePic" width="20px">
                </a>
            <?php endif; ?>

        </div>
    </div>

    <?php include('./includes/cart.php'); ?>

</body>