<?php
require "db.php";
require 'json.php';
//require 'name.php';
//echo $_POST['parkname'];
$parkdbname = $mysqli->escape_string($_POST['parkdbname']);
//echo $parkname;
$valveid = intval($mysqli->escape_string($_POST['valveid']));
//echo $parkname;
//echo $valveid;
addvalvej($valveid,$parkdbname);




 ?>



 
