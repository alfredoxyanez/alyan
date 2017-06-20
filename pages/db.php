<?php
$host= "alyanpr.cmydnnixocdw.us-west-2.rds.amazonaws.com:3306";
$user= "alyanadmin";
$pass= "password";
$db= "innodb";

$mysqli= new mysqli('alyanpr.cmydnnixocdw.us-west-2.rds.amazonaws.com:3306','alyanadmin','password', $db)
OR die('mysql failed'.
	mysqli_connect_error());

if (!$mysqli) {
    die("Connection failed: " . mysqli_connect_error());
}
//echo "Connected to DB ". mysqli_get_host_info($mysqli) ."<br>" ;
 ?>
