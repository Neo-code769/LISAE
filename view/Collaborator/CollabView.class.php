<?php

class CollabView extends LisaeTemplate {

    public function run($content) {
        $this->setHeader();
        $this->setBody($content);
        $this->setFooter();
    }

    public function setBody($content) {

        switch ($content) {

            case "dashboard": include "dashboard.php";
            break;

            case "infoActivity": include "infoActivity.php";
            break;

            case "topics": include "topicsActivity.php";
            break;

            case "registration": include "registrationActivity.php";

            default: include "dashboard.php";

        }
    }
}   

?>