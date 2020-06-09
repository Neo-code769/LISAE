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

    public function setHeader() {
        echo <<<EOD
            <header>
                <div id="headerIMG">
                    <figure>
                        <img src="/images/header-logo.png" alt="logo AFPA-ELOCE" />
                        <img src="/images/LISAE.png" alt="logo LISAE" />
                    </figure>
                </div>
                    <div id="log">
                        <div id="link"><a href="./dashboard">Dashboard</a></div>
                        <div id="link"><a href="../collab/info">Mon Compte</a></div>
                        <div id="link"><a href="../password/logout">Déconnexion</a></div>
                    </div>
                <figure>
                    <img src="/images/Life-line.png" alt="Ligne de Vie" />
                </figure>
            </header>
            <body>
            EOD;
    }

    abstract public function setBody($content);

}