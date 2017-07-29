<?php
require "db.php";
require 'json.php';

$parkdbname = mysqli_real_escape_string($mysqli,$_POST['parkdbname']);
$valveid = mysqli_real_escape_string($mysqli,$_POST['valveid']);
$valveid= preg_replace('/\s+/', '', $valveid);
$numtrees = mysqli_real_escape_string($mysqli,$_POST['trees']);
$numtrees = intval($numtrees);
$numgals = mysqli_real_escape_string($mysqli,$_POST['gals']);
$numgals =floatval($numgals);

if(IDisused($valveid,$parkdbname)){
  die(header("HTTP/1.0 404 Not Found"));
}else{
  addvalvej($valveid,$parkdbname,$numtrees,$numgals);
}




 ?>
