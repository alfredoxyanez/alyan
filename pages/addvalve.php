<?php
require "db.php";
require 'json.php';
//require 'name.php';

$parkname = $mysqli->escape_string($_POST['parkname']);
$parkname= getname($parkname);
$valveid = intval($mysqli->escape_string($_POST['valveid']));
// echo $parkname;
// echo $valveid;
addvalvej($valveid,$parkname);




 ?>
