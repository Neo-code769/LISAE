<?php

class RegistrationView extends LisaeTemplate {


    public function setBody($content) {

        switch($content) {

            case "registration": include "registrationCollab.html";
            break;

            default: include "registrationCollab.html";
        }
    }

}