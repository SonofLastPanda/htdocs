<!DOCTYPE html>
<html>
  <head>
    <link href="styles.css" rel="stylesheet" type="text/css" />
    <div class="header">
    <h1><img src="logo1.2.png" alt="BatGirl logo" width="50" height="50" style= "margin-bottom: -10px; margin-left: 15px; margin-right: 0px;">CoTRACK-19<button type="submit" id="loginButton" class="button button_header"; form="login_form" style="margin-right:7px;">LOGIN<form method="get" id="login_form" action="login.php"></form></button><button type="submit" id="registerButton" form="reg_form" class="button button_header" style="margin-right:3px;" >REGISTER USER<form method="get" id="reg_form" action="user_reg.php"></form></button></h1>
    </div>
  </head>
 <body>
    <div class="container">
      <img src="map_background.png" class=body_frontpage>
      <div class="centered">COVID-19 Restriction Tracking System</div>
      <div class="boxed_l"><h3>Welcome traveler!</h1> <div class="p2">As a traveler in 2022, it can be difficult to gather all information needed in an easy way. CoTRACK-19 is a COVID-19 regulation tracking system which can be used when traveling between different parts of the world. </div><br> <h4>Safe travels!</h4>
      </div><div class="boxed_m"><h3>Want updates?<br>Log in!</h3><div class="p2">This way you can get updates about your favorite destinations.<br> CoTRACK-19 is updated regularly with new information from government websites, national authorities and other official information channels. <b>We stay updated so that you don't have to!</b></div></div>
      <div class="boxed_r"><h3>Search your travel route:</h3>
      <form action="country_page.php">
        <div style="margin-left:50px; text-align:left; display:inline-block; min-width: 50px;">
        Departure: &nbsp; <select name="FROM"> <!--Drop down list-->
        <?php 
          include "connect.php"; //Including database connection
          $result = mysqli_query($link,"SELECT DISTINCT regulation.FROM FROM regulation"); 
          while($row = mysqli_fetch_assoc($result)) { 
          // $catid = $row["FROM"];
          $catname = $row["FROM"]; 
          print "<option>$catname</option>"; 
        }  
        ?> </select> <br><br>
        
        Destination: <select name="TO"> <!--Drop down list -->
        <?php 
          include "connect.php"; //Including database connection
          $result2 = mysqli_query($link,"SELECT DISTINCT regulation.TO FROM regulation"); 
          while($row2 = mysqli_fetch_assoc($result2)) { 
          // $catid = $row["TO"];
          $catname2 = $row2["TO"]; 
          print "<option>$catname2</option>"; 
        } 
        include 'closeDB.php'; //Closing database conncetion
        ?> </select>
        </div><br>
        <button id="country_button" class="button button_register" style="margin-top:20px; margin-left:20px;">SEARCH</button>
    </div>
</body>
</div>
</div>
</html>

