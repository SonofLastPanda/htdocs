<!DOCTYPE html>
<?php
include 'connect.php'; //Including database connection
$FROM = $_GET["FROM"];
$TO = $_GET["TO"];
$result = mysqli_query($link,"SELECT regulation.FROM, regulation.TO, regulation.Boarding, regulation.Qurantine, regulation.Regulation,regulation.Vaccine, regulation.Face_Mask, regulation.Public_Transportation, regulation.Businesses, regulation.Restaurants, regulation.Reminder FROM regulation");
?>
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
        <div class="boxed_top" style= "padding-top: 10px;">
            <h4 style= "color:#40798C; position: relative; top: 10px;" >Edit Depature and Destination<h4>
            <form action="admin_frontpage.php">
            <div style="float: left; display:flex; flex-direction: row;"><p>Departure: &nbsp; <p> <select name="FROM" style="postion: relative; top:-5px; left:-25px;"> <!--Drop down list-->
            <?php 
            include "connect.php"; //Including database connection
            $result = mysqli_query($link,"SELECT DISTINCT regulation.FROM FROM regulation"); 
            while($row = mysqli_fetch_assoc($result)) { 
            $catname = $row["FROM"]; 
            print "<option>$catname</option>"; 
            }  
            ?> </select></div>
            <div style="float: left; display:flex; flex-direction: row;"><p>Destination: <p> <select name="TO"> <!--Drop down list -->
            <?php 
            include "connect.php"; //Including database connection
            $result2 = mysqli_query($link,"SELECT DISTINCT regulation.TO FROM regulation"); 
            while($row2 = mysqli_fetch_assoc($result2)) { 
            $catname2 = $row2["TO"]; 
            print "<option>$catname2</option>"; 
            } 
            include 'closeDB.php'; //Closing database conncetion
            ?> </select></div>
            <button id="admin_country_button" class="button button_register" style=>APPLY</button>
        </form>
        </div>
        <div class="boxed_bottom">
            <br>
            <h4 style= "color:#40798C; position: relative; top: 10px;">Admin Information</h4>
            <p style= "position: relative; top: -10px; margin-bottom:-15px; text-align:left;">Edit user information below:</p><br>
            <form action="admin_frontpage.php">
            <div><label><b>Email:</b></label><input type="text" placeholder="Enter Email" name="useremail"></div><br><br>
            <div><label><b> New Password:</b></label><input type="password" class="resizedTextbox" placeholder="Enter Password" name="userpassword"></div><br><br>
            <div><label><b>Confirm New Password:</b></label><input type="password" placeholder="Confirm Password" name="confirmpassword"><br><br>
            <button onclick="location.href = 'www.yoursite.com';" id="myButton" class="button button_register";>UPDATE</button>
            </form>
            <div>
      </div>
    </div>
    <div class="boxed_info">
      <h1> <?php echo "From: $FROM &nbsp &nbsp To: $TO &nbsp" ?></h1>
        <div class=boxed_c_l style= "background-color:#f8f7f1; position: relative; top:-10px; left:45px; border-style:dotted; border-color:#E2E8E5, border-width:5px;" >
          <p style='font-size:18pt; font-weight:bolder; position:relative;'>Current information</p>
          <div class="scrollbar_country" id="style">
            <div class="scroll_text_country" id="style">
            <?php
              include "connect.php"; 
              while($row = mysqli_fetch_row($result)){ 
              if (($row[0]=="$FROM")&&($row[1]=="$TO")){ 
                echo "<p style='font-size:16pt; font-weight:bolder; position:relative; left:-50px; top:20px;'>Boarding</p>";
                echo $row[2];
                echo "<p style='font-size:16pt; font-weight:bolder; position:relative; left:-50px; top:20px;'>Quarantine</p>";
                echo $row[3];
                // echo "<p style='font-size:16pt; font-weight:bolder; position:relative; left:-50px; top:20px;'>Regulations</p>";
                // echo $row[4];
                echo "<p style='font-size:16pt; font-weight:bolder; position:relative; left:-50px; top:20px;'>Vaccination</p>";
                echo $row[5];
                echo "<p style='font-size:16pt; font-weight:bolder; position:relative; left:-50px; top:20px;'>Face Mask</p>";
                echo $row[6];
                echo "<p style='font-size:16pt; font-weight:bolder; position:relative; left:-50px; top:20px;'>Public Transportation</p>";
                echo $row[7];
                echo "<p style='font-size:16pt; font-weight:bolder; position:relative; left:-50px; top:20px;'>Businesses</p>";
                echo $row[8];
              }}
              ?>
            </div>
            </div>
            </div>
            <div class=boxed_c_l style= "background-color:#f8f7f1; border-style:dotted; left:900px; top: 214px; border-color:#E2E8E5, border-width:5px; margin-bottom:50px;">
                <p style='font-size:18pt; font-weight:bolder; position:relative;'>Update information</p>
                <div class="scrollbar_country" id="style">
                  <div class="scroll_text_country" id="style" style= "margin-left:0px; margin-bottom:10px; height:450px; margin-top:-20px;">
                    <p style='font-size:16pt; font-weight:bolder; position:relative; left:-50px; top:20px;'>Boarding</p>
                    <textarea rows = "5" cols = "45" name = "description">
                    </textarea><br>
                    <p style='font-size:16pt; font-weight:bolder; position:relative; left:-50px; top:20px;'>Quarantine</p>
                    <textarea rows = "5" cols = "45" name = "description">
                    </textarea><br>
                    <p style='font-size:16pt; font-weight:bolder; position:relative; left:-50px; top:20px;'>Regulations</p>
                    <textarea rows = "5" cols = "45" name = "description">
                    </textarea><br>
                    <p style='font-size:16pt; font-weight:bolder; position:relative; left:-50px; top:20px;'>Vaccination</p>
                    <textarea rows = "5" cols = "45" name = "description">
                    </textarea><br>
                    <p style='font-size:16pt; font-weight:bolder; position:relative; left:-50px; top:20px;'>Face Mask</p>
                    <textarea rows = "5" cols = "45" name = "description">
                    </textarea><br>
                    <p style='font-size:16pt; font-weight:bolder; position:relative; left:-50px; top:20px;'>Public Transportation</p>
                    <textarea rows = "5" cols = "45" name = "description">
                    </textarea><br>
                    <p style='font-size:16pt; font-weight:bolder; position:relative; left:-50px; top:20px;'>Businesses</p>
                    <textarea rows = "5" cols = "45" name = "description">
                    </textarea><br>
          </div>
        </div>
      </div>
  </body>
  <?php include "close_db.php" ?>
</div>
</div>
</html>
