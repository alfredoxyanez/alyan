<?php

require "db.php";
require "name.php";

function getparkname(){
  require "db.php";
  $parkname =  mysqli_real_escape_string($mysqli, $_GET['parkname']);
  $parkdb= getnamedb($parkname);
  $sql= "SELECT * FROM parks WHERE databasename='$parkdb'";
  $entry= mysqli_query($mysqli,$sql);
  if(mysqli_num_rows($entry)>0){
    $user = mysqli_fetch_assoc($entry);
    echo $user['parkname'];


  }else{
    echo "something went wrong";
  }
  mysqli_close($mysqli);
}
function getparknamer(){
  require "db.php";
  $parkname =  mysqli_real_escape_string($mysqli, $_GET['parkname']);
  $parkdb= getnamedb($parkname);
  $sql= "SELECT * FROM parks WHERE databasename='$parkdb'";
  $entry= mysqli_query($mysqli,$sql);
  if(mysqli_num_rows($entry)>0){
    $user = mysqli_fetch_assoc($entry);
    return $user['parkname'];


  }else{
    return "something went wrong";
  }
  mysqli_close($mysqli);
}
function getparkdbnamer(){
  require "db.php";
  $parkname =  mysqli_real_escape_string($mysqli, $_GET['parkname']);
  $parkdb= getnamedb($parkname);
  $sql= "SELECT * FROM parks WHERE databasename='$parkdb'";
  $entry= mysqli_query($mysqli,$sql);
  if(mysqli_num_rows($entry)>0){
    $user = mysqli_fetch_assoc($entry);
    return $user['databasename'];


  }else{
    return null;
  }
  mysqli_close($mysqli);
}
function getparkdbname(){
  require "db.php";
  $parkname =  mysqli_real_escape_string($mysqli, $_GET['parkname']);
  $parkdb= getnamedb($parkname);
  $sql= "SELECT * FROM parks WHERE databasename='$parkdb'";
  $entry= mysqli_query($mysqli,$sql);
  if(mysqli_num_rows($entry)>0){
    $user = mysqli_fetch_assoc($entry);
    echo $user['databasename'];


  }else{
    echo "something went wrong";
  }
  mysqli_close($mysqli);
}

function getparktime(){
  require "db.php";
  $parkname =  mysqli_real_escape_string($mysqli, $_GET['parkname']);
  $parkdb= getnamedb($parkname);
  $sql= "SELECT * FROM parks WHERE databasename='$parkdb'";
  $entry= mysqli_query($mysqli,$sql);
  if(mysqli_num_rows($entry)>0){
    $user = mysqli_fetch_assoc($entry);
    echo $user['datet'];


  }else{
    echo "something went wrong";
  }
  mysqli_close($mysqli);
}
function getparkjson(){
  require "db.php";
  $parkname =  mysqli_real_escape_string($mysqli, $_GET['parkname']);
  $parkdb= getnamedb($parkname);
  $sql= "SELECT * FROM parks WHERE databasename='$parkdb'";
  $entry= mysqli_query($mysqli,$sql);
  if(mysqli_num_rows($entry)>0){
    $user = mysqli_fetch_assoc($entry);
    echo $user['valveswork'];


  }else{
    echo "something went wrong";
  }
  mysqli_close($mysqli);
}

