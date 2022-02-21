<!--- Script to close connection to database --->

<?php
mysqli_close($link) //closing the connection to the database
or
die("Could not close connection to the database"); //Error message if not able to close the connection
?>