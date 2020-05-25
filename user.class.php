<?php

    class User {
        $_lastname;
        $_firstname;
        $_birthdate;
        $_phoneNumber;
        $_mail;
        $_password;

        public function __construct($lastname, $firstname, $birthdate, $phoneNumber, $mail, $password) {
            $this->_lastname = $lastname;
            $this->_firstname = $firstname;
            $this->_birthdate = $birthdate;
            $this->_phoneNumber = $phoneNumber;
            $this->_mail = $mail;
            $this->_password = $password;
        }

        public function getAllActivity() {
            //TODO
        }

        public function getListActivity() {
            // TODO
        }

    }

?>