<?php
abstract class LisaeTemplateConnected extends LisaeTemplate {

    public function __construct() {
        if(!ISSET($_SESSION['id_user']))
        {
            echo "Erreur, vous ne pouvez pas accéder a cette page, veuillez vous connecter d'abord !";
            header('Refresh:2;url=../../index.php');
            exit();
        }
    }

    public function setHeader($errorMess) {
        echo <<<EOD
            <header>
                <div id="headerIMG">
                    <img src="/images/LISAE.png" alt="logo LISAE" />
                        <div class="buttons">
                            <a href="./dashboard"><button class="btn-hover color-1" style="text-decoration: none; color: black; font-size: 24px;">Tableau de Bord</button></a>
                            <a href="../collab/eloce"><button class="btn-hover color-1" style="text-decoration: none; color: black; font-size: 24px;"> Calendrier ELOCE</button></a>
                            <a href="../collab/softskill"><button class="btn-hover color-1" style="text-decoration: none; color: black; font-size: 24px;">Atelier Soft Skills</button></a>
                            <a href="../collab/jobcible"><button class="btn-hover color-1" style="text-decoration: none; color: black; font-size: 24px;">Atelier Job Cible</button></a>
                            <a href="../collab/info"><button class="btn-hover color-1" style="text-decoration: none; color: black; font-size: 24px;">Mon Compte</button></a>
                            <a href="../password/logout"><button class="btn-hover color-1" style="text-decoration: none; color: black; font-size: 24px;">Deconnection</button></a>
                        </div>
                </div>
                <div class="lifeline"></div>
            </header>
            <div id="margin"></div>
            <body>
            EOD;
        echo "<p>".$errorMess."</p>";
    }

    abstract public function setBody($content);

}