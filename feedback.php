<?php
session_start();
if (!isset($_SESSION['email'])) {
    echo '<script>alert("Please Log in first");</script>';
    header("refresh: 0.0; url=login.php");
    exit();
}
if ($_SESSION["profile_completed"] === 1) {

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
$query = "SELECT * FROM details WHERE EmailID = '$email'";
$result = mysqli_query($conn, $query);
if($_SESSION['profile_completed']){
if ($result) {
    $row = mysqli_fetch_assoc($result);
    $name = $row["Name"];
    $contact=$row["ContactNo"];
}
}

// Process the form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["name"]) && isset($_POST["email"]) && isset($_POST["contact"]) && isset($_POST["message"])) {
        $contact = $_POST["contact"];
        $message = $_POST["message"];
        $classNo=$_POST["classNo"];
        $q1=$_POST["q1"];
        $q2=$_POST["q2"];
        $q3=$_POST["q3"];
        $q4=$_POST["q4"];
        $q5=$_POST["q5"];
        $currentDateTime = date('Y-m-d H:i:s');



            

        // Save the feedback data to the database (you should have your own database structure and query here)
        $query = "INSERT INTO feedback (Name, EmailID, Contact, Message,q1,q2,q3,q4,q5,subTime,classNo) VALUES ('$name', '$email', '$contact', '$message', '$q1' , '$q2' ,'$q3' , '$q4' , '$q5' , '$currentDateTime' , '$classNo')";
        if (mysqli_query($conn, $query)) {
            $feedbackMessage = "Feedback submitted successfully.";
            echo '<script>alert("Feedback Recorded !");</script>';
            header("refresh: 1.0; url=dashboard.php");
        } else {
            $feedbackMessage = "Error: " . mysqli_error($conn);
        }
    }
}
}
else
{
    echo '<script>alert("Profile not completed,Click on Complete Profile!");</script>';
    header("refresh: 0; url=dashboard.php"); // Redirect after a 0-second delay
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
            width: 90%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .feedback-form textarea {
            height: 150px;
        }
        h1 {
            text-align: center;
        }

        label {
            display: block;
            font-weight: bold;
            margin-top: 10px;
        }

        input[type="radio"] {
            margin-right: 10px;
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
            <input type="text" id="name" name="name" value="<?php echo $name ?>" readonly required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?php echo $email ?>" readonly required>

            <label for="contact">Contact:</label>
            <input type="tel" id="contact" name="contact" value="<?php echo $contact ?>" required>

            <label for="semester">Class Number:</label>
        <input type="number" id="classNo" name="classNo" required>

            <label for="q1">Overall Experience: Please rate your overall experience during your training/internship at SNTI, Jamshedpur.</label>
            <input type="radio" name="q1" value="1" required> 1
            <input type="radio" name="q1" value="2" required> 2
            <input type="radio" name="q1" value="3" required> 3
            <input type="radio" name="q1" value="4" required> 4
            <input type="radio" name="q1" value="5" required> 5

            <label for="q2">Relevance of Content: How would you rate the relevance of the training/internship content to your field of study or career goals?</label>
            <input type="radio" name="q2" value="1" required> 1
            <input type="radio" name="q2" value="2" required> 2
            <input type="radio" name="q2" value="3" required> 3
            <input type="radio" name="q2" value="4" required> 4
            <input type="radio" name="q2" value="5" required> 5

            <label for="q3">Quality of Instructors: Please rate the quality and effectiveness of the instructors or mentors during your training/internship.</label>
            <input type="radio" name="q3" value="1" required> 1
            <input type="radio" name="q3" value="2" required> 2
            <input type="radio" name="q3" value="3" required> 3
            <input type="radio" name="q3" value="4" required> 4
            <input type="radio" name="q3" value="5" required> 5

            <label for="q4">Support and Resources: How would you rate the availability of support, resources, and facilities provided during your training/internship?</label>
            <input type="radio" name="q4" value="1" required> 1
            <input type="radio" name="q4" value="2" required> 2
            <input type="radio" name="q4" value="3" required> 3
            <input type="radio" name="q4" value="4" required> 4
            <input type="radio" name="q4" value="5" required> 5

            <label for="q5">Career Development: To what extent do you feel your training/internship at SNTI, Jamshedpur has contributed to your career development and skill enhancement?</label>
            <input type="radio" name="q5" value="1" required> 1
            <input type="radio" name="q5" value="2" required> 2
            <input type="radio" name="q5" value="3" required> 3
            <input type="radio" name="q5" value="4" required> 4
            <input type="radio" name="q5" value="5" required> 5


            <label for="message">Message:</label>
            <textarea id="message" name="message" rows="3" required></textarea>

            <button type="submit">Submit Feedback</button>
        </form>
    </div>
</body>
</html>
