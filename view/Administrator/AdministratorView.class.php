<?php

class AnimatorView extends LisaeTemplateConnected {

    public function __construct()
    {
        parent::__construct();
    } 

    public function setBody($content) {

        switch ($content) {

            // TODO switch case

            default: $include = "dashboardAdministrator.php";

        }
    }
}   

?>