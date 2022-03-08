<?php
include 'connect.php';
session_start();

$new_to=$_GET["TO"];
$username=$_SESSION['username'];

#To prevent unlogged in users to enter this page
if (!isset($_SESSION['username'])) {
    header("location: login.php");
    die();
  }

#Transaction to update database
mysqli_autocommit($link, FALSE);
$queries_ok=TRUE;

mysqli_query($link, "INSERT INTO bookmark (bookmark.user_id, bookmark.country_id)
                    SELECT users.user_id, country.country_id
                    FROM users, country
                    WHERE users.username = '$username'
                    AND country.country_name = '$new_to'
                    AND NOT EXISTS
                    (SELECT users.username, country.country_name
                    FROM country
                    JOIN bookmark ON country.country_id = bookmark.country_id
                    JOIN users ON users.user_id = bookmark.user_id
                    WHERE users.username = '$username'
                    AND country.country_name = '$new_to');
                    ") ? null: $queries_ok=FALSE;

#Commit Transaction
if ($queries_ok) {
    mysqli_commit($link);
} else {
    echo "Commit transaction failed";
    mysqli_rollback($link);
    exit();
}

header("location: user_frontpage.php");

include 'close.php';

?>