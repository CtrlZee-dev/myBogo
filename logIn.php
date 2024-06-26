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

session_start();

$is_invalid = false;

if ($_SERVER["REQUEST_METHOD"] === "POST") {

  $mysqli = require __DIR__ . "/../project_Control_Panel/database.php";

  $email = $mysqli->real_escape_string($_POST["email"]);

  $sql = "SELECT * FROM user WHERE email = '$email'";

  $result = $mysqli->query($sql);

  $user = $result->fetch_assoc();

  if ($user) {

    if (password_verify($_POST["password"], $user["user_password"])) {

      session_regenerate_id();

      $_SESSION["user_id"] = $user["id"];

      if ($user["role"] === "customer") {
        header("Location: /project/index.html");
        exit;
      } elseif ($user["role"] === "admin") {
        header("Location: ../project_Control_Panel/index.html");
        exit;
      }
    }
  }

  $is_invalid = true;
}

?>

<section id="login">



  <?php include('./includes/bw_header.php'); ?>



  <div class="login-container" style="padding-bottom:15px ;">
    <h1>Log In</h1>


    <?php if ($is_invalid) : ?>
      <em>Invalid login</em>
    <?php endif; ?>

    <form method="POST">
      <label for="email">Email</label>
      <input type="email" name="email" id="email" value="<?php echo htmlspecialchars(isset($_POST['email']) ? $_POST['email'] : '', ENT_QUOTES, 'UTF-8'); ?>">
      <label for="password">Password</label>
      <input type="password" name="password" id="password">

      <button>Log in</button>
      <p style="padding-bottom:15px ;"><a href="./signUp.php">Don't have an account, Sign up!</a></p>
    </form>
  </div>




</section>


<?php include('./includes/footer.php'); ?>
<script src="./assests/index.js"></script>

</body>

</html>
