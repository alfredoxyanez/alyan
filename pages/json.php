<?php
require "db.php";
require "name.php";
date_default_timezone_set("America/Los_Angeles");

function addvalvej($id,$parkdbname,$numtrees,$numgals){
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
    $response->{'numtrees'}=$numtrees;
    $response->{'numgals'}=$numgals;
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

// $id1="A1   (VALVE HAS 23 TREES)    (VALVE USES 17.5 GPM)";
// $parkdbname="riversidegolfcoursedb";
// getworkjson($id1,$parkdbname);
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
    $response = new stdClass;
    $response->{'valveidf'}=$parkid."-".$id;
    $response->{'parkname'}=$parkname;
    $response->{'message'}=$message;
    $response->{'datetime'}=$datetime;
    array_push($jsonp->{'work'},$response);
    $newvalue= json_encode($jsonp);
    $sql = "UPDATE users SET work='$newvalue' WHERE email='$email'";
    $result2=mysqli_query($mysqli,$sql) or die('Query failed: '. mysqli_error($mysqli));


  }
}

function returnworkperson($email){
  require "db.php";
  $email= mysqli_real_escape_string($mysqli,$email);
  $sql="SELECT * FROM users WHERE email='$email'";
  $result=mysqli_query($mysqli,$sql) or die('Query failed: '. mysqli_error($mysqli));
  if(mysqli_num_rows($result)>0){
    $user = mysqli_fetch_assoc($result);
    $jsonp=$user['work'];
    $jsonp= json_decode($jsonp);
    $updatej=$jsonp->{'work'};
    //  print_r($updatej);
    return $updatej;


  }
}
function getAllParks(){
  require "db.php";
  $sql="SELECT * FROM parks";
  $result=mysqli_query($mysqli,$sql) or die('Query failed: '. mysqli_error($mysqli));
  $arr=array();
  if(mysqli_num_rows($result)>0){
    while($row = mysqli_fetch_array($result)) {
      array_push($arr,$row['parkname']);
    }
    return $arr;
  }
  return null;
}

function getAllValveStatus(){
  require "db.php";
  $sql="SELECT * FROM parks";
  $result=mysqli_query($mysqli,$sql) or die('Query failed: '. mysqli_error($mysqli));
  $total=0;
  $working=0;
  if(mysqli_num_rows($result)>0){
    while($row = mysqli_fetch_array($result)) {
      if($row['numvalves']>0){
        $js=json_decode($row['valveswork']);
        $valves= $js->{'valvelist'};
        $total+= $row['numvalves'];
        foreach ($valves as $key => $value) {
          if($value->{'status'}){
            $working+=1;
          }
        }
      }
    }
    $response = new stdClass;
    $response->{'working'}=$working;
    $response->{'total'}=$total;
    return $response;
  }

  return null;


}

function deletevalve($id,$parkdbname){
  require "db.php";
  $dbname= mysqli_real_escape_string($mysqli,$parkdbname);
  $sql="SELECT * FROM parks WHERE databasename='$dbname'";
  $result=mysqli_query($mysqli,$sql) or die('Query failed: '. mysqli_error($mysqli));
  $id= preg_replace('/\s+/', '', $id);
  if(mysqli_num_rows($result)>0){
    $user = mysqli_fetch_assoc($result);
    $jsonp=$user['valveswork'];
    $jsonp= json_decode($jsonp);
    $updatej=$jsonp->{'valvelist'};
    $oldvalves=$user['numvalves'];
    $index=0;
    foreach ($updatej as $key => $value) {
      $val= preg_replace('/\s+/', '', $value->{'id'});
      if($val==$id){
        unset($jsonp->{'valvelist'}[$index]);
        $arr2=array_values($jsonp->{'valvelist'});
        $jsonp->{'valvelist'}=$arr2;
        //print_r($arr2);
        $jsonp->{'vnum'}-=1;
        $oldvalves-=1;
        $newvalue= json_encode($jsonp);
        $sql = "UPDATE parks SET valveswork='$newvalue' WHERE databasename='$dbname'";
        $result=mysqli_query($mysqli,$sql) or die('Query failed: '. mysqli_error($mysqli));
        $sql2 = "UPDATE parks SET numvalves='$oldvalves' WHERE databasename='$dbname'";
        $result2=mysqli_query($mysqli,$sql2) or die('Query failed: '. mysqli_error($mysqli));

      }
      $index+=1;
    }
    return null;
  }
}


