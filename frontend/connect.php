<?php
$hostname2 = 'localhost';
$username2 = "root";
$password2 = "root";
$dbname2 = "batgirl_project";

//Establishing connection
$link = mysqli_connect($hostname2, $username2, $password2, $dbname2);

if (!$link) { //Error message if no connection to database
echo "Error: Unable to connect to MySQL." . mysqli_connect_error() . PHP_EOL;
exit;
}
?>