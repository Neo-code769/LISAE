<?php

class CollabView extends LisaeTemplate {

    public function run() {
        $this->setHeader();
        $this->setBody();
        $this->setFooter();
    }

    public function setBody($content) {

        switch ($content) {

            case "dashboard": $include = "dashboard.php";
            break;

            case "infoActivity": $include = "infoActivity.php";
            break;

            case "registration": $include = "registrationActivity.php";
            break;

            case "topics": $include = "topicsActivity.php";

            default: $include = "dashboard.php";

        }
    }
}

?>