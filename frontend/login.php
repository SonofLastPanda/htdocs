<!-- Code for the webpage in which one can register as a user.  -->
<?php

session_start();

?>
<!DOCTYPE html>
<html>
  <head>
    <link href="styles.css" rel="stylesheet" type="text/css"/> <!-- Connecting to the css file named styles.css -->
    <div class="header">
    <h1><img src="logo1.2.png" alt="BatGirl logo" width="50" height="50" style= "margin-bottom: -10px; margin-left: 15px; margin-right: 0px;">CoTRACK-19<form method="get" action="index.php"><button type="submit" id="myButton" class="button button_header" style="margin-right:7px; top:-53px;";>HOME</form></h1>
    </div>
  </head>
  <body>
  <div class="container">
  <img src="map_background.png" class=body_frontpage>
    <div class= "boxed_login">
      <form action="./perform_login.php" method="POST">
      <div>
      <h1 style= "text-align: center; margin-right:10px;">Login</h1>
      <p>Please fill in the form below:</p>
        <label for="username"><b>Username</b></label>
        <input type="text" placeholder="Enter Username" name="username" required><br><br>
        <label for="psw"><b>Password</b></label>
        <input type="password" placeholder="Enter Password" name="psw" required><br>
        <p>Please validate by submitting your CAPTCHA:</p>
        <!--canvas id="captcha" style="position: relative; top: -35px;">captcha text</canvas>
        <div><p style="position: relative;top: -95px; left:1px;">Enter CAPTCHA here:</p><input id="textBox" type="text" name="text"style="position: relative; top: -134px; left: 205px;"><div>
        <div><button id="refreshButton" type="submit" class= "button button_register" style="position:relative; left:130px; top:-110px;">REFRESH CAPTCHA</button></div>
        <span id="output"></span>
        <script src="script.js"></script-->
        <input name="captchacode" type="text" name="text"style="position: relative; top: -10px; left: 125px;" required ><br>

    <img style="position:relative; top:0px; left:100px;" src="captcha/captcha.php">

    <br>
     
    
      <button name="submit" id="myButton" type="submit" class= "button button_register" style= "margin-left:43px; top:0px;">LOGIN</button>
</div>
      </form>
    </div>
  </div>
  </body>
</div>
</div>
</html>