<?php

namespace root;

use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

class mail
{
    private $email;
    private $token;

    public function __construct($email, $token)
    {
        require_once (base_path . separator . 'vendor' . separator . 'autoload.php');
        $this->email = $email;
        $this->token = $token;
    }

    public function sendMessage()
    {
        $mail = new PHPMailer;

        try {
            $mail->SMTPDebug = 3;
            $mail->isSMTP();
            $mail->Host = 'smtp.mailtrap.io';
            $mail->SMTPAuth = true;
            $mail->Username = '2d3a8fd5f267af';
            $mail->Password = 'c05b56ef0a416d';
            $mail->SMTPSecure = 'tls';
            $mail->Port = 2525;

            $mail->From = 'admin@custommvc.local';
            $mail->addAddress($this->email, 'Sajid');
            $mail->isHTML(true);
            $mail->Subject = 'Please verify your email';
            $mail->Body = 'For verify your email please click <a href="http://custommvc.local/verify?token='. $this->token .'" >there</a>';
            $mail->send();

        } catch (Exception $e) {
            echo 'Message could not be sent.';
            echo 'Mailer error: ' . $mail->ErrorInfo;
        }
    }
}