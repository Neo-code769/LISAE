<?php

class UserForm{

    private $_lastname;
    private $_firstname;
    private $_birthdate;
    private $_phoneNumber;
    private $_mail;
    private $_password;
    private $_password2;


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

    public function createCollab()
    {
        $collab = null;
        if ($this->checkPassword() && $this->checkMail() ) {
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
}