<?php


// Start the session at the beginning of the file
// session_start();

include('./includes/b_header.php');

// Change the title based on the current file
$currentFile = basename(__FILE__);
if ($currentFile == 'ourStory.php') {
    echo '<title>OurStory</title>';
    echo '    <link rel="icon" href="./images/logo_icon.png" type="image/x-icon">';
} elseif ($currentFile == 'whatWeDo.php') {
    echo '<title>What We Do</title>';
} else {
    echo '<title>Story</title>';
}




?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Our Story</title>

    <link rel="stylesheet" href="styles.css">
    <style>
        .color-b {
            color: #878937;
            font-weight: 400;

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

        .one2,
        .one1 {
            grid-row-start: 2;
            text-align: center;

        }

        .mission-container {
            display: flex;

            text-align: center;
            margin-bottom: 50px;

        }

        .vision-container {
            display: grid;
            grid-template-columns: 1fr 1fr;
            text-align: center;
            margin-bottom: 50px;


        }

        .mission-container img,
        .vision-container img {
            border-radius: 10px;
        }

        .mission-content {
            display: flex;
            flex-direction: column;
            margin: 0 30px;
            align-items: center;
            justify-content: center;
            text-align: center;



        }

        .mission-content h2,
        .vision-content h2 {

            font-size: 2.5rem;
            font-family: "PT Serif", serif;
            color: #3282f6;
            font-style: italic;

            margin-top: 0;
            margin-bottom: 15px;

        }

        .mission-content p,
        .vision-content p {
            font-size: 1rem;
            font-family: "Mulish", sans-serif;


            margin-top: 0;
            margin-bottom: 15px;



        }

        .impact-container {
            display: flex;

        }

        .impact-container img {
            display: block;
            width: 50%;

        }

        .whole-pic {
            display: block;
            width: 100%;

        }

        .bogo-design {
            display: grid;
            grid-template-columns: 0.5fr 0.5fr;
            color: #3c3333;


        }

        @media (max-width: 600px) {
            .ourStory-container {

                display: grid;
                grid-template-columns: 0.5fr 0.5fr;


            }


            #our-story,
            #mission,
            #vision {

                margin: 0;
            }


            .ourStory-container img {
                margin-top: 20px;
                border-radius: 10px;

            }

            .ourStory-container h1 {
                font-family: "PT Serif", serif;
                font-size: 2.3rem;
                color: #c6488c;
                margin-top: 15px;
                font-style: italic;
                margin-bottom: 12px;
            }

            .ourStory-container p {
                font-family: "Mulish", sans-serif;
                font-size: 1rem;
                align-items: center;

                margin-top: 15px;

                margin-bottom: 12px;

            }


        }

        @media (max-width: 728px) {
            .ourStory-container {
                display: flex;
                flex-direction: column;
                align-items: center;
            }

            .ourStory-container img {
                order: 2;
                margin-top: 20px;
                width: 75%;
                height: 75%;
                border-radius: 10px;
            }

            .bogo-story {
                order: 1;
                width: 100%;

            }

            .bogo-design {
                display: grid;
                grid-template-columns: 1fr 1fr;

            }

            .bogo-do h1 {
                font-family: "PT Serif", serif;
                font-size: 2.3rem;
                color: #c6488c;
                margin-top: 15px;
                font-style: italic;
                margin-bottom: 12px;
            }

            .bogo-do p {
                font-family: "Mulish", sans-serif;
                font-size: 1rem;
                margin-top: 15px;
                margin-bottom: 12px;
            }


            .ourStory-container,
            .mission-container {
                display: flex;
                flex-direction: column;
                align-items: center;
            }


            .mission-container img {
                order: 1;
                margin-top: 20px;
                width: 50%;
                height: auto;
                border-radius: 10px;
            }


            .mission-content {
                order: 2;
                width: 100%;
                text-align: center;
            }

            .bogo-design {
                display: grid;
                grid-template-columns: 1fr 1fr;
            }

            .bogo-do h1 {
                font-family: "PT Serif", serif;
                font-size: 2.3rem;
                color: #c6488c;
                margin-top: 15px;
                font-style: italic;
                margin-bottom: 12px;
            }


            .mission-content p,
            .vision-content p {
                font-family: "Mulish", sans-serif;
                font-size: 1rem;
                margin-top: 15px;
                margin-bottom: 12px;
            }

            .impact-container {
                flex-direction: column;
                align-items: center;
            }

            .impact-container img,
            .whole-pic {
                width: 100%;

            }

            .vision-container {
                display: flex;
                flex-direction: column;
                align-items: center;
            }

            .vision-container img {
                width: 75%;
                margin-top: 20px;
            }

            .vision-content {
                width: 100%;
                text-align: center;
                order: 1;
            }
        }





        @media (min-width: 729px) and (max-width: 991.98px) {
            .ourStory-container {

                display: grid;
                grid-template-columns: 0.88fr 1fr;


            }


            #our-story,
            #mission,
            #vision {

                margin: 0 20px;
            }


            .ourStory-container img {
                width: 86%;
                margin-top: 20px;
                border-radius: 10px;

            }

            .ourStory-container h1 {
                font-family: "PT Serif", serif;
                font-size: 2rem;
                color: #c6488c;
                margin-top: 15px;
                font-style: italic;
                margin-bottom: 12px;
            }

            .ourStory-container p {
                font-family: "Mulish", sans-serif;
                font-size: 2rem;
                align-items: center;

                margin-top: 15px;

                margin-bottom: 12px;

            }

            .bogo-do p {
                font-family: "Mulish", sans-serif;
                font-size: 0.7rem;
                align-items: center;

            }

            .bogo-design p {
                font-size: 2.3rem;
                font-family: "PT Serif", serif;
                font-weight: 700;
                font-style: italic;

                margin-top: 0;
                margin-bottom: 12px;

            }

            .ourStory-container,
            .mission-container {
                display: grid;
                grid-template-columns: 0.88fr 1fr;
            }

            #our-story,
            #mission,
            #vision {
                margin: 0 20px;
            }


            .mission-container img {
                width: 100%;
                margin-top: 20%;
                border-radius: 10px;
            }


            .mission-content h2 {
                font-family: "PT Serif", serif;
                font-size: 2rem;
                color: #3282f6;
                margin-top: 15px;
                font-style: italic;
                margin-bottom: 12px;
            }


            .mission-content p,
            .vision-content p {
                font-family: "Mulish", sans-serif;
                font-size: 0.8rem;
                align-items: center;
                margin-top: 15px;
                margin-bottom: 12px;
            }

            .vision-content p {
                margin-left: 20px;
            }

            .impact-container {
                display: grid;
                grid-template-columns: 1fr 1fr;
                align-items: center;
            }

            .impact-container img,
            .whole-pic {
                display: block;

                width: 100%;
            }

        }
    </style>

