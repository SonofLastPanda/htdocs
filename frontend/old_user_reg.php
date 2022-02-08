<!DOCTYPE html>
<html>
  <head>
    <link href="styles.css" rel="stylesheet" type="text/css" />
    <div class="header">
    <h1><img src="logo1.2.png" alt="BatGirl logo" width="50" height="50" style= "margin-bottom: -10px; margin-left: 30px; margin-right: -10px;"> CoTRACK-19<button onclick="location.href = 'www.yoursite.com';" id="myButton" class="button button_header";>HOME</button></h1>
    </div>
  </head>
  <body>
  <div class="container">
    <form action="/performreg.php">
    <div>
    <h1>User Registration Form</h1>
    <p>Please fill in this form below:</p>
    <label><b>Username:</b></label>
    <input type="text" placeholder=" Enter Username" name="username" required><br><br>
    <label><b>Email:</b></label>
    <input type="text" placeholder="Enter Email" name="useremail" required><br><br>
    <label><b>Password:</b></label>
    <input type="password" placeholder="Enter Password" name="userpassword" required><br><br>
    <label><b>Confirm Password:</b></label>
    <input type="password" placeholder="Confirm Password" name="confirmpassword" required><br><br>
    <label for="Nationality"><b>Nationality:</b></label>
    <select id="nationality" name="nationality">
    <option value="Sweden">Sweden</option>
    <option value="USA">USA</option>
    <option value="Denmark">Denmark</option>
    </select><br><br>
    <label><b># of Vaccine doses:</b></label>
    <input type="vaccine_doses" placeholder="Number of doses" name="vaccine_doses" required><br><br>
    <label><b>Vaccine type:</b></label>
    <input type="vaccine_type" placeholder="Brand of vaccine" name="vaccine_type" required><br><br>
    <p>By creating an account you agree to our <a href="linktotermsandprivacypage.html" style="color:dodgerblue">Terms & Privacy</a>.</p>
    <div> <button onclick="location.href = 'www.yoursite.com';" id="myButton" class="button button_register";>CANCEL</button>
    <button onclick="location.href = 'www.yoursite.com';" id="myButton" class="button button_register";>REGISTER</button>
    </div></div>
    </form>
  </body>
</div>
</div>
</html>
