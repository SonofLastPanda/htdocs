<!-- Code for the webpage in which one can register as a user.  -->
<!DOCTYPE html>
<html>
  <head>
    <link href="styles.css" rel="stylesheet" type="text/css"/> <!-- Connecting to the css file named styles.css -->
    <div class="header">
    <h1><img src="logo1.2.png" alt="BatGirl logo" width="50" height="50" style= "margin-bottom: -10px; margin-left: 30px; margin-right: -10px;">CoTRACK-19<form method="get" action="index.php"><button type="submit" id="myButton" class="button button_header";>HOME</form></h1>
    </div>
  </head>
  <body>
  <div class="container">
    <div class= "boxed_c">
      <form action="login.php">
      <div>
      <h1 style= "text-align: center;">Login</h1>
      <p>Please fill in this form below:</p>
        <label for="uname"><b>Username</b></label>
        <input type="text" placeholder="Enter Username" name="uname" required><br><br>
        <label for="psw"><b>Password    </b></label>
        <input type="password" placeholder="Enter Password" name="psw" required>
      </label><br><br>
        <!-- <span class="psw" style= "font-family: 'Red Hat Display'; color: #77A6B6; text-align:center;">Forgot <a href="#">password?</a></span> -->
      <div><form method="get" action="index.php"><button type = "submit" id="myButton" class="button button_register";>CANCEL</form>
      <button onclick="location.href = 'www.yoursite.com';" id="myButton" class="button button_register"; style= "float: center;">LOGIN</button>
      </div>
      </div>
      </form>
    </div>
  </div>
  </body>
</div>
</div>
</html>
