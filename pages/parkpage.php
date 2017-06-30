<?php  session_start();
if(!isset($_SESSION['active']) || empty($_SESSION['active'])){
  header("location: login.php");
}
?>
<?php
require "db.php";
require "name.php";


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

function admin(){
  $ad=$_SESSION['admin'];
  if($ad=="0"){
    return false;
  }
  else if($ad=="1"){
    return true;
  }
}



function getparkname(){
  require "db.php";
  $parkname =  mysqli_real_escape_string($mysqli, $_GET['parkname']);
  $parkdb= getnamedb($parkname);
  $sql= "SELECT * FROM parks WHERE databasename='$parkdb'";
  $result= mysqli_query($mysqli,$sql) or die('Query failed: '. mysqli_error($mysqli));
  if(mysqli_num_rows($result)>0){
    $user = mysqli_fetch_assoc($result);
    echo $user['parkname'];


  }else{
    echo "something went wrong";
  }
  mysqli_close($mysqli);
}
function getparknamer(){
  require "db.php";
  $parkname =  mysqli_real_escape_string($mysqli, $_GET['parkname']);
  $parkdb= mysqli_real_escape_string($mysqli,getnamedb($parkname));
  $sql= "SELECT * FROM parks WHERE databasename='$parkdb'";
  $result= mysqli_query($mysqli,$sql) or die('Query failed: '. mysqli_error($mysqli));
  if(mysqli_num_rows($result)>0){
    $user = mysqli_fetch_assoc($result);
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
  $result= mysqli_query($mysqli,$sql) or die('Query failed: '. mysqli_error($mysqli));
  if(mysqli_num_rows($result)>0){
    $user = mysqli_fetch_assoc($result);
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
  $result= mysqli_query($mysqli,$sql) or die('Query failed: '. mysqli_error($mysqli));
  if(mysqli_num_rows($result)>0){
    $user = mysqli_fetch_assoc($result);
    echo $user['databasename'];


  }else{
    echo "something went wrong";
  }
  mysqli_close($mysqli);
}

function getparktime(){
  require "db.php";
  $parkname =  mysqli_real_escape_string($mysqli, $_GET['parkname']);
  $parkdb=  mysqli_real_escape_string($mysqli,getnamedb($parkname));
  $sql= "SELECT * FROM parks WHERE databasename='$parkdb'";
  $result= mysqli_query($mysqli,$sql) or die('Query failed: '. mysqli_error($mysqli));
  if(mysqli_num_rows($result)>0){
    $user = mysqli_fetch_assoc($result);
    echo $user['datet'];


  }else{
    echo "something went wrong";
  }
  mysqli_close($mysqli);
}
function getparklatlng(){
  require "db.php";
  $parkname =  mysqli_real_escape_string($mysqli, $_GET['parkname']);
  $parkdb=  mysqli_real_escape_string($mysqli,getnamedb($parkname));
  $sql= "SELECT * FROM parks WHERE databasename='$parkdb'";
  $result= mysqli_query($mysqli,$sql) or die('Query failed: '. mysqli_error($mysqli));
  if(mysqli_num_rows($result)>0){
    $user = mysqli_fetch_assoc($result);
    echo $user['latlng'];
  }else{
    echo "something went wrong";
  }
  mysqli_close($mysqli);
}
function getparkjson(){
  require "db.php";
  $parkname =  mysqli_real_escape_string($mysqli, $_GET['parkname']);
  $parkdb=  mysqli_real_escape_string($mysqli,getnamedb($parkname));
  $sql= "SELECT * FROM parks WHERE databasename='$parkdb'";
  $result= mysqli_query($mysqli,$sql) or die('Query failed: '. mysqli_error($mysqli));
  if(mysqli_num_rows($result)>0){
    $user = mysqli_fetch_assoc($result);
    echo $user['valveswork'];


  }else{
    echo "something went wrong";
  }
  mysqli_close($mysqli);
}

function getparkidr(){
  require "db.php";
  $parkname =  mysqli_real_escape_string($mysqli, $_GET['parkname']);
  $parkdb=  mysqli_real_escape_string($mysqli,getnamedb($parkname));
  $sql= "SELECT * FROM parks WHERE databasename='$parkdb'";
  $result= mysqli_query($mysqli,$sql) or die('Query failed: '. mysqli_error($mysqli));
  if(mysqli_num_rows($result)>0){
    $user = mysqli_fetch_assoc($result);
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
function changev(id,dbname){
  $.ajax({
    type: 'POST',
    url: 'changestat.php',
    data: {'parkdbname': dbname,'valveid':id},
    success: function(html) {
      location.reload();

    }
  });


}

function goback(){
  window.location.href ="tables.php";

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

  <style>
  #map {
    height: 400px;
    width: 100%;
  }

  .pac-container{
    z-index: 10000;
  }
  </style>

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
        <a class="navbar-brand" href="tables.php"><span><i class="glyphicon glyphicon-tree-deciduous" style="color:green"></i></span>  Park Ranger</a>      </div>
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
            <div class="col-lg-6">
              <h1 id="pnameid" class="page-header">
                <span>
                  <button type="button" name="button" style="border:0px solid transparent; margin-top: -10px" class="btn btn-default btn-lg" onclick="goback()">
                    <i class='fa fa-lg fa-arrow-left' style='color: #5bc0de;' aria-hidden="true"></i>
                  </button>
                </span id="pname1">
                <?php getparkname();?>
                <span>
                  <button type='button' class='btn btn-circle btn-info' name='button'  data-toggle='modal' data-target='#myInfo'>
                    <i class='fa fa-info'></i>
                  </button>
                </span>
              </h1>
            </div>
            <div id="myInfo" class="modal fade" role="dialog">
              <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"><?php getparkname(); ?></h4>
                    <input id="latlng" type='hidden'  value="<?php getparklatlng(); ?>">
                  </div>
                  <div class="modal-body">
                    <div id="map">

                    </div>

                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  </div>
                </div>

              </div>
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
                <?php
                if(admin()){
                  echo " <button type='button'  class='btn btn-success btn-circle pull-right' style='margin-top: -5px' data-toggle='modal' data-target='#myModal' ><i class='fa fa-plus'></i></button>";
                }
                ?>
              </div>
              <div id="myModal" class="modal fade" role="dialog">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                      <h4 class="modal-title">Add Park</h4>
                    </div>
                    <div class="modal-body col-sm-12">

                      <div class='col-sm-2'>
                        <div class='pull-right' style='font-weight: bold; font-size: '125%>
                          <?php echo getparkidr().'-' ?>
                        </div>
                      </div>

                      <div class='col-sm-10 '>
                        <div>
                          <input  autocomplete='false' style='width: 100%' type='text' id='vid' name='valvename' placeholder='Valve ID' autofocus>
                          <input type='hidden' id='pvname' value= "<?php echo getparkdbnamer(); ?>">
                          <input type='hidden' id='pname' value= "<?php echo getparknamer(); ?>">
                        </div>
                      </div>

                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-default" onclick='addvalve()'> Add Valve</button>
                    </div>
                  </div>

                </div>
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
                    $dbname=mysqli_real_escape_string($mysqli,getparkdbnamer());
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
                          $message="<button type='button'  class='btn btn-success btn-circle text-center center-block' onclick=\"changev('$eid','$dbname')\"> <i class='fa fa-thumbs-up'></i></button>";
                        }else{
                          $message="<button type='button'  class='btn btn-danger btn-circle text-center center-block' onclick=\"changev('$eid','$dbname')\"><i class='fa fa-thumbs-down'></i></button>";
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
    <script type="text/javascript">


    </script>


    <!-- <script>

    function initMap() {
    latlng=$("#latlng").val();
    latlng= latlng.split("?");
    var uluru = {lat: -25.363, lng: 131.044};
    var map = new google.maps.Map(document.getElementById('map'), {
    zoom: 7,
    center: uluru
  });
  var marker = new google.maps.Marker({
  position: uluru,
  map: map
});
}
</script> -->

<!-- <script>
function initMap() {
latlng=$("#latlng").val();
latlng= latlng.split("?");

var myLatLng = {lat: Number(latlng[0]), lng: Number(latlng[1])};

var map = new google.maps.Map(document.getElementById('map'), {
zoom: 17,
center: myLatLng
});

var marker = new google.maps.Marker({
position: myLatLng,
map: map,
});

}

</script> -->
<script type="text/javascript">
function initialize() {
  var name = document.getElementById("pname").value;
  var latlng=$("#latlng").val();
  latlng= latlng.split("?");

  var location = [name, latlng[0], latlng[1]];

  window.map = new google.maps.Map(document.getElementById('map'), {
    mapTypeId: google.maps.MapTypeId.ROADMAP
  });

  var infowindow = new google.maps.InfoWindow();

  var bounds = new google.maps.LatLngBounds();

  // for (i = 0; i < locations.length; i++) {
  //     marker = new google.maps.Marker({
  //         position: new google.maps.LatLng(locations[i][1], locations[i][2]),
  //         map: map
  //     });
  //
  //     bounds.extend(marker.position);
  //
  //     google.maps.event.addListener(marker, 'click', (function (marker, i) {
  //         return function () {
  //             infowindow.setContent(locations[i][0]);
  //             infowindow.open(map, marker);
  //         }
  //     })(marker, i));
  // }
  marker = new google.maps.Marker({
    position: new google.maps.LatLng(location[1], location[2]),
    map: map
  });

  bounds.extend(marker.position);

  google.maps.event.addListener(marker, 'click', (function (marker) {
    return function () {
      infowindow.setContent(location[0]);
      infowindow.open(map, marker);
    }
  })(marker));

  map.fitBounds(bounds);

  var listener = google.maps.event.addListener(map, "idle", function () {
    map.setZoom(18);
    google.maps.event.removeListener(listener);
  });
}

function loadScript() {
  var script = document.createElement('script');
  script.type = 'text/javascript';
  script.src = "http://maps.googleapis.com/maps/api/js?key=AIzaSyD6RsQuot1EGNW89-uIU70htIbLaGy_Gb8&callback=initialize";

  document.body.appendChild(script);
}



$("#myInfo").on('shown.bs.modal', function () {
  map.setZoom( map.getZoom() - 1);
  map.setZoom( map.getZoom() + 1 );
  google.maps.event.trigger(map, 'resize');

});


window.onload = loadScript;

</script>
<!-- <script async defer src="http://maps.googleapis.com/maps/api/js?key=AIzaSyD6RsQuot1EGNW89-uIU70htIbLaGy_Gb8&callback=initMap"></script> -->




</body>

</html>
