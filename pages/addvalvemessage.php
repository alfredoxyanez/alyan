<?php
require 'json.php';
require 'db.php';

$dbname = $mysqli->escape_string($_POST['parkdbname']);
$id = $mysqli->escape_string($_POST['valveid']);
$message = $mysqli->escape_string($_POST['message']);

 addvalvework($id,$dbname,$message);


 ?>
