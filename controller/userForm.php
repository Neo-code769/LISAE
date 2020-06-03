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

    /////// Verification e-mail PHPMailer /////////
    public function sendMailConfirmation() 
    {
        try{
            $user_activation_hash = sha1(uniqid(mt_rand(), true)); //creating ramdom string
            $mail= new PHPMailer\PHPMailer\PHPMailer();

            $mail->isSMTP(); // Paramétrer le Mailer pour utiliser SMTP 
            $mail->Host = 'smtp.gmail.com'; // Spécifier le serveur SMTP
            $mail->SMTPAuth = true; // Activer authentication SMTP
            $mail->Username = 'contact.afpa.lisae@gmail.com'; // Votre adresse email d'envoi
            $mail->Password = 'AR3n96f4aQ'; // Le mot de passe de cette adresse email
            $mail->SMTPSecure = 'ssl'; // Accepter SSL
            $mail->Port = 465; 

            $mail->setFrom('contact.afpa.lisae@gmail.com', 'AFPA LISAE');
            $mail->addAddress($_POST['mail']);  // Personnaliser l'adresse d'envoi  
            $mail->addReplyTo('contact.afpa.lisae@gmail.com', 'Information'); // L'adresse de réponse
            $mail->Subject = 'Confirmation de votre Mail - AFPA-LISAE';
            $link = "http://www.lisae.fr/view/registration/confirm-registration"; //script".'?verification_code='.urlencode($user_activation_hash); // verification code exemple
            $mail->Body = "Veuillez confirmer votre adresse en mail en cliquant sur ce lien:<br><br>". ' '.$link; // Creation page: "LISAE/registration/confirm-registration"
            $mail->isHTML(true);
            $mail->setLanguage('fr');

            if ($mail->send()) {
                echo 'Confirmation Message has been sent.';
            }else {
                echo 'Message was not sent.<br>';
                echo 'Mailer error: ' . $mail->ErrorInfo; 
            }

        } catch (Exception $e) {
            var_dump($e->getLine());
            throw new LisaeException("ERROR" . $e->getLine());
        }
    }

    ///////// Creation Collaborateur /////////////
    public function createCollab()
    {
        $collab = null;

        if ($this->checkPassword() && $this->checkMail()) {
            $collab = new Collaborator($this->_lastname,$this->_firstname,$this->_birthdate,$this->_phoneNumber,$this->_mail,$this->_password);
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