<?php
// Check if the form is submitted

session_start();
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




if (isset($_POST['upload'])) {
    $image = $_FILES['file'];

    // Check if it's a valid image
    $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
    $fileExtension = strtolower(pathinfo($image['name'], PATHINFO_EXTENSION));

    if (!in_array($fileExtension, $allowedExtensions)) {
        echo "Invalid file format. Please upload a valid image.";
    } elseif ($image['size'] > 10485760) { // 10MB (in bytes)
        echo "Image size exceeds the limit. Please upload an image smaller than 10MB.";
    } else {
        // Upload the image to a directory
        $targetDirectory = "uploads/"; // Create this directory if it doesn't exist
        $targetFile = $targetDirectory.basename($image['name']);
        if (move_uploaded_file($image['tmp_name'], $targetFile)) {
        
        // Save image information to the database
        $imageLocation = $targetFile;
        $imageSize = $image['size'];


        // Replace this with database connection and insertion code
        // Example code to insert into the users table
        $query = "INSERT INTO pfp (EmailID, imgsz, imgloc)
        VALUES ('$email', '$imageSize', '$imageLocation')
        ON DUPLICATE KEY UPDATE imgsz = '$imageSize', imgloc = '$imageLocation'";
         
         
         $stmt = $conn->prepare($query);
         $stmt->execute();

        // Redirect back to the profile page
        header("Location: pfpUpload.php");}
        else
        {
            echo "Failed to upload image";
        }
    }
}
?>


<!DOCTYPE html>
<html>
<head>
    <title>Profile Page</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        #profile {
            width: 60%;
            display: flex;
            flex-direction: column;
            align-items: center;
            border: 1px solid #ccc;
            padding: 20px;
        }
        #home-link {
            display: block;
            background-color: #333;
            color: #fff;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 10px;
        }
        #home-link:hover {
            background-color: #555;}
    </style>
</head>
<body>
    
    <div id="profile">
        <?php
        $query1="select * from pfp where EmailID='$email'";
        $result1 = mysqli_query($conn, $query1);
        $loc="";
        if (!$result1) {
            die("Query failed: " . mysqli_error($conn));
        }
        if (mysqli_num_rows($result1) === 1) { 
            $row = mysqli_fetch_assoc($result1);
            $loc=$row["imgloc"];
            }


        $imageLocation = $loc; //  image location
        echo '<img src="' . $imageLocation . '" width="30% height="30%">';
        ?>
        <form action="" method="post" enctype="multipart/form-data">
            <input type="file" name="file" accept="image/*" required>
            <input type="submit" name="upload" value="Upload Image">
        </form>
        <a  id="home-link" href="dashboard.php">Home</a>

    </div>
</body>
</html>
