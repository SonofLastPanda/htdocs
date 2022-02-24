<!-- This script perform the login request from html form in login.php -->

<head>
    <link rel="stylesheet" href="styles.css" type="text/css" />
</head>

<body>
    <h1>Error message</h1>
</body>

<?php
session_start();
include 'connect.php';

$uname=$_POST["uname"];
$psw=$_POST["psw"];

$_SESSION['email']=$uname;
header('Location: user_frontpage.php');

$result = mysqli_query($link, "SELECT users.password FROM users WHERE users.email='$uname'");

#check captacha! Else return error

if(! $uname || ! $psw) { #check if username and password were entered
  #error, some fields are empty
  die ("Filed login. Some fields are left empty.");
} elseif (mysqli_num_rows($result) == 0){ #check if user excist in database
    #error, no such username in db
    die("Failed login. Username or password is wrong.");
} else{ #check if password is correct
while($row = mysqli_fetch_row($result)){
    $stored_psw=$row[0];
    if ($psw == $stored_psw) {#(password_verify($psw, $stored_psw)){ #use php function to check if password is correct compared to hashed & salted password stored
    #password was correct, pass user to the next page
    header("location: user_frontpage.php");
  } else {
    #error, wrong password
    die("Failed login. Username or password is wrong.");
  }
}
}
include 'close.php';
?>