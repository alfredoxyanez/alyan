<?php


require 'db.php';
require 'name.php';

session_start();
date_default_timezone_set("America/Los_Angeles");


// Make sure the form is being submitted with method="post"
$park = mysqli_real_escape_string($mysqli,$_POST['parkname']);
$latlng = mysqli_real_escape_string($mysqli,$_POST['latlng']);
$park = getname($park);

$parkdb= getnamedb($park);


if(empty($_POST['numvals']) || !is_numeric($_POST['numvals'])){
  $numval=0;
}else{
  $numval = mysqli_real_escape_string($mysqli,$_POST['numvals']);
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
$sql = "INSERT INTO parks (parkname, databasename, datet ,latlng,numvalves, valveswork) "
. "VALUES ('$park','$parkdb','$datetime', '$latlng',DEFAULT,'$prejson')";
$result=mysqli_query($mysqli,$sql) or die('Query failed: '. mysqli_error($mysqli));

if(!$result){
  $message = "Please Try Again";
  echo "<script type='text/javascript'>alert('$message');</script>";
}


mysqli_close($mysqli);

//header("location: tables.php")
?>
