<?php

require_once 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;


    class Email
    {

        private $mailer;

        public function __construct($host,$username,$senha,$name)
        {

            $this->mailer = new PHPMailer;
            $this->mailer->isSMTP();
            $this->mailer->SMTPDebug = 0;
            $this->mailer->Host = $host;             //smtp.hostinger.com
            $this->mailer->Port = 587;
            $this->mailer->SMTPAuth = true;
            $this->mailer->Username = $username;      //exemplo@cursospoderfeminino.com
            $this->mailer->Password = $senha;         //Jaca1000$
            $this->mailer->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $this->mailer->setFrom($username,$name);   //exemplo@cursospoderfeminino.com
            $this->mailer->CharSet = 'UTF-8';
            

        }

        public function addAddress($email,$nome){
            $this->mailer->addAddress($email,$nome);
        }

        public function formatarEmail($info){
            $this->mailer->Subject = $info['assunto'];
            $this->mailer->Body = $info['corpo'];
            $this->mailer->isHTML(true); 
            //$this->mailer->altBody = strip_tags($info['assunto']);
            //$mail->addAttachment('test.txt');
        }

        public function enviarEmail(){
            if($this->mailer->send()){
                return true;
            }else{
                return false;
            }
        }
    };


?>


 