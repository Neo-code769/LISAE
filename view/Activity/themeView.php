<?php


class ThemeView extends LisaeTemplateConnected {

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
                <h1> Job Cible 2.0 </h1>
                <div id="list">
                    <button id="profil" class ="activity">Profil Perso/Pro</button>
                    <button id="recherche" class ="activity">Recherche d'emploi</button>
                    <button id="reputation" class ="activity">E-réputation</button>
                    <button id="CV" class ="activity">Curriculum Vittae</button>
                    <button id="motivation" class ="activity">Lettre de motivation</button>
                    <button id="entretien" class ="activity">Entretien d'embauche</button>
                </div>
                <div id="description">
                    <!-- Affichage des resultats -->
                </div>
            
            <script type="text/javascript" src="/view/Activity/mainScript.js"></script>
        EOD;
    }

}

?>