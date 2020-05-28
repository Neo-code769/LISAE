<?php

class RegistrationView extends LisaeTemplate {

    public function run() {
        $this->setHeader();
        $this->setBody($content);
        $this->setFooter();
    }

    public function setBody($content) {

        switch($content) {

            case "registration": $include = "registrationCollab.php";
            break;

            default: $include = "registrationCollab.php";
        }
    }

    public function setBodyContent() {

    }

}