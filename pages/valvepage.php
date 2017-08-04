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
function loginemail(){
  return $_SESSION['email'];
}
function loginactive(){
  return $_SESSION['active'];
}

function getfname(){
  $fullname= loginfname()." ".loginlname();
  return $fullname;
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

function getparkidr(){
  require "db.php";
  $parkdb= mysqli_real_escape_string($mysqli, $_GET['pdbname']);
  $sql= "SELECT * FROM parks WHERE databasename='$parkdb'";
  $entry= mysqli_query($mysqli,$sql);
  if(mysqli_num_rows($entry)>0){
    $user = mysqli_fetch_assoc($entry);
    return $user['idparks'];


  }else{
    return "something went wrong";
  }
  mysqli_close($mysqli);
}

function getvalvetrees(){
  return gettrees(getvid(),getdbname());

}

function getvalvegp(){
  return getgals(getvid(),getdbname());
}




?>

<script type="text/javascript">

function addvalvemessage(){
  id=$('#vidm').text();
  message = document.getElementById("messagetext").value;
  dbname = $('#dbvname').text();
  person= $('#fullname').text();
  email= $('#gmail').text();
  pid= $('#pid').text();
  parkname=$('#parkname').text();
  if( $.trim( $("#messagetext").val() ) == ''){
    alert("Please input a valid message");
  }
  else{
    $.ajax({
      type: 'POST',
      url: 'addvalvemessage.php',
      data: {'parkdbname': dbname,'valveid':id,'message':message,'fullname':person,'email':email,'pid':pid,'parkname':parkname},
      success: function(html) {
        $('#myModal').modal('hide');
        location.reload();
      }
    });
  }
}

function goback(){
  parkname=$('#parkname').text();
  window.location.href ="parkpage.php"+"?parkname="+parkname;

}

function logout(){
  $.ajax({
    type: 'POST',
    url: 'logout.php',
    success: function(html) {
      window.location.href ="login.php";

    }
  });

}


function changevstat(){
  id=$('#vidm').text();
  dbname = $('#dbvname').text();

  $.ajax({
    type: 'POST',
    url: 'changev.php',
    data: {'parkdbname': dbname,'valveid':id},
    success: function(html) {
      location.reload();
    }
  });

}
function deletevalve(){
  id=$('#vidm').text();
  dbname = $('#dbvname').text();
  $.ajax({
    type: 'POST',
    url: 'deletev.php',
    data: {'parkdbname': dbname,'valveid':id},
    success: function(html) {
      parkname=$('#parkname').text();
      window.location.href ="parkpage.php"+"?parkname="+parkname;
    }
  });

}


function editvalve(){
  id = $('#vidm').text();
  nid = document.getElementById("vidn").value;
  name = $('#dbvname').text();
  numt = document.getElementById("vtress").value;
  numg = document.getElementById("vgp").value;
  if( $.trim( $("#vidn").val() ) == ''){
    alert("Please Input a ValveID");
  }
  if( $.trim( $("#vtress").val() ) == ''){
    alert("Please Input # of Tress");
  }
  if( $.trim( $("#vgp").val() ) == ''){
    alert("Please Input # of GPM/H");
  }
  else{
    $.ajax({
      type: 'POST',
      url: 'editvalve.php',
      data: {'parkdbname': name,'valveid':id,'newid':nid,'trees':numt, 'gals':numg},
      success: function(html) {
        window.location.href = "valvepage.php?pdbname="+name+"&"+"vid="+nid.replace(/\s/g, "") ;
      },
      error:function(error){
        alert(error.responseText)
        // alert("That ID is taken. Please Enter another." + error.responseText);
      }
    });
  }
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
  <style media="screen">
  .pac-container{
    z-index: 10000;
  }
  </style>

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
        <a class="navbar-brand" href="tables.php"><span><i class="glyphicon glyphicon-tree-deciduous" style="color:green"></i></span>  Park Ranger</a>      </div>
        <!-- /.navbar-header -->

        <ul class="nav navbar-top-links navbar-right">
          <li class="dropdown pull-right">
            <a class="dropdown-toggle " data-toggle="dropdown" href="#">
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
            <div >
              <p id="vidm" hidden><?php  echo getvid();?></p>
            </div>
            <div >
              <p id="dbvname" hidden><?php  echo getdbname();?></p>
            </div>
            <div >
              <p id="fullname" hidden><?php  echo getfname();?></p>
            </div>
            <div >
              <p id="gmail" hidden><?php  echo loginemail();?></p>
            </div>
            <div >
              <p id="pid" hidden><?php  echo getparkidr();?></p>
            </div>
            <div >
              <p id="parkname" hidden><?php  echo getparknamer();?></p>
            </div>









            <div class="col-lg-6">
              <h1 id="pnameid" class="page-header">
                <button type="button" name="button"  style="border:0px solid transparent; margin-top: -10px" class="btn btn-default btn-lg" onclick="goback()"><i class='fa fa-lg fa-arrow-left' style='color: #5bc0de;' aria-hidden="true"></i></button>
                <?php getparkname(); ?>
              </h1>
            </div>
            <div class="col-lg-6 pull-right">
              <h1 class="page-header pull-right">
                <?php
                require_once "json.php";
                $id=getvid();
                $dbname=getdbname();
                $stat=vstatus($id,$dbname);

                if($stat){
                  echo "Valve ID: " .$id. "   "."<span><button type='button' class='btn btn-lg btn-circle btn-default' name='button' style='border-color: #5cb85c' onclick='changevstat()'><i class='fa  fa-thumbs-up ' style='color:#5cb85c'></i></button></span>";
                }
                else if(!$stat){
                  echo "Valve ID: " .$id. "   "."<span><button type='button' class='btn btn-lg btn-circle btn-default' name='button' style='border-color: #d9534f' onclick='changevstat()'><i class='fa  fa-thumbs-down ' style='color:#d9534f'></i></button></span>";
                }

                ?>

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
                      <textarea id="messagetext" class="form-control" rows="8" autofocus=""></textarea>
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
                    require_once "json.php";
                    // echo getvid();
                    // echo
                    $jsondata=getworkjson(getvid(),getdbname());
                    //print_r($jsondata);
                    foreach ($jsondata as $key => $value) {
                      $datetime=  explode('?',$value->{'date'});
                      $message= $value->{'message'};
                      $person= $value->{'person'};
                      echo "<tr>";
                      echo "<td class='center col-sm-3'>" .$person. "</td>";
                      echo "<td class='center col-sm-2'>" .$datetime[0]. "</td>";
                      echo "<td class='center col-sm-2'>" .$datetime[1]. "</td>";
                      echo "<td class='center col-sm-5'>" .$message. "</td>";
                      echo "</tr >";
                    }
                    ?>

                  </tbody>

                </table>
                <!-- /.table-responsive -->
                <div class="col-sm-12" >
                  <div class="col-sm-4 text-center">
                    <a class='btn btn-danger' href='javascript:;' onclick='deletevalve()'><i class='fa fa-trash-o fa-lg '></i> Delete Valve</a>

                  </div>
                  <div class="col-sm-4 text-center">
                    <?php
                    require_once "json.php";
                    $id=getvid();
                    $dbname=getdbname();
                    $stat=vstatus($id,$dbname);

                    if($stat){
                      echo "<a class='btn btn-success' href='javascript:;' onclick='changevstat()'><i class='fa fa-refresh fa-lg fa-spin'></i> Change Status </a>";
                      //echo "<button type='button' class='btn btn-danger' onclick='changevstat()'></button>";
                    }
                    else if(!$stat){
                      echo "<a class='btn btn-danger' href='javascript:;' onclick='changevstat()'><i class='fa fa-refresh fa-lg fa-spin'></i> Change Status </a>";

                    }
                    ?>

                  </div>
                  <div class="col-sm-4 text-center">
                    <a class='btn btn-primary' data-toggle="modal" data-target="#editModal"><i class='fa fa-pencil fa-lg '></i> Edit Valve</a>

                  </div>

                </div>

                <!-- Modal -->
                <div id="editModal" class="modal fade" role="dialog">
                  <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Edit Valve</h4>
                      </div>
                      <div class="modal-body">

                        <form class="form-horizontal">
                          <div class="form-group">
                            <label class="control-label col-sm-2" for="email">Valve Name:</label>
                            <div class="col-sm-10">
                              <input class="form-control" id="vidn" value=<?php echo getvid(); ?> >
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="control-label col-sm-2" for="vtress"># of Tress:</label>
                            <div class="col-sm-10">
                              <?php
                              echo '<input type="text" class="form-control" id="vtress" value="'.getvalvetrees().   ' ">'
                               ?>
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="control-label col-sm-2" for="vgp"># of GPM/H:</label>
                            <div class="col-sm-10">
                              <?php
                              echo '<input type="text" class="form-control" id="vgp" value="'.getvalvegp().   ' ">'
                               ?>
                            </div>
                          </div>
                        </form>
                      </div>
                      <div class="modal-footer">

                        <button type="button" class="btn btn-warning" onclick="editvalve()">Edit Valve</button>
                      </div>
                    </div>

                  </div>
                </div>




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
    <script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyD6RsQuot1EGNW89-uIU70htIbLaGy_Gb8&libraries=places"></script>
    <script src="../js/jquery.geocomplete.js"></script>

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
