<?php
// Change the title based on the current file
$currentFile = basename(__FILE__);
if ($currentFile == 'signUp.php') {
    echo '<title> Sign Up</title>';
} elseif ($currentFile == 'logIn.php') {
    echo '<title>Log In</title>';
} else {
    echo '<title>home</title>';
}
?>





<section id="sign-Up">
    <?php include('./includes/bw_header.php'); ?>

    <div class="signUp-container">
        <h1>Sign Up</h1>
        <form action="../project_Control_Panel/signUp-process.php" method="POST">
            <label for="email" name="email">Name:</label>
            <input type="text" id="name" name="name" required>

            <label for="email" name="email">Email:</label>
            <input type="email" id="emailAddress" name="emailAddress" required>

            <label for="password" name="password">Password:</label>
            <input type="password" id="password" name="password" required>

            <label for="confirm-pass" name="password_confirmation"> Confirm Password:</label>
            <input type="password" id="confirm-pass" name="password_confirmation" required>
            <input type="hidden" name="role" value="customer">


            <button type="submit">Submit</button>
        </form>

    </div>

    <?php include('./includes/footer.php'); ?>
    <script src="./assests/index.js"></script>
</section>



</body>

</html>