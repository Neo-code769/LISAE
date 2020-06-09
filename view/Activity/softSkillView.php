<?php


class SoftSkillView extends LisaeTemplateConnected {

    public function setBody($content) {
        echo <<<EOD
                <h1> Soft Skills </h1>
                <div id="list">
                    <button id="confiance" class ="activity">Capital Confiance</button>
                    <button id="mindmapping" class ="activity">Mind Mapping</button>
                    <button id="stress" class ="activity">Gestion du stress</button>
                    <button id="communication" class ="activity">Communication</button>
                    <button id="cognitive" class ="activity">Strategies Cognitives</button>
                    <button id="numerique" class ="activity">Usage du numerique</button>
                </div><br>
                <div id="description">
                    <!-- Affichage des resultats -->
                </div>
            
            <script type="text/javascript" src="/view/Activity/mainScript.js"></script>
        EOD;
    }

}

?>