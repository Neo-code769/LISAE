<?php

class ExceptionLisae extends Exception{

    private $_mess;
    private $_gravity;

    public function __construct($mess, $gravity=0)
    {
        $this->_mess = $mess;
        $this->_gravity = $gravity;
    }

    public function render(){
        var_dump($this->_mess,$this->_gravity);
    }

}