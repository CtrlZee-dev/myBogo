<?php
include('./includes/header.php');
$mysqli = new mysqli("localhost", "root", "Fuck.you67", "login_db");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["delete_id"])) {
        $delete_id = intval($_POST["delete_id"]);
        $sql = "DELETE FROM newsletters WHERE id = $delete_id";

        if ($mysqli->query($sql)) {
            echo "Newsletter deleted successfully.";
        } else {
            echo "Error: " . $mysqli->error;
        }
    } elseif (isset($_POST["view_id"])) {
        $view_id = intval($_POST["view_id"]);
        $sql = "SELECT * FROM newsletters WHERE id = $view_id";
        $result = $mysqli->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $view_title = $row["title"];
            $view_subject = $row["subject"];
            $view_content = $row["content"];
        } else {
            echo "No newsletter found.";
        }
    } elseif (isset($_POST["update_id"])) {
        $update_id = intval($_POST["update_id"]);
        $title = $mysqli->real_escape_string($_POST["title"]);
        $subject = $mysqli->real_escape_string($_POST["subject"]);
        $content = $mysqli->real_escape_string($_POST["content"]);
        $status = $mysqli->real_escape_string($_POST["status"]);

        $sql = "UPDATE newsletters SET title='$title', subject='$subject', content='$content', status='$status' WHERE id=$update_id";
        if ($mysqli->query($sql)) {
            echo "Newsletter updated successfully.";
        } else {
            echo "Error updating newsletter: " . $mysqli->error;
        }
    } else {
        $title = $mysqli->real_escape_string($_POST["title"]);
        $subject = $mysqli->real_escape_string($_POST["subject"]);
        $content = $mysqli->real_escape_string($_POST["content"]);
        $status = isset($_POST["status"]) ? $mysqli->real_escape_string($_POST["status"]) : '';

        if (empty($status)) {
            echo "Error: Status is required.";
        } else {
            $sql = "INSERT INTO newsletters (title, subject, content, status) VALUES ('$title', '$subject', '$content', '$status')";

            if ($mysqli->query($sql)) {
                echo "Newsletter saved successfully.";
            } else {
                echo "Error: " . $mysqli->error;
            }
        }
    }
}
?>
<div class="container-fluid">
    <div class="row">
        <?php include('./includes/sidebar.php'); ?>

        <main id="testimonial" class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div class="newsletter-management">
                <div class="header">
                    <h1 class="orderh2">Newsletters</h1>
                    <button id="createNewBtn" type="button" class="btn btn-outline-success">Create New</button>
                    <button type="button" class="btn btn-outline-success">Import</button>
                    <button type="button" class="btn btn-outline-success">Export</button>
                </div>
                <table class="table" id="newsletterTable">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $result = $mysqli->query("SELECT * FROM newsletters");
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row['title'] . "</td>";
                            echo "<td>" . $row['status'] . "</td>";
                            echo "<td>
                            <button type='button' class='btn btn-primary' onclick='editNewsletter(" . $row['id'] . ", \"" . addslashes($row['title']) . "\", \"" . addslashes($row['subject']) . "\", \"" . addslashes($row['content']) . "\", \"" . addslashes($row['status']) . "\")'>Edit</button>
                                    <button type='button' class='btn btn-secondary' onclick='viewNewsletter(" . $row['id'] . ")'>View</button>
                                    <button type='button' class='btn btn-danger' onclick='deleteNewsletter(" . $row['id'] . ")'>Delete</button>
                                  </td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>

            <div class="newsletter-container" id="newsletterContainer" style="display: none;">
                <h1 class="orderh2">Create New Newsletter</h1>

                <form id="newsletterForm" method="post">
                    <label for="title">Title:</label>
                    <input type="text" id="title" name="title" required>

                    <label for="subject">Subject:</label>
                    <input type="text" id="subject" name="subject" required>

                    <label for="content">Content:</label>
                    <textarea id="content" name="content"></textarea>

                    <input type="hidden" id="status" name="status">

                    <div class="buttons">
                        <button type="button" class="save" onclick="saveDraft()">Save as Draft</button>
                        <button type="button" class="send" onclick="sendNewsletter()">Send Now</button>
                    </div>
                </form>
            </div>

            <div class="newsletter-container" id="viewNewsletterContainer" style="display: none;">
                <h1 class="orderh2">View Newsletter</h1>

                <form id="viewNewsletterForm" class="message-details" method="post">
                    <label for="view_title">Title:</label>
                    <input type="text" id="view_title" name="view_title" value="<?php echo htmlspecialchars($view_title ?? ''); ?>" readonly>

                    <label for="view_subject">Subject:</label>
                    <input type="text" id="view_subject" name="view_subject" value="<?php echo htmlspecialchars($view_subject ?? ''); ?>" readonly>

                    <label for="view_content">Content:</label>
                    <textarea id="view_content" name="view_content" readonly><?php echo htmlspecialchars($view_content ?? ''); ?></textarea>

                    <div class="buttons">
                        <button type="button" class="btn btn-secondary" onclick="closeView()">Close</button>
                    </div>
                </form>
            </div>

            <div class="newsletter-container" id="editNewsletterContainer" style="display: none;">
                <h1 class="orderh2">Edit Newsletter</h1>

                <form id="editNewsletterForm" class="message-details" method="post">
                    <input type="hidden" id="update_id" name="update_id">

                    <label for="edit_title">Title:</label>
                    <input type="text" id="edit_title" name="title" required>

                    <label for="edit_subject">Subject:</label>
                    <input type="text" id="edit_subject" name="subject" required>

                    <label for="edit_content">Content:</label>
                    <textarea id="edit_content" name="content" required></textarea>

                    <input type="hidden" id="edit_status" name="status">

                    <div class="buttons">
                        <button type="button" class="save" onclick="saveDraftUpdate()">Save as Draft</button>
                        <button type="button" class="send" onclick="sendNewsletterUpdated()">Send Now</button>
                        <button type="button" class="btn btn-secondary" onclick="closeEdit()">Cancel</button>
                    </div>
                </form>
            </div>
        </main>
    </div>
