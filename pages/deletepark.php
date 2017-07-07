<?php
require "db.php";
require 'name.php';

$parkname = mysqli_real_escape_string($mysqli,$_POST['parkname']);
$parkname= getname($parkname); //if broken remove this
$parkdb= getnamedb($parkname);
$parkdb=mysqli_real_escape_string($mysqli,$parkdb);
$email = mysqli_real_escape_string($mysqli,$_POST['email']);
$password = mysqli_real_escape_string($mysqli,$_POST['password']);

$sql="SELECT * FROM users WHERE email='$email'";
$result=mysqli_query($mysqli,$sql) or die('Query failed: '. mysqli_error($mysqli));

if ( mysqli_num_rows($result) == 0 ){ // User doesn't exist
    $_SESSION['message'] = "Please try again";
    header("location: error.php");
}
else { // User exists
    $user = mysqli_fetch_assoc($result);
    if ( password_verify($password, $user['password']) ) {
      $sql= "DELETE FROM parks WHERE databasename='$parkdb'";

      $result=mysqli_query($mysqli,$sql)or die('Query failed: '. mysqli_error($mysqli));

    }
    else {
      die(header("HTTP/1.0 404 Not Found"));

    }
}








//mysqli_close($mysqli);


 ?>
