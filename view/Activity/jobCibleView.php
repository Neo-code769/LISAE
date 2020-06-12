<?php


class JobCibleView extends LisaeTemplateConnected {

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