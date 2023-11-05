<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['email'])) {
    echo json_encode(array('error' => 'Please log in first'));
    exit();
}

// Database connection parameters
$dbHost = "localhost:3306";
$dbUsername = "root";
$dbPassword = "";
$dbName = "lgdb";

// Create a database connection
$conn = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

if (!$conn) {
    echo json_encode(array('error' => 'Database connection failed'));
    exit();
}

// Get the selected TSLDepartment from the POST data
if (isset($_POST['department'])) {
    $selectedDepartment = $_POST['department'];

    // Prepare a SQL query to retrieve ProjectGuide and ProjectTitle for the selected department
    $query = "SELECT ProjectGuide, ProjectTitle FROM department WHERE TSLDepartment = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $selectedDepartment);

    if ($stmt->execute()) {
        $stmt->bind_result($projectGuide, $projectTitle);
        $stmt->fetch();

        // Construct an array with the project information
        $projectInfo = array(
            'ProjectGuide' => $projectGuide,
            'ProjectTitle' => $projectTitle
        );

        echo json_encode($projectInfo);
    } else {
        echo json_encode(array('error' => 'Query execution failed'));
    }

    $stmt->close();
} else {
    echo json_encode(array('error' => 'Department not provided'));
}

$conn->close();
?>
