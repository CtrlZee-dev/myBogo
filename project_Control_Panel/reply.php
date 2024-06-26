<?php
include('./includes/header.php');
$mysqli = new mysqli("localhost", "root", "Fuck.you67", "login_db");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["reply_id"], $_POST["reply_message"])) {
        $replyId = intval($_POST["reply_id"]);
        $replyMessage = $mysqli->real_escape_string($_POST["reply_message"]);

        // Update replied status and reply message in the database
        $sql = "UPDATE contactUs SET replied = 1, reply_message = '$replyMessage' WHERE id = $replyId";
        if ($mysqli->query($sql)) {
            echo "Reply sent successfully.";
        } else {
            echo "Error replying to message: " . $mysqli->error;
        }
    }
}
?>

<div class="container-fluid">
    <div class="row">
        <?php include('./includes/sidebar.php'); ?>

        <main id="reply" class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div class="container">
                <h1 class="orderh2">Reply to Message</h1>
                <?php
                if (isset($_GET['id'])) {
                    $id = $_GET['id'];
                    $result = $mysqli->query("SELECT * FROM contactUs WHERE id = $id");
                    if ($result->num_rows > 0) {
                        $row = $result->fetch_assoc();
                ?>
                        <div class="message-details">
                            <p><strong>Name:</strong> <?php echo $row['name']; ?></p>
                            <p><strong>Email:</strong> <?php echo $row['email']; ?></p>
                            <p><strong>Date/Time:</strong> <?php echo $row['received_at']; ?></p>
                            <p><strong>Phone:</strong> <?php echo $row['phone']; ?></p>
                            <p><strong>Message:</strong> <?php echo $row['message']; ?></p>
                        </div>
                        <form method="post">
                            <input type="hidden" name="reply_id" value="<?php echo $row['id']; ?>">
                            <textarea name="reply_message" placeholder="Enter your reply message" required></textarea>
                            <button type="submit" class="btn btn-primary">Send Reply</button>
                        </form>
                <?php } else {
                        echo "No message found.";
                    }
                } else {
                    echo "Message ID not provided.";
                }
                ?>
            </div>
        </main>
    </div>
</div>