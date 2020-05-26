<?php

    abstract class User {

        private $_lastname;
        private $_firstname;
        private $_birthdate;
        private $_phoneNumber;
        private $_mail;
        private $_password;

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

        public function get_lastname()
        {
                return $this->_lastname;
        }

        public function set_lastname($_lastname)
        {
                $this->_lastname = $_lastname;

                return $this;
        }

        public function get_firstname()
        {
                return $this->_firstname;
        }

        public function set_firstname($_firstname)
        {
                $this->_firstname = $_firstname;

                return $this;
        }

        public function get_birthdate()
        {
                return $this->_birthdate;
        }

        public function set_birthdate($_birthdate)
        {
                $this->_birthdate = $_birthdate;

                return $this;
        }

        public function get_phoneNumber()
        {
                return $this->_phoneNumber;
        }

        public function set_phoneNumber($_phoneNumber)
        {
                $this->_phoneNumber = $_phoneNumber;

                return $this;
        }

        public function get_mail()
        {
                return $this->_mail;
        }

        public function set_mail($_mail)
        {
                $this->_mail = $_mail;

                return $this;
        }

        public function get_password()
        {
                return $this->_password;
        }

        public function set_password($_password)
        {
                $this->_password = $_password;

                return $this;
        }

        abstract public function get_role();
    }

?>