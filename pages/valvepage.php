<?php  session_start();
if(!isset($_SESSION['active']) || empty($_SESSION['active'])){
  header("location: index.php");
}
?>
<?php

function loginfname(){
  return $_SESSION['first_name'];
}
function loginlname(){
  return $_SESSION['last_name'];
}
function loginemail(){
  return $_SESSION['email'];
}
function loginactive(){
  return $_SESSION['active'];
}

function getfname(){
  return $_SESSION['first_name']." ".$_SESSION['last_name'];
}


function getvid(){
  return $_GET['vid'];
}
function getdbname(){
  return $_GET['pdbname'];
}
function getparkname(){
  require "db.php";
  $parkdb= mysqli_real_escape_string($mysqli, $_GET['pdbname']);
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
  $parkdb= mysqli_real_escape_string($mysqli, $_GET['pdbname']);
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

?>

<script type="text/javascript">

function addvalvemessage(){
  id=$('#vidm').text();
  message = document.getElementById("messagetext").value;
  dbname = $('#dbvname').text();
  person= document.getElementById("fullname").value;
  if( $.trim( $("#messagetext").val() ) == ''){
    alert("Please input a valid message");
  }
  else{
    $.ajax({
      type: 'POST',
      url: 'addvalvemessage.php',
      data: {'parkdbname': dbname,'valveid':id,'message':message,'fullname':person},
      success: function(html) {
        $('#myModal').modal('hide');
        location.reload();
      }
    });
  }
}

function goback(){
  parkname=bname = $('#pnameid').text();
  window.location.href ="parkpage.php"+"?parkname="+parkname;

}

function logout(){
  $.ajax({
    type: 'POST',
    url: 'logout.php',
    success: function(html) {
      window.location.href ="index.php";

    }
  });

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
          <a class="dropdown-toggle pull-right" data-toggle="dropdown" href="#">
            <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
          </a>
          <ul class="dropdown-menu dropdown-user dropdown-menu-right pull-right">
            <li><a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a>
            </li>
            <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
            </li>
            <li class="divider"></li>
            <li><a href="javascript:;" onclick="logout();"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
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
            <h3 class="text-center">Hello, <?php echo loginfname() ?> !</h3>
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
          <div >
            <p id="vidm" hidden><?php  echo getvid();?></p>
          </div>
          <div >
            <p id="dbvname" hidden><?php  echo getdbname();?></p>
          </div>
          <div >
            <p id="fullname" hidden><?php  echo getfname()?></p>
          </div>



          <div class="col-lg-6">
            <h1 id="pnameid" class="page-header">
              <button type="button" name="button"  style="border:0px solid transparent; margin-top: -10px" class="btn btn-default btn-lg" onclick="goback()"><i class='fa fa-lg fa-arrow-left' style='color: #5bc0de;' aria-hidden="true"></i></button>
              <?php getparkname(); ?>
            </h1>
          </div>
          <div class="col-lg-6 pull-right">
            <h1 class="page-header pull-right">
              <?php echo "Valve ID: " . getvid();?>
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
              Valve <?php echo $_GET['vid'] ?> Messages
              <button type='button'  class='btn btn-success btn-circle pull-right' style="margin-top: -5px" data-toggle="modal" data-target="#myModal" ><i class='fa fa-plus'></i></button>
            </div>

            <!-- Modal -->
            <div id="myModal" class="modal fade" role="dialog">
              <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Add Valve Message</h4>
                  </div>
                  <div class="modal-body">
                    <textarea id="messagetext" class="form-control" rows="8"></textarea>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" onclick="addvalvemessage()"> Add Message</button>
                  </div>
                </div>

              </div>
            </div>

            <!-- /.panel-heading -->
            <div class="panel-body">
              <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                <thead>
                  <tr>
                    <th>Done By</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Message</th>
                  </tr>
                </thead>
                <tbody id="tablelist">
                  <?php
                  require "json.php";
                  // echo getvid();
                  // echo
                  $jsondata=getworkjson(getvid(),getdbname());
                  //print_r($jsondata);

                  foreach ($jsondata as $key => $value) {
                    $datetime=  explode('?',$value->{'date'});
                    $message= $value->{'message'};
                    $person= $value->{'person'};
                    echo "<tr>";
                    echo "<td class='center col-sm-4'>" .$person. "</td>";
                    echo "<td class='center col-sm-2'>" .$datetime[0]. "</td>";
                    echo "<td class='center col-sm-2'>" .$datetime[1]. "</td>";
                    echo "<td class='center col-sm-4'>" .$message. "</td>";
                    echo "</tr >";

                  }


                  ?>







                </tbody>

              </table>
              <!-- /.table-responsive -->










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
