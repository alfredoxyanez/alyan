<?php


require 'db.php';
require 'name.php';

session_start();
date_default_timezone_set("America/Los_Angeles");


// Make sure the form is being submitted with method="post"
$park = $mysqli->escape_string($_POST['parkname']);
$park = getname($park);
//echo $park;
$parkdb= getnamedb($park);
//echo $parkdb;
//$numval = $mysqli->escape_string($_POST['numvals']);

if(empty($_POST['numvals']) || !is_numeric($_POST['numvals'])){
  $numval=0;
}else{
  $numval = $mysqli->escape_string($_POST['numvals']);
}
$prejson= '
{
  "vnum": 0,
  "valvelist": [
  ]
}
';
//$prejson=json_decode($prejson);
$datetime=date("m-d-Y")."?". date("H:i:s")."PST";
$sql = "INSERT INTO parks (parkname, databasename, datet ,numvalves, valveswork) "
. "VALUES ('$park','$parkdb','$datetime',DEFAULT,'$prejson')";
$q=mysqli_query($mysqli,$sql) or die('Query failed: '. mysqli_error($mysqli));

if(!q){
  $message = "Please Try Again";
  echo "<script type='text/javascript'>alert('$message');</script>";
}


mysqli_close($mysqli);

//header("location: tables.php")
?>
