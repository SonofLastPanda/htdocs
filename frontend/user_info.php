<!DOCTYPE html>
<!-- This file is a HTML form for users to update their userinformation -->

<?php
// establish server connection
define("encryption_method", "AES-128-CBC");
define("key", "batgirl_to_the_rescue"); //change the encryption key?? The web site says one should
include 'connect.php';
session_start();

#To prevent unlogged in users to enter this page
if (!isset($_SESSION['username'])) {
  header("location: login.php");
  die();
}

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

$old_username = $_SESSION['username'];

#Check if connection to database is established 
if (!$link) {
  echo "Error: Unable to connect to MySQL." . mysqli_connect_error() . PHP_EOL;
  exit;
}

$result=mysqli_query($link, "SELECT users.email, users.password FROM users WHERE users.username='$old_username'");
?>

<html>
  <head>
    <link href="styles.css" rel="stylesheet" type="text/css"/> <!-- Connecting to the css file named styles.css -->
    <div class="header">
    <h1><img src="logo1.2.png" alt="BatGirl logo" width="50" height="50" style= "margin-bottom: -10px; margin-left: 15px; margin-right: 0px;">CoTRACK-19<form method="get" action="logout.php"><button type="submit" id="myButton" class="button button_header" style="margin-right:7px; top:-53px;";>LOG OUT</form><form method="get" action="user_frontpage.php"><button type="submit" id="myButton" class="button button_header" style="margin-right:7px; top:-53px;";>HOME</form></h1>
    </div>
  </head>
  <body>
  <div class="container">
      <img src="map_background.png" class=body_frontpage>
      <div class="boxed_login">
      <form action="update_user.php" method="POST" id="submit">
      <div class="">
      <h1 style= "text-align: center;">User Information</h1>
      <p>Edit user information below:</p>
      <?php
      $row=mysqli_fetch_row($result);
      ?>
      <label><b>Username: </b></label>
      <input type="text" placeholder="<?php echo $old_username;?>" name="new_username" value="<?php echo $old_username;?>"><br><br>
      <label><b>Email: </b></label>
      <input type="text" placeholder="<?php echo decrypt($row[0]);?>" name="new_useremail" value="<?php echo decrypt($row[0]);?>"><br><br>
      <label><b>Password:</b></label>
      <input type="password" placeholder="Enter New Password" name="new_userpassword" id="new_userpassword" value="<?php echo decrypt($row[1]);?>"><br><br>
      <label><b>Confirm Password:</b></label>
      <input type="password" placeholder="Confirm  Password" name="new_confirmpassword" id="new_confirmpassword" value="<?php echo decrypt($row[1]);?>"><br><br>
      <label for="Nationality"><b>Nationality:</b></label>
      <select id="nationality" name="nationality">
      <option value="Sweden">Sweden</option>
      <!-- <option value="India">India</option>
      <option value="Sweden">Sweden</option>
      <option value="Turkey">Türkiye</option>-->
      </select><br><br> <br>
      <!--<label><b># of Vaccine doses:</b></label>
      <input type="vaccine_doses" placeholder="Number of Doses" name="vaccine_doses" required><br><br>
      <label><b>Vaccine type:</b></label>
      <input type="vaccine_type" placeholder="Brand of Vaccine" name="vaccine_type" required><br><br> -->

      <label><b>Remove favorited destination:</b></label> <select name="TO"> <!--Drop down list -->
        <option value="value" selected>Bookmark</option>
        <?php 
          include "connect.php"; //Including database connection
          $result2 = mysqli_query($link,"SELECT country.country_name FROM country JOIN bookmark ON country.country_id = bookmark.country_id JOIN users ON users.user_id = bookmark.user_id WHERE users.username = '$old_username'"); 
          while($row2 = mysqli_fetch_assoc($result2)) { 
          // $catid = $row["TO"];
          $catname2 = $row2["country_name"]; 
          print "<option>$catname2</option>"; 
        } 
        include 'close.php'; //Closing database conncetion
        ?> </select>
      
      <div>
        <br><br>
      <button type="submit" form="submit" value="Submit" class="button button_register" onclick="return password_validate()"; style= "margin-left:43px;">UPDATE</button> 
    </div></div>
      </div>
      </form>
</body>

<script type="text/javascript">
    function password_validate() {
        var password = document.getElementById("new_userpassword").value;
        var confirmPassword = document.getElementById("new_confirmpassword").value;
        if (password != confirmPassword) {
            alert("Passwords do not match.");
            return false;
        }
        return true;
    }
</script>
</html>