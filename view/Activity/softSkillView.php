<?php


class SoftSkillView extends LisaeTemplateConnected {

    public function setBody($content) {
        echo <<<EOD
                <div id="themeview">
                    <div id="list">
                        <button id="apprendre" class ="activity">Apprendre à Apprendre</button>
                        <button id="memoire" class ="activity">Memoire</button>
                        <button id="confiance" class ="activity">Capital Confiance</button>
                        <button id="empathie" class ="activity">Empathie</button>
                        <button id="comportement" class ="activity">Comportement</button>
                        <button id="image" class ="activity">Optimiser son Image</button>
                        <button id="cognitive" class ="activity">Strategies Cognitives</button>
                        <button id="parole" class ="activity">Prise de Parole</button>
                        <button id="parole2" class ="activity">Prise de Parole 2</button>
                        <button id="stress" class ="activity">Gestion du Stress</button>
                        <button id="stress2" class ="activity">Gestion du Stress 2</button>
                        <button id="communication" class ="activity">Communication</button>
                        <button id="communication2" class ="activity">Communication 2</button>
                        <button id="mindmapping" class ="activity">Mind Mapping</button>
                        <button id="mindmapping2" class ="activity">Mind Mapping 2</button>
                        <button id="mindmapping3" class ="activity">Mind Mapping 3</button>
                        <button id="mindmapping4" class ="activity">Mind Mapping 4</button>
                        <button id="mindmapping5" class ="activity">Mind Mapping 5</button>
                    </div><br>
                    <div id="description">
                        <!-- Affichage des resultats -->
                    </div>
                </div>
            
            <script type="text/javascript" src="/view/Activity/ScriptSS.js"></script>
        EOD;
    }

}

?>