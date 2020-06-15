<?php

class AnimatorView extends LisaeTemplateConnected {

    public function __construct()
    {
        parent::__construct();
    } 

    public function setBody($content) {

        switch ($content) {

            case "dashboard": include "dashboard.phtml";
            break;

            default: include "dashboard.phtml";

        }
    }
}   

?>