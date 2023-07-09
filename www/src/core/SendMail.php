<?php

namespace App\core;

//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function

use Dotenv\Dotenv;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

//Load Composer's autoloader
//require '../../vendor/autoload.php';

class SendMail
{
    //Create an instance; passing `true` enables exceptions
    public PHPMailer $mail;
    protected array $informations;
    
    public function __construct(array $informations)
    {
        $this->mail = new PHPMailer(true);
        $this->informations = $informations;
    } 

    public function send()
    {
        try {
            //Server settings
            $this->mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
            $this->mail->isSMTP();                                            //Send using SMTP
            $this->mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
            $this->mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $this->mail->Username   = getenv('EMAIL');                     //SMTP username
            $this->mail->Password   = getenv('PASSWORD');                               //SMTP password
            $this->mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
            $this->mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
    
            //Recipients
            $this->mail->setFrom($_ENV['EMAIL']);
            $this->mail->addAddress($this->informations['email']);

            //Content
            $this->mail->isHTML(true);                                  //Set email format to HTML
            $this->mail->Subject = 'No reply';
            $this->mail->Body    = $this->informations['bodyText'] .'<b><a href="' . $this->informations['url'] . $this->informations['token'] . '">"' . $this->informations['url'] . $this->informations['token'] . '"</a></b>';
    
            $this->mail->send();
            echo 'Message has been sent';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$this->mail->ErrorInfo}";
        }
    }
}