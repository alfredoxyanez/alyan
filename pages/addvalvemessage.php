<?php
require 'json.php';
require 'db.php';

$dbname = $mysqli->escape_string($_POST['parkdbname']);
$id = $mysqli->escape_string($_POST['valveid']);
$message = $mysqli->escape_string($_POST['message']);
$person = $mysqli->escape_string($_POST['fullname']);

 addvalvework($id,$dbname,$message);


 ?>
