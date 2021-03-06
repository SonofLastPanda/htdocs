<!DOCTYPE html>
<?php
include 'connect.php'; //Including database connection
define("encryption_method", "AES-128-CBC");
define("key", "batgirl_to_the_rescue");
session_start();

#To prevent unlogged in users to enter this page, and non-admins
if (!isset($_SESSION['username']) || $_SESSION['admin']==FALSE) {
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

$username=$_SESSION['username'];
$user_result=mysqli_query($link, "SELECT admin.email, admin.password FROM admin WHERE admin.adminname='$username'");

$FROM = $_GET["FROM"];
$TO = $_GET["TO"];
$result = mysqli_query($link,"SELECT regulation.FROM, regulation.TO, regulation.Boarding, regulation.Qurantine, regulation.Vaccine, regulation.Regulation, regulation.Face_Mask, regulation.Public_Transportation, regulation.Businesses, regulation.Restaurants, regulation.Reminder FROM regulation");

#include "close.php";
?>
<html>
  <head>
    <link href="styles.css" rel="stylesheet" type="text/css"/> <!-- Connecting to the css file named styles.css -->
    <div class="header">
    <h1><img src="logo1.2.png" alt="BatGirl logo" width="50" height="50" style= "margin-bottom: -10px; margin-left: 15px; margin-right: 0px;">CoTRACK-19<form method="get" action="logout.php"><button type="submit" id="myButton" class="button button_header" style="margin-right:7px; top:-53px;";>LOG OUT</form><form method="get" action="index.php"><button type="submit" id="myButton" class="button button_header" style="margin-right:7px; top:-53px;";>HOME</form></h1>
    </div>
  </head>
<body>
<div class="container">
      <img src="map_background.png" class=body_frontpage>
        <div class="boxed_top" style= "padding-top: 10px;">
            <h4 style= "color:#40798C; position: relative; top: 10px; line-height:1.2;" >Edit Depature and Destination<h4>
            <form action="admin_frontpage.php">
            <div style="float: left; display:flex; flex-direction: row;"><p style="padding-left:20px; padding-top:5px;">Departure: &nbsp; </p> <select name="FROM" style="top:-10px; left:-25px; height:25px; margin-top:15px;"> <!--Drop down list-->
            <?php 
            // include "connect.php"; //Including database connection
            
            $result = mysqli_query($link,"SELECT DISTINCT regulation.FROM FROM regulation"); 
            while($row = mysqli_fetch_assoc($result)) { 
            $catname = $row["FROM"]; 
            print "<option>$catname</option>"; 
            }  
            ?> </select></div>
            <div style="float: left; display:flex; flex-direction: row;"><p style="padding-left:20px;">Destination: </p> <select name="TO" style="top:-10px; left:-25px; height:25px; margin-top:10px;"> <!--Drop down list -->
            <?php 
            // include "connect.php"; //Including database connection
            $result2 = mysqli_query($link,"SELECT DISTINCT regulation.TO FROM regulation"); 
            while($row2 = mysqli_fetch_assoc($result2)) { 
            $catname2 = $row2["TO"]; 
            print "<option>$catname2</option>"; 
            } 
            // include 'closeDB.php'; //Closing database conncetion
            ?> </select></div>
            <button id="admin_country_button" class="button button_register" style="margin-top:15px; left:3px;">APPLY</button>
        </form>
        </div>
        <div class="boxed_bottom">
            <br>
            <h4 style= "color:#40798C; position: relative; top: 10px;">Admin Information</h4>
            <p style= "position: relative; top: -10px; margin-bottom:-15px; left:-23px;">Edit admin information below:</p><br>
            <?php
            $row=mysqli_fetch_row($user_result);
            ?>
            <form action="update_admin.php" method="POST" id="submit">
            <div><b><p style="text-align:left; margin-bottom:5px;">Email:</p></b><input type="text" placeholder="<?php echo decrypt($row[0]);?>" value="<?php echo decrypt($row[0]);?>" name="useremail" style="margin-left:0px; color:#40798C;"></div><br>
            <div><b><p style="text-align:left; margin-bottom:5px; margin-top:5px;">Password:</p></b><input id="userpassword" type="password" placeholder="New Password" name="userpassword" style="margin-left:0px;"></div><br>
            <div><b><p style="text-align:left; margin-bottom:5px; margin-top:5px;">Confirm Password:</p></b><input id="confirmpassword" type="password" placeholder="Confirm Password" name="confirmpassword" style="margin-left:0px;"><br>
            <button id="myButton" type="submit" form="submit" value="Submit" class="button button_register"; onclick="return password_validate()"; style="left:0px; top:30px;">UPDATE</button>  
    
          </form>
            <div>
      </div>
    </div>
    <div class="boxed_info">
      <form action="update_database.php">
        <h1> <?php echo "From: $FROM &nbsp &nbsp To: $TO &nbsp" ?></h1>
        <div class=boxed_c_l style= "background-color:#fcfaf4; border-style:dotted; left:425px; top: 214px; height: 475px; width:900px; border-color:#E2E8E5, border-width:5px; margin-bottom:50px;">
               <?php
                  #include 'connect.php';
                  $result = mysqli_query($link,"SELECT regulation.FROM, regulation.TO, regulation.Boarding, regulation.Qurantine, regulation.Regulation,regulation.Vaccine, regulation.Face_Mask, regulation.Public_Transportation, regulation.Businesses, regulation.Restaurants, regulation.Reminder,regulation.ID, source.Source_link FROM regulation, source WHERE (source.Regulation_ID=regulation.ID)");              
                  while($row = mysqli_fetch_row($result)){ 
                  if (($row[0]=="$FROM")&&($row[1]=="$TO")){
                    // Listing all info
                    echo "<input type='hidden' name='id' value='$row[11]'/> ";
                    echo "<input type='hidden' name='from' value='$FROM'/> ";
                    echo "<input type='hidden' name='to' value='$TO'/> ";
                    echo "<div class='scroll_text_country' id='style' style='position:fixed; top: 270px; float:left; left:440px; text-align:justify; height:400px; width:720px; background:#fcfaf4; margin-bottom:0px; margin-right:50px; margin-left:50px; scroll-margin-bottom: 2em;'>";
                    echo "<form>";
                    echo "<p style='font-size:22pt; font-weight:bolder; position:relative; left:-50px; top:-36px; margin-bottom:-20px;'>Boarding</p>";
                    echo "<textarea name='boarding' rows='10'; cols='95'; style='color:#40798C; font-family:'Red Hat Display'; font-size:12pt; position:relative; left:20px; top:20px; margin-bottom:-20px;'> $row[2] </textarea>";
                    echo "<p style='font-size:22pt; font-weight:bolder; position:relative; left:-50px; top:20px;'>Quarantine</p>";
                    echo "<textarea name='quarantine'  rows='10'; cols='95'; style='color:#40798C; font-family:'Red Hat Display'; font-size:12pt; position:relative; left:20px; top:20px; margin-bottom:-20px;'> $row[3] </textarea>";
                    echo "<p style='font-size:22pt; font-weight:bolder; position:relative; left:-50px; top:20px;'>Vaccination</p>";
                    echo "<textarea name='vaccination'  rows='10'; cols='95'; style='color:#40798C; font-family:'Red Hat Display'; font-size:12pt; position:relative; left:20px; top:20px; margin-bottom:-20px;'> $row[4] </textarea>";
                    echo "<p style='font-size:22pt; font-weight:bolder; position:relative; left:-50px; top:20px;'>Face Mask</p>";
                    echo "<textarea name='face_mask'  rows='10'; cols='95'; style='color:#40798C; font-family:'Red Hat Display'; font-size:12pt; position:relative; left:20px; top:20px; margin-bottom:-20px;'> $row[6] </textarea>";
                    echo "<p style='font-size:22pt; font-weight:bolder; position:relative; left:-50px; top:20px;'>Public Transportation</p>";
                    echo "<textarea name='transport'  rows='10'; cols='95'; style='color:#40798C; font-family:'Red Hat Display'; font-size:12pt; position:relative; left:20px; top:20px; margin-bottom:-20px;'> $row[7] </textarea>";
                    echo "<p style='font-size:22pt; font-weight:bolder; position:relative; left:-50px; top:20px;'>Businesses</p>";
                    echo "<textarea name='business'  rows='10'; cols='95'; style='color:#40798C; font-family:'Red Hat Display'; font-size:12pt; position:relative; left:20px; top:20px; margin-bottom:-20px;'> $row[8] </textarea>";
                    echo "<p style='font-size:22pt; font-weight:bolder; position:relative; left:-50px; top:20px;'>Restaurants</p>";
                    echo "<textarea name='restaurants'  rows='10'; cols='95'; style='color:#40798C; font-family:'Red Hat Display'; font-size:12pt; position:relative; left:20px; top:20px; margin-bottom:-20px;'> $row[9] </textarea>";
                    echo "<p style='font-size:22pt; font-weight:bolder; position:relative; left:-50px; top:20px;'>Reminder</p>";
                    echo "<textarea name='reminder'  rows='10'; cols='95'; style='color:#40798C; font-family:'Red Hat Display'; font-size:12pt; position:relative; left:20px; top:20px; margin-bottom:-20px;'> $row[10] </textarea>";
                    echo "<p style='font-size:22pt; font-weight:bolder; position:relative; left:-50px; top:20px;'>Sources</p>";
                    echo "<textarea name='sources'  rows='10'; cols='95'; style='color:#40798C; font-family:'Red Hat Display'; font-size:12pt; position:relative; left:20px; top:20px; margin-bottom:-20px;'> $row[12] </textarea>";
                    }}
                    echo "</form>";
                  #include "close.php"
                ?>
        </div>
        <button id="button_admin"; class="button button_admin"; style="position:fixed; top:745px; left:850px;">UPDATE</button>
                  </form>
      </div>
        
</div>
</body>
  <?php include "close.php" ?>
</div>
</div>
<script type="text/javascript">
    function password_validate() {
        var password = document.getElementById("userpassword").value;
        var confirmPassword = document.getElementById("confirmpassword").value;
        if (password != confirmPassword) {
            alert("Passwords do not match.");
            return false;
        }
        return true;
    }
</script>
</html>
