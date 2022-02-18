<?php
include 'connect_db.php'; //Including database connection
if (!$link) { //Error message if no database connection
    echo "Error: Unable to connect to MySQL." . mysqli_connect_error() . PHP_EOL;
    exit;
}
//Establishing local variables for SQL query
$email = $_POST["email"]; 
$psw = $_POST["psw"];

$sql = "INSERT INTO movies (mid, mname, myear, mgenreid, mrating) VALUES (NULL, '$mname', '$myear', '$mgenreid', '$mrating')";
if (mysqli_query($link,$sql)){ //Insertion into database
    echo "New movie addded successfully! You entered $mname to the database.";
} else { //Error message if database insertion fails
    echo "Error: " . $sql . "<br>" . mysqli_error($link);
};

header("refresh: 8; url=index.php"); //Go back to index page after 8 seconds if successfully inserted movie
include 'closeDB.php' //Closing database conncetion

?>