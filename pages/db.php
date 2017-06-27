<?php

$host= "alyandb.cmydnnixocdw.us-west-2.rds.amazonaws.com:3306";
$user= "root";
$pass= "password";
$db= "alyan";

$mysqli=mysqli_connect("alyanpr.cmydnnixocdw.us-west-2.rds.amazonaws.com",'alyanadmin','password','innodb','3306')or die($mysqli->error);

mysqli_query($mysqli,"SET time_zone='US/Pacific'");
 ?>
