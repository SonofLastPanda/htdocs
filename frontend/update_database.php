<?php
    include 'connect.php';
    //include 'admin_frontpage.php';


    //$FROM=$_REQUEST["$FROM"];
    //$TO=$_REQUEST["$TO"];
    $boarding=$_GET["boarding"];
    $quarantine=$_GET["quarantine"];
    $vaccination=$_GET["vaccination"];
    $facemask=$_GET["face_mask"];
    $transport=$_GET["transport"];
    $business=$_GET["business"];
    $restaurants=$_GET["restaurants"];
    $sources=$_GET["sources"];

    

    $sql="UPDATE regulation SET 
    boarding='$boarding', 
    quarantine='$quarantine',
    regulation='$regulation',
    vaccination='$facemask',
    transport='$transport',
    business='$business'
    WHERE TO='$TO' AND FROM='$FROM' ";
    echo  $sql;
    if(!mysqli_query($link,$sql))
    {
        echo "The update process has failed.";
            
    }

    //header("Location: ./admin_frontpage.php");
    //include 'close.php';

?>