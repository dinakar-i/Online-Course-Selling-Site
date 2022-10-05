<?php 
class Mail{
    public static function send_mail($toaddress,$subject,$Msg){
    $mailto = $toaddress;
    $mailSub = $subject;
    $mailMsg = $Msg;
   require 'PHPMailer-master/PHPMailerAutoload.php';
   $mail = new PHPMailer();
   $mail ->IsSmtp();
   $mail ->SMTPDebug = 0;
   $mail ->SMTPAuth = true;
   $mail ->SMTPSecure = 'ssl';
   $mail ->Host = "smtp.hostinger.in";
   $mail ->Port = 465; // or 587
   $mail ->IsHTML(true);
   $mail ->Username = "info-account@spoofcolors.com";
   $mail ->Password = "*y&mG*E4J";
   $mail ->SetFrom("info-account@spoofcolors.com");
   $mail ->Subject = $mailSub;
   $mail ->Body = $mailMsg;
   $mail ->AddAddress($mailto);

   if(!$mail->Send())
   {
       return "Mail Not Sent";
   }
   else
   {
       return "Mail Sent";
   }

    }
}