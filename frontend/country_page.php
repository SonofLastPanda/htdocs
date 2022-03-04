<?php
include 'connect.php'; //Including database connection
$FROM = $_GET["FROM"];
$TO = $_GET["TO"];
$result = mysqli_query($link,"SELECT regulation.FROM, regulation.TO, regulation.Boarding, regulation.Qurantine, regulation.Regulation,regulation.Vaccine, regulation.Face_Mask, regulation.Public_Transportation, regulation.Businesses, regulation.Restaurants, regulation.Reminder FROM regulation");
include "close_db.php"
?>
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
<div class="boxed_country">
<h1 style="position:fixed; top: 140px; left:465px;"> <?php echo "From: $FROM &nbsp &nbsp To: $TO &nbsp" ?></h1>
<button onclick="location.href = 'report.php';" id="button_admin"; class="button button_register"; style="top:20px; left:470px;">REPORT INVALID INFO</button>
<img src="face_mask.png" alt="face_mask_icon" width="50" height="50" style="position:fixed; top:240px; left: 310px;">
<img src="public_transportation.png" alt="public_transportation_icon" width="50" height="50" style="position:fixed; top:240px; left:800px;">
<img src="businesses.png" alt="businesses_icon" width="50" height="50" style="position:fixed; top:300px; left:310px;">
<img src="restaurants.png" alt="restaurants_icon" width="50" height="50" style="position:fixed; top:300px; left:800px;">
<div class="info_box" id="style">
<?php      
while($row = mysqli_fetch_row($result)){ 
if (($row[0]=="$FROM")&&($row[1]=="$TO")){
echo "<p font-family:'Red Hat Display' style='text-align:left;width:400px;position:fixed;top:240px;left:320px;'> $row[6] </div>";
echo "<p font-family:'Red Hat Display' style='text-align:left;width:400px;position:fixed;top:240px;left:810px;'> $row[7] </div>";
echo "<p font-family:'Red Hat Display' style='text-align:left;width:400px;position:fixed;top:300px;left:320px;'> $row[8] </div>";
echo "<p font-family:'Red Hat Display' style='text-align:left;width:400px;position:fixed;top:300px;left:810px;'> $row[9] </div>";
// Listing all info
echo "<div class='scrollbar_country' id='style' style='color:#40798C; position:fixed; top:350px; left:100px; float:left; text-align:justify; height:380px; width:calc(100%-20px); background:#fcfaf4; top:100px; margin-bottom:100px; margin-right:50px; margin-left:50px; scroll-margin-bottom: 2em;'>";
echo "<div class='scroll_text_country' id='style' style='position:fixed; top:350px; float:left; text-align:justify; height:380px; width:calc(100%-20px); background:#fcfaf4; top:370px; margin-bottom:100px; margin-right:50px; margin-left:50px; scroll-margin-bottom: 2em;'>";
echo "<p style='color:#40798C; font-size:22pt; font-weight:bolder; position:relative; left:-50px; top:-30px; margin-bottom:-20px;'>Boarding</p>";
if (!empty($row[2])) {  //Checks if the value is not NULL
  echo $row[2]; //Prints the value if it is not NULL
 }
else { //Prints a message if it is NULL
echo "There is currently no information regarding this field for this travel route, please check with relevant sources for more information";
}

echo "<p style='font-size:22pt; font-weight:bolder; position:relative; left:-50px; top:20px;'>Quarantine</p>";
if (!empty($row[3])) {  
  echo $row[3]; 
 }
else {
echo "There is currently no information regarding this field for this travel route, please check with relevant sources for more information";
}

echo "<p style='font-size:22pt; font-weight:bolder; position:relative; left:-50px; top:20px;'>Vaccination</p>";
if (!empty($row[5])) {  
  echo $row[5]; 
 }
else {
echo "There is currently no information regarding this field for this travel route, please check with relevant sources for more information";
}

echo "<p style='font-size:22pt; font-weight:bolder; position:relative; left:-50px; top:20px;'>Regulation</p>";
if (!empty($row[4])) {  
  echo $row[4]; 
 }
else {
echo "There is currently no information regarding this field for this travel route, please check with relevant sources for more information";
}

echo "<p style='font-size:22pt; font-weight:bolder; position:relative; left:-50px; top:20px;'>Face Mask</p>";
if (!empty($row[6])) {  
  echo $row[6]; 
 }
else {
echo "There is currently no information regarding this field for this travel route, please check with relevant sources for more information";
}

echo "<p style='font-size:22pt; font-weight:bolder; position:relative; left:-50px; top:20px;'>Public Transportation</p>";
if (!empty($row[7])) {  
  echo $row[7]; 
 }
else {
echo "There is currently no information regarding this field for this travel route, please check with relevant sources for more information";
}

echo "<p style='font-size:22pt; font-weight:bolder; position:relative; left:-50px; top:20px;'>Businesses</p>";
if (!empty($row[8])) {  
  echo $row[8]; 
 }
else {
echo "There is currently no information regarding this field for this travel route, please check with relevant sources for more information";
}

echo "<p style='font-size:22pt; font-weight:bolder; position:relative; left:-50px; top:20px;'>Restaurants</p>";
if (!empty($row[9])) {  
  echo $row[9]; 
 }
else {
echo "There is currently no information regarding this field for this travel route, please check with relevant sources for more information";
}

echo "<p style='font-size:22pt; font-weight:bolder; position:relative; left:-50px; top:20px;'>Reminders</p>";
if (!empty($row[10])) {  
  echo $row[10]; 
 }
else {
echo "There is currently no information regarding this field for this travel route, please check with relevant sources for more information";
}

echo "<p style='font-size:22pt; font-weight:bolder; position:relative; left:-50px; top:20px;'>Sources</p>";
if (!empty($row[11])) {  
  echo $row[11]; 
 }
else {
echo "There is currently no information regarding this field for this travel route, please check with relevant sources for more information";
}
            }}
echo "</div>";
echo "</div>";
include "close_db.php"
?>
          }}     
        ?>
</div>
</div>
</div>
<div class="reminder"><b>Remember!</b> When traveling, each intermediate landing can have its own restrictions and regulations, so it is a good idea to check all layovers separately beforehand.</div>
</body>