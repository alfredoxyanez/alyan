<?php


require 'db.php';
require 'name.php';
session_start();


// Make sure the form is being submitted with method="post"
$park = $mysqli->escape_string($_POST['parkname']);
$park = getname($park);
echo $park;
$parkdb= getnamedb($park);
echo $parkdb;
//$numval = $mysqli->escape_string($_POST['numvals']);

if(empty($_POST['numvals']) || !is_numeric($_POST['numvals'])){
  $numval=0;
}else{
  $numval = $mysqli->escape_string($_POST['numvals']);
}

$sql = "INSERT INTO parks (parkname, databasename, datec ,numvalves, valveswork) "
. "VALUES ('$park','$parkdb',DEFAULT,DEFAULT,DEFAULT)";
$q=mysqli_query($mysqli,$sql);

if(!q){
  $message = "Please Try Again";
  echo "<script type='text/javascript'>alert('$message');</script>";
}
echo mysql_error();


// $sql2 =  "CREATE TABLE ".$parkdb." (
// id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
// datecreated DATETIME NOT NULL DEFAULT now(),
// numvalves INT(6) NOT NULL DEFAULT 0,
// valves JSON NULL
// )";
// //datecreated DATETIME GENERATED ALWAYS AS (),
//
// $q2=mysqli_query($mysqli,$sql2);




// if(!q2){
//   $message= mysql_errno($mysql) . ": " . mysql_error($mysql) . "\n";
//   echo "<script type='text/javascript'>alert('$message');</script>";
// }
// echo mysql_error();
?>
