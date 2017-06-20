<?php
    $to = "fredyyanez39@yahoo.com";
    $subject = "This is subject";

    $message = "<b>This is HTML message.</b>";
    $message .= "<h1>This is headline.</h1>";

    $header = "From:alyantech@gmail.com \r\n";
    $header .= "Content-type: text/html\r\n";

    $retval = mail ($to,$subject,$message,$header);

    if( $retval == true ) {
       echo "Message sent successfully...";
    }else {
       echo "Message could not be sent...";
    }
 ?>
