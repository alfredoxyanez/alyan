<?php
require "db.php";
$parkname = $mysqli->escape_string($_POST['parkname']);
$parkdb= preg_replace('/\s+/', '', strtolower($parkname)).'db';
echo "<script type='text/javascript'>alert('$parkdb');</script>";
$sql= "DELETE FROM parks WHERE databasename='$parkdb'";


$q=mysqli_query($mysqli,$sql);

if($q){
  echo "<script type='text/javascript'>alert('true1');</script>";

}else{
  echo "<script type='text/javascript'>alert('false1');</script>";
}

$sql2= "DROP TABLE ".$parkdb;


$q2=mysqli_query($mysqli,$sql2);

if($q2){
  echo "<script type='text/javascript'>alert('true2');</script>";

}else{
  echo "<script type='text/javascript'>alert('false2');</script>";
}


 ?>
