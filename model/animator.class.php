<?php

    class Animator extends User {

        public function __construct($idUser,$lastname, $firstname, $birthdate, $phoneNumber, $mail, $password)
        {
            parent::__construct($idUser,$lastname, $firstname, $birthdate, $phoneNumber, $mail, $password);

        }
        public function createSlot() {
            //TODO
        }

        public function deleteSlot() {
            //TODO
        }

        public function changeSlot() {
            //TODO
        }

        public function checkSlot() {
            //TODO
        }

        public function getRegistered() {
            //TODO
        }

        public function generatePresentList() {
            //TODO
        }

        // Fonction MAILING

        public function sendMailAnimator() {
            //TOdO
        }

        public function get_role(){
            return get_class($this);
        }
    }

