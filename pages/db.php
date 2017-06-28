<?php

$host= 'alyanpr.cmydnnixocdw.us-west-2.rds.amazonaws.com';
$user= "alyanadmin";
$pass= 'password';
$db= "innodb";
$port= "3306";

$mysqli=mysqli_connect($host,$user,$pass,$db,$port);
//$mysqli=mysqli_connect($host,$user,'password','innodb','3306')or die($mysqli->error);

if (mysqli_connect_errno()){
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}else{
  mysqli_query($mysqli,"SET time_zone='US/Pacific'");
}


 ?>
