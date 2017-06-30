<?php
require 'json.php';
require 'db.php';
$dbname = mysqli_real_escape_string($mysqli,$_POST['parkdbname']);
$id = mysqli_real_escape_string($mysqli,$_POST['valveid']);
$message = mysqli_real_escape_string($mysqli,$_POST['message']);
$person = mysqli_real_escape_string($mysqli,$_POST['fullname']);
$email = mysqli_real_escape_string($mysqli,$_POST['email']);
$pid = mysqli_real_escape_string($mysqli,$_POST['pid']);
$parkname = mysqli_real_escape_string($mysqli,$_POST['parkname']);
$datetime=date("m-d-Y")."?". date("H:i:s")."PST";
addvalvework($id,$dbname,$message,$person, $datetime);
addworkperson($id,$parkname,$message,$email,$datetime,$pid);


 ?>
