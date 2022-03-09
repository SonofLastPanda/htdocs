<!DOCTYPE html>
<!-- This file is the user frontpage -->
<html>
  <head>
    <link href="styles.css" rel="stylesheet" type="text/css"/> <!-- Connecting to the css file named styles.css -->
    <div class="header">
    <h1><img src="logo1.2.png" alt="BatGirl logo" width="50" height="50" style= "margin-bottom: -10px; margin-left: 15px; margin-right: 0px;">CoTRACK-19<form method="get" action="logout.php"><button type="submit" id="myButton" class="button button_header" style="margin-right:7px; top:-53px;";>LOG OUT</form><form method="get" action="index.php"><button type="submit" id="myButton" class="button button_header" style="margin-right:7px; top:-53px;";>HOME</form><form method="get" action="user_info.php"><button type="submit" id="user_info" class="button button_header" style="margin-right:7px; top:-53px;";>USER INFO</form></h1>

    </div>
  </head>
  <body>
  <?php
      session_start();
      include 'connect.php';

      #To prevent unlogged in users to enter this page
      if ((!isset($_SESSION['username'])) || ($_SESSION['admin']==TRUE)) {
      header("location: login.php");
      die();
      }

      $username = $_SESSION['username'];
  ?>
  <div class="container">
      <img src="map_background.png" class=body_frontpage>
      <div class="boxed_top">
        <h6>Welcome <?php echo $username;?>!</h6><br>
        <div class="p3">"We are in this together<br>and we will get through this,<br></div><div class="p3"><br><br><strong>together</strong>"</div><br><br><br>
        <div class="p4">- UN Secretary-General <br>Antonio Guterrez</div>
      </div>
      <div class="boxed_bottom">
        <h5>Your favorite destinations</h5>

        <?php
        echo "<div class='boxed_favourites' id='style3'>";
        #Check if connection to database is estalished 
        if (!$link) {
          echo "Error: Unable to connect to MySQL." . mysqli_connect_error() . PHP_EOL;
          exit;
      }

        #Displaying favorite countries
        $fav_countries = mysqli_query($link, "SELECT DISTINCT country.country_name FROM country JOIN bookmark ON country.country_id = bookmark.country_id JOIN users ON users.user_id = bookmark.user_id WHERE users.username = '$username'");
        
        while($row = mysqli_fetch_row($fav_countries)){
            echo "<img src='heart.png' alt='face_mask_icon' width='20' height='15' style='position:relative; left:-80px;'>";
            echo "<p style='font-size:12pt; font-weight:bolder; position:relative; left:-15px; top:-38px; margin-bottom:-19px;text-align:left;'>$row[0]</p>";
          }

        ?>
        </div>


      <div style="display:inline-block; position: relative; top:40%">
        <h5 style=  "margin-bottom: 10px;">Add favorite destinations</h5>
        <form action="change_bookmarks.php">
            <div style="float: left; display:flex; flex-direction: row;"><select name="TO" style="top:-6px; left:-30px; height:25px; margin-top:15px; margin-bottom:15px; margin-left:65px;"> Drop down list
        <?php 
          $result2 = mysqli_query($link,"SELECT DISTINCT regulation.TO FROM regulation"); 
          while($row2 = mysqli_fetch_assoc($result2)) { 
          $catname2 = $row2["TO"]; 
          print "<option>$catname2</option>"; 
          } 
        ?> </select></div>
            <button id="admin_country_button" class="button button_register" type="submit" style="margin-top:5px; left:3px;">ADD DESTINATION</button>
        </div>
        </form>


      </div>
      <div class="boxed_info">
      
      <!--Displaying info about favorite countries-->
        <?php echo "<h1>$username's feed</h1>";?>
        <div class="scrollbar">
          <div class="scroll_text" id="style">
        <?php

        $sql = "SELECT * FROM regulation WHERE regulation.to IN
        (SELECT country.country_name
        FROM country
        JOIN bookmark ON country.country_id = bookmark.country_id
        JOIN users ON users.user_id = bookmark.user_id
        WHERE users.username = '$username'
        )";

        $regulations=mysqli_query($link, $sql);
        while($row = mysqli_fetch_row($regulations)){
          echo "<h1 style='font-size:30pt; font-family:'Righteous'; font-weight:bolder; position:relative; margin-left:0px; left:-50px; top:-30px;'>From: $row[1] To: $row[2]</h1>";
          echo "<div style='margin-bottom:-300px; margin-top:70px;'>";
          echo "<img src='face_mask.png' alt='face_mask_icon' width='50' height='50' style='position:relative; top:-50px;'>";
          echo "<p font-family:'Red Hat Display' style='text-align:left; width:400px; position:relative; top:-105px; left:10px;'> $row[7] </p>";
          echo "<img src='public_transportation.png' alt='face_mask_icon' width='50' height='50' style='position:relative; top:-154px; left:400px;'>";
          echo "<p font-family:'Red Hat Display' style='text-align:left; width:400px; position:relative; top:-210px; left:415px;'> $row[8] </p>";
          echo "<img src='businesses.png' alt='face_mask_icon' width='50' height='50' style='position:relative; top:-190px;'>";
          echo "<p font-family:'Red Hat Display' style='text-align:left; width:400px; position:relative; top:-244px; left:10px;'> $row[9] </p>";
          echo "<img src='restaurants.png' alt='face_mask_icon' width='50' height='50' style='position:relative; top:-294px; left:400px;'>";
          echo "<p font-family:'Red Hat Display' style='text-align:left; width:400px; position:relative; top:-350px; left:416px;'> $row[10] </p>";
          echo "</div>";
          echo "<p style='color:#40798C; font-size:22pt; font-weight:bolder; position:relative; left:-50px; top:-30px; margin-bottom:-20px;'>Boarding</p>";
          if (!empty($row[3])) {  //Checks if the value is not NULL
            echo $row[3]; //Prints the value if it is not NULL
          }
          else { //Prints a message if it is NULL
          echo "There is currently no information regarding this field for this travel route, please check with relevant sources for more information.";
          }

          echo "<p style='font-size:22pt; font-weight:bolder; position:relative; left:-50px; top:20px;'>Quarantine</p>";
          if (!empty($row[4])) {  
            echo $row[4]; 
          }
          else {
          echo "There is currently no information regarding this field for this travel route, please check with relevant sources for more information.";
          }

          echo "<p style='font-size:22pt; font-weight:bolder; position:relative; left:-50px; top:20px;'>Vaccination</p>";
          if (!empty($row[5])) {  
            echo $row[5]; 
          }
          else {
          echo "There is currently no information regarding this field for this travel route, please check with relevant sources for more information.";
          }

          echo "<p style='font-size:22pt; font-weight:bolder; position:relative; left:-50px; top:20px;'>Regulation</p>";
          if (!empty($row[6])) {  
            echo $row[6]; 
          }
          else {
          echo "There is currently no information regarding this field for this travel route, please check with relevant sources for more information.";
          }

          echo "<p style='font-size:22pt; font-weight:bolder; position:relative; left:-50px; top:20px;'>Face Mask</p>";
          if (!empty($row[7])) {  
            echo $row[7]; 
          }
          else {
          echo "There is currently no information regarding this field for this travel route, please check with relevant sources for more information.";
          }

          echo "<p style='font-size:22pt; font-weight:bolder; position:relative; left:-50px; top:20px;'>Public Transportation</p>";
          if (!empty($row[8])) {  
            echo $row[8]; 
          }
          else {
          echo "There is currently no information regarding this field for this travel route, please check with relevant sources for more information.";
          }

          echo "<p style='font-size:22pt; font-weight:bolder; position:relative; left:-50px; top:20px;'>Businesses</p>";
          if (!empty($row[9])) {  
            echo $row[9]; 
          }
          else {
          echo "There is currently no information regarding this field for this travel route, please check with relevant sources for more information.";
          }

          echo "<p style='font-size:22pt; font-weight:bolder; position:relative; left:-50px; top:20px;'>Restaurants</p>";
          if (!empty($row[10])) {  
            echo $row[10]; 
          }
          else {
          echo "There is currently no information regarding this field for this travel route, please check with relevant sources for more information.";
          }

          echo "<p style='font-size:22pt; font-weight:bolder; position:relative; left:-50px; top:20px;'>Reminders</p>";
          if (!empty($row[11])) {  
            echo $row[11]; 
          }
          else {
          echo "There is currently no information regarding this field for this travel route, please check with relevant sources for more information.";
          }

          echo "<p style='font-size:22pt; font-weight:bolder; position:relative; left:-50px; top:20px;'>Sources</p>";
          if (!empty($row[12])) {  
            echo $row[12]; 
          }
          else {
          echo "There is currently no information regarding this field for this travel route, please check with relevant sources for more information.";
          }
          echo "<br><br><br><br><br>";
                      }
          echo "</div>";
          echo "</div>";
          include "close.php"
          ?>

</div></div><!-- <meta name="viewport" content="dith=device-width, initial-scale=1"> -->


</div> 
  </body>