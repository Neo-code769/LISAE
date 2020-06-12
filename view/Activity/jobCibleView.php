<?php


class JobCibleView extends LisaeTemplateConnected {

    public function setBody($content) {
        echo <<<EOD
                <div id="themeview">
                    <div id="buttons">
                        <button id="profil" class="btn-hover color-3" style="text-decoration: none; color: white; font-size: 20px;">Profil Perso/Pro</button>
                        <button id="recherche" class="btn-hover color-3" style="text-decoration: none; color: white; font-size: 20px;">Recherche d'emploi</button>
                        <button id="reputation" class="btn-hover color-3" style="text-decoration: none; color: white; font-size: 20px;">E-réputation</button>
                        <button id="CV" class="btn-hover color-3" style="text-decoration: none; color: white; font-size: 20px;">Curriculum Vittae</button>
                        <button id="motivation" class="btn-hover color-3" style="text-decoration: none; color: white; font-size: 20px;">Lettre de motivation</button>
                        <button id="entretien" class="btn-hover color-3" style="text-decoration: none; color: white; font-size: 20px;">Entretien d'embauche</button>
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