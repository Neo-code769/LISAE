<?php

class AnimatorView extends LisaeTemplateConnected {

    public function __construct()
    {
        parent::__construct();
    } 

    public function setBody($content) {

        switch ($content) {

            case "dashboard": $include = "dashboardAnimateur.php";
            break;

            case "manage": $include = "manageActivity.php";
            break;

            case "createActivity": $include = "createActivity.php";
            break;

            case "review": $include = "reviewActivity.php";
            break;

            case "details": $include = "detailsActivity.php";

            default: $include = "dashboardAnimateur.php";

        }
    }
}   

?>