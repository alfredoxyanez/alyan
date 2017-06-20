<?php
require 'db.php';
session_start();
 ?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Bootstrap Admin Theme</title>

    <!-- Bootstrap Core CSS -->
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

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

<?php
if($_SERVER["REQUEST_METHOD"]=='POST'){
  if(isset($POST['login'])){
    echo "login";
    require 'login.php';
  }
  elseif (isset($POST['resgister'])) {
    echo "register";
    require 'register.php';
  }

}
 ?>


<body>
  <div class="container">
    <div class="row">
      <div class="col-md-4 col-md-offset-4">
        <div class="login-panel panel panel-default">
          <ul class="nav nav-tabs">
            <li class="active">
              <a href="#1" data-toggle="tab">Log In</a>
            </li>
            <li>
              <a href="#2" data-toggle="tab">Sign Up</a>
            </li>

          </ul>
          <div class="tab-content">
            <div class="tab-pane active" id="1">
              <div class="panel-body">
                <form role="form" action="index.php" method="post">
                    <fieldset>
                        <div class="form-group">
                            <input class="form-control req" placeholder="E-mail" name="email" type="email" autofocus>
                        </div>
                        <div class="form-group">
                            <input class="form-control req" placeholder="Password" name="password" type="password" value="">
                        </div>

                        <div class="checkbox">
                            <label>
                                <input name="remember" type="checkbox" value="Remember Me">Remember Me
                            </label>
                        </div>
                        <button name="login"  class="btn btn-lg btn-success btn-block">Login</button>

                    </fieldset>
                </form>
              </div>


            </div>

            <div class="tab-pane" id="2">
              <div class="panel-body">
                  <form role="form"  action="register.php" method="post">
                      <fieldset>
                          <div class="form-group">
                              <input class="form-control" placeholder="Name" name="name" type="text" autofocus>
                          </div>
                          <div class="form-group">
                              <input class="form-control" placeholder="Last Name" name="lastname" type="text" >
                          </div>
                          <div class="form-group">
                              <input class="form-control" placeholder="E-mail" name="email" type="email" >
                          </div>
                          <div class="form-group">
                              <input class="form-control" placeholder="Password" name="password" type="password" value="">
                          </div>
                          <div class="form-group">
                              <input class="form-control" placeholder="Confirm Password" name="c_password" type="password" value="">
                          </div>
                          <div class="form-group">
                              <input class="form-control" placeholder="Code (if Aplicable)" name="code" type="text" >
                          </div>

                          <button name="register" type="submit" class="btn btn-lg btn-primary btn-block">Create Account</button>

                          </div>
                      </fieldset>
                  </form>
              </div>

            </div>

          </div>



        </div>



      </div>

    </div>


    </div>

  </div>


    <!-- jQuery -->
    <script src="../vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../vendor/metisMenu/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>

</body>

</html>