</div>

<script>
    document.getElementById('createNewBtn').addEventListener('click', function() {
        document.getElementById('viewNewsletterContainer').style.display = 'none';
        document.getElementById('editNewsletterContainer').style.display = 'none';
        document.getElementById('newsletterContainer').style.display = 'block';
    });

    function saveDraft() {
        document.getElementById('status').value = 'Draft';
        document.getElementById('newsletterForm').submit();
    }

    function sendNewsletter() {
        document.getElementById('status').value = 'Sent';
        document.getElementById('newsletterForm').submit();
    }

    function saveDraftUpdate() {
        document.getElementById('edit_status').value = 'Draft';
        document.getElementById('editNewsletterForm').submit();
    }

    function sendNewsletterUpdated() {
        document.getElementById('edit_status').value = 'Sent';
        document.getElementById('editNewsletterForm').submit();
    }

    function deleteNewsletter(id) {
        if (confirm('Are you sure you want to delete this newsletter?')) {
            var form = document.createElement('form');
            form.method = 'POST';
            form.action = 'newsletter.php';

            var input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'delete_id';
            input.value = id;

            form.appendChild(input);
            document.body.appendChild(form);
            form.submit();
        }
    }

    function viewNewsletter(id) {
        document.getElementById('viewNewsletterContainer').style.display = 'block';
        var form = document.createElement('form');
        form.method = 'POST';
        form.action = 'newsletter.php';

        var input = document.createElement('input');
        input.type = 'hidden';
        input.name = 'view_id';
        input.value = id;

        form.appendChild(input);
        document.body.appendChild(form);
        form.submit();
    }

    function closeView() {
        document.getElementById('viewNewsletterContainer').style.display = 'none';
    }

    window.onload = function() {
        <?php if (isset($view_title)) { ?>
            document.getElementById('viewNewsletterContainer').style.display = 'block';
        <?php } ?>
    }

    function editNewsletter(id, title, subject, content, status) {
        document.getElementById('viewNewsletterContainer').style.display = 'none';
        document.getElementById('editNewsletterContainer').style.display = 'block';
        document.getElementById('update_id').value = id;
        document.getElementById('edit_title').value = title;
        document.getElementById('edit_subject').value = subject;
        document.getElementById('edit_content').value = content;
        document.getElementById('edit_status').value = status;
    }

    function closeEdit() {
        document.getElementById('editNewsletterContainer').style.display = 'none';
    }
</script>