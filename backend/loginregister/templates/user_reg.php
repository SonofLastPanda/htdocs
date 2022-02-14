<!-- Code for the webpage in which one can register as a user.  -->
{% load static %}
<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" href="{% static 'css/style.css' %}" type="text/css"/> Connecting to the css file named styles.css
    <div class="header">
    <!-- <h1><img src="/Users/ellensiggstedt/Desktop/Informationshanteringssystem/IMS Projekt/CoTRACK/frontend/logo1.2.png" alt="BatGirl logo" width="50" height="50" style= "margin-bottom: -10px; margin-left: 30px; margin-right: 0px;">CoTRACK-19<form method="get" action="index.php"><button type="submit" id="myButton" class="button button_header";>HOME</form></h1>-->
    </div>
  </head>
  <body>
  <div class="container">
    <div class="boxed_c">
      <form action="", method="post">
      {% csrf_token %} <!-- some security thing-->
      <div>
      <h1 style= "text-align: center;">User Registration</h1>
      <p>Please fill in the form below:</p>
      <label><b>Username:</b></label>
      <input type="text" placeholder="Enter Username" name="username" required><br><br>
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
      <p>By creating an account you agree to our <a href="linktotermsandprivacypage.html" style="color:dodgerblue">Terms & Privacy</a>.</p>
      <div><form method="get" action="index.php"><button type = "submit" id="myButton" class="button button_register";>CANCEL</form>
      <button id="myButton" class="button button_register"; style= "float: center;">REGISTER</button>
      </div></div>
      </form>
    </div>
  </body>
</div>
</div>
</html>