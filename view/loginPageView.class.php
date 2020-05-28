<?php

class LoginPageView extends LisaeTemplate {

    public function run($content) {
        $this->setHeader();
        $this->setBody($content);
        $this->setFooter();
    }

    public function setBody($content) {

        include "loginPage.php";

    }

}