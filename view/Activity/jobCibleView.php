<?php


class JobCibleView extends LisaeTemplateConnected {

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
                        <button id="profil" class="btn-hover color-3" style="text-decoration: none; color: black; font-size: 18px;">Profil Perso/Pro</button>
                        <button id="recherche" class="btn-hover color-3" style="text-decoration: none; color: black; font-size: 18px;">Recherche d'emploi</button>
                        <button id="reputation" class="btn-hover color-3" style="text-decoration: none; color: black; font-size: 18px;">E-réputation</button>
                        <button id="CV" class="btn-hover color-3" style="text-decoration: none; color: black; font-size: 18px;">Curriculum Vittae</button>
                        <button id="motivation" class="btn-hover color-3" style="text-decoration: none; color: black; font-size: 18px;">Lettre de motivation</button>
                        <button id="entretien" class="btn-hover color-3" style="text-decoration: none; color: black; font-size: 18px;">Entretien d'embauche</button>
                    </div>
                </div>
                    <div id="descriptionJC">
                        <!-- Affichage des resultats -->
                    </div>
                
            <script type="text/javascript" src="/view/Activity/ScriptJC.js"></script>
        EOD;
    }

}

?>