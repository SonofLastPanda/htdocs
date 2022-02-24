<?php
    $hostname = "localhost";
    $username = "root";
    $password = "root";
    $dbname = "BATGIRL_PROJECT";
    $link = mysqli_connect($hostname, $username, $password, $dbname);
    if (!$link) {
        echo "Error: Unable to connect to MySQL." . mysqli_connect_error() . PHP_EOL;
        exit;
    }
?>