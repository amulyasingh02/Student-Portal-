<?php  
session_start();
if (!isset($_SESSION['email'])) {
    echo '<script>alert("Please Log in first");</script>';
    header("refresh: 0.0; url=login.php");
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
$data=array();
$row=array();
if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}
if (mysqli_num_rows($result) === 1) { 
$row = mysqli_fetch_assoc($result);
$name=$row["Name"];
}
$data=$row;

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
        #home-link {
            display: block;
            background-color: #333;
            color: #fff;
            width: 3rem;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 10px;
        }
        #home-link:hover {
            background-color: #555;
        }
    </style>
</head>
<body>
    <div class="navbar">
        <a href="dashboard.php">Home</a>
        <span>Hello, <?php  echo $name ?> </span>

       <a href="pfpUpload.php"> <img class="profile-image"  src="<?php echo $imageLocation ?>" alt="Profile Picture"> </a>
        <a href="logout.php">Logout</a>
    </div>
    <a id="home-link" href="dashboard.php" >Close</a>

    <?php
    if ($_SESSION["profile_completed"] === 1) {
        echo '<div class="body">';  // Create a new "body" div
        // Output the profile data in a tabular form
        echo '<h2>Profile Details</h2>';
        echo '<table>';
        foreach ($data as $key => $value) {
            echo '<tr><th>' . $key . '</th><td>' . $value . '</td></tr>';
        }
        echo '</table>';
        echo '</div>';  // Close the "body" div
    }
    else{
        echo '<script>alert("Profile not completed,Click on Complete Profile!");</script>';
        header("refresh: 0; url=dashboard.php"); // Redirect after a 0-second delay
    }
    ?>
    
</body>
</html>
