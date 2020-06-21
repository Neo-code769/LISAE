<?php

    class Collaborator extends User {

        private $_training;

        public function __construct($idUser,$lastname, $firstname, $birthdate, $phoneNumber, $mail, $password,$training=null)
        {
            parent::__construct($idUser,$lastname, $firstname, $birthdate, $phoneNumber, $mail, $password);
            $this->_training=$training;
        }

        public function get_role(){
            return get_class($this);
        }
    }

?>