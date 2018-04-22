// This php file will set up the database
<?php
$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '';
$conn = mysqli_connect($dbhost, $dbuser, $dbpass) ;
if (!$conn)
 {
 die('Could not connect: ' . mysqli_error());
 }
mysqli_select_db($conn,"ssp");
?>
