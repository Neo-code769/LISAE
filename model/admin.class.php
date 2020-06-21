<?php

    class Admin extends Animator {
        
        public function __construct($idUser,$lastname, $firstname, $birthdate, $phoneNumber, $mail, $password)
        {
            parent::__construct($idUser,$lastname, $firstname, $birthdate, $phoneNumber, $mail, $password);

        }
        // Fonction CREATE
        
        public function createTraining() {
            //TODO
        }

        public function createSession() {
            //TODO
        }

        public function createActivity() {
            //TODO
        }

        public function createTheme() {
            //TODO
        }

        // FONCTION CHANGE

        public function changeTraining() {
            //TODO
        }

        public function changeSession() {
            //TODO
        }

        public function changeActivity() {
            //TODO
        }

        public function changeTheme() {
            //TODO
        }

        // Fonction DELETE

        public function deleteTraining() {
            //TODO
        }

        public function deleteSession() {
            //TODO
        }

        public function deleteActivity() {
            //TODO
        }
        public function deleteTheme() {
            //TODO
        }

        // Fonction MAILING

        public function sendMailAnimator() {
            //TODO
        }

        public function get_role(){
            return get_class($this);
        }

    }


?>