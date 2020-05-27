<?php

class LisaeException extends Exception{

    const GRAV_ARR= ["warning", "danger"];
    private $_gravity = 0;  // exception gravity
    private $_mess =  "";   // message

    public function __construct (string $mess, int $gravity=0) {
      $this->_mess = "<p style='background-color: red;'>".$mess."</p>";
      $this->_gravity = $gravity;
     }
    public function render() {
      return $this->_mess;
    }

}