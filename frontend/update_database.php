<?php
    include 'connect.php';
    //include 'admin_frontpage.php';


    $FROM=$_GET["from"];
    $TO=$_GET["to"];
    $id=$_GET["id"];
    $boarding=$_GET["boarding"];
    $quarantine=$_GET["quarantine"];
    $vaccination=$_GET["vaccination"];
    $facemask=$_GET["face_mask"];
    $transport=$_GET["transport"];
    $business=$_GET["business"];
    $restaurants=$_GET["restaurants"];
    $reminder=$_GET["reminder"];
    //$sources=$_GET["sources"];

    
    //typo in db, therefore qurantine, instead of Quarantine.
    $sql="UPDATE regulation 
    SET 
    regulation.Boarding='$boarding', 
    regulation.Qurantine='$quarantine', 
    regulation.Vaccine='$vaccination',
    regulation.Face_mask='$facemask',
    regulation.Public_transportation='$transport',
    regulation.Businesses='$business',
    regulation.Restaurants='$restaurants',
    regulation.Reminder='$reminder'
    
    WHERE regulation.id='$id'";
    //echo  $sql;
    if(!mysqli_query($link,$sql))
    {
        echo "The update process has failed.";
            
    }

    header("Location: ./admin_frontpage.php?FROM=$FROM&TO=$TO");
    //include 'close.php';

?>