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





 ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript">

function del(name){
  $.ajax({
  type: 'POST',
  url: 'deletepark.php',
  data: {'parkname': name},
  success: function(html) {
    var element = document.getElementById(name);
    element.outerHTML = "";
    delete element;
  }
});
}

function addentry(){
  name = document.getElementById("pname").value;
  // vnum = document.getElementById("vnum").value;
  if( $.trim( $("#pname").val() ) == ''){
    alert("Please Input a Park Name");

  }
  else{
    $.ajax({
    type: 'POST',
    url: 'addpark.php',
    data: {'parkname': name},
    success: function() {
      location.reload();
    }
  });
  }



}
function info(name){
  window.location.href = "parkpage.php?parkname="+name;

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
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">
            <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
          </a>
          <ul class="dropdown-menu dropdown-user dropdown-menu-right ">
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
          <h1 class="page-header">Parks</h1>
        </div>
        <!-- /.col-lg-12 -->
      </div>
      <!-- /.row -->
      <div class="row">
        <div class="col-lg-12">
          <div class="panel panel-default">
            <div class="panel-heading">
              All Managed Parks
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
              <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                <thead>
                  <tr>
                    <th>Info</th>
                    <th>Park</th>
                    <th>Valves</th>
                    <!-- <th>Delete</th> -->

                  </tr>
                </thead>
                <tbody id="tablelist">

                  <?php
                  require 'db.php';

                  $sql= "SELECT parkname, numvalves FROM parks";
                  $result= mysqli_query($mysqli, $sql);
                  if (mysqli_num_rows($result) > 0) {
                    // output data of each row
                    while($row = mysqli_fetch_assoc($result)) {
                      $pname=$row["parkname"];
                      echo "<tr  id='". $pname ."'>";
                      echo "<td class='center col-sm-2'>" . "<button type='button'  class='btn btn-info btn-circle text-center center-block' onclick=\"info('$pname')\" ><i class='fa fa-info'></i></button>". "</td>";
                      echo "<td class='center col-sm-5'>" . $row["parkname"]. "</td>";
                      echo "<td class='center col-sm-3'>" . $row["numvalves"]. "</td>";
                      //echo "<td class='center col-sm-2'>" . "<button type='button'  class='btn btn-danger btn-circle text-center center-block' onclick=\"del('$pname')\" ><i class='fa fa-times'></i></button>". "</td>";
                      echo "</tr >";
                    }
                  }

                  mysqli_close($mysqli);

                  ?>



              </tbody>

            </table>
            <!-- /.table-responsive -->



            <table class="table table-inverse">
              <thead class="thead-inverse">
                <tr>
                  <th>Add Park</th>
                  <th></th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                <form name="addpark" action="tables.php" method="post" autocomplete="false">
                  <tr>
                    <td class="col-sm-5 center">
                      <div>
                        <input autocomplete="false" style="width: 100%" type="text" id="pname" name="parkname" placeholder="Park Name">
                      </div>
                    </td>
                    <!-- <td class="col-sm-5 center">
                      <div >
                        <input autocomplete="false" style="width: 100%" type="text" id ="vnum" name="numvals" placeholder="Number of Valves">

                      </div>
                    </td> -->
                    <td class="col-sm-2  center">
                      <div >
                        <button name='add' type='button' class='btn btn-success btn-circle text-center center-block center' onclick="addentry()"><i class='fa fa-check'></i></button>

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
