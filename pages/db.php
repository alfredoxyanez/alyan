<?php
$host= "alyandb.cmydnnixocdw.us-west-2.rds.amazonaws.com:3306";
$user= "root";
$pass= "password";
$db= "alyan";

$mysqli= new mysqli($host,'root','password', "alyan")or die($mysqli->error);
$message= mysqli_ping() ;
if (!$mysqli) {
    die("Connection failed: " . mysqli_connect_error());
}
 ?>
