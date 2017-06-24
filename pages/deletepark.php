<?php
require "db.php";
$parkname = $mysqli->escape_string($_POST['parkname']);
$parkdb= preg_replace('/\s+/', '', strtolower($parkname)).'db';
echo "<script type='text/javascript'>alert('$parkdb');</script>";
$sql= "DELETE FROM parks WHERE databasename='$parkdb'";
// $result = $mysqli->query("SELECT * FROM parks WHERE databasename='$parkdb'");
// $user = $result->fetch_assoc();
// if ( $result->num_rows == 0 ){ // User doesn't exist
//   echo "<script type='text/javascript'>alert('cantfind');</script>";
// }else{
//   echo $user['parkname'];
// }

$q=mysqli_query($mysqli,$sql);

if($q){
  echo "<script type='text/javascript'>alert('true');</script>";
}else{
  echo "<script type='text/javascript'>alert('false');</script>";
}





 ?>
