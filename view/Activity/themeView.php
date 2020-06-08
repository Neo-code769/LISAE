<?php

require_once '../lisaeTemplate.class.php';

class ThemeView extends LisaeTemplate {

    public function setBody($content) {
        echo <<<EOD
            <div id="datacontent" class="container">
                <button id="SS" class ="theme">Soft Skills</button>
                <button id="JC" class ="theme">Job Cible 2.0</button>
            </div><br><br>
            <div id="theme">
                <br/><br/>
                <!-- Affichage des resultats -->
                <br/><br/>
            </div>
            <script src="mainScript.js"></script>
        EOD;
    }

}

    $testView = new ThemeView();
    $testView->run($content="");

?>