<?php
session_start();
if (!isset($_SESSION['email'])) {
    header("Location: index.php"); // Redirect to the login page if not logged in
    exit();
}

$dbHost = "localhost:3306"; // Change this if your MySQL server is on a different host
$dbUsername = "root"; // 
$dbPassword = ""; // MySQL password (default for XAMPP)
$dbName = "lgdb"; // The name of the database you created

// Create a database connection
$conn = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}
$email = $_SESSION["email"];

$name = "";
$query = "SELECT Name FROM details WHERE EmailID = '$email'";
$result = mysqli_query($conn, $query);
if($_SESSION['profile_completed']){
if ($result) {
    $row = mysqli_fetch_assoc($result);
    $name = $row["Name"];
}
}

// Process the form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["name"]) && isset($_POST["email"]) && isset($_POST["contact"]) && isset($_POST["message"])) {
        $name = $_POST["name"];
        $email = $_POST["email"];
        $contact = $_POST["contact"];
        $message = $_POST["message"];

        // Save the feedback data to the database (you should have your own database structure and query here)
        $query = "INSERT INTO feedback (Name, Email, Contact, Message) VALUES ('$name', '$email', '$contact', '$message')";
        if (mysqli_query($conn, $query)) {
            $feedbackMessage = "Feedback submitted successfully.";
        } else {
            $feedbackMessage = "Error: " . mysqli_error($conn);
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
        }

        .navbar {
            background-color: #333;
            color: #fff;
            display: flex;
            justify-content: space-between;
            padding: 10px;
        }

        .navbar a {
            color: #fff;
            text-decoration: none;
            margin: 0 10px;
        }

        .feedback-form {
            width: 60%;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .feedback-form input[type="text"],
        .feedback-form input[type="email"],
        .feedback-form input[type="tel"],
        .feedback-form textarea {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .feedback-form textarea {
            height: 150px;
        }

        .feedback-form button {
            background-color: #333;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }

        .feedback-form button:hover {
            background-color: #555;
        }
    </style>
</head>
<body>
    <div class="navbar">
        <a href="dashboard.php">Home</a>
        <span>Hello, <?php echo $name ?></span>
        <a href="logout.php">Logout</a>
    </div>
    <div class="feedback-form">
        <h2>Feedback Form</h2>
        <?php
        if (isset($feedbackMessage)) {
            echo "<p>$feedbackMessage</p>";
        }
        ?>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="contact">Contact:</label>
            <input type="tel" id="contact" name="contact" required>

            <label for="message">Message:</label>
            <textarea id="message" name="message" rows="5" required></textarea>

            <button type="submit">Submit Feedback</button>
        </form>
    </div>
</body>
</html>
