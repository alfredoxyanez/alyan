<?php
require "db.php";
require "name.php";
date_default_timezone_set("America/Los_Angeles");

//$entry="Sample";
// $name= getname($entry);
// $dbname= getnamedb($name);
//
// $sql="SELECT * FROM parks WHERE databasename='$dbname'";
//
// $q=mysqli_query($mysqli,$sql) or die('Query failed: '. mysqli_error($mysqli));
// if(mysqli_num_rows($q)>0){
//   $user = mysqli_fetch_assoc($q);
//   $jsonp=$user['valveswork'];
//   $jsonp= json_decode($jsonp);
//   $json_string = json_encode($jsonp, JSON_PRETTY_PRINT);
//   header('Content-Type: application/json');
//   //echo($json_string);
//   print_r($jsonp->{'valvelist'});
//
// }

//addvalvej($id,$entry);
//add valvelist
 function addvalvej($id,$parkname){
   require "db.php";
   $parkname= getname($parkname);
   $dbname= getnamedb($parkname);

   $sql="SELECT * FROM parks WHERE databasename='$dbname'";

   $q=mysqli_query($mysqli,$sql) or die('Query failed: '. mysqli_error($mysqli));
   if(mysqli_num_rows($q)>0){
     $user = mysqli_fetch_assoc($q);
     $jsonp=$user['valveswork'];
     $numv=$user['numvalves'];
     $numv= $numv+1;


     $jsonp= json_decode($jsonp);
     $updatej=$jsonp->{'vnum'} =$numv;
     //$vlist=$jsonp->{'valvelist'};
     $datetime=date("m-d-Y")."?". date("H:i:s")."PST";
     $response = new stdClass;
     $response->{'id'}=$id;
     $response->{'status'}=true;
     $response->{'date'}=$datetime;
     $response->{'workdone'}=array();


     array_push($jsonp->{'valvelist'},$response);
     $newvalue= json_encode($jsonp);
     //echo "string \n";
     //print_r($jsonp);
     $sql2 = "UPDATE parks SET valveswork='$newvalue', numvalves='$numv' WHERE databasename='$dbname'";
     $q2=mysqli_query($mysqli,$sql2) or die('Query failed: '. mysqli_error($mysqli));

   }
   $sql="SELECT * FROM parks WHERE databasename='$dbname'";
   $q3=mysqli_query($mysqli,$sql) or die('Query failed: '. mysqli_error($mysqli));
   if(mysqli_num_rows($q3)>0){
     $user = mysqli_fetch_assoc($q3);
     $jsonp2=$user['valveswork'];
     $jsonp2= json_decode($jsonp2);
     //print_r($jsonp2);
     $json_string = json_encode($jsonp2, JSON_PRETTY_PRINT);
      header('Content-Type: application/json');
      echo($json_string);


   }



 }





 ?>
