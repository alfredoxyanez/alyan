<?php
require "db.php";
require "name.php";
date_default_timezone_set("America/Los_Angeles");

function addvalvej($id,$parkdbname){
  require "db.php";
  //$parkname= getname($parkname);
  $dbname= mysqli_real_escape_string($mysqli,$parkdbname);

  $sql="SELECT * FROM parks WHERE databasename='$dbname'";

  $result=mysqli_query($mysqli,$sql) or die('Query failed: '. mysqli_error($mysqli));
  if(mysqli_num_rows($result)>0){
    $user = mysqli_fetch_assoc($result);
    $jsonp=$user['valveswork'];
    $numv=$user['numvalves'];
    $numv= $numv+1;
    $jsonp= json_decode($jsonp);
    $updatej=$jsonp->{'vnum'} =$numv;
    $datetime=date("m-d-Y")."?". date("H:i:s")."PST";
    $response = new stdClass;
    $response->{'id'}= (string) strtoupper($id);
    $response->{'status'}=true;
    $response->{'date'}=$datetime;
    $response->{'workdone'}=array();
    array_push($jsonp->{'valvelist'},$response);
    $newvalue= json_encode($jsonp);
    $sql2 = "UPDATE parks SET valveswork='$newvalue', numvalves='$numv' WHERE databasename='$dbname'";
    $result2=mysqli_query($mysqli,$sql2) or die('Query failed: '. mysqli_error($mysqli));

  }

}



function addvalvework($id,$parkdbname,$message,$person,$datetime){
  require "db.php";
  //$parkname= getname($parkname);
  $dbname= mysqli_real_escape_string($mysqli,$parkdbname);
  $datetime=mysqli_real_escape_string($mysqli,$datetime);

  $sql="SELECT * FROM parks WHERE databasename='$dbname'";

  $result=mysqli_query($mysqli,$sql) or die('Query failed: '. mysqli_error($mysqli));
  if(mysqli_num_rows($result)>0){
    $user = mysqli_fetch_assoc($result);
    $jsonp=$user['valveswork'];
    $jsonp= json_decode($jsonp);
    $updatej=$jsonp->{'valvelist'};
    $response = new stdClass;
    $response->{'person'}=$person;
    $response->{'date'}=$datetime;
    $response->{'message'}=$message;
    foreach ($updatej as $key => $value) {
      if($value->{'id'}==$id){
        array_push($value->{'workdone'},$response);
      }
    }
    $newvalue= json_encode($jsonp);
    $sql2 = "UPDATE parks SET valveswork='$newvalue' WHERE databasename='$dbname'";
    $result2=mysqli_query($mysqli,$sql2) or die('Query failed: '. mysqli_error($mysqli));
  }
}


//getworkjson($id1,$parkdbname);
function getworkjson($id,$parkdbname){
  require "db.php";
  $dbname= mysqli_real_escape_string($mysqli,$parkdbname);
  $sql="SELECT * FROM parks WHERE databasename='$dbname'";
  $result=mysqli_query($mysqli,$sql) or die('Query failed: '. mysqli_error($mysqli));
  if(mysqli_num_rows($result)>0){
    $user = mysqli_fetch_assoc($result);
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
  $dbname= mysqli_real_escape_string($mysqli,$parkdbname);
  $sql="SELECT * FROM parks WHERE databasename='$dbname'";
  $result=mysqli_query($mysqli,$sql) or die('Query failed: '. mysqli_error($mysqli));
  if(mysqli_num_rows($result)>0){
    $user = mysqli_fetch_assoc($result);
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



function changevstatus($id,$parkdbname){
  require "db.php";
  $dbname= mysqli_real_escape_string($mysqli,$parkdbname);
  $sql="SELECT * FROM parks WHERE databasename='$dbname'";
  $result=mysqli_query($mysqli,$sql) or die('Query failed: '. mysqli_error($mysqli));
  if(mysqli_num_rows($result)>0){
    $user = mysqli_fetch_assoc($result);
    $jsonp=$user['valveswork'];
    $jsonp= json_decode($jsonp);
    $updatej=$jsonp->{'valvelist'};
    foreach ($updatej as $key => $value) {
      if($value->{'id'}==$id){
        if($value->{'status'}==true){
          $value->{'status'}=false;
          $newvalue= json_encode($jsonp);
          $sql2 = "UPDATE parks SET valveswork='$newvalue' WHERE databasename='$dbname'";
          $result2=mysqli_query($mysqli,$sql2) or die('Query failed: '. mysqli_error($mysqli));
        }else if($value->{'status'}==false){
          $value->{'status'}=true;
          $newvalue= json_encode($jsonp);
          $sql2 = "UPDATE parks SET valveswork='$newvalue' WHERE databasename='$dbname'";
          $result2=mysqli_query($mysqli,$sql2) or die('Query failed: '. mysqli_error($mysqli));

        }

      }
    }
  }
}

function vstatus($id,$parkdbname){
  require "db.php";
  $dbname= mysqli_real_escape_string($mysqli,$parkdbname);
  $sql="SELECT * FROM parks WHERE databasename='$dbname'";
  $result=mysqli_query($mysqli,$sql) or die('Query failed: '. mysqli_error($mysqli));
  if(mysqli_num_rows($result)>0){
    $user = mysqli_fetch_assoc($result);
    $jsonp=$user['valveswork'];
    $jsonp= json_decode($jsonp);
    $updatej=$jsonp->{'valvelist'};
    foreach ($updatej as $key => $value) {
      if($value->{'id'}==$id){

        $stat=$value->{'status'};
        if($stat){
          return true;

        }else if(!$stat){
          return false;


        }

      }
    }
    return null;
  }
  return null;
}

$datetime=date("m-d-Y")."?". date("H:i:s")."PST";
addworkperson("3D","rialto","does this work","ayanez@mit.edu",$datetime,"3");
function addworkperson($id,$parkname,$message,$email,$datetime,$parkid){
  require "db.php";
  $dbname= mysqli_real_escape_string($mysqli,$dbname);
  $email= mysqli_real_escape_string($mysqli,$email);
  $sql="SELECT * FROM users WHERE email='$email'";
  $result=mysqli_query($mysqli,$sql) or die('Query failed: '. mysqli_error($mysqli));
  if(mysqli_num_rows($result)>0){
    $user = mysqli_fetch_assoc($result);
    $jsonp=$user['work'];
    $jsonp= json_decode($jsonp);
    $updatej=$jsonp->{'work'};
    print_r($updatej);
    echo "<br>";
    $response = new stdClass;
    $response->{'valveidf'}=$parkid."-".$id;
    $response->{'parkname'}=$parkname;
    $response->{'message'}=$message;
    $response->{'datetime'}=$datetime;
    print_r($response);
    echo "<br>";
    array_push($jsonp->{'work'},$response);
    print_r($updatej);
    echo "<br>";
    print_r($jsonp);
    echo "<br>";

    $newvalue= json_encode($jsonp);
    print_r($newvalue);

    $sql = "UPDATE users SET work='$newvalue' WHERE email='$email'";
    $result2=mysqli_query($mysqli,$sql) or die('Query failed: '. mysqli_error($mysqli));


  }
}









?>
