<?php
require "db.php";
require "name.php";
date_default_timezone_set("America/Los_Angeles");

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
     $datetime=date("m-d-Y")."?". date("H:i:s")."PST";
     $response = new stdClass;
     $response->{'id'}= (string) $id;
     $response->{'status'}=true;
     $response->{'date'}=$datetime;
     $response->{'workdone'}=array();
     array_push($jsonp->{'valvelist'},$response);
     $newvalue= json_encode($jsonp);
     $sql2 = "UPDATE parks SET valveswork='$newvalue', numvalves='$numv' WHERE databasename='$dbname'";
     $q2=mysqli_query($mysqli,$sql2) or die('Query failed: '. mysqli_error($mysqli));

   }

 }



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
     foreach ($updatej as $key => $value) {
       if($value->{'id'}==$id){
          array_push($value->{'workdone'},$response);
       }
     }
     $newvalue= json_encode($jsonp);
     $sql2 = "UPDATE parks SET valveswork='$newvalue' WHERE databasename='$dbname'";
     $q2=mysqli_query($mysqli,$sql2) or die('Query failed: '. mysqli_error($mysqli));
   }
   }


   //getworkjson($id1,$parkdbname);
   function getworkjson($id,$parkdbname){
     require "db.php";
     $dbname= $parkdbname;
     $sql="SELECT * FROM parks WHERE databasename='$dbname'";
     $q=mysqli_query($mysqli,$sql) or die('Query failed: '. mysqli_error($mysqli));
     if(mysqli_num_rows($q)>0){
       $user = mysqli_fetch_assoc($q);
       $jsonp=$user['valveswork'];
       $jsonp= json_decode($jsonp);
       $updatej=$jsonp->{'valvelist'};
       foreach ($updatej as $key => $value) {
         if($value->{'id'}==$id){
          return $value->{'workdone'};
         }
       }
       return null;
     }
     }

     function IDisused($id,$parkdbname){
       require "db.php";
       $dbname= $parkdbname;
       $sql="SELECT * FROM parks WHERE databasename='$dbname'";
       $q=mysqli_query($mysqli,$sql) or die('Query failed: '. mysqli_error($mysqli));
       if(mysqli_num_rows($q)>0){
         $user = mysqli_fetch_assoc($q);
         $jsonp=$user['valveswork'];
         $jsonp= json_decode($jsonp);
         $updatej=$jsonp->{'valvelist'};
         foreach ($updatej as $key => $value) {
           if($value->{'id'}==$id){
            return true;
           }
         }
         return false;
       }
       }












 ?>
