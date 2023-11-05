<!DOCTYPE html>
<html>
<head>
    <title>Reports</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
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

</style>
</head>
<body>
<div class="navbar">
        <a href="adminDashboard.php">Home</a>
        <span>Hello, Administrator </span>
        <a href="../logout.php">Logout</a>
    </div>
    <h2 style="text-align: center; margin-bottom: 20px;">All Reports</h2>

    <?php
 session_start();
if (!isset($_SESSION['email'])) {
    echo '<script>alert("Please Log in first");</script>';
    header("refresh: 0.0; url=login.php");
    exit();
}
    // Create a connection to the XAMPP MySQL database
    $servername = "localhost";
    $username = "root"; // Default XAMPP username
    $password = ""; // Default XAMPP password is empty
    $database = "lgdb"; // Replace with your database name

    $conn = new mysqli($servername, $username, $password, $database);
    $fd="Not Submitted";
    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Execute the SELECT query
    $sql = "SELECT * FROM details"; // Replace with your table name
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<table id='dataTable' class='display' style='width:100%'>";
        echo "<thead><tr><th>Name</th><th>EmailID</th><th>ContactNo</th><th>CollegeName</th><th>Course</th><th>Sem</th><th>ProjectTitle</th><th>TSLDepartment</th><th>ProjectGuide</th><th>JoinDate</th><th>Feedback?</th><th>ExitDate</th></tr></thead>";
        echo "<tbody>";

        while ($row = $result->fetch_assoc()) {
            $sql1 = "SELECT * FROM feedback WHERE EmailID = '" . $row['EmailID'] . "'";
            $result1 = $conn->query($sql1);
            $com="NA";
            if ($result1->num_rows > 0) 
            {$fd="Submitted";
            $row1=$result1->fetch_assoc();
            $com=$row1["subTime"];
            }


            echo "<tr>";
            echo "<td>" . $row["Name"] . "</td>";
            echo "<td>" . $row["EmailID"] . "</td>";
            echo "<td>" . $row["ContactNo"] . "</td>";
            echo "<td>" . $row["CollegeName"] . "</td>";
            echo "<td>" . $row["Course"] . "</td>";
            echo "<td>" . $row["Semester"] . "</td>";
            echo "<td>" . $row["ProjectTitle"] . "</td>";
            echo "<td>" . $row["TSLDepartment"] . "</td>";
            echo "<td>" . $row["ProjectGuide"] . "</td>";
            echo "<td>" . $row["joinDate"] . "</td>";
            echo "<td>" . $fd . "</td>";
            echo "<td>" . $com . "</td>";
            echo "</tr>";
        }

        echo "</tbody></table>";
    } else {
        echo "No records found";
    }

    // Close the connection
    $conn->close();
    ?>

    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    
    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable();
        });
    </script>


</body>
</html>
