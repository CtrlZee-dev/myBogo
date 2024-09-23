<?php
// Change the title based on the current file
$currentFile = basename(__FILE__);
if ($currentFile == 'ourStory.php') {
    echo '<title>Our Story</title>';
} elseif ($currentFile == 'whatWeDo.php') {
    echo '<title>What We Do</title>';
} else {
    echo '<title>Story</title>';
}
?>
<?php include('./includes/b_header.php'); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        .whatWeDo-heading {
            font-family: "PT Serif", serif;
            font-size: 3.3rem;
            color: #c6488c;
            margin-top: 15px;
            font-style: italic;
            margin-bottom: 12px;
            text-align: center;
        }

        .whatWeDo-container {
            display: flex;
            margin: 0 30px;
            align-items: center;
            justify-content: center;
            text-align: center;
        }

        .weDo-content {
            margin: 0 30px;
        }

        .weDo-heading {
            font-size: 2.5rem;
            font-family: "PT Serif", serif;
            color: #3282f6;
            font-style: italic;
            margin-top: 0;
            text-align: center;
            margin-bottom: 15px;
        }

        .weDo-subHeading {
            font-size: 1rem;
            font-family: "Mulish", sans-serif;
            text-align: center;
            margin: 0 20px 15px 20px;
        }

        .weDoTasks-container {
            display: flex;
            flex-direction: column;
            margin: 0 30px;
            align-items: center;
            justify-content: center;
            text-align: center;
        }

        .weDoTasks-content {
            margin: 0 30px;
        }

        .whatWedo-info {
            display: flex;
            margin: 0 30px 60px 0;
            align-items: center;
            justify-content: center;
            text-align: center;
        }

        .whatWedo-info img {
            border-radius: 10px;
        }

        .partners-img {
            display: flex;
        }

        .partners-img img {
            width: 35%;
        }

        /* Small screens (max-width: 600px) */
        /* New CSS for stacking on mobile devices */
        @media (max-width: 600px) {
            .whatWedo-info {
                flex-direction: column;
            }

            .whatWedo-info .weDoTasks-content {
                order: 1;
            }

            .whatWedo-info img {
                order: 2;
                width: 75%;
                margin-top: 20px;
                border-radius: 10px;
            }
        }



        /* Medium screens (max-width: 768px) */
        @media (max-width: 769px) {

            .whatWeDo-container,
            .weDoTasks-container,
            .whatWedo-info {
                flex-direction: column;
                align-items: center;
                text-align: center;
            }

            .whatWeDo-container img,
            .whatWedo-info img {
                width: 75%;
                margin-top: 20px;
                border-radius: 10px;
            }

            .weDo-content,
            .weDoTasks-content {
                width: 100%;
                text-align: center;
            }

            .weDo-subHeading {
                margin: 0 15px 15px 15px;
            }

            .whatWedo-info .weDoTasks-content {
                order: 1;
            }

            .whatWedo-info img {
                order: 2;
                width: 75%;
                margin-top: 20px;
                border-radius: 10px;
            }
        }

        /* Medium to large screens (min-width: 769px and max-width: 991.98px) */
        @media (min-width: 770px) and (max-width: 991.98px) {
            .whatWeDo-heading {
                font-size: 2.4rem;
            }

            .weDo-heading {
                font-size: 2rem;
            }

            .weDo-subHeading {
                font-size: 0.8rem;
            }

            .whatWeDo-container img,
            .whatWedo-info img {
                width: 50%;
            }
        }
    </style>


</head>

<body>


    <section id="what-we-do">
        <h1 class="whatWeDo-heading">Youth Development and Community Empowerment through Skincare.</h1>
        <div class="whatWeDo-container">

            <div class="weDo-content">
                <p class="weDo-heading">Skincare Donations</p>
                <p class="weDo-subHeading">we provide access to quality skincare products for those in need. Through our innovative buy-one-give-one model, every purchase made on our platform helps us donate a skincare item to someone in need. Whether it's a moisturizer, cleanser, or sunscreen, these products are more than just beauty essentials – they're a lifeline for those facing economic hardship or limited access to resources.</p>
            </div>
            <img src="./images/donate.jpg" width="440px">

        </div>

    </section>

    <section id="weDo-tasks">
        <div class="weDoTasks-container">
            <div class="whatWedo-info">
                <img src="./images/beau.jpg" width="410px" height="410px">
                <div class="weDoTasks-content">
                    <p class="weDo-heading">Education & Resources</p>
                    <p class="weDo-subHeading">We're also committed to education and empowerment. We believe that everyone deserves to feel confident in their own skin, regardless of their circumstances. That's why we offer resources and support to help individuals learn about skincare, practice self-care, and boost their self-esteem.</p>
                </div>
            </div>
            <div class="whatWedo-info">


                <div class="weDoTasks-content">
                    <p class="weDo-heading">Community Emowerment</p>
                    <p class="weDo-subHeading">we're dedicated to building a community of like-minded individuals who share our passion for making a difference. Whether it's through social media, events, or partnerships, we're constantly working to amplify our impact and inspire others to join us in our mission.</p>
                </div>
                <img src="./images/boo.jpg" width="400px">

            </div>


        </div>

    </section>

    <section id="partnerships">
        <div class="partners-container">
            <div class="partners-content">

                <p class="weDo-heading">Partners</p>
                <p class="weDo-subHeading">we're dedicated to building a community of like-minded individuals who share our passion for making a difference. Whether it's through social media, events, or partnerships, we're constantly working to amplify our impact and inspire others to join us in our mission.</p>


            </div>
            <div class="partners-img">
                <img src="./images/g11.jpg" width="100px">
                <img src="./images/g22.jpg" width="100px">
                <img src="./images/vol.jpg" width="300px">


            </div>

        </div>
    </section>
    <!-- 
    php include('./getInvolved.php'); ?> -->





    <?php include('./includes/footer.php'); ?>
    <script src="./assests/index.js"></script>


</body>

</html>