function gettrees($id,$parkdbname){
  require "db.php";
  $dbname= mysqli_real_escape_string($mysqli,$parkdbname);
  $sql="SELECT * FROM parks WHERE databasename='$dbname'";
  $result=mysqli_query($mysqli,$sql) or die('Query failed: '. mysqli_error($mysqli));
  $id= preg_replace('/\s+/', '', $id);
  if(mysqli_num_rows($result)>0){
    $user = mysqli_fetch_assoc($result);
    $jsonp=$user['valveswork'];
    $jsonp= json_decode($jsonp);
    $updatej=$jsonp->{'valvelist'};
    $oldvalves=$user['numvalves'];
    $index=0;
    foreach ($updatej as $key => $value) {
      $val= preg_replace('/\s+/', '', $value->{'id'});
      if($val==$id){
        return $jsonp->{'valvelist'}[$index]->{'numtrees'};
      }
      $index+=1;
    }
    return null;
  }
}



function getgals($id,$parkdbname){
  require "db.php";
  $dbname= mysqli_real_escape_string($mysqli,$parkdbname);
  $sql="SELECT * FROM parks WHERE databasename='$dbname'";
  $result=mysqli_query($mysqli,$sql) or die('Query failed: '. mysqli_error($mysqli));
  $id= preg_replace('/\s+/', '', $id);
  if(mysqli_num_rows($result)>0){
    $user = mysqli_fetch_assoc($result);
    $jsonp=$user['valveswork'];
    $jsonp= json_decode($jsonp);
    $updatej=$jsonp->{'valvelist'};
    $oldvalves=$user['numvalves'];
    $index=0;
    foreach ($updatej as $key => $value) {
      $val= preg_replace('/\s+/', '', $value->{'id'});
      if($val==$id){
        return $jsonp->{'valvelist'}[$index]->{'numgals'};
      }
      $index+=1;
    }
    return null;
  }
}



function editvalve($id,$parkdbname,$newid,$numtrees,$numgals){
  require "db.php";
  $dbname= mysqli_real_escape_string($mysqli,$parkdbname);
  $sql="SELECT * FROM parks WHERE databasename='$dbname'";
  $result=mysqli_query($mysqli,$sql) or die('Query failed: '. mysqli_error($mysqli));
  $id= preg_replace('/\s+/', '', $id);
  if(mysqli_num_rows($result)>0){
    $user = mysqli_fetch_assoc($result);
    $jsonp=$user['valveswork'];
    $jsonp= json_decode($jsonp);
    $updatej=$jsonp->{'valvelist'};
    $oldvalves=$user['numvalves'];
    $index=0;
    foreach ($updatej as $key => $value) {
      $val= preg_replace('/\s+/', '', $value->{'id'});
      if($val==$id){
        $jsonp->{'valvelist'}[$index]->{'id'}=$newid;
        $jsonp->{'valvelist'}[$index]->{'numtress'}=$numtrees;
        $jsonp->{'valvelist'}[$index]->{'numgals'}=$numgals;
        $arr2=array_values($jsonp->{'valvelist'});
        $jsonp->{'valvelist'}=$arr2;
        $newvalue= json_encode($jsonp);
        $sql = "UPDATE parks SET valveswork='$newvalue' WHERE databasename='$dbname'";
        $result=mysqli_query($mysqli,$sql) or die('Query failed: '. mysqli_error($mysqli));


      }
      $index+=1;
    }
  }
}

?>
