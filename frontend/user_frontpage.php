<!DOCTYPE html>
<html>
  <head>
    <link href="styles.css" rel="stylesheet" type="text/css"/> <!-- Connecting to the css file named styles.css -->
    <div class="header">
    <h1><img src="logo1.2.png" alt="BatGirl logo" width="50" height="50" style= "margin-bottom: -10px; margin-left: 15px; margin-right: 0px;">CoTRACK-19<form method="get" action="index.php"><button type="submit" id="myButton" class="button button_header" style="margin-right:7px; top:-53px;";>HOME</form><form method="get" action="user_info.php"><button type="submit" id="user_info" class="button button_header" style="margin-right:7px; top:-53px;";>USER INFO</form></h1>
    </div>
  </head>
  <body>
  <div class="container">
      <img src="map_background.png" class=body_frontpage>
      <div class="boxed_top">
        <h6>Welcome!</h6><br>
        <div class="p3">"We are in this together<br>and we will get through this,<br></div><div class="p3"><br><br><strong>together</strong>"</div><br><br><br>
        <div class="p4">- UN Secretary-General <br>Antonio Guterrez</div>
      </div>
      <div class="boxed_bottom">
        <h5>Your favorite destinations</h5>
        <?php
        session_start();
        include 'connect.php';

        #Displaying favorit countries
        $email = $_SESSION['email'];
        $fav_countries = mysqli_query($link, "SELECT country.country_name FROM country JOIN bookmark ON country.country_id = bookmark.country_id JOIN users ON users.user_id = bookmark.user_id WHERE users.email = '$email'");
        
        while($row = mysqli_fetch_row($fav_countries)){
            echo "<p style='font-size:12pt; font-weight:bolder; position:relative; left:-50px; top:20px;'>$row[0]</p>";
          }

        ?>
      </div>
      <div class="boxed_info">
      
      <!--Displaying info about favorite countries-->
        <h1>Your feed</h1>
        <div class="scrollbar" id="style">
          <div class="scroll_text" id="style">
        <?php

        $sql = "SELECT * FROM regulation WHERE regulation.to IN
        (SELECT country.country_name
        FROM country
        JOIN bookmark ON country.country_id = bookmark.country_id
        JOIN users ON users.user_id = bookmark.user_id
        WHERE users.email = '$email'
        )";

        $regulations=mysqli_query($link, $sql);
        while($row = mysqli_fetch_row($regulations)){
          echo "<p style='font-size:22pt; font-weight:bolder; position:relative; left:-50px; top:20px;'>From $row[1] To $row[2]</p>";
          echo "<p style='font-size:16pt; font-weight:bolder; position:relative; left:-50px; top:20px;'>Boarding</p>";
          echo $row[3];
          echo "<p style='font-size:16pt; font-weight:bolder; position:relative; left:-50px; top:20px;'>Quarantine</p>";
          echo $row[4];
          echo "<p style='font-size:16pt; font-weight:bolder; position:relative; left:-50px; top:20px;'>Vaccination</p>";
          echo $row[5];
          echo "<p style='font-size:16pt; font-weight:bolder; position:relative; left:-50px; top:20px;'>Regulations</p>";
          echo $row[6];
          echo "<p style='font-size:16pt; font-weight:bolder; position:relative; left:-50px; top:20px;'>Face Mask</p>";
          echo $row[7];
          echo "<p style='font-size:16pt; font-weight:bolder; position:relative; left:-50px; top:20px;'>Public Transportation</p>";
          echo $row[8];
          echo "<p style='font-size:16pt; font-weight:bolder; position:relative; left:-50px; top:20px;'>Businesses</p>";
          echo $row[9];
          echo "<p style='font-size:16pt; font-weight:bolder; position:relative; left:-50px; top:20px;'>Restaurants</p>";
          echo $row[10];
          echo "<p style='font-size:16pt; font-weight:bolder; position:relative; left:-50px; top:20px;'>Reminder</p>";
          echo $row[11];
        }
        include 'close.php';
        ?>

</div></div><!-- <meta name="viewport" content="dith=device-width, initial-scale=1"> -->
 <style>
          ::-webkit-scrollbar-track{
            box-shadow:inset 0 0 5px grey;
            border-radius: 10px;
          }
          ::webkit-scrollbar-thumb{
           background-color:#40798C;
            border-radius: 10px;
          }
          ::-webkit-scrollbar-thumb:hover{
            background-color: #011638;
          }
  </style>

</div> 
  </body>