<?php
session_start();
require 'db.php';


if (!$mysqli) {
  //echo "Failed to connect to MySQL: " . mysqli_connect_error();
}else {
  //echo "connected";
}
$password1= $_POST['password'];
$password2= $_POST['c_password'];
$fname = $_POST['name'];
$lname = $_POST['lastname'];
$email = $_POST['email'];

if(strcmp($password1,$password2)!=0){
  $_SESSION['message'] = "Passwords do not match";
  header("location: error.php");
  exit;
}
else if (preg_match('/\s/',$password1)){
  $_SESSION['message'] = "Invalid password";
  header("location: error.php");
  exit;
}
else if( strlen($password1)<5 ){
  $_SESSION['message'] = "Password is too short";
  header("location: error.php");
  exit;
}


else{
  include "Mail.php";
  $_SESSION['email'] = $_POST['email'];
  $_SESSION['first_name'] = $_POST['name'];
  $_SESSION['last_name'] = $_POST['lastname'];
  $code = preg_replace('/\s+/', '', $_POST['code']);

  $firstname = mysqli_real_escape_string($mysqli,$_POST['name']);
  $lastname = mysqli_real_escape_string($mysqli,$_POST['lastname']);
  $email = mysqli_real_escape_string($mysqli,$_POST['email']);
  $password = mysqli_real_escape_string($mysqli,password_hash($_POST['password'], PASSWORD_BCRYPT) );
  $hash = mysqli_real_escape_string($mysqli, md5( rand(0,1000) ) );
  $num = 1;

  if($code=="admin92"){
    $ad=1;
  }else{
    $ad=0;
  }


  $sql="SELECT * FROM users WHERE email='$email'";
  $result= mysqli_query($mysqli,$sql) or die('Query failed: '. mysqli_error($mysqli));
  if ( mysqli_num_rows($result)>0) {
      $_SESSION['message'] = 'User with this email already exists!';
  }
  else {
      $sql = "INSERT INTO users (name, lastname, email, password, hash, active, admin) "
              . "VALUES ('$firstname','$lastname','$email','$password', '$hash',DEFAULT,'$ad')";
      $result=mysqli_query($mysqli,$sql) or die('Query failed: '. mysqli_error($mysqli));

      if ($result){

          $_SESSION['active'] = 0; //0 until user activates their account with verify.php
          $_SESSION['logged_in'] = true; // So we know the user has logged in
          $_SESSION['message'] =

                   "Confirmation link has been sent to $email, please verify
                   your account by clicking on the link in the message!";

          // Send registration confirmation link (verify.php)
          $to = $email;
          $subject = 'Account Verification ( alyan.tech )';
          $header = "From:alyantech@gmail.com \r\n";
          $message_body = '
          Hello '.$firstname.',

          Thank you for signing up!

          Please click this link to activate your account:

          http://alyan.tech/pages/verify.php?email='.$email.'&hash='.$hash;

          mail( $to, $subject, $message_body,$header );

          header("location: success.php");
      }

      else {
          $_SESSION['message'] = 'Registration failed!';
          //echo "error";
          header("location: error.php");
      }

  }


}










 ?>
