<!DOCTYPE html>
<?php
include 'connect.php'; //Including database connection
$FROM = $_GET["FROM"];
$TO = $_GET["TO"];

session_start();
#To prevent unlogged in users to enter this page
if (!isset($_SESSION['username'])) {
  header("location: login.php");
  die();
}

?>
<!DOCTYPE html>
<html>
  <head>
    <link href="styles.css" rel="stylesheet" type="text/css"/> <!-- Connecting to the css file named styles.css -->
    <div class="header">
    <h1><img src="logo1.2.png" alt="BatGirl logo" width="50" height="50" style= "margin-bottom: -10px; margin-left: 15px; margin-right: 0px;">CoTRACK-19<form method="get" action="user_frontpage.php"><button type="submit" id="myButton" class="button button_header" style="margin-right:7px; top:-53px;";>HOME</form></h1>
    </div>
  </head>
  <body>
  <div class="container">
      <img src="map_background.png" class=body_frontpage>
      <div class="boxed_report">
      <form action="report_database.php"> <!-- needs to be updated when the correct form is available -->
      <div class="">
      <h1 style= "text-align: center; margin-bottom:-20px; left:20px; margin-left:20px;"> Report invalid information</h1>
      <p style= "text-align: center; margin-left:-5px; "><b><em>Please report the invalid information under the correct category</em></b></p>
      <form action="report.php"> <!-- change here according to which file it is sent to to send emails -->
            <div style="float: left; display:flex; flex-direction: row;"><p style="margin-left:5px; padding-top:5px;">Departure: </p> <select name="FROM" style="top:-5px; left:-25px; height:25px; margin-top:17px;"> <!--Drop down list-->
            <?php 
            $result = mysqli_query($link,"SELECT DISTINCT regulation.FROM FROM regulation"); 
            while($row = mysqli_fetch_assoc($result)) { 
            $catname = $row["FROM"]; 
            print "<option>$catname</option>"; 
            }  
            ?> </select></div>
            <div style="float: left; display:flex; flex-direction: row;"><p style="padding-left:32px; padding-top:5px;">Destination: </p> <select name="TO" style="top:-5px; left:-25px; height:25px; margin-top:17px;"> <!--Drop down list -->
            <?php 
            $result2 = mysqli_query($link,"SELECT DISTINCT regulation.TO FROM regulation"); 
            while($row2 = mysqli_fetch_assoc($result2)) { 
            $catname2 = $row2["TO"]; 
            print "<option>$catname2</option>"; 
            } 
            ?> </select>
            </div>
        </form>
        <div class="scrollbar_country" id="style">
        <form action='report_database.php' >
                  <div class="scroll_text_country" id="style" style= "margin-left:0px; margin-bottom:10px; height:350px; margin-top:10px;">
                    <p style='font-size:16pt; font-weight:bolder; position:relative; left:-50px; top:20px; margin-top:-20px;'>Boarding</p>
                    <textarea id="new_boarding_info" rows = "5" cols = "48" name = "new_boarding_info">
                    </textarea><br>
                    <p style='font-size:16pt; font-weight:bolder; position:relative; left:-50px; top:20px;'>Quarantine</p>
                    <textarea id="new_quarantine_info" rows = "5" cols = "48" name = "new_quarantine_info">
                    </textarea><br>
                    <!--p style='font-size:16pt; font-weight:bolder; position:relative; left:-50px; top:20px;'>Regulations</p>
                    <textarea id="new_regulation_info" rows = "5" cols = "48" name = "new_regulation_info">
                    </textarea><br-->
                    <p style='font-size:16pt; font-weight:bolder; position:relative; left:-50px; top:20px;'>Vaccination</p>
                    <textarea id="new_vaccination_info" rows = "5" cols = "48" name = "new_vaccination_info">
                    </textarea><br>
                    <p style='font-size:16pt; font-weight:bolder; position:relative; left:-50px; top:20px;'>Face Mask</p>
                    <textarea id="new_facemask_info" rows = "5" cols = "48" name = "new_facemask_info">
                    </textarea><br>
                    <p style='font-size:16pt; font-weight:bolder; position:relative; left:-50px; top:20px;'>Public Transportation</p>
                    <textarea id="new_publictransport_info" rows = "5" cols = "48" name = "new_publictransport_info">
                    </textarea><br>
                    <p style='font-size:16pt; font-weight:bolder; position:relative; left:-50px; top:20px;'>Businesses</p>
                    <textarea id="new_businesses_info" rows = "5" cols = "48" name = "new_businesses_info">
                    </textarea><br>
                    <p style='font-size:16pt; font-weight:bolder; position:relative; left:-50px; top:20px;'>Sources</p>
                    <textarea id="new_businesses_info" rows = "5" cols = "48" name = "new_sources_info">
                    </textarea><br>                   
            </div>
        </div>
        <button id="button_register"; class="button button_register"; style="top:380px; left:75px;">SEND REPORT</button>
          </form>
      </div>
  </body>
  <?php include "close.php" ?>

  <style>
  .boxed_report{
    background-color: #CFD7C7;
    position: fixed;
    top: 100px;
    left: 32%;
    opacity: 1;
    height: 675px;
    width: 450px;
    text-align: left;
    padding-left: 15px;
    padding-right: 45px;
    margin-right: 30px;
    padding-top: 17px;
    padding-bottom: 15px;
    border-radius:30px;
  }
  </style>