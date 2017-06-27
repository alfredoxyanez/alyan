<?php
require "db.php";
require 'json.php';
//require 'name.php';
//echo $_POST['parkname'];
$parkdbname = $mysqli->escape_string($_POST['parkdbname']);
//echo $parkname;
$valveid = $mysqli->escape_string($_POST['valveid']);
//echo $parkname;
//echo $valveid;
if(IDisused($valveid,$parkdbname)){
  //http_response_code(404);
  //die();
  die(header("HTTP/1.0 404 Not Found"));
}else{
  addvalvej($valveid,$parkdbname);

}




 ?>
