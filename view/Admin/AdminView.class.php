<?php

class AdminView extends LisaeTemplateConnected {

    public function __construct()
    {
        parent::__construct();
    } 

    public function setHeader($errorMess) {
        if ($_SESSION['role']!='Admin') {
            echo "Vous ne pouvez pas accéder a cette page !";
            header("Refresh:2;url=http://www.lisae.fr:8081/index.php");
        }
        echo <<<EOD
            <header>
                <div id="headerIMG">
                    <img src="/images/LISAE.png" alt="logo LISAE" />
                        <div class="buttons">
                            <a href="../admin/createTheme"><button class="btn-hover color-1" style="text-decoration: none; color: black; font-size: 24px;">Créer un Thème</button></a>
                            <a href="../admin/createActivity"><button class="btn-hover color-1" style="text-decoration: none; color: black; font-size: 24px;">Créer une Activité</button></a>
                            <a href="../anim/dashboard"><button class="btn-hover color-1" style="text-decoration: none; color: black; font-size: 24px;">Sortir de la console</button></a>
                            <a href="../password/logout"><button class="btn-hover color-1" style="text-decoration: none; color: black; font-size: 24px;">Deconnexion</button></a>
                        </div>
                </div>
                <div class="lifeline"></div>
            </header>
            <div id="margin"></div>
            <body id="admin">
            EOD;
        echo "<p>".$errorMess."</p>";
    }

    public function setBody($content) {

        switch ($content) {

            case "dashboard": include "dashboard.php";
            break;

            case "createTheme": include "createTheme.phtml";
            break;

            case "createActivity": include "createActivity.phtml";
            break;

            default: include "dashboard.php";

        }
    }
}   

?>