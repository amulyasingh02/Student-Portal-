<?php
session_start();
$_SESSION["valid"]=1;

// Database connection parameters
$dbHost = "localhost:3306"; // Change this if your MySQL server is on a different host
$dbUsername = "root"; // 
$dbPassword = ""; // MySQL password (default for XAMPP)
$dbName = "lgdb"; // The name of the database you created

// Create a database connection
$conn = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

// Get user input
$email = $_POST['email'];
$password = $_POST['password'];

// Sanitize user input (prevent SQL injection)
$email = mysqli_real_escape_string($conn, $email);

// Query the database
$query = "SELECT * FROM users WHERE email = '$email'";
$result = mysqli_query($conn, $query);

if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}


// Check if a user with the provided email exists
if (mysqli_num_rows($result) === 1) {
    $row = mysqli_fetch_assoc($result);
    $stored_password = $row['password'];

    // Verify the password
    if (password_verify($password, $stored_password)) {
        

        // Password is correct, user is authenticated
        // You can redirect the user to a dashboard or some other page
        $_SESSION["email"]=$email;
        //echo file_get_contents('dashboard.php');
header("location:dashboard.php");
    
}

        else {
            echo '<script>alert("Invalid User/Password");</script>';
            header("refresh: 0; url=index.php");

    }
} else {
    // No user found with the provided email
    echo '<script>alert("User not found");</script>';
header("refresh: 0; url=index.php");
}

// Close the database connection
mysqli_close($conn);
?>
