<?php    session_start();
if (!isset($_SESSION['email'])) {
    echo '<script>alert("Please Log in first");</script>';
    header("refresh: 0.0; url=login.php");
    exit();
}?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit/Delete Trainee Details</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
        }
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


        .login-container {
            width: 300px;
            margin: 100px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .input-group {
            margin-bottom: 20px;
        }

        .input-group label {
            display: block;
            font-weight: bold;
        }

        .input-group input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .login-button {
            width: 100%;
            padding: 10px;
            background-color: #007BFF;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .login-button:hover {
            background-color: #0056b3;
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
<div class="navbar">
        <a href="adminDashboard.php">Home</a>
        <span>Hello, Administrator </span>
        <a href="../logout.php">Logout</a>
    </div>
    <div class="login-container">
        <h2>Edit Details</h2>
        
        <form action="editDetails.php" method="post">
            <div class="input-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <button type="submit" class="login-button">Edit </button>
        </form>
          <br>
          <h2>Delete Trainee</h2>

        <form action="deleteTrainee.php"  id="delete-form" method="post">
            <div class="input-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <button type="button" class="login-button" id="delete-button">Delete </button>
        </form>
        <a id="home-link" href="adminDashboard.php">Home</a>

    </div>
    <script>
    $(document).ready(function () {
        $("#delete-button").on("click", function () {
            // Show a confirmation dialog when the "Delete" button is clicked
            if (confirm("Are you sure you want to delete this trainee?")) {
                // If the user confirms, submit the form
                $("#delete-form").submit();
            }
        });
    });
</script>

 

</body>
</html>
