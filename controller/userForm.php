<?php

class UserForm{

    private $_lastname;
    private $_firstname;
    private $_birthdate;
    private $_phoneNumber;
    private $_mail;
    private $_password;
    private $_password2;
    private $_collab=null;


    public function __construct($params)
    {
        $this->_password = sha1($params["password"]);
        $this->_firstname = htmlentities($params["firstname"]);
        $this->_lastname = htmlentities($params["lastname"]);
        $this->_birthdate = htmlentities($params["birthdate"]);
        $this->_phoneNumber = htmlentities($params["phoneNumber"]);
        $this->_mail = htmlentities($params["mail"]);
        $this->_password2 = sha1($params["password2"]);

        if ($this->checkPassword() && $this->checkMail() ) {
            $this->_collab = new Collaborator($this->_lastname,$this->_firstname,$this->_birthdate,$this->_phoneNumber,$this->_mail,$this->_password);
        }elseif($this->checkPassword() == false){
            throw new LisaeException("Erreur, les mots de passe ne correspondent pas !");
        }elseif($this->checkMail() == false){
            throw new LisaeException("Erreur, le mail est déjà utilisé !");
        }else {
            throw new LisaeException("Erreur, les mots de passe ne correspondent pas et/ou le mail est déjà utilisé !");
        }
    }

    private function checkPassword()
    {
        $passwordOk = false;
        if ($this->_password == $this->_password2)
        {
            $passwordOk = true;
        }
        return $passwordOk;
    }
    
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

    public function createAnimator()
    {

    }

    public function createAdministrator()
    {
    }

    /**
     * Get the value of _collab
     */ 
    public function getCollab()
    {
        return $this->_collab;
    }
}