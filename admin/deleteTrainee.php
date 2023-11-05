<?php
$dbhost = "localhost:3306";
$dbuser = "root";
$dbpss = "";
$dbname = "lgdb";

$connection = new mysqli($dbhost, $dbuser, $dbpss, $dbname);

if ($connection->connect_error) {
    die("Connection error:" . $connection->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["email"])) {
        $email = $connection->real_escape_string($_POST["email"]);
             $c=0;
               $sql="delete from pfp where EmailID=?";
               $stmt = $connection->prepare($sql);
               $stmt->bind_param("s",$email);
               if ($stmt->execute()) {  
                   $c=1;
            } else {
                echo "Error: " . $stmt->error;
            }
            $sql="delete from details where EmailID=?";
               $stmt = $connection->prepare($sql);
               $stmt->bind_param("s",$email);
               if ($stmt->execute()) {  
                   $c=1;
            } else {
                echo "Error: " . $stmt->error;
            }
            $sql="delete from users where email=?";
               $stmt = $connection->prepare($sql);
               $stmt->bind_param("s",$email);
               if ($stmt->execute()) {  
                   $c=1;
            } else {
                echo "Error: " . $stmt->error;
            }
            
            if($c==1){
            echo '<script>alert("Profile deletd!");</script>';
            header("refresh: 0.1; url=editTrainee.php");}
            else{
            echo '<script>alert("failed!");</script>';
                header("refresh: 0.1; url=editTrainee.php");}
        
        
            }
        
}
                    
        
?>


