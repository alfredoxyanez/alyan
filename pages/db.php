<?php

$host= "alyandb.cmydnnixocdw.us-west-2.rds.amazonaws.com:3306";
$user= "root";
$pass= "password";
$db= "alyan";

//$mysqli= mysqli_connect("alyanpr.cmydnnixocdw.us-west-2.rds.amazonaws.com:3306",'alyanadmin','password', "innodb")or die($mysqli->error);
$mysqli=mysqli_connect("alyanpr.cmydnnixocdw.us-west-2.rds.amazonaws.com",'alyanadmin','password','innodb','3306')or die($mysqli->error);
// $message= mysqli_ping($mysqli) ;
// echo "<script type='text/javascript'>alert('$message');</script>";
// if (!$mysqli) {
//     die("Connection failed: " . mysqli_connect_error());
// }

mysqli_query($mysqli,"SET time_zone='US/Pacific'");
 ?>
