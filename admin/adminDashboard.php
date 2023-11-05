<?php


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
        <a href="adminDashboard.php">Home</a>
        <span>Hello, Administrator </span>
        <a href="../logout.php">Logout</a>
    </div>
    <div class="body">
        <a href="addDepartment.php">Add Department</a>
        <a href="editTrainee.php">Edit Trainee Details</a>
        <a href="reports.php">Department Reports</a>

        
    </div>
</body>
</html>
