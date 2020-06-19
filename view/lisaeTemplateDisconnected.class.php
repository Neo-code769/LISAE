<?php
abstract class LisaeTemplateDisconnected extends LisaeTemplate {

    public function __construct() {
        if(ISSET($_SESSION['id_user']))
        {
            if ($_SESSION['role']=='Collaborator') {
                header('Location:../../index.php/collab/dashboard');
                exit();
            }elseif ($_SESSION['role']=='Animator') {
                header('Location:../../index.php/anim/dashboard');
                exit();
            }elseif ($_SESSION['role']=='Admin') {
                header('Location:../../index.php/anim/dashboard');
                exit();
            }
        }
    }

    public function setHeader($errorMess) {
        echo <<<EOD
            <header>
                <div id="headerIMG">
                    <img style="width: 12%; height: 12%; margin-left: 44%; margin-top:1%;" src="/images/LISAE.png" alt="logo LISAE" />
                </div>
            </header>
            EOD;
        echo "<p>".$errorMess."</p>";
    }

    abstract public function setBody($content);

}