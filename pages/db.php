<?php
echo 'Current PHP version: ' . phpversion();
$host= "alyandb.cmydnnixocdw.us-west-2.rds.amazonaws.com:3306";
$user= "root";
$pass= "password";
$db= "alyan";

$mysqli= new mysqli('alyandb.cmydnnixocdw.us-west-2.rds.amazonaws.com:3306','root','password', "alyan")or die($mysqli->error);
echo mysqli_ping() ;
if (!$mysqli) {
    $message = "you fucked up";
    echo "<script type='text/javascript'>alert('$message');</script>";
    die("Connection failed: " . mysqli_connect_error());
}
 ?>
