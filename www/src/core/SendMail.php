<?php

namespace App\core;

//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function

use App\core\Application;
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
    protected string $userMail;
    protected string $code;
    
    public function __construct(string $userMail, string $code)
    {
        $this->mail = new PHPMailer(true);
        $this->userMail = $userMail;
        $this->code = $code;
    }

    public function send()
    {
        $dotenv = Dotenv::createImmutable(dirname("../../"));
        $dotenv->load();

        try {
            //Server settings
            $this->mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
            $this->mail->isSMTP();                                            //Send using SMTP
            $this->mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
            $this->mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $this->mail->Username   = $_ENV['EMAIL'];                     //SMTP username
            $this->mail->Password   = $_ENV['PASSWORD'];                               //SMTP password
            $this->mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
            $this->mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
    
            //Recipients
            $this->mail->setFrom($_ENV['EMAIL']);
            $this->mail->addAddress($this->userMail);

            //Content
            $this->mail->isHTML(true);                                  //Set email format to HTML
            $this->mail->Subject = 'No reply';
            $this->mail->Body    = 'Here is the verification link <b><a href="http://localhost/verify?verification='.$this->code.'">http://localhost/verify?verification='.$this->code.'</a></b>';
    
            $this->mail->send();
            echo 'Message has been sent';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$this->mail->ErrorInfo}";
        }
    }
}