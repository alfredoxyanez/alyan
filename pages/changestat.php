<?php
require_once "json.php";
$parkdbname = mysqli_real_escape_string($mysqli,$_POST['parkdbname']);
$valveid = mysqli_real_escape_string($mysqli,$_POST['valveid']);

changevstatus($valveid,$parkdbname);



 ?>
