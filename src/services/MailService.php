<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
require 'IMessenger.php';
class MailService implements IMessenger
{

    private PHPMailer $mail;

    private const SMTP_HOST = 'smtp.gmail.com';
    private const SMTP_PORT = 587;
    private const SMTP_USER = 'louis.bec05@gmail.com';
    private const SMTP_PASSWORD = 'ulgv ojeb uweu cfhl';
    private const SMTP_FROM_EMAIL = 'louis.bec05@gmail.com';
    private const SMTP_FROM_NAME = 'LOUIS BEC';

    public function __construct()
    {
        $this->mail = new PHPMailer(true);
        $this->configureSMTP();
    }

    private function configureSMTP(): void
    {
        $this->mail->isSMTP();
        $this->mail->Host = self::SMTP_HOST;
        $this->mail->SMTPAuth = true;
        $this->mail->Username = self::SMTP_USER;
        $this->mail->Password = self::SMTP_PASSWORD;
        $this->mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $this->mail->Port = self::SMTP_PORT;
        $this->mail->setFrom(self::SMTP_FROM_EMAIL, self::SMTP_FROM_NAME);
    }

    public function send(string $destinataire, string $body, string $subject): bool
    {
        try {
            $this->mail->addAddress($destinataire);
            $this->mail->isHTML(true);
            $this->mail->Subject = $subject;
            $this->mail->Body = $body;

            return $this->mail->send();
        } catch (Exception $e) {
            error_log("Erreur lors de l'envoi du mail : {$this->mail->ErrorInfo}");
            return false;
        }
    }
    
}
