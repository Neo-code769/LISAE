<?php

class AnimatorView extends LisaeTemplate {

    public function run($content) {
        $this->setHeader();
        $this->setBody($content);
        $this->setFooter();
    }

    public function setBody($content) {

        switch ($content) {

            // TODO switch case

            default: $include = "dashboardAdministrator.php";

        }
    }
}   

?>