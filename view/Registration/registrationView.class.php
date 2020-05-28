<?php

class RegistrationView extends LisaeTemplate {

    public function run() {
        $this->setHeader();
        $this->setBody();
        $this->setFooter();
    }

    public function setBody() {

        include 'registrationCollab.phtml';

    }

}