<!-- Code for the webpage in which one can register as a user.  -->
<!DOCTYPE html>
<html>
  <head>
    <link href="styles.css" rel="stylesheet" type="text/css"/> <!-- Connecting to the css file named styles.css -->
    <script src="https://www.google.com/recaptcha/api.js"></script>
    <div class="header">
    <h1><img src="logo1.2.png" alt="BatGirl logo" width="50" height="50" style= "margin-bottom: -10px; margin-left: 15px; margin-right: 0px;">CoTRACK-19<form method="get" action="index.php"><button type="submit" id="myButton" class="button button_header" style="margin-right:7px; top:-53px;";>HOME</form></h1>
    </div>
  </head>
  <body>
  <div class="container">
  <img src="map_background.png" class=body_frontpage>
  
    <div class="scrollbar" id="style2">
      <div class="boxed_c" id="style2">
      <div class="scroll_user" id="style2">
      <form action="./performreg_2.php" method="POST" id="submit">
      <div>
      <h1 style= "text-align: center;">User Registration</h1>
      <p>Please fill in the form below:</p>
      <label><b>Username:</b></label>
      <input type="text" placeholder="Enter a Fun Username" name="username" required><br><br>
      <label><b>Email:</b></label>
      <input type="email" placeholder="Enter Email" name="useremail" required><br><br>
      <label><b>Password:</b></label>
      <input type="password" placeholder="Enter Password" name="userpassword" id="userpassword" required><br><br>
      <label><b>Confirm Password:</b></label>
      <input type="password" placeholder="Confirm Password" name="confirm_password" id="confirm_password" required><br><br>
      <label for="Nationality"><b>Nationality:</b></label>
      <select id="nationality" name="nationality">
      <!--<option value="choose">Nationality</option>
      <option value="HongKong">Hong Kong</option>
      <option value="India">India</option>-->
      <option value="Sweden">Sweden</option>
      <!--<option value="Turkey">Türkiye</option>-->
      </select><br><br>
      <p>Please validate by submitting your CAPTCHA:</p>
        <div class="g-recaptcha brochure__form__captcha" data-sitekey="6LevzsoeAAAAAMOZtVgI7q7MnFipVPoyB-U0-cFr"></div>
        
      <p style="position:relative; top:-100px; left:-10px;">By creating an account you agree to our <a href="terms.php" style="color:dodgerblue; position:relative;">Terms & Privacy</a>.</p>
     
      <div>
      <button id="submitButton" type="submit" form="submit"  value="Submit"  class= "button button_register" onclick="return Validate()"; style= "margin-left:43px; top:-90px;">REGISTER</button>
      </div>
      </div>
      </div>
</div>
      </form>
    </div>
  </body>
</div>
</div>
<script src="script.js"></script>
<script type="text/javascript">
    function Validate() {
        var password = document.getElementById("userpassword").value;
        var confirmPassword = document.getElementById("confirm_password").value;
        if (password != confirmPassword) {
            alert("Passwords do not match.");
            return false;
        }
        return true;
    }

    function reCaptcha($recaptcha){
  $secret = "6LevzsoeAAAAAHVE88IAKb7Hxf124k5mEHaKhXT8";
  $ip = $_SERVER['REMOTE_ADDR'];

  $postvars = array("secret"=>$secret, "response"=>$recaptcha, "remoteip"=>$ip);
  $url = "https://www.google.com/recaptcha/api/siteverify";
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_TIMEOUT, 10);
  curl_setopt($ch, CURLOPT_POSTFIELDS, $postvars);
  $data = curl_exec($ch);
  curl_close($ch);

  return json_decode($data, true);
}
</script>
</html>
<!-- style="position: relative; top: -45px; font-family: 'Red Hat Display';" -->