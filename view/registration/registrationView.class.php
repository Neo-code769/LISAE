<?php

class RegistrationView extends LisaeTemplate {


    public function setBody($content) {

        switch($content) {

            case "registration": include "registrationCollab.phtml";
            break;

            default: include "registrationCollab.phtml";
        }
    }

}