<?php  
session_start();
if (!isset($_SESSION['email'])) {
    echo '<script>alert("Please Log in first");</script>';
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
$email=$_SESSION["email"];
$query = "SELECT * FROM details WHERE EmailID = '$email'";
$result = mysqli_query($conn, $query);
$name="";

if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}
if (mysqli_num_rows($result) === 1) { 
    $_SESSION['profile_completed']=1;
$row = mysqli_fetch_assoc($result);
$name=$row["Name"];
}
else
{
    $_SESSION['profile_completed']=0;
}

// profile picture retrieval from database
$query1="select * from pfp where EmailID='$email'";
        $result1 = mysqli_query($conn, $query1);
        $loc="";
        if (!$result1) {
            die("Query failed: " . mysqli_error($conn));
        }
        if (mysqli_num_rows($result1) === 1) { 
            $row1 = mysqli_fetch_assoc($result1);
            $loc=$row1["imgloc"];
            }
 $imageLocation = $loc; //  image location


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

        .profile-image {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    overflow: hidden; /* Hide the overflowing parts of the image */
}

        .body {
            margin: 20px;
        }

        a {
            display: block;
            margin: 10px 0;
            font-size: 18px;
            text-decoration: none;
            color: #333;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #333;
            color: #fff;
        }
    </style>
</head>
<body>
    <div class="navbar">
        <a href="#">Home</a>
        <span>Hello, <?php  echo $name ?> </span>

       <a href="pfpUpload.php"> <img class="profile-image"  src="<?php echo $imageLocation ?>" alt="Profile Picture"> </a>
        <a href="logout.php">Logout</a>
    </div>
    <div class="body">
        <a href="completeProfile.php">Complete Profile</a>
        <a href="show_profile.php">Show Profile</a>
        <a href="feedback.php">Feedback Form</a>

        
    </div>
</body>
</html>
