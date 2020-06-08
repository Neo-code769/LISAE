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

    public function setHeader($errorMess="") {
        parent::setHeader();
        echo <<<EOD
                <p><a href="../password/logout">Déconnexion</a></p>
                <p><a href="../collab/info">Mon Compte</a></p>
        EOD;
    }

    abstract public function setBody($content);

}