<?php

    // PHPmailer
        use PHPMailer\PHPMailer\PHPMailer;
        use PHPMailer\PHPMailer\SMTP;
        use PHPMailer\PHPMailer\Exception;

        require 'vendor/phpmailer/phpmailer/src/Exception.php';
        require 'vendor/phpmailer/phpmailer/src/PHPMailer.php';
        require 'vendor/phpmailer/phpmailer/src/SMTP.php';
        require_once 'vendor/autoload.php'; 
        require_once 'vendor/phpmailer/phpmailer/src/PHPMailer.php';

        require_once 'controller/userForm.php';

        $tab = [
            "password" => "Azert001",
            "firstname" => "Trubl",
            "lastname" => "Pierre",
            "birthdate" => "03/04/1992",
            "phoneNumber" => "0652485765",
            "mail" => "pierre.trublereau@gmail.com",
            "password2" => "Azert001",
        ];

        $userForm = new UserForm($tab);
        $userForm->sendMailConfirmation();

    

?>