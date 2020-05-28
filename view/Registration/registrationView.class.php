<?php

class RegistrationView extends LisaeTemplate {

    public function setBody($content) {

        switch ($content) {

            case "registration": $include = "registrationCollab.php";
            break;

            default: $include = "registrationCollab.php";
        }

    }

}