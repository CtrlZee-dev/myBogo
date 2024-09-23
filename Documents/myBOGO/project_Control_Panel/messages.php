<?php
include('./includes/header.php');
$mysqli = new mysqli("localhost", "root", "Fuck.you67", "login_db");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["delete_id"])) {
        $deleteId = intval($_POST["delete_id"]);
        $sql = "DELETE FROM contactUs WHERE id = $deleteId";

        if ($mysqli->query($sql)) {
            echo "Record deleted successfully.";
        } else {
            echo "Error deleting record: " . $mysqli->error;
        }
    }
}
?>
<div class="container-fluid">
    <div class="row">
        <?php include('./includes/sidebar.php'); ?>

        <main id="message" class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div class="container">
                <h1 class="orderh2">Messages</h1>
                <table class="table" id="messageTable">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Received</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $result = $mysqli->query("SELECT * FROM contactUs");
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row['name'] . "</td>";
                            echo "<td>" . $row['email'] . "</td>";
                            echo "<td>" . $row['received_at'] . "</td>";
                            echo "<td>" . ($row['replied'] ? 'Replied' : 'Unreplied') . "</td>";
                            echo "<td>";
                            echo "<a href='?id=" . $row['id'] . "#reply-section' class='btn btn-primary reply-btn'>Reply</a>";

                            echo "<form method='post'>";
                            echo "<input type='hidden' name='delete_id' value='" . $row['id'] . "'>";
                            echo "<button type='submit' class='btn btn-danger delete-btn' onclick='return confirm(\"Are you sure you want to delete this record?\")'>Delete</button>";
                            echo "</form>";
                            echo "</td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>

            <?php if (isset($_GET['id'])) : ?>
                <div class="message-container" id="reply-section">
                    <h1 class="orderh2">Reply to Message</h1>
                    <?php
                    $id = intval($_GET['id']);
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
                            <button type="submit" class="btn btn-primary" style="width: 150px;">Send Reply</button>
                            <button type="button" class="btn btn-secondary" onclick="closeView()">Close</button>

                        </form>
                    <?php
                    } else {
                        echo "No message found.";
                    }
                    ?>
                </div>
            <?php endif; ?>
        </main>
    </div>
</div>
<script>
    function closeView() {
        document.getElementById('reply-section').style.display = 'none';
    }
</script>