function getparkidr(){
  require "db.php";
  $parkname =  mysqli_real_escape_string($mysqli, $_GET['parkname']);
  $parkdb= getnamedb($parkname);
  $sql= "SELECT * FROM parks WHERE databasename='$parkdb'";
  $entry= mysqli_query($mysqli,$sql);
  if(mysqli_num_rows($entry)>0){
    $user = mysqli_fetch_assoc($entry);
    return  $user['idparks'];


  }else{
    return "something went wrong";
  }
  mysqli_close($mysqli);
}


 ?>
 <script type="text/javascript">
 function addvalve(){
   id = document.getElementById("vid").value;
   name = document.getElementById("pvname").value;
   //alert(id+"   "+name);

   // vnum = document.getElementById("vnum").value;
   if( $.trim( $("#vid").val() ) == ''){
     alert("Please Input a ValveID");
   }
   else{
     $.ajax({
     type: 'POST',
     url: 'addvalve.php',
     data: {'parkdbname': name,'valveid':id},
     success: function(html) {
       //document.location.reload();
       location.reload();
     },
     error:function(error){
       //alert("ahhh");
       //console.log("noooo");
       alert("That ID is taken. Please Enter another.");
     }
   });
   }
 }

 function infov(id, parkdbname){
   window.location.href = "valvepage.php?pdbname="+parkdbname+"&"+"vid="+id;


 }

 function goback(){
   window.location.href ="tables.php";

 }



 </script>
 <!DOCTYPE html>
 <html lang="en">

 <head>

   <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <meta name="description" content="">
   <meta name="author" content="">

   <title>Park Ranger</title>

   <!-- Bootstrap Core CSS -->
   <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

   <!-- MetisMenu CSS -->
   <link href="../vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

   <!-- DataTables CSS -->
   <link href="../vendor/datatables-plugins/dataTables.bootstrap.css" rel="stylesheet">

   <!-- DataTables Responsive CSS -->
   <link href="../vendor/datatables-responsive/dataTables.responsive.css" rel="stylesheet">

   <!-- Custom CSS -->
   <link href="../dist/css/sb-admin-2.css" rel="stylesheet">

   <!-- Custom Fonts -->
   <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

   <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
   <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
   <!--[if lt IE 9]>
   <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
   <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
   <![endif]-->

 </head>

 <body>


   <div id="wrapper">

     <!-- Navigation -->
     <!-- Navigation -->
     <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
       <div class="navbar-header">
         <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
           <span class="sr-only">Toggle navigation</span>
           <span class="icon-bar"></span>
           <span class="icon-bar"></span>
           <span class="icon-bar"></span>
         </button>
         <a class="navbar-brand" href="tables.php">Park Ranger</a>
       </div>
       <!-- /.navbar-header -->

       <ul class="nav navbar-top-links navbar-right">


         <li class="dropdown">
           <a class="dropdown-toggle" data-toggle="dropdown" href="#">
             <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
           </a>
           <ul class="dropdown-menu dropdown-user">
             <li><a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a>
             </li>
             <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
             </li>
             <li class="divider"></li>
             <li><a href="index.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
             </li>
           </ul>
           <!-- /.dropdown-user -->
         </li>
         <!-- /.dropdown -->
       </ul>
       <!-- /.navbar-top-links -->
       <div class="navbar-default sidebar" role="navigation">
         <div class="sidebar-nav navbar-collapse">
           <ul class="nav" id="side-menu">
             <li class="sidebar-search">
               <div class="input-group custom-search-form">
                 <input type="text" class="form-control" placeholder="Search...">
                 <span class="input-group-btn">
                   <button class="btn btn-default" type="button">
                     <i class="fa fa-search"></i>
                   </button>
                 </span>
               </div>
               <!-- /input-group -->
             </li>
             <li>
               <a href="tables.php"><i class="fa fa-home fa-fw"></i> All Parks</a>
             </li>

           </ul>
         </div>
         <!-- /.sidebar-collapse -->
       </div>
       <!-- /.navbar-static-side -->
     </nav>

     <div id="page-wrapper">
       <div class="row">
         <div class="col-lg-12">
           <div class="col-lg-6">
             <h1 id="pnameid" class="page-header">
               <button type="button" name="button" style="border:0px solid transparent; margin-top: -10px" class="btn btn-default btn-lg" onclick="goback()"><i class='fa fa-lg fa-arrow-left' style='color: #5bc0de;' aria-hidden="true"></i></button>

               <?php getparkname();?>
             </h1>
           </div>
           <div class="col-lg-6 pull-right">
             <h1 class="page-header pull-right">
                <?php echo "Park ID: " . getparkidr();?>
             </h1>

           </div>

         </div>
         <!-- /.col-lg-12 -->
       </div>
       <!-- /.row -->
       <div class="row">
         <div class="col-lg-12">
           <div class="panel panel-default">
             <div class="panel-heading">
               Valves Status
             </div>
             <!-- /.panel-heading -->
             <div class="panel-body">
               <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                 <thead>
                   <tr>
                     <th>Info</th>
                     <th>Valve ID</th>
                     <th>Status</th>

                     <!-- <th>Delete</th> -->

                   </tr>
                 </thead>
                 <tbody id="tablelist">
                   <?php
                   require "db.php";
                   $dbname=getparkdbnamer();
                   $sname=getparknamer();
                   $parkid=getparkidr();
                   $sql= "SELECT valveswork FROM parks WHERE databasename='$dbname'";
                   $result= mysqli_query($mysqli, $sql) or die('Query failed: '. mysqli_error($mysqli));
                   if(mysqli_num_rows($result)>0){
                     $user = mysqli_fetch_assoc($result)['valveswork'];
                     $json = json_decode($user);
                     //print_r($json->{'valvelist'});
                     $tables=$json->{'vnum'};
                     for ($x = 0; $x < $tables; $x++) {
                       $eid= $json->{'valvelist'}[$x]->{'id'};
                       $status= $json->{'valvelist'}[$x]->{'status'};
                       if($status){
                         $message="<button type='button'  class='btn btn-success btn-circle text-center center-block'> <i class='fa fa-thumbs-up'></i></button>";
                       }else{
                         $message="<button type='button'  class='btn btn-danger btn-circle text-center center-block'><i class='fa fa-thumbs-down'></i></button>";
                       }

                       echo "<tr  id='". $sname . $eid ."'>";
                       echo "<td class='center col-sm-2'>" . "<button type='button'  class='btn btn-info btn-circle text-center center-block' onclick=\"infov('$eid','$dbname')\" ><i class='fa fa-info'></i></button>". "</td>";
                       echo "<td class='center col-sm-6'>" .$parkid."-". $eid . "</td>";
                       echo "<td class='center col-sm-4'>" .$message. "</td>";
                       //echo "<td class='center col-sm-2'>" . "<button type='button'  class='btn btn-danger btn-circle text-center center-block' onclick=\"del('$pname')\" ><i class='fa fa-times'></i></button>". "</td>";
                       echo "</tr >";
                     }
                   }
                    ?>




               </tbody>

             </table>
             <!-- /.table-responsive -->

             <table class="table table-inverse">
               <thead class="thead-inverse">
                 <tr>
                   <th>Add Valve</th>
                   <th></th>
                   <th></th>
                 </tr>
               </thead>
               <tbody>
                 <form name="addvf" action="" method="post" autocomplete="false">
                   <tr>
                     <td class="col-sm-2">
                       <div class="pull-right" style="font-weight: bold; font-size: 125%">
                         <?php echo getparkidr()."-" ?>
                       </div>
                     </td>

                     <td class="col-sm-6 center">
                       <div>
                         <input autocomplete="false" style="width: 100%" type="text" id="vid" name="valvename" placeholder="Valve ID">
                         <input type="hidden" id="pvname" value=<?php getparkdbname() ?> >
                       </div>
                     </td>
                     <td class="col-sm-4  center">
                       <div >
                         <button name='addvb' type='button' class='btn btn-success btn-circle text-center center-block center' onclick='addvalve()'><i class='fa fa-check'></i></button>

                       </div>
                     </td>
                   </tr>
                 </form>

               </tbody>
             </table>








           </div>
           <!-- /.panel-body -->
         </div>
         <!-- /.panel -->
       </div>
       <!-- /.col-lg-12 -->
     </div>

   </div>
   <!-- /#page-wrapper -->

 </div>
 <!-- /#wrapper -->

 <!-- jQuery -->
 <script src="../vendor/jquery/jquery.min.js"></script>

 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

 <!-- Bootstrap Core JavaScript -->
 <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>

 <!-- Metis Menu Plugin JavaScript -->
 <script src="../vendor/metisMenu/metisMenu.min.js"></script>

 <!-- DataTables JavaScript -->
 <script src="../vendor/datatables/js/jquery.dataTables.min.js"></script>
 <script src="../vendor/datatables-plugins/dataTables.bootstrap.min.js"></script>
 <script src="../vendor/datatables-responsive/dataTables.responsive.js"></script>

 <!-- Custom Theme JavaScript -->
 <script src="../dist/js/sb-admin-2.js"></script>

 <!-- Page-Level Demo Scripts - Tables - Use for reference -->
 <script>
 $(document).ready(function() {
   $('#dataTables-example').DataTable({
     responsive: true
   });
 });
 </script>



 </body>

 </html>
