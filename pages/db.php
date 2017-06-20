<?php
$host= "alyandb.cmydnnixocdw.us-west-2.rds.amazonaws.com:";
$user= "root";
$pass= "password";
$db= "alyan";

if (!function_exists('mysqli_init') && !extension_loaded('mysqli')) {
    echo 'We don\'t have mysqli!!!';
} else {
    echo 'Phew we have it!';
}
$mysqli= new mysqli($host,'root','password', "alyan")or die($mysqli->error);
echo mysqli_ping() ;
if (!$mysqli) {
    die("Connection failed: " . mysqli_connect_error());
}
 ?>
