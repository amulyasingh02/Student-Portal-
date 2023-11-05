<?php
 session_start();
 if (!isset($_SESSION['email'])) {
     echo '<script>alert("Please Log in first");</script>';
     header("refresh: 0.0; url=../index.php");
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


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["TSLDepartment"]) && isset($_POST["ProjectGuide"]) && isset($_POST["ProjectTitle"]) ) {
        $TSLDepartment = $_POST["TSLDepartment"];
        $ProjectGuide = $_POST["ProjectGuide"];
        $ProjectTitle = $_POST["ProjectTitle"];

        // Save the feedback data to the database (you should have your own database structure and query here)
        $query = "INSERT INTO department  VALUES ('$TSLDepartment', '$ProjectGuide', '$ProjectTitle')";
        if (mysqli_query($conn, $query)) {
            $feedbackMessage = "Department added succesfully successfully.";
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

        .feedback-form input[type="text"]{
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
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
        <a href="adminDashboard.php">Home</a>
        <span>Hello  Administartor</span>
        <a href="../logout.php">Logout</a>
    </div>
    <div class="feedback-form">
        <h2>ADD Department</h2>
        <?php
        if (isset($feedbackMessage)) {
            echo "<p>$feedbackMessage</p>";
        }
        ?>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <label for="TSLDepartment">TSLDepartment:</label>
            <input type="text" id="TSLDepartment" name="TSLDepartment" required>

            <label for="ProjectGuide">ProjectGuide:</label>
            <input type="text" id="ProjectGuide" name="ProjectGuide"  required>

            <label for="ProjectTitle">ProjectTitle:</label>
            <input type="text" id="ProjectTitle" name="ProjectTitle" required>

            <button type="submit">Add Department </button>
        </form>
    </div>
</body>
</html>
