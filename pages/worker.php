<?php  session_start();
if(!isset($_SESSION['active']) || empty($_SESSION['active'])){
  header("location: login.php");
}
?>
<?php
function loginfname(){
  return $_SESSION['first_name'];
}
function loginlname(){
  return $_SESSION['last_name'];
}
function fullname(){
  return $_SESSION['first_name']." ".$_SESSION['last_name'];
}
function loginemail(){
  return $_SESSION['email'];
}
function loginactive(){
  return $_SESSION['active'];
}

function admin(){
  $ad=$_SESSION['admin'];
  if($ad=="0"){
    return false;
  }
  else if($ad=="1"){
    return true;
  }
}

?>
<script type="text/javascript">
function logout(){
  $.ajax({
    type: 'POST',
    url: 'logout.php',
    success: function(html) {
      window.location.href ="login.php";

    }
  });

}

</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>



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

        <a class="navbar-brand" href="tables.php"><span><i class="glyphicon glyphicon-tree-deciduous" style="color:green"></i></span>  Park Ranger</a>
      </div>
      <!-- /.navbar-header -->

      <ul class="nav navbar-top-links navbar-right">


        <li class="dropdown pull-right">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">
            <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
          </a>
          <ul class="dropdown-menu dropdown-user dropdown-menu-right ">
            <li><a href="worker.php"><i class="fa fa-user fa-fw"></i> User Profile</a>
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
          <h1 class="page-header">Work</h1>
        </div>
        <!-- /.col-lg-12 -->
      </div>
      <!-- /.row -->
      <div class="row">
        <div class="col-lg-12">
          <div class="panel panel-default">
            <div class="panel-heading">
              Work done by <?php echo fullname(); ?>
            </div>


            <!-- /.panel-heading -->
            <div class="panel-body">
              <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                <thead>
                  <tr>
                    <th>Park</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Valve</th>
                    <th>Message</th>

                    <!-- <th>Delete</th> -->

                  </tr>
                </thead>
                <tbody id="tablelist">
                  <?php
                  require_once "json.php";
                  $email=loginemail();
                  $json = returnworkperson($email);
                  foreach ($json as $key => $value) {
                    $parkname=$value->{'parkname'};
                    $datetime=  explode('?',$value->{'datetime'});
                    $valveid=$value->{'valveidf'};
                    $message=$value->{'message'};
                    echo "<tr>";
                    echo "<td class='center col-sm-2'>" .$parkname. "</td>";
                    echo "<td class='center col-sm-2'>" .$datetime[0]. "</td>";
                    echo "<td class='center col-sm-2'>" .$datetime[1]. "</td>";
                    echo "<td class='center col-sm-2'>" .$valveid. "</td>";
                    echo "<td class='center col-sm-4'>" .$message. "</td>";
                    echo "</tr >";
                  }
                  ?>
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
  <script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyD6RsQuot1EGNW89-uIU70htIbLaGy_Gb8&libraries=places"></script>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="../js/jquery.geocomplete.js"></script>

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


  <script >
  $(function(){
    $("#steest").geocomplete({ details: "form" });

  });

  </script>




</body>

</html>
