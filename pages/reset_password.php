<?php
/* Password reset process, updates database with new user password */
require 'db.php';
session_start();

// Make sure the form is being submitted with method="post"
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Make sure the two passwords match
    if ( $_POST['newpassword'] == $_POST['cpassword'] ) {

        $new_password = password_hash($_POST['newpassword'], PASSWORD_BCRYPT);
        $new_password=mysqli_real_escape_string($mysqli,$new_password);

        $email = mysqli_real_escape_string($mysqli,$_POST['email']);
        $hash = mysqli_real_escape_string($mysqli,$_POST['hash']);

        $sql = "UPDATE users SET password='$new_password', hash='$hash' WHERE email='$email'";
        $result= mysqli_query($mysqli,$sql) or die('Query failed: '. mysqli_error($mysqli));

        if ( $result ) {

        $_SESSION['message'] = "Your password has been reset successfully!";
        header("location: success.php");

        }

    }
    else {
        $_SESSION['message'] = "Two passwords you entered don't match, try again!";
        header("location: error.php");
    }

}
?>
