<!DOCTYPE html>
<html>
  
<head>
    <title>Validation</title>
</head>
  
<body>
    <center>

<?php
    // establish server connection
    include 'connect.php';

    // values
    $username = $_REQUEST["username"]; 
    $usermail = $_REQUEST["usermail"];
    $password = $_REQUEST["password"]; 
    $vaccinedoses = $_REQUEST["vaccine_doses"];
    $vaccinetype= $_REQUEST["vaccine_type"]

    //SQL Queries to insert data

    $sql = "INSERT INTO Users (user_id, usermail, password) VALUES ('$username', '$usermail', '$password')";
    if(mysqli_query($link, $sql)){
    echo "Records inserted successfully.";
    }   
    else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
    }

    $sql = "INSERT INTO Vaccination_Info (user_id,vaccine_type ) VALUES ('$username', '$vaccinetype')";
    if(mysqli_query($link, $sql)){
    echo "Records inserted successfully.";
    }   
    else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
    }
    
    // Close connection
    include 'close.php';

?>

</center>
</body>
  
</html>
