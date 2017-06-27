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
 function addvalvej($id,$parkdbname){
   require "db.php";
   //$parkname= getname($parkname);
   $dbname= $parkdbname;

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
  //  $sql="SELECT * FROM parks WHERE databasename='$dbname'";
  //  $q3=mysqli_query($mysqli,$sql) or die('Query failed: '. mysqli_error($mysqli));
  //  if(mysqli_num_rows($q3)>0){
  //    $user = mysqli_fetch_assoc($q3);
  //    $jsonp2=$user['valveswork'];
  //    $jsonp2= json_decode($jsonp2);
  //    //print_r($jsonp2);
  //    $json_string = json_encode($jsonp2, JSON_PRETTY_PRINT);
  //     header('Content-Type: application/json');
  //     echo($json_string);
   //
   //
  //  }

 }
 $id1=2;
 $parkdbname="riversidedb";
 $message="itworks";
 addvalvework($id1,$parkdbname,$message);

 function addvalvework($id,$parkdbname,$message){
   require "db.php";
   //$parkname= getname($parkname);
   $dbname= $parkdbname;

   $sql="SELECT * FROM parks WHERE databasename='$dbname'";

   $q=mysqli_query($mysqli,$sql) or die('Query failed: '. mysqli_error($mysqli));
   if(mysqli_num_rows($q)>0){
     $user = mysqli_fetch_assoc($q);
     $jsonp=$user['valveswork'];

     $jsonp= json_decode($jsonp);
     $updatej=$jsonp->{'valvelist'};

     $datetime=date("m-d-Y")."?". date("H:i:s")."PST";
     $response = new stdClass;
     $response->{'date'}=$datetime;
     $response->{'message'}=$message;

    //  echo $id;
    //  echo "</br>";
    //  echo gettype($id);
    //  echo "</br>";


     foreach ($updatej as $key => $value) {
      //  echo $value->{'id'};
      //  echo "</br>";
      //  echo gettype($value->{'id'});
      //  echo "</br>";
       if($value->{'id'}==$id){
          print_r($value);
          array_push($value->{'workdone'},$response);
          echo "done!!!!";

       }
     }
     //print_r($updatej);
     //$vlist=$jsonp->{'valvelist'};
     $newvalue= json_encode($jsonp);
     $sql2 = "UPDATE parks SET valveswork='$newvalue' WHERE databasename='$dbname'";
     $q2=mysqli_query($mysqli,$sql2) or die('Query failed: '. mysqli_error($mysqli));




    //  array_push($jsonp->{'valvelist'}->,$response);
     //$newvalue= json_encode($jsonp);
     //echo "string \n";
     //print_r($jsonp);
     //$sql2 = "UPDATE parks SET valveswork='$newvalue', numvalves='$numv' WHERE databasename='$dbname'";
     //$q2=mysqli_query($mysqli,$sql2) or die('Query failed: '. mysqli_error($mysqli));

   }
  //  $sql="SELECT * FROM parks WHERE databasename='$dbname'";
  //  $q3=mysqli_query($mysqli,$sql) or die('Query failed: '. mysqli_error($mysqli));
  //  if(mysqli_num_rows($q3)>0){
  //    $user = mysqli_fetch_assoc($q3);
  //    $jsonp2=$user['valveswork'];
  //    $jsonp2= json_decode($jsonp2);
  //    //print_r($jsonp2);
  //    $json_string = json_encode($jsonp2, JSON_PRETTY_PRINT);
  //     header('Content-Type: application/json');
  //     echo($json_string);


   }












 ?>
