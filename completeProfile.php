<?php
session_start();
if ($_SESSION["profile_completed"]) {
    // Use JavaScript to show an alert message
    echo '<script>alert("Profile  Completed,Click Show Profile!");</script>';
    header("refresh: 0; url=dashboard.php"); // Redirect after a 0-second delay

}

else
{
    header("location:details.html");
}

?>