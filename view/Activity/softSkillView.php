<?php


class SoftSkillView extends LisaeTemplateConnected {

    public function setBody($content) {
        echo <<<EOD
                <div id="themeview">
                    <div id="buttons">
                        <button id="apprendre"  class="btn-hover color-2" style="text-decoration: none; color: white; font-size: 20px;">Apprendre à Apprendre</button>
                        <button id="memoire" class="btn-hover color-2" style="text-decoration: none; color: white; font-size: 20px;">Memoire</button>
                        <button id="confiance" class="btn-hover color-2" style="text-decoration: none; color: white; font-size: 20px;">Capital Confiance</button>
                        <button id="empathie" class="btn-hover color-2" style="text-decoration: none; color: white; font-size: 20px;">Empathie</button>
                        <button id="comportement" class="btn-hover color-2" style="text-decoration: none; color: white; font-size: 20px;">Comportement</button>
                        <button id="image" class="btn-hover color-2" style="text-decoration: none; color: white; font-size: 20px;">Optimiser son Image</button><br>
                        <button id="cognitive" class="btn-hover color-2" style="text-decoration: none; color: white; font-size: 20px;">Strategies Cognitives</button>
                        <button id="parole" class="btn-hover color-2" style="text-decoration: none; color: white; font-size: 20px;">Prise de Parole</button>
                        <button id="parole2" class="btn-hover color-2" style="text-decoration: none; color: white; font-size: 20px;">Prise de Parole 2</button>
                        <button id="stress" class="btn-hover color-2" style="text-decoration: none; color: white; font-size: 20px;">Gestion du Stress</button>
                        <button id="stress2" class="btn-hover color-2" style="text-decoration: none; color: white; font-size: 20px;">Gestion du Stress 2</button>
                        <button id="communication" class="btn-hover color-2" style="text-decoration: none; color: white; font-size: 20px;">Communication</button><br>
                        <button id="communication2" class="btn-hover color-2" style="text-decoration: none; color: white; font-size: 20px;">Communication 2</button>
                        <button id="mindmapping" class="btn-hover color-2" style="text-decoration: none; color: white; font-size: 20px;">Mind Mapping</button>
                        <button id="mindmapping2" class="btn-hover color-2" style="text-decoration: none; color: white; font-size: 20px;">Mind Mapping 2</button>
                        <button id="mindmapping3" class="btn-hover color-2" style="text-decoration: none; color: white; font-size: 20px;">Mind Mapping 3</button>
                        <button id="mindmapping4" class="btn-hover color-2" style="text-decoration: none; color: white; font-size: 20px;">Mind Mapping 4</button>
                        <button id="mindmapping5" class="btn-hover color-2" style="text-decoration: none; color: white; font-size: 20px;">Mind Mapping 5</button>
                    </div>
                </div>
                    <div id="descriptionSS">
                        <!-- Affichage des resultats -->
                    </div>
                </div>
            
            <script type="text/javascript" src="/view/Activity/ScriptSS.js"></script>
        EOD;
    }

}

?>