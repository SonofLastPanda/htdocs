<!-- This script perform the login request from html form in login.php -->

<head>
    <link rel="stylesheet" href="styles.css" type="text/css" />
</head>

<?php
session_start();
// establish server connection
define("encryption_method", "AES-128-CBC");
define("key", "batgirl_to_the_rescue");
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

//echo $_POST['captchacode'];
//echo $_SESSION['captchacode'];

if(($_POST['captchacode']) == $_SESSION['captchacode']) { // Do process the other submitted form data


$uname=$_POST["username"];
$psw=$_POST["psw"];

$_SESSION['username']=$uname;

$admin=FALSE;
$result = mysqli_query($link, "SELECT users.password FROM users WHERE users.username='$uname'");
if (mysqli_num_rows($result) == 0){ #it's not a user
  $result = mysqli_query($link, "SELECT admin.password FROM admin WHERE admin.adminname='$uname'");
  if (mysqli_num_rows($result) != 0){
    $admin=TRUE;
  }
}

$_SESSION['admin']=$admin;

#Error message when wrong or missing password/username are entered
$occured_error = "";
if(! $uname || ! $psw) { #check if username and password were entered
  #error, some fields are empty
  $occured_error='Failed login. Some fields are left empty.';
} elseif (mysqli_num_rows($result) == 0){ #check if user excist in database
    #error, no such username in db
    $occured_error='Failed login. Username or password is wrong.';
} else{ #check if password is correct
while($row = mysqli_fetch_row($result)){
    $stored_psw=$row[0];
    if (password_verify($psw,$stored_psw)==true) {
    #password was correct
  } else {
    #error, wrong password
    $occured_error='Failed login. Username or password is wrong.';
  }
}
}

#Redirection to correct homepage or display error
if ((! $occured_error) && ($admin == FALSE)) {
  header("location: user_frontpage.php");
} elseif ((! $occured_error) && ($admin == TRUE)) {
  header("location: admin_frontpage.php");
} else {
  echo "<script type='text/javascript'>alert('$occured_error');
window.location='login.php';
</script>";
}

include 'close.php';

}
else{
  
  echo "<script type='text/javascript'>alert('Wrong captcha code, please try again!');
  window.location='login.php';
  </script>";



  //header('refresh:1;url=./user_reg.php');

  exit();
}

?>
