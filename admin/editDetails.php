<?php
$dbhost="localhost:3306";
$dbuser="root";
$dbpss="";
$dbname="lgdb";

$connection =new mysqli($dbhost,$dbuser,$dbpss,$dbname);

if($connection->connect_error){
    die("Connection error:".$connection->connect_error);

}
// get trainee details

if($_SERVER["REQUEST_METHOD"]=="POST")
{
    if(isset($_POST["email"])){
        $email=$_POST["email"];
    $query = "SELECT * FROM details WHERE EmailID = '$email'";
$result = mysqli_query($connection, $query);
if ($result) {
    if (mysqli_num_rows($result) === 0) { 
        echo '<script>alert("Details not present!");</script>';
        header("refresh: 0.0; url=editTrainee.php"); // Redirect after a 0-second delay

    }
    $row = mysqli_fetch_assoc($result);
    $name = $row["Name"];
    $contact=$row["ContactNo"];
    $collegeName=$row["CollegeName"];
    $course=$row["Course"];
    $semester=$row["Semester"];
    $projectTitle=$row["ProjectTitle"];
    $tslDepartment=$row["TSLDepartment"];
    $projectGuide=$row["ProjectGuide"];

}
    }
}


// get department options for dropdown
$query = "SELECT * FROM department";
$result = mysqli_query($connection, $query);
if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}

while($row = mysqli_fetch_assoc($result)){
    $rows[]=$row["TSLDepartment"];
} 
$tslDepartmentoptions=$rows;


// handling post - submission of details form
if( $_SERVER["REQUEST_METHOD"]=="POST")
{
    if (
        isset($_POST["name"]) &&
        isset($_POST["email"]) &&
        isset($_POST["contactNo"]) &&
        isset($_POST["collegeName"]) &&
        isset($_POST["course"]) &&
        isset($_POST["semester"]) &&
        isset($_POST["projectTitle"]) &&
        isset($_POST["tslDepartment"]) &&
        isset($_POST["projectGuide"])
    ) {
    $name=$_POST["name"];
    $email=$_POST["email"];
    $contactNo=$_POST["contactNo"];
    $collegeName=$_POST["collegeName"];
    $course=$_POST["course"];
    $semester=$_POST["semester"];    
    $projectTitle=$_POST["projectTitle"];
    $tslDepartment=$_POST["tslDepartment"];
    $projectGuide=$_POST["projectGuide"];


    $sql = "UPDATE details 
    SET Name = ?,
        ContactNo = ?,
        CollegeName = ?,
        Course = ?,
        Semester = ?,
        ProjectTitle = ?,
        TSLDepartment = ?,
        ProjectGuide = ?
    WHERE EmailID = ?";

$stmt = $connection->prepare($sql);
$stmt->bind_param("sssssssss", $name, $contactNo, $collegeName, $course, $semester, $projectTitle, $tslDepartment, $projectGuide, $email);

if ($stmt->execute()) {
    echo '<script>alert("Profile Updated!");</script>';
    header("refresh: 0.0; url=editTrainee.php"); // Redirect after a 0-second delay

} else {
    echo "Error: " . $stmt->error;
}


$stmt->close();
}
}

$connection->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #ece5e5;
        }

        form {
            background: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            max-width: 400px;
            margin: 20px auto;
        }
        

        h1 {
            text-align: center;
            color: #3498db;
        }

        label {
            display: block;
            margin-top: 10px;
            color: #333;
        }

        input {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        
        input[type="submit"] {
            background: #3498db;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
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
            background-color: #555;
        }
    </style>
</head>
<body>
    <div>
    <form action=<?php echo $_SERVER["PHP_SELF"] ?> method="post">
        <h1>Student Project Information</h1>
        <label for="name">Name:</label>
        <input type="text" name="name" value="<?php echo htmlspecialchars($name, ENT_QUOTES, 'UTF-8'); ?>" size="30" required>

        <label for="email">Email ID:</label>
        <input type="email" id="email" name="email" value="<?php echo $email?>" readonly required>

        <label for="contactNo">Contact Number:</label>
        <input type="tel" id="contactNo" name ="contactNo" value="<?php echo $contact ?>" required>

        <label for="collegeName">College Name:</label>
        <input type="text" id="collegeName" name="collegeName" value="<?php echo $collegeName; ?>" required>

        <label for="course">Course:</label>
        <input type="text" id="course" name="course" value="<?php echo $course; ?>" required>

        <label for="semester">Semester:</label>
        <input type="number" id="semester" name="semester" value="<?php echo $semester; ?>" required>

        <label for="tslDepartment">Select TSLDepartment:</label>
        <select name="tslDepartment"  id="tslDepartment">
               <option value="<?php echo $tslDepartment ?>"><?php echo $tslDepartment ?></option>"
            <?php
            foreach ($tslDepartmentoptions as $dept) {
                echo "<option value='$dept'>$dept</option>";
            }
            ?>
        </select>

     

        <label for="projectGuide">Project Guide:</label>
        <input type="text" id="projectGuide" name="projectGuide" value="<?php echo $projectGuide; ?>" readonly required>

        <label for="projectTitle">Project Title:</label>
        <input type="text" id="projectTitle" name="projectTitle" value="<?php echo $projectTitle; ?>" readonly required>

        <input type="submit" value="Submit">
        <a id="home-link" href="adminDashboard.php">Home</a>

    </form>

</div>

<script>
    $(document).ready(function() {
        $('#tslDepartment').change(function() {
            var selectedDepartment = $(this).val();
            $.ajax({
                type: "POST",
                url: "../fetch_depart_info.php", // Create a separate PHP file to handle the AJAX request
                data: { department: selectedDepartment },
                success: function(response) {
                    var data = JSON.parse(response);
                    $('#projectGuide').val(data.ProjectGuide);
                    $('#projectTitle').val(data.ProjectTitle);
                }
            });
        });

        // Trigger the change event initially to populate the fields if a default value is selected.
        $('#tslDepartment').trigger('change');
    });
    </script>



</body>
</html>

?>

