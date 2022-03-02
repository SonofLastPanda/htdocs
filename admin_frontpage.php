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
            <h4 style= "color:#40798C; position: relative; top: 10px; line-height:1.2;" >Edit Depature and Destination<h4>
            <form action="admin_frontpage.php">
            <div style="float: left; display:flex; flex-direction: row;"><p style="padding-left:32px; padding-top:5px;">Departure: &nbsp; </p> <select name="FROM" style="top:-10px; left:-25px; height:25px; margin-top:15px;"> <!--Drop down list-->
            <?php 
            // include "connect.php"; //Including database connection
            
            $result = mysqli_query($link,"SELECT DISTINCT regulation.FROM FROM regulation"); 
            while($row = mysqli_fetch_assoc($result)) { 
            $catname = $row["FROM"]; 
            print "<option>$catname</option>"; 
            }  
            ?> </select></div>
            <div style="float: left; display:flex; flex-direction: row;"><p style="padding-left:32px;">Destination: </p> <select name="TO" style="top:-10px; left:-25px; height:25px; margin-top:10px;"> <!--Drop down list -->
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
            <form action="admin_frontpage.php">
            <div><b><p style="text-align:left; margin-bottom:5px;">Email:</p></b><input type="text" placeholder="New Email" name="useremail" style="margin-left:0px; color:#40798C;"></div><br>
            <div><b><p style="text-align:left; margin-bottom:5px; margin-top:5px;">Password:</p></b><input type="password" placeholder="New Password" name="userpassword" style="margin-left:0px;"></div><br>
            <div><b><p style="text-align:left; margin-bottom:5px; margin-top:5px;">Confirm Password:</p></b><input type="password" placeholder="Confirm Password" name="confirmpassword" style="margin-left:0px;"><br>
            <button onclick="location.href = 'www.yoursite.com';" id="myButton" class="button button_register"; style="left:0px; top:30px;">UPDATE</button>
            </form>
            <div>
      </div>
    </div>
    <div class="boxed_info">
      <h1> <?php echo "From: $FROM &nbsp &nbsp To: $TO &nbsp" ?></h1>
        <div class=boxed_c_l style= "background-color:#f8f7f1; position: relative; top:-10px; left:45px; height: 475px; border-style:dotted; border-color:#E2E8E5, border-width:5px;" >
          <p style='font-size:18pt; font-weight:bolder; position:relative;'>Current information</p>
          <div class="scrollbar_country" id="style">
            <div class="scroll_text_country" id="style" style="left:380px; width:405px; height:410px; top:295px;">
            <?php
              include 'connect.php'; //Including database connection
              $FROM = $_GET["FROM"];
              $TO = $_GET["TO"];
              $result = mysqli_query($link,"SELECT regulation.FROM, regulation.TO, regulation.Boarding, regulation.Qurantine, regulation.Regulation,regulation.Vaccine, regulation.Face_Mask, regulation.Public_Transportation, regulation.Businesses, regulation.Restaurants, regulation.Reminder FROM regulation");
              
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
            <div class=boxed_c_l style= "background-color:#f8f7f1; border-style:dotted; left:900px; top: 214px; height: 475px; border-color:#E2E8E5, border-width:5px; margin-bottom:50px;">
                <p style='font-size:18pt; font-weight:bolder; position:relative;'>Update information</p>
                <div class="scrollbar_country" id="style">
                  <div class="scroll_text_country" id="style" style= "margin-left:0px; margin-bottom:10px; height:410px; margin-top:-20px;">
                  <form>
                    <p style='font-size:16pt; font-weight:bolder; position:relative; left:-50px; top:20px;'>Boarding</p>
                    <textarea id="new_boarding_info" rows = "5" cols = "45" name = "new_boarding_info">
                    </textarea><br>
                    <p style='font-size:16pt; font-weight:bolder; position:relative; left:-50px; top:20px;'>Quarantine</p>
                    <textarea id="new_quarantine_info" rows = "5" cols = "45" name = "new_quarantine_info">
                    </textarea><br>
                    <p style='font-size:16pt; font-weight:bolder; position:relative; left:-50px; top:20px;'>Regulations</p>
                    <textarea id="new_regulation_info" rows = "5" cols = "45" name = "new_regulation_info">
                    </textarea><br>
                    <p style='font-size:16pt; font-weight:bolder; position:relative; left:-50px; top:20px;'>Vaccination</p>
                    <textarea id="new_vaccination_info" rows = "5" cols = "45" name = "new_vaccination_info">
                    </textarea><br>
                    <p style='font-size:16pt; font-weight:bolder; position:relative; left:-50px; top:20px;'>Face Mask</p>
                    <textarea id="new_facemask_info" rows = "5" cols = "45" name = "new_facemask_info">
                    </textarea><br>
                    <p style='font-size:16pt; font-weight:bolder; position:relative; left:-50px; top:20px;'>Public Transportation</p>
                    <textarea id="new_publictransport_info" rows = "5" cols = "45" name = "new_publictransport_info">
                    </textarea><br>
                    <p style='font-size:16pt; font-weight:bolder; position:relative; left:-50px; top:20px;'>Businesses</p>
                    <textarea id="new_businesses_info" rows = "5" cols = "45" name = "new_businesses_info">
                    </textarea><br></form>
          </div>
        </div>
        <button onclick="location.href = 'update_database.php';" id="button_admin"; class="button button_admin"; style="top:430px; left:-165px;">UPDATE</button>
      </div>
  </body>
  <?php include "close_db.php" ?>
</div>
</div>
</html>
