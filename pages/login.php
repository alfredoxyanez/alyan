<?php
require 'db.php';
session_start();
/* User login process, checks if user exists and password is correct */

// Escape email to protect against SQL injections
$email = mysqli_real_escape_string($mysqli,$_POST['email']);
$sql="SELECT * FROM users WHERE email='$email'";
$result=mysqli_query($mysqli,$sql) or die('Query failed: '. mysqli_error($mysqli));

if ( mysqli_num_rows($result) == 0 ){ // User doesn't exist
    $_SESSION['message'] = "User with that email doesn't exist!";
    header("location: error.php");
}
else { // User exists
    $user = mysqli_fetch_assoc($result);

    if ( password_verify($_POST['password'], $user['password']) ) {

        $_SESSION['email'] = $user['email'];
        $_SESSION['first_name'] = $user['name'];
        $_SESSION['last_name'] = $user['lastname'];
        $_SESSION['active'] = $user['active'];
        $_SESSION['admin'] = $user['admin'];

        // This is how we'll know the user is logged in
        $_SESSION['logged_in'] = true;

        header("location: tables.php");
    }
    else {
        $_SESSION['message'] = "You have entered wrong password, try again!";
        header("location: error.php");
    }
}

mysqli_close($mysqli);
?>
