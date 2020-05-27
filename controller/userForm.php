<?php

class UserForm{

    private $_pass;


    public function __construct($params)
    {
        $this->_pass = $params["pass"];
        $this->checkValues();
    }

    private function checkValues()
    {
        throw new ExceptionLisae("");
        //new Collaborator();
    }
}