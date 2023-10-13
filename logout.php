<?php
// Start the session
session_start();

// Destroy the session
session_destroy();

// Redirect to the index.php page
echo '<script>alert("Logged Out");</script>';
header("refresh: 0; url=index.php");

exit();
?>
