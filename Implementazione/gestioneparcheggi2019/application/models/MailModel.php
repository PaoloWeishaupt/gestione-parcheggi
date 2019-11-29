<?php

namespace Models;

use Libs\PHPMailer\Exception as Exception;
use Libs\PHPMailer\PHPMailer as PHPMailer;
use Libs\PHPMailer\SMTP as SMTP;

class MailModel
{
    private static $mail;

    public static function newUserMail($newUserMail, $nome, $cognome){
        self::build();
        self::$mail->addAddress($newUserMail, $nome." ".$cognome);
        self::$mail->Subject = "Registrazione effettuata";
        self::$mail->Body = "Il tuo account è stato creato con successo!<br><br>
                             Per poter essere in grado di usare il tuo account clicca sul seguente link per attivarlo:<br>
                             https://samtinfo.ch/gestioneparcheggi2019/register/verify/?mail=".$newUserMail."&nome=".$nome.
                             "&cognome=".$cognome;
        self::$mail->send();
    }

    public static function build()
    {
        self::$mail = new PHPMailer(true);
        self::$mail->isSMTP();
        self::$mail->Host = 'smtp.gmail.com';
        self::$mail->Port = 587;
        self::$mail->SMTPAuth = true;
        self::$mail->Username = 'gestioneparcheggi.samt@gmail.com';
        self::$mail->Password = 'Parcheggi_Admin_2019';
        self::$mail->setFrom('gestioneparcheggi.samt@gmail.com', 'Gestione parcheggi');
    }

}