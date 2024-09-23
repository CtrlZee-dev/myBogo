<?php
// Include database connection
include('/database.php');

// Function to sanitize user input
function sanitize_input($data)
{
    return htmlspecialchars(stripslashes(trim($data)));
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data and sanitize
    $title = sanitize_input($_POST['title']);
    $subject = sanitize_input($_POST['subject']);
    $content = sanitize_input($_POST['content']);
    $action = sanitize_input($_POST['action']);

    // Determine the status based on action
    $status = ($action == 'draft') ? 'Draft' : 'Sent';

    // Prepare SQL query to insert data into the database
    $sql = "INSERT INTO newsletters (title, subject, content, status) VALUES ('$title', '$subject', '$content', '$status')";

    // Execute the query
    if (mysqli_query($conn, $sql)) {
        if ($status == 'Draft') {
            echo "Newsletter saved as draft.";
        } else {
            echo "Newsletter sent.";
        }
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    // Close the database connection
    mysqli_close($conn);
}
