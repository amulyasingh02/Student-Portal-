<?php
// Database connection parameters
$dbHost = "localhost:3306"; // Change this if your MySQL server is on a different host
$dbUsername = "root"; // 
$dbPassword = ""; // MySQL password (default for XAMPP)
$dbName = "lgdb"; // The name of the database you created

// Create a database connection
$conn = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT); // Hash the password

    // Insert user data into the database
    $sql = "INSERT INTO users (email, password) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $email, $password);

    if ($stmt->execute()) {
        echo '<script>alert("Signup Sucesfull");</script>';
        header("refresh: 0; url=index.php");     // Redirect after a 0-second delay 
       } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

// Close the database connection
$conn->close();
?>

