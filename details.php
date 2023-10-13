<?php

$dbhost="localhost:3306";
$dbuser="root";
$dbpss="";
$dbname="lgdb";

$connection =new mysqli($dbhost,$dbuser,$dbpss,$dbname);

if($connection->connect_error){
    die("Connection error:".$connection->connect_error);

}

if( $_SERVER["REQUEST_METHOD"]=="POST")
{
    $name=$_POST["name"];
    $email=$_POST["email"];
    $contactNo=$_POST["contactNo"];
    $collegeName=$_POST["collegeName"];
    $course=$_POST["course"];
    $semester=$_POST["semester"];    
    $projectTitle=$_POST["projectTitle"];
    $tslDepartment=$_POST["tslDepartment"];
    $peojectGuide=$_POST["projectGuide"];


$sql="insert into details (Name,EmailID,ContactNo,CollegeName,Course,Semester,ProjectTitle,TSLDepartment,ProjectGuide) values (?,?,?,?,?,?,?,?,?)";

$stmt = $connection->prepare($sql);
$stmt->bind_param("sssssssss", $name,$email,$contactNo,$collegeName,$course,$semester,$projectTitle,$tslDepartment,$peojectGuide);

if ($stmt->execute()) {
    echo '<script>alert("Profile Completed!");</script>';
    header("refresh: 0.5; url=dashboard.php"); // Redirect after a 0-second delay

} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();

}
$connection->close();
?>
