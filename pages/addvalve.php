<?php
require "db.php";
require 'json.php';

$parkdbname = mysqli_real_escape_string($mysqli,$_POST['parkdbname']);
$valveid = mysqli_real_escape_string($mysqli,$_POST['valveid']);

if(IDisused($valveid,$parkdbname)){

  die(header("HTTP/1.0 404 Not Found"));
}else{
  addvalvej($valveid,$parkdbname);

}




 ?>
