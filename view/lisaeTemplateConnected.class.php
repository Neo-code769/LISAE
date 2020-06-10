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
                    <div id="log">
                        <div id="link"><a href="./dashboard" style="text-decoration:none">Tableau de Bord</a></div>
                        <div id="link"><a href="../collab/eloce" style="text-decoration:none">Calendrier ELOCE</a></div>
                        <!--<div id="link"><a href="../collab/conference" style="text-decoration:none">Conférence</a></div> -->
                        <div id="link"><a href="../collab/softskill" style="text-decoration:none">Soft Skills</a></div>
                        <div id="link"><a href="../collab/jobcible" style="text-decoration:none">Job Cible 2.0</a></div>
                        <div id="link"><a href="../collab/info" style="text-decoration:none">Mon Compte</a></div>
                        <div id="link"><a href="../password/logout" style="text-decoration:none">Déconnexion</a></div>
                    </div>
                </div>
            </header>
            <div id="margin"></div>
            <body>
            EOD;
        echo "<p>".$errorMess."</p>";
    }

    abstract public function setBody($content);

}