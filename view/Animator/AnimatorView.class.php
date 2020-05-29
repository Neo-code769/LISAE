<?php

class AnimatorView extends LisaeTemplate {


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