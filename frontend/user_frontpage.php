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
      <div class="boxed_top">
        <h6>Welcome username</h6>
        <div class="p3">"We are in this together<br>and we will get through this,<br></div><div class="p3"><br><br><strong>together</strong>"</div><br><br><br>
        <div class="p4">- UN Secretary-General <br>Antonio Guterrez</div>
      </div>
      <div class="boxed_bottom">
        <h5>Your favorite destinations:</h5>
        <?php
        include 'connect.php';

        #$email = $_POST["uname"];
        $email = "bb";
        #$uid = mysqli_query($link, "SELECT users.user_id FROM users WHERE users.email = '$email'");
        $uid='2';
        $fav_countries = mysqli_query($link, "SELECT country.country_name FROM country JOIN bookmark ON country.country_id = bookmark.country_id WHERE bookmark.user_id = '$uid'");

        if (mysqli_num_rows($fav_countries) > 0) {
        echo "<table, th, td {
          border='1';
          border-collapse: collapse;
          border-color: #CFD7C7;
        }>";
        while($row = mysqli_fetch_row($fav_countries)){
        echo "<tr><td>";
        echo $row[0];
        echo "</td></tr>";
        }
        echo "</table>";
        }
        ?>
      </div>
      <div class="boxed_info">
        
        <h1>Your feed</h1>
        <div class="scrollbar" id="style">
          <div class="scroll_text">
        <?php

      $c_name='Hong Kong';  
      $regulations=mysqli_query($link, "SELECT * FROM regulation WHERE regulation.to = '$c_name'");
      if (mysqli_num_rows($regulations) > 0) {
        echo "<table border='1'>";
        while($row3 = mysqli_fetch_row($regulations)){

        echo "<tr><td>";
        echo $row3[1].' to '.$row3[2];
        echo "</td></tr><tr>";

        echo "</tr><tr><td>";
        echo "Boarding<br>".$row3[3];
        echo "</td></tr><tr>";

        echo "</tr><tr><td>";
        echo "Quarantine<br>".$row3[4];
        echo "</td></tr><tr>";

        echo "</tr><tr><td>";
        echo "Vaccine<br>".$row3[5];
        echo "</td></tr><tr>";

        echo "</tr><tr><td>";
        echo "Regulation<br>".$row3[6];
        echo "</td></tr><tr>";

        echo "</tr><tr><td>";
        echo "Face Mask<br>".$row3[7];
        echo "</td></tr><tr>";

        echo "</tr><tr><td>";
        echo "Public Transportation<br>".$row3[8];
        echo "</td></tr><tr>";

        echo "</tr><tr><td>";
        echo "Businesses<br>".$row3[9];
        echo "</td></tr><tr>";
        
        echo "</tr><tr><td>";
        echo "Restaurants<br>".$row3[10];
        echo "</td></tr><tr>";

        echo "</tr><tr><td>";
        echo "Reminder<br>".$row3[11];
        echo "</td></tr><tr>";

        echo "</tr>";
        }
        echo "</table>";
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