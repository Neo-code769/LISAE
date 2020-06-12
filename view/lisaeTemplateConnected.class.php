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
                            <button class="btn-hover color-1"><a style="text-decoration: none; color: white; font-size: 22px;" href="./dashboard">Tableau de Bord</a></button>
                            <button class="btn-hover color-1"><a style="text-decoration: none; color: white; font-size: 22px;" href="../collab/eloce">Calendrier ELOCE</a></button>
                            <button class="btn-hover color-1"><a style="text-decoration: none; color: white; font-size: 22px;" href="../collab/softskill">Soft Skills</a></button>
                            <button class="btn-hover color-1"><a style="text-decoration: none; color: white; font-size: 22px;" href="../collab/jobcible">Job Cible</a></button>
                            <button class="btn-hover color-1"><a style="text-decoration: none; color: white; font-size: 22px;" href="../collab/info">Mon Compte</a></button>
                            <button class="btn-hover color-1"><a style="text-decoration: none; color: white; font-size: 22px;" href="../password/logout">Déconnection</a></button>
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