<?php
$to = "<jiri.hollan@gmail.com>";
//$to .= ", <hocimin68@gmail.com>";
$subject = "obvestilo anestiz";
$from = '<noreply@sender.com>';
$message = "Nov uporabnik";
$headers[] = "From: " .($from);
$headers[] = $to;
//$headers[] = "CC: somebodyelse@example.com";
$headers[] = "Reply-To: ".($from);
$headers[] = "Return-Path: ".($from);
$headers[] = "MIME-Version: 1.0"; 
$headers[] = "Content-Type: text/html";
$headers[] = "charset=ISO-8859-1";
$headers[] = "X-Priority: 3";
$headers[] = "X-Mailer: PHP". phpversion();
//$retval = mail($to,$subject,$message,implode("\r\n", $headers));
$retval = mail($to,$subject,$message,$headers);
         
         if( $retval == true ) {
            echo "Obvestilo poslano adminu...";
         }else {
            echo "Message could not be sent...";
         }

?>