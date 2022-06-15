<?php 

require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';

use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\PHPMailer;

    
        date_default_timezone_set('Europe/Paris');
        
        
        //partie à mettre en place avec PHPMailer
        $output ='<!DOCTYPE html>';
        $output .='<html lang="fr"><head><meta charset="UTF-8"><meta http-equiv="X-UA-Compatible" content="IE=edge"><meta name="viewport" content="width=device-width, initial-scale=1.0"><title>Admin MNS</title></head>';
        $output .='<body>';
        $output .='<p></p>';
        $output.='<p></p>';
        $output.='<p></p>';
        $output.='<p></p>';		
        $output.='<p></p>'; 
        $output.='<p></p>';
        $output.='<p></p>';
        $output .='</body>';
        $output .='</html>';
        $body = $output; 
        $subject = "";
        
        $email_to = $email;
        $fromserver = "noreply@"; 
     
        $mail = new PHPMailer(true);
        $mail->CharSet = 'UTF-8';
        $mail->Encoding = 'base64';
        $mail->SMTPDebug = 0;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = '';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = '';                     //SMTP username
        $mail->Password   = '';                               //SMTP password
        $mail->SMTPSecure = 'ssl';            //Enable implicit TLS encryption
        $mail->Port       = 465;
        $mail->IsHTML(true);
        $mail->From = "";
        $mail->FromName = "";
        $mail->Sender = $fromserver; // indicates ReturnPath header
        $mail->Subject = $subject;
        $mail->Body = $body;
        $mail->AddAddress($email_to);
        $mail->send();

        if(!$mail->Send())
        {
            echo "Mailer Error: " . $mail->ErrorInfo;
        }
        else
        {
            $stmtMsg = '<p></p>';
            
        }   








