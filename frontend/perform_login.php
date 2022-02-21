<!-- This script perform the login request from html form in login.php -->

<head>
    <link rel="stylesheet" href="styles.css" type="text/css" />
</head>

<body>
    <h1>Error message</h1>
</body>

<?php
include 'connect.php';

$result = mysqli_query($link, "SELECT users.password FROM users WHERE users.user_id=1");

$uname=$_POST["uname"];
$psw=$_POST["psw"];

#check captacha, already done??

#check if user excist in database
$sql="SELECT * FROM users WHERE email='$uname'";
$result=mysqli_query($link, $sql);
if(! $uname) {
#if(empty($uname) or empty($psw)) {
  #error, some fields are empty
  die ("Filed login. Some fields are left empty.");
} elseif (! $psw){
  die ("Filed login. Some fields are left empty.");
} elseif (mysqli_num_rows($result) == 0){
    #error, no such username in db
    die("Failed login. Username or password is wrong.");
} else{ #check if password is correct
while($row = mysqli_fetch_row($result)){
    $stored_psw=$row[2];
    if ($psw == $stored_psw) {#(password_verify($psw, $stored_psw)){ #use php function to check if password is correct compared to hashed & salted password stored
    #password was correct, pass user to the next page
    header("location: user_frontpage.php");
  } else {
    #error, wrong password
    die("Failed login. Username or password is wrong.");
  }
}
}
?>