<?php

class LoginPageView extends LisaeTemplate {

    public function run() {
        $this->setHeader();
        $this->setBody();
        $this->setFooter();
    }

    public function setBody() {

        include 'loginPage.phtml';

    }

}