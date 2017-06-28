<?php
require 'json.php';
require 'db.php';

$dbname = mysqli_real_escape_string($mysqli,$_POST['parkdbname']);
$id = mysqli_real_escape_string($mysqli,$_POST['valveid']);
$message = mysqli_real_escape_string($mysqli,$_POST['message']);
$person = mysqli_real_escape_string($mysqli,$_POST['fullname']);

 addvalvework($id,$dbname,$message,$person);


 ?>
