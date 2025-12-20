<?php
Class Posta{
	public function __construct($ime, $priimek, $email) {
$to = "<jiri.hollan@gmail.com>";
//$to .= ", <hocimin68@gmail.com>";
$subject = "obvestilo anestiz";
$from = 'noreply@sender.com';
//$from = '<anestiz@sh17.neoserv.si>';
$message = "<br>Nov uporabnik: ".$ime." ". $priimek;
$headers[] = "From: " .($from);
//$headers[] = "To: " .($to);
//$headers[] = "CC: somebodyelse@example.com";
$headers[] = "Reply-To: ".($email);
$headers[] = "Return-Path: ".($from);
$headers[] = "MIME-Version: 1.0"; 
$headers[] = "Content-Type: text/html; charset=ISO-8859-1";
$headers[] = "X-Priority: 3";
$headers[] = "X-Mailer: PHP". phpversion();
$retval = mail($to,$subject,$message,implode("\r\n", $headers));
//$retval = mail($to,$subject,$message,$headers);
         
         if( $retval == true ) {
            echo "Obvestilo poslano adminu...";
         }else {
            echo "Message could not be sent...";
         }
	}//od construct
}//od class posta
?>