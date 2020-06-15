<?php


class SoftSkillView extends LisaeTemplateConnected {

    public function setHeader($errorMess) {
        echo <<<EOD
            <header>
                <div id="headerIMG">
                    <img src="/images/LISAE.png" alt="logo LISAE" />
                        <div class="buttons">
                            <a href="./dashboard"><button class="btn-hover color-1" style="text-decoration: none; color: black; font-size: 24px;">Tableau de Bord</button></a>
                            <a href="../collab/eloce"><button class="btn-hover color-1" style="text-decoration: none; color: black; font-size: 24px;"> Calendrier ELOCE</button></a>
                            <a href="../collab/softskill"><button class="btn-hover color-1" style="text-decoration: none; color: black; font-size: 24px;">Atelier Soft Skills</button></a>
                            <a href="../collab/jobcible"><button class="btn-hover color-1" style="text-decoration: none; color: black; font-size: 24px;">Atelier Job Cible</button></a>
                            <a href="../collab/info"><button class="btn-hover color-1" style="text-decoration: none; color: black; font-size: 24px;">Mon Compte</button></a>
                            <a href="../password/logout"><button class="btn-hover color-1" style="text-decoration: none; color: black; font-size: 24px;">Deconnexion</button></a>
                        </div>
                </div>
                <div class="lifeline"></div>
            </header>
            <div id="margin"></div>
            <body>
            EOD;
        echo "<p>".$errorMess."</p>";
    }

    public function setBody($content) {
        echo <<<EOD
                <div id="themeview">
                    <div id="buttons">
                        <button id="apprendre"  class="btn-hover color-2" style="text-decoration: none; color: black; font-size: 18px;">Apprendre à Apprendre</button>
                        <button id="memoire" class="btn-hover color-2" style="text-decoration: none; color: black; font-size: 18px;">Memoire</button>
                        <button id="confiance" class="btn-hover color-2" style="text-decoration: none; color: black; font-size: 18px;">Capital Confiance</button>
                        <button id="empathie" class="btn-hover color-2" style="text-decoration: none; color: black; font-size: 18px;">Empathie</button>
                        <button id="comportement" class="btn-hover color-2" style="text-decoration: none; color: black; font-size: 18px;">Comportement</button>
                        <button id="image" class="btn-hover color-2" style="text-decoration: none; color: black; font-size: 18px;">Optimiser son Image</button><br>
                        <button id="cognitive" class="btn-hover color-2" style="text-decoration: none; color: black; font-size: 18px;">Strategies Cognitives</button>
                        <button id="parole" class="btn-hover color-2" style="text-decoration: none; color: black; font-size: 18px;">Prise de Parole</button>
                        <button id="parole2" class="btn-hover color-2" style="text-decoration: none; color: black; font-size: 18px;">Prise de Parole 2</button>
                        <button id="stress" class="btn-hover color-2" style="text-decoration: none; color: black; font-size: 18px;">Gestion du Stress</button>
                        <button id="stress2" class="btn-hover color-2" style="text-decoration: none; color: black; font-size: 18px;">Gestion du Stress 2</button>
                        <button id="communication" class="btn-hover color-2" style="text-decoration: none; color: black; font-size: 18px;">Communication</button><br>
                        <button id="communication2" class="btn-hover color-2" style="text-decoration: none; color: black; font-size: 18px;">Communication 2</button>
                        <button id="mindmapping" class="btn-hover color-2" style="text-decoration: none; color: black; font-size: 18px;">Mind Mapping</button>
                        <button id="mindmapping2" class="btn-hover color-2" style="text-decoration: none; color: black; font-size: 18px;">Mind Mapping 2</button>
                        <button id="mindmapping3" class="btn-hover color-2" style="text-decoration: none; color: black; font-size: 18px;">Mind Mapping 3</button>
                        <button id="mindmapping4" class="btn-hover color-2" style="text-decoration: none; color: black; font-size: 18px;">Mind Mapping 4</button>
                        <button id="mindmapping5" class="btn-hover color-2" style="text-decoration: none; color: black; font-size: 18px;">Mind Mapping 5</button>
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