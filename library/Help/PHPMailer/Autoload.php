<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once 'src/Exception.php';
require_once 'src/PHPMailer.php';
require_once 'src/SMTP.php';

/**
 * 
 * @param array $mail_to
 * array $mail_to [array TO, array CC, array BCC]
 * @return boolean
 */
function send_mail(array $mail_to, $mail_name, $mail_subject, $mail_content){
    $mail = new PHPMailer(true);
    $str = new vsc_string();
    $send_mail = "daisan2018.dsc@gmail.com";
    $send_pass = "udluS+hb81TMETnZIiNvjusa6tUrZhWuv/TDktoRtoo=";
    try {
        // Server settings
        $mail->SMTPDebug = 0; // Enable verbose debug output
        $mail->isSMTP(); // Set mailer to use SMTP
        $mail->Host = 'smtp.gmail.com'; // Specify main and backup SMTP servers
        $mail->SMTPSecure = 'ssl'; // Enable TLS encryption, `ssl` also accepted
        $mail->Port = 465; // TCP port to connect to
        $mail->CharSet = 'UTF-8';
        
        $mail->SMTPAuth = true; // Enable SMTP authentication
        $mail->Username = $send_mail; // SMTP username
        $mail->Password = $str->decrypt_string($send_pass);; // SMTP password
        // Recipients
        $mail->setFrom($send_mail, $mail_name);
        if(isset($mail_to['TO']) && count($mail_to['TO'])>0){
            foreach ($mail_to['TO'] AS $item){
                $mail->addAddress($item);
            }
        }
        if(isset($mail_to['CC']) && count($mail_to['CC'])>0){
            foreach ($mail_to['CC'] AS $item){
                $mail->addCC($item);
            }
        }
        if(isset($mail_to['BCC']) && count($mail_to['BCC'])>0){
            foreach ($mail_to['BCC'] AS $item){
                $mail->addBCC($item);
            }
        }
        //$mail->addReplyTo('info@example.com', 'Information');
                                                           
        // Content
        $mail->isHTML(true); // Set email format to HTML
        $mail->Subject = $mail_subject;
        $mail->Body = $mail_content;
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
        
        $mail->send();
        return true;
    } catch (Exception $e) {
        return false;
        //echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
    }
}