<?php

class UserForm{

    private $_lastname;
    private $_firstname;
    private $_birthdate;
    private $_phoneNumber;
    private $_mail;
    private $_password;
    private $_password2;
    private $_validateAccount;


    public function __construct($params)
    {
        $this->_password = sha1($params["password"]);
        $this->_firstname = htmlentities($params["firstname"]);
        $this->_lastname = htmlentities($params["lastname"]);
        $this->_birthdate = htmlentities($params["birthdate"]);
        $this->_phoneNumber = htmlentities($params["phoneNumber"]);
        $this->_mail = htmlentities($params["mail"]);
        $this->_password2 = sha1($params["password2"]);

    }

    // Verification de la concordance des mots de passe //
    private function checkPassword()
    {
        $passwordOk = false;
        if ($this->_password == $this->_password2)
        {
            $passwordOk = true;
        }
        return $passwordOk;
    }
    
    // Verification de l'inexistance d'un compte similaire mail existant //
    private function checkMail()
    {
        $mailOk = false;

        $userDao = new UserDao();
        $tab = $userDao->getMail($this->_mail);
        if ($tab['exist'] == 0)
        {
            //var_dump($tab['exist']);
            $mailOk = true;
        }
        return $mailOk;
    }

    // Verification de la confirmation du compte mail //
    private function checkConfirmation()
    {
        $confirmMail = false;
        $confirmOK = false
        
        $userDao = new UserDao();
        $result = $userDao->getConfirmationMail();
            if ($result = true) 
            {
                $_confirmMail = true;
                return $confirmMail;
            }else {
                echo 'Veuillez confirmer votre adresse e-mail! <a>' . $this->sendMailConfirmation(); . 'Cliquez sur ce lien pour renvoyer un e-mail de confirmation </a>';
            }
    }

    /////// Verification e-mail PHPMailer /////////
    private function sendMailConfirmation() 
    {
        $mail= new PHPMailer();
 
        $mail->isSMTP(); // Paramétrer le Mailer pour utiliser SMTP 
        $mail->Host = 'smtp.gmail.com'; // Spécifier le serveur SMTP
        $mail->SMTPAuth = true; // Activer authentication SMTP
        $mail->Username = 'contact.afpa.lisae@gmail.com'; // Votre adresse email d'envoi
        $mail->Password = 'AR3n96f4aQ'; // Le mot de passe de cette adresse email
        $mail->SMTPSecure = 'ssl'; // Accepter SSL
        $mail->Port = 465; 

        $mail->setFrom('contact.afpa.lisae@gmail.com', 'AFPA LISAE');
        $mail->addAddress('pierre.trublereau@gmail.com', 'Pierre Trublereau'); /****** TODO: Personnaliser l'adresse d'envoi **********/
        $mail->addReplyTo('contact.afpa.lisae@gmail.com', 'Information'); // L'adresse de réponse
        $mail->Subject = 'Confirmation de votre Mail - AFPA-LISAE';
        $mail->Body = 'Veuillez confirmer votre adresse en mail en cliquant sur ce lien: <br>
        <a href="http://www.lisae.fr/confirm-registration"> Cliquer ici pour confirmer votre mail ! </a>'; // Creation page: "LISAE/registration/confirm-registration"
        $mail->isHTML(true);
        $mail->setLanguage('fr');

        if ($mail->send()) {
            echo 'Confirmation Message has been sent.';
        }else {
            echo 'Message was not sent.<br>';
            echo 'Mailer error: ' . $mail->ErrorInfo; 
        }
    }

    ///////// Creation Collaborateur /////////////
    public function createCollab()
    {
        $collab = null;

        if ($this->checkPassword() && $this->checkMail()) {
            $collab = new Collaborator($this->_lastname,$this->_firstname,$this->_birthdate,$this->_phoneNumber,$this->_mail,$this->_password);
            $this->sendMailConfirmation();  // Envoi du mail de confirmation
        }elseif($this->checkPassword() == false){
            throw new LisaeException("Erreur, les mots de passe ne correspondent pas !");
        }elseif($this->checkMail() == false){
            throw new LisaeException("Erreur, le mail est déjà utilisé !");
        }else {
            throw new LisaeException("Erreur, les mots de passe ne correspondent pas et/ou le mail est déjà utilisé !");
        }   
        return $collab;
    }

    ///////// Creation Animateur /////////////
    public function createAnimator()
        {
            $anim = null;
            if ($this->checkPassword() && $this->checkMail() ) {
                $anim = new Animator($this->_lastname,$this->_firstname,$this->_birthdate,$this->_phoneNumber,$this->_mail,$this->_password);
            }elseif($this->checkPassword() == false){
                throw new LisaeException("Erreur, les mots de passe ne correspondent pas !");
            }elseif($this->checkMail() == false){
                throw new LisaeException("Erreur, le mail est déjà utilisé !");
            }else {
                throw new LisaeException("Erreur, les mots de passe ne correspondent pas et/ou le mail est déjà utilisé !");
            }   
            return $anim;
        }

    ///////// Creation Administrateur /////////////
    public function createAdministrator()
    {
        $admin = null;
        if ($this->checkPassword() && $this->checkMail() ) {
            $admin = new Admin($this->_lastname,$this->_firstname,$this->_birthdate,$this->_phoneNumber,$this->_mail,$this->_password);
        }elseif($this->checkPassword() == false){
            throw new LisaeException("Erreur, les mots de passe ne correspondent pas !");
        }elseif($this->checkMail() == false){
            throw new LisaeException("Erreur, le mail est déjà utilisé !");
        }else {
            throw new LisaeException("Erreur, les mots de passe ne correspondent pas et/ou le mail est déjà utilisé !");
        }   
        return $admin;
    }

}