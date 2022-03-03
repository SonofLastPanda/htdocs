<?php
    include 'connect.php';


    $FROM=$_REQUEST["$FROM"];
    $TO=$_REQUEST["$TO"];
    $boarding=$_REQUEST["new_boarding_info"];
    $quarantine=$_REQUEST["new_quarantine_info"];
    $regulation=$_REQUEST["new_regulation_info"];
    $vaccination=$_REQUEST["new_vaccination_info"];
    $facemask=$_REQUEST["new_facemask_info"];
    $transport=$_REQUEST["new_transport_info"];
    $business=$_REQUEST["new_business_info"];

    $sql="UPDATE regulation SET 
    boarding='$boarding', 
    quarantine='$quarantine',
    regulation='$regulation',
    vaccination='$facemask',
    transport='$transport',
    business='$business'
    WHERE TO='$TO' AND FROM='$FROM' ";
    if(!mysqli_query($link,$sql))
    {
        echo "The update process has failed.";
            
    }
    header("Location: ./admin_frontpage.php");
    include 'close.php';

?>