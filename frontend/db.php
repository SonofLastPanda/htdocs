<!--- Script to connect to the database --->
<?php
$hostname = "localhost";
$username = "root";
$password = "root";
$dbname = "batgirl_project";
$link = mysqli_connect($hostname, $username, $password, $dbname); //link to connect to the database

if (!$link) { //Error message if not able to connect to the database
  echo "Error: Unable to connect to MySQL." .
  mysqli_connect_error() . PHP_EOL;
  exit;
}
?>