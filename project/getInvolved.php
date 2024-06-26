<?php
// Change the title based on the current file
$currentFile = basename(__FILE__);
if ($currentFile == 'getInvolved.php') {
    echo '<title>Get Involved</title>';
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
    <title>Get Involved</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://unpkg.com/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://unpkg.com/bs-brain@2.0.4/components/contacts/contact-1/assets/css/contact-1.css">
    <style>
        /* General styles */


        .section {
            padding: 80px 0;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        /* Section specific styles */

        #join-ussi {
            background-color: lavender;
        }

        .joinTask-container {
            display: flex;
            gap: 20px;
            justify-content: center;
            align-items: flex-start;
            flex-wrap: wrap;
            margin-top: 30px;
        }

        .joinTask-content {
            flex: 1;
            text-align: center;
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            max-width: 300px;
        }

        .weDo-headings {
            font-size: 2rem;
            color: #e0a533;
            font-weight: 300;
            font-style: italic;
            margin-bottom: 15px;
        }

        .make-a-difference-Container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
            align-items: center;
            justify-content: center;
            margin-top: 50px;
        }

        .message-details {
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .message-details h1 {
            font-size: 2.5rem;
            color: #e0a533;
            font-weight: 700;
            font-style: italic;
            margin-bottom: 20px;
        }

        .message-details p {
            font-size: 1.1rem;
            margin-bottom: 20px;
        }

        a {
            color: inherit;
            /* Set the color to inherit from the parent element */
            text-decoration: none;
            /* Remove underline */
        }



        .btn-primary {
            background-color: #3282f6;
            color: #fff;
            border: none;
            padding: 15px 30px;
            font-size: 1.2rem;
            border-radius: 5px;
            cursor: pointer;
        }

        .btn-primary:hover {
            background-color: #1a65d4;
        }

        /* Responsive adjustments */

        @media (max-width: 768px) {
            .joinTask-content {
                max-width: 100%;
            }
        }
    </style>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.querySelector('form');

            form.addEventListener('submit', function() {
                // Allow the form to submit normally
                setTimeout(function() {
                    form.reset();
                }, 0); // Clear the form immediately after submission
            });
        });
    </script>

</head>

