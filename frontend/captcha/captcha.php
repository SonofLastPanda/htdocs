<?php

session_start();

/**
 * Function to generate the random string
 * Input parameter is the string of allowed characters
 *  */ 

function generate_string($input, $length = 10) {
    $input_length = strlen($input);
    $random_string = '';
    for($i = 0; $i < $length; $i++) {
        $random_character = $input[mt_rand(0, $input_length - 1)];
        $random_string .= $random_character;
    }
 
    return $random_string;
}

// Create an image. Values is pixel size.
$image = imagecreatetruecolor(250, 60);

// Creating an array and generating random colors for the image
$greys = [];
$white = imagecolorallocate($image, 240, 240, 240); //ish-white
$black = imagecolorallocate($image, 0, 0, 0);

// Generates several different shades of grey
for($i = 0; $i < 5; $i++) {
    $color_value = rand(70, 150);
    $greys[] = imagecolorallocate($image, $color_value, $color_value, $color_value);
}

// Makes the image background white
imagefill($image, 0, 0, $white);

// Draws 10 lines on the image
for ($i = 0; $i < 10; $i++) {
    $color = $greys[rand(1, 4)];
    imageline( $image, rand(1,249),rand(1,59),rand(1,249),(rand(1,59)),$color);
}

// Draws 10 dashed lines on the image
for ($i = 0; $i < 10; $i++) {
    $color = $greys[rand(1, 4)];
    imagedashedline( $image, rand(1,249),rand(1,59),rand(1,249),(rand(1,59)),$color);
}

// Draws 10 arcs on the image
for ($i = 0; $i < 10; $i++) {
    $color = $greys[rand(1, 4)];
    imagearc( $image, rand(1,249),rand(1,59),rand(1,249),(rand(1,59)), rand(0,360), rand(0,360) , $color);
}

// Imports the fonts and adds them to an array
$fonts = ['arial.ttf', 'toon.ttf', 'segoe.ttf'];

//Settings for the captcha string
$min_row_length = 6;
$max_row_length = 8;
$permitted_chars = 'ABCDEFGHJKLMNPQRSTUVWXYZ1234567890'; // Specifies characters that might appear in string
$string_length = rand($min_row_length,$max_row_length); 

$captcha_string = generate_string($permitted_chars, $string_length); //generates captcha string
$_SESSION['captchacode'] = $captcha_string; //saves in session, allows us to validate later

//Loop to draw in the characters on the image
for($i = 0; $i < $string_length; $i++) {
  $letter_space = 220/$string_length;
  $initial = 15;
  $side_movement = rand(-3,3);

  imagettftext($image, //image
   rand(20,26), //font size
   rand(-15, 15), //angle
   $initial + $i*$letter_space + $side_movement, //position in x-coordinate
   rand(30, 50), //positions y-coordinate
   $black, //color
   $fonts[array_rand($fonts)], //font
   $captcha_string[$i]); //character from gaptcha string
}


header('Content-type: image/png');
imagepng($image);
imagedestroy($image);
?>