<?php
require "db.php";
require 'json.php';

$parkdbname = $mysqli->escape_string($_POST['parkdbname']);
$valveid = $mysqli->escape_string($_POST['valveid']);

if(IDisused($valveid,$parkdbname)){

  die(header("HTTP/1.0 404 Not Found"));
}else{
  addvalvej($valveid,$parkdbname);

}




 ?>
