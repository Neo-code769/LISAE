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
        $this->_password = htmlentities($params["password"]);
        $this->_firstname = htmlentities($params["firstname"]);
        $this->_lastname = htmlentities($params["lastname"]);
        $this->_birthdate = htmlentities($params["birthdate"]);
        $this->_phoneNumber = htmlentities($params["phoneNumber"]);
        $this->_mail = htmlentities($params["mail"]);
        $this->_password2 = htmlentities($params["password2"]);    
    }

    private function checkPassword()
    {
        $passwordOk = false;
        throw new LisaeException("");
        //new Collaborator();
        if (($_POST["password"]) == ($_POST["password2"]))
        {
            $passwordOk = true;
        } else {
            echo '<script type="text/javascript">window.alert("les mots de passe doivent etre identiques !");</script>';
        }
        return $passwordOk;
    }
    private function checkMail()
    {
        $mailOk = false;
        if ((new UserDao())->getMail($this->_mail) == 0)
        {
            $mailOk = true;
        } else {
            echo '<script type="text/javascript">window.alert("mails déjà utilisé!");</script>';
        }
        return $mailOk;
    }

    public function createCollaborator()
    {
        $this->checkPassword();
        $this->checkMail();
        $t = new Collaborator();
    }

    public function createAnimator()
    {
        $this->checkValues();
    }

    public function createAdministrator()
    {
        $this->checkValues();
    }
}