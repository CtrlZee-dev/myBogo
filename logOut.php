<?php
// Start session
session_start();

// Clear session data
session_unset();
session_destroy();

// Redirect to index.php
header("Location: index.html");

// Execute JavaScript to clear localStorage
echo "<script>
    localStorage.removeItem('cart');
    window.location.href = 'login.php'; // Replace with the actual login page URL
</script>";
exit;
