<?php
require "db.php";
require 'json.php';


$parkdbname = mysqli_real_escape_string($mysqli,$_POST['parkdbname']);

$valveid = mysqli_real_escape_string($mysqli,$_POST['valveid']);
$valveid= preg_replace('/\s+/', '', $valveid);

$newid = mysqli_real_escape_string($mysqli,$_POST['newid']);
$newid= preg_replace('/\s+/', '', $newid);

$numtrees = mysqli_real_escape_string($mysqli,$_POST['trees']);
$numtrees = intval($numtrees);

$numgals = mysqli_real_escape_string($mysqli,$_POST['gals']);
$numgals = split(' ',$numgals);
$numgals =floatval($numgals[0]).' '.$numgals[1];

if(IDisused($newid,$parkdbname)){
  echo($newid);
  die(header("HTTP/1.0 404 Not Found"));
}else{
  editvalve($valveid,$parkdbname,$newid,$numtrees,$numgals);
}





 ?>
