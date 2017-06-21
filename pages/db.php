<?php
$host= "alyandb.cmydnnixocdw.us-west-2.rds.amazonaws.com:3306";
$user= "root";
$pass= "password";
$db= "alyan";

$mysqli= mysqli_connect($host,'root','password', "alyan")or die($mysqli->error);
$message= mysqli_ping($mysqli) ;
echo "<script type='text/javascript'>alert('$message');</script>";
if (!$mysqli) {
    die("Connection failed: " . mysqli_connect_error());
}
 ?>
