<?php
abstract class LisaeTemplateDisconnected extends LisaeTemplate {

    public function __construct() {
        if(ISSET($_SESSION['id_user']))
        {
            if ($_SESSION['role']=='Collaborator') {
                echo "Erreur, vous ne pouvez pas accéder a cette page !";
                header('Refresh:2;url=../../index.php/collab/dashboard');
                exit();
            }elseif ($_SESSION['role']=='Animator') {
                echo "Erreur, vous ne pouvez pas accéder a cette page !";
                header('Refresh:2;url=../../index.php/Animator/dashboard');
                exit();
            }elseif ($_SESSION['role']=='Admin') {
                echo "Erreur, vous ne pouvez pas accéder a cette page !";
                header('Refresh:2;url=../../index.php/Admin/dashboard');
                exit();
            }
        }
    }

    public function setHeader() {
        echo <<<EOD
            <header>
                <div id="headerIMG">
                    <img src="/images/LISAE.png" alt="logo LISAE" />
                </div>
            </header>
            <div id="margin"></div>
            EOD;
    }

    abstract public function setBody($content);

}