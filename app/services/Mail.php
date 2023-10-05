<?php

namespace App\services;

use App\modules\database\ConfigLoader;
use PHPMailer\PHPMailer\PHPMailer;

class Mail
{
    protected $mailer;
    public function __construct()
    {
        $this->mailer = new PHPMailer(true);
        $this->config();
    }
    protected function config()
    {
        $config = ConfigLoader::loadSMTPConfig();

        $this->mailer->isSMTP();
        $this->mailer->SMTPAuth = $config['SMTPAuth'];
        $this->mailer->Host = $config['host'];
        $this->mailer->Username = $config['username'];
        $this->mailer->Password = $config['password'];
        $this->mailer->SMTPSecure = $config['SMTPSecure'];
        $this->mailer->Port = $config['port'];
        $this->mailer->setFrom($config['sendersMail'], $config['sendersName']);
        $this->mailer->addAddress($config['recipientsMail']);
    }

    public function send($subject, $name, $surname)
    {
            $this->mailer->isHTML(true);
            $this->mailer->Subject = $subject;
            $this->mailer->Body = 'Новое сообщение от ' . $name . ' ' . $surname;
            $this->mailer->send();
            return true;
    }
}