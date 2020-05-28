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
        $this->_password = $params["password"];
        $this->_firstname = $params["firstname"];
        $this->_lastname = $params["lastname"];
        $this->_birthdate = $params["birthdate"];
        $this->_phoneNumber = $params["phoneNumber"];
        $this->_mail = $params["mail"];
        $this->_password2 = $params["password2"];

        
    }

    private function checkValues()
    {
        throw new LisaeException("");
        //new Collaborator();
        if (($_POST["password"]) == ($_POST["password2"]))
        {
            if ()
        }
    }

    public function createCollaborator()
    {
        $this->checkValues();
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