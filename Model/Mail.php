<?php
require 'vendor/autoload.php';
use Mailgun\Mailgun;
use PHPMailer\PHPMailer;
class Mail
{

    public function sendMail($subject, $message, $email){
        $mail = new PHPMailer\PHPMailer();

         $mail->isSMTP();                                      // Set mailer to use SMTP
        $mail->Host = 'smtp.mailgun.org';                     // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                               // Enable SMTP authentication
        $mail->Username = 'postmaster@email.ternio.io';   // SMTP username
        $mail->Password = 'fd81fdf2772f3ef4640e807704f43ded';                           // SMTP password
        $mail->SMTPSecure = 'tls';                            // Enable encryption, only 'tls' is accepted

        $mail->From = 'postmaster@email.ternio.io';
        $mail->FromName = 'Mailer';
        $mail->addAddress($email);                 // Add a recipient

        $mail->WordWrap = 50;                                 // Set word wrap to 50 characters

        $mail->Subject = $subject;
        $mail->IsHTML(true);
        //$mail->Body    = $message;
        $mail->MsgHTML($message);
        // $mail->send();

        if(!$mail->send()) {
            $mailerResponse = array(
                'message' => $mail->ErrorInfo
            );
        } else {
            $mailerResponse = array(
                'message' => 'success'
            );
        }

        return $mailerResponse;
    }
}