<body>
    <div style="background-color:#3282f6 ; ">
        <section id="join-ussi" class="section">
            <div class="container">
                <div class="joinUs-container">
                    <div class="joinUs-content">
                        <h1 class="joinUs-headline">"Join the Movement: Be a Force for Good with BOGO!"</h1>
                        <p class="joinUs-subheading">At BOGO, we believe that true beauty shines brightest when it's shared. Whether you're an individual looking to make a difference or an organization seeking to align with our mission, there are countless ways to get involved and spread the love. Here's how you can join the BOGO family:</p>
                    </div>


                    <div class="joinTask-container">
                        <div class="joinTask-content">
                            <img src="./images/sponsor.png" class="join-img">
                            <h2 class="weDo-headings">Sponsor</h2>
                            <p>Become a BOGO sponsor and showcase your brand's commitment to social responsibility. Your support will not only help us expand our reach and impact but also demonstrate your dedication to creating positive change in the world.</p>
                        </div>
                        <div class="joinTask-content">
                            <img src="./images/DonateDo.png" class="join-img">
                            <h2 class="weDo-headings">Donate</h2>
                            <p>Your contribution, big or small, can make a world of difference. By donating to BOGO, you're not just giving skincare products – you're giving hope, confidence, and empowerment to those in need. Every donation counts, so let's make an impact together.</p>
                        </div>



                        <div class="joinTask-content">
                            <img src="./images/fundraiser.png" class="join-img">
                            <h2 class="weDo-headings">Fundraiser</h2>
                            <p>Host your own BOGO fundraiser and rally your friends, family, and colleagues to support our cause. From bake sales to charity auctions, the possibilities are endless. Together, we can raise funds and awareness to support underserved communities around the world.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="make-a-difference">

            <div class="make-a-difference-Container">
                <div class="joinTask-content">
                    <div class="make-a-dif">
                        <img src="./images/volunteer.png" class="join-img">
                        <h2 class="weDo-headings">Volunteer</h2>
                        <p>Are you passionate about making a difference in your community? Join our volunteer network and be a part of something truly special. Whether it's organizing events, spreading awareness, or lending a helping hand, your time and talents can help us create positive change.</p>
                    </div>

                    <button type="button">Join our newsletter</button>
                </div>



                <div class="message-details">
                    <h1>
                        READY TO MAKE A DIFFERENCE ?
                    </h1>
                    <p> YOU can make a difference. Join us in our mission to create healthier, more empowered communities through the power of beauty. Whether you're a skincare brand, influencer, or passionate individual, there are countless ways to get involved and make an impact with BOGO. </p>
                </div>
                <!-- 
                <form action="../project_Control_Panel/messageProcess.php" method="POST">
                    <label>Name:</label>
                    <input type="text" name="name" id="name" placeholder="name">
                    <label>Email:</label>
                    <input type="email" name="email" id="email" placeholder="email Address">
                    <label>Phone Number:</label>
                    <input type="tel" name="number" id="number" placeholder=" 011 0322 332">
                    <label>Message:</label>
                    <input type="text" name="message" id="message">
                    <button type="submit">Submit</button>
                </form> -->


                <!-- Contact 1 - Bootstrap Brain Component -->





            </div>





        </section>
    </div>
    <section class="bg-light py-3 py-md-5">
        <div class="container">
            <div class="row justify-content-md-center">
                <div class="col-12 col-md-10 col-lg-8 col-xl-7 col-xxl-6">
                    <h2 class="mb-4 display-5 text-center">Send us a message</h2>
                    <p class="text-secondary mb-5 text-center">The best way to contact us is to use our contact form below. Please fill out all of the required fields and we will get back to you as soon as possible.</p>
                    <hr class="w-50 mx-auto mb-5 mb-xl-9 border-dark-subtle">
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row justify-content-lg-center">
                <div class="col-12 col-lg-9">
                    <div class="bg-white border rounded shadow-sm overflow-hidden">

                        <form action="../project_Control_Panel/messageProcess.php" method="POST">
                            <div class="row gy-4 gy-xl-5 p-4 p-xl-5">
                                <div class="col-12">
                                    <label for="name" class="form-label">Full Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="name" name="name" value="" required>
                                </div>
                                <div class="col-12 col-md-6">
                                    <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-envelope" viewBox="0 0 16 16">
                                                <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4Zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1H2Zm13 2.383-4.708 2.825L15 11.105V5.383Zm-.034 6.876-5.64-3.471L8 9.583l-1.326-.795-5.64 3.47A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.741ZM1 11.105l4.708-2.897L1 5.383v5.722Z" />
                                            </svg>
                                        </span>
                                        <input type="email" class="form-control" id="email" name="email" value="" required>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <label for="phone" class="form-label">Phone Number</label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-telephone" viewBox="0 0 16 16">
                                                <path d="M3.654 1.328a.678.678 0 0 0-1.015-.063L1.605 2.3c-.483.484-.661 1.169-.45 1.77a17.568 17.568 0 0 0 4.168 6.608 17.569 17.569 0 0 0 6.608 4.168c.601.211 1.286.033 1.77-.45l1.034-1.034a.678.678 0 0 0-.063-1.015l-2.307-1.794a.678.678 0 0 0-.58-.122l-2.19.547a1.745 1.745 0 0 1-1.657-.459L5.482 8.062a1.745 1.745 0 0 1-.46-1.657l.548-2.19a.678.678 0 0 0-.122-.58L3.654 1.328zM1.884.511a1.745 1.745 0 0 1 2.612.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511z" />
                                            </svg>
                                        </span>
                                        <input type="tel" class="form-control" id="number" name="number" value="">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <label for="message" class="form-label">Message <span class="text-danger">*</span></label>
                                    <textarea class="form-control" id="message" name="message" rows="3" required></textarea>
                                </div>
                                <div class="col-12">
                                    <div class="d-grid">
                                        <button class="btn btn-primary btn-lg" type="submit">Submit</button>

                                    </div>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </section>



</body>

</html>