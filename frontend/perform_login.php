<!-- This script perform the login request from html form in login.php -->

<head>
    <link rel="stylesheet" href="styles.css" type="text/css" />
</head>

<?php
session_start();
// establish server connection
define("encryption_method", "AES-128-CBC");
define("key", "your_amazing_key_here"); //change the encryption key?? The web site says one should
include 'connect.php';

// decrypt data
function decrypt($data) {
  $key = key;
  $c = base64_decode($data);
  $ivlen = openssl_cipher_iv_length($cipher = encryption_method);
  $iv = substr($c, 0, $ivlen);
  $hmac = substr($c, $ivlen, $sha2len = 32);
  $ciphertext_raw = substr($c, $ivlen + $sha2len);
  $original_plaintext = openssl_decrypt($ciphertext_raw, $cipher, $key, $options = OPENSSL_RAW_DATA, $iv);
  $calcmac = hash_hmac('sha256', $ciphertext_raw, $key, $as_binary = true);
  if (hash_equals($hmac, $calcmac))
  {
      return $original_plaintext;
  }
}

#Check if connection to database is established 
if (!$link) {
  echo "Error: Unable to connect to MySQL." . mysqli_connect_error() . PHP_EOL;
  exit;
}

$uname=$_POST["username"];
$psw=$_POST["psw"];

$_SESSION['username']=$uname;

$result = mysqli_query($link, "SELECT users.password FROM users WHERE users.username='$uname'");


#$captcha="<script>document.writeln(cap);</script>";
#if ($captcha != "Correct!") {
# echo $captcha;
#  die("Wrong captcha");
#} else {
# echo $captcha;
#};


$occured_error = "";
if(! $uname || ! $psw) { #check if username and password were entered
  #error, some fields are empty
  $occured_error='Failed login. Some fields are left empty.';
} elseif (mysqli_num_rows($result) == 0){ #check if user excist in database
    #error, no such username in db
    $occured_error='Failed login. Username or password is wrong.';
} else{ #check if password is correct
while($row = mysqli_fetch_row($result)){
    $stored_psw=decrypt($row[0]);
    if ($psw == $stored_psw) {
    #password was correct
  } else {
    #error, wrong password
    $occured_error='Failed login. Username or password is wrong.';
  }
}
}

#Error message when wrong or missing password/username are entered
if (! $occured_error) {
  header("location: user_frontpage.php");
} else {
  echo "<script type='text/javascript'>alert('$occured_error');
window.location='login.php';
</script>";
}

include 'close.php';
?>