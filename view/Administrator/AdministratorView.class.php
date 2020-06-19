<?php

class AdministratorView extends LisaeTemplateConnected {

    public function __construct()
    {
        parent::__construct();
    } 

    public function setBody($content) {

        switch ($content) {

            case "dashboard": include "dashboard.php";
            break;

            case "createTheme": include "createTheme.phtml";
            break;

            default: include "dashboard.php";

        }
    }
}   

?>