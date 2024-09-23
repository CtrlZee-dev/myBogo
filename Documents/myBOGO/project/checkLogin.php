<?php
// Check if user is logged in
if (isset($_SESSION['user_id'])) {
    // User is logged in
    echo "logged_in";
} else {
    // User is not logged in
    echo "not_logged_in";
}
