<?php
require 'json.php';
require 'db.php';


$parkdbname = mysqli_real_escape_string($mysqli,$_POST['parkdbname']);

$valveid = mysqli_real_escape_string($mysqli,$_POST['valveid']);
$valveid= preg_replace('/\s+/', '', $valveid);

$newid = mysqli_real_escape_string($mysqli,$_POST['newid']);
$newid= preg_replace('/\s+/', '', $newid);

$numtrees = mysqli_real_escape_string($mysqli,$_POST['trees']);
$numtrees = intval($numtrees);
//
$numgals = (string) mysqli_real_escape_string($mysqli,$_POST['gals']);
$numgals = split(' ',$numgals);
// $numgals =floatval($numgals[0]).' '.$numgals[1];
print_r( $numgals);
//echo $valveid.$parkdbname.$newid.$numtrees.$numgals;
// if(IDisused($newid,$parkdbname)){
//   die(header("HTTP/1.0 404 Not Found"));
// }else{
//   editvalve($valveid,$parkdbname,$newid,$numtrees,$numgals);
// }




 ?>
