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
      <div class="boxed_login">
      <form action="/performreg.php">
      <div class="">
      <h1 style= "text-align: center;">User Information</h1>
      <p>Edit user information below:</p>
      
      <label><b>Email:</b></label>
      <input type="text" placeholder="Enter Email" name="useremail" required><br><br>
      <label><b>Password:</b></label>
      <input type="password" placeholder="Enter Password" name="userpassword" required><br><br>
      <label><b>Confirm Password:</b></label>
      <input type="password" placeholder="Confirm Password" name="confirmpassword" required><br><br>
      <label for="Nationality"><b>Nationality:</b></label>
      <select id="nationality" name="nationality">
      <option value="HongKong">Hong Kong</option>
      <option value="India">India</option>
      <option value="Sweden">Sweden</option>
      <option value="Turkey">Türkiye</option>
      </select><br><br>
      <label><b># of Vaccine doses:</b></label>
      <input type="vaccine_doses" placeholder="Number of Doses" name="vaccine_doses" required><br><br>
      <label><b>Vaccine type:</b></label>
      <input type="vaccine_type" placeholder="Brand of Vaccine" name="vaccine_type" required><br><br>
      <div>
      <button onclick="location.href = 'www.yoursite.com';" id="myButton" class="button button_register"; style= "margin-left:43px;">UPDATE</button>
      </div></div>
      </div>
      </form>
</body>