</head>

<body>
    <section id="our-story">
        <div class="ourStory-container">
            <img src="./images/donation-story.jpg" width="380px" height="380px" alt="">

            <div class="bogo-story">
                <div class="bogo-design">
                    <p class="buy"> <span class="color-b">B</span>uy</p>
                    <p class="one1"> <span class="color-o1">O</span>ne</p>
                    <p class="give"> <span class="color-g">G</span>ive</p>
                    <p class="one2"> <span class="color-o2">O</span>ne</p>

                </div>
                <div class="bogo-do">
                    <h1>
                        Where Skin Care meets Purpose

                    </h1>
                    <p>At BOGO, we're more than just a skincare platform – we're a movement dedicated to redefining beauty standards and making a meaningful difference in the lives of others. Founded on the belief that self-care should be accessible to all, we're on a mission to revolutionize the skincare industry by integrating philanthropy into everyday beauty routines.</p>

                </div>

            </div>


        </div>

    </section>

    <section id="mission">
        <div class="mission-container">
            <div class="mission-content">
                <P>Our story began with a simple idea: that skincare has
                    the power to transform not just appearances, but lives.
                    Recognizing the profound impact that self-esteem and
                    confidence have on individual well-being, we set out
                    to create a platform where beauty is synonymous with
                    compassion and authenticity.</P>
                <h2>Mission</h2>
                <p>Our mission is to provide access to quality skincare
                    products for those in need while empowering
                    individuals to embrace their beauty and well-being,
                    regardless of their circumstances. Through education,
                    donation, and community empowerment, we strive to
                    create a world where self-care becomes a tool for
                    positive change, fostering healthier, more empowered
                    communities.</p>
            </div>


            <img src="./images/h3.jpeg" width="380px">

        </div>

        <div class="vision-container">
            <img src="./images/scin.jpg" width="440px">

            <div class="vision-content">
                <h2>Vision</h2>
                <p>we envision a future where skincare is not just about appearance, but about empowerment and social impact. We aspire to be a catalyst for change in the beauty industry, inspiring individuals to redefine beauty standards and embrace self-care as a means of self-expression and social responsibility. Through our innovative platform and collaborative efforts, we aim to create a world where everyone has the opportunity to look and feel their best, while making a meaningful difference in the lives of others.
                </p>
            </div>
        </div>

    </section>




    <section id="impact-pictures">
        <div class="impact-container">
            <img src="./images/her.jpeg" width="430px">
            <img src="./images/h.jpg" width="440px">
        </div>
        <img src="./images/h2.jpeg" width="440px" class="whole-pic">

    </section>





    <div id="cart-side-pane" class="side-pane">
        <div class="side-pane-content">
            <span class="close-btn">&times;</span>
            <h2>Your Cart</h2>
            <p>Cart is currently empty.</p>
        </div>
    </div>

    <?php include('./includes/footer.php'); ?>
    <script src="./assests/cart.js"></script>

</body>

</html>