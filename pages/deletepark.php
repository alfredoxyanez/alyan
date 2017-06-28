<?php
require "db.php";
require 'name.php';

$parkname = mysqli_real_escape_string($mysqli,$_POST['parkname']);
$parkname= getname($parkname); //if broken remove this
$parkdb= getnamedb($parkname);
$parkdb=mysqli_real_escape_string($mysqli,$parkdb);

//echo "<script type='text/javascript'>alert('$parkdb');</script>";
$sql= "DELETE FROM parks WHERE databasename='$parkdb'";

$result=mysqli_query($mysqli,$sql)or die('Query failed: '. mysqli_error($mysqli));


$sql2= "DROP TABLE ".$parkdb;

$result2=mysqli_query($mysqli,$sql2)or die('Query failed: '. mysqli_error($mysqli));



mysqli_close($mysqli);


 ?>
