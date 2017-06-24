<?php

require 'db.php';
session_start();

// Make sure the form is being submitted with method="post"
$park = $mysqli->escape_string($_POST['parkname']);
$park = ucwords(preg_replace("/[^A-Za-z ]/", '', $park));
$park = trim(preg_replace('!\s+!', ' ', $park));

$parkdb= preg_replace('/\s+/', '', strtolower($park)).'db';
$numval = $mysqli->escape_string($_POST['numvals']);

if(empty($_POST['numvals']) || !is_numeric($_POST['numvals'])){
  $numval=0;
}else{
  $numval = $mysqli->escape_string($_POST['numvals']);
}

$sql = "INSERT INTO parks (parkname, databasename, valves) "
. "VALUES ('$park','$parkdb','$numval')";
$q=mysqli_query($mysqli,$sql);

$sql2 =  "CREATE TABLE ".$parkdb." (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
numvalves INT(6) NOT NULL DEFAULT 0,
valves JSON NULL
)";


$q2=mysqli_query($mysqli,$sql2);


if(!q){
  $message = "Please Try Again";
  echo "<script type='text/javascript'>alert('$message');</script>";
}


?>
