<?php

class ChangePasswordView extends LisaeTemplate {

    public function setBody($content) {
    echo <<<EOD
        <div id="title" class="container">
            <h2>Changement de mot de passe</h2>
        </div>
            <div id="connexion" class="container">
                <form method="post">
                    <fieldset>
                        <label>Mot de passe :</label>
                        <input type="password" name="password" pattern="(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z]).{6,}" title="Le mot de passe doit comporter au minimum 6 caractères et contenir une majuscule, une minuscule et un chiffre." required><br>
                        <label>Entrer le mot de passe à nouveau :</label>
                        <input type="password" name="password2" pattern="(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z]).{6,}" title="Le mot de passe doit comporter au minimum 6 caractères et contenir une majuscule, une minuscule et un chiffre." required><br><br>
                        <input id="button" type="submit" name="changePassword" value="Valider"><br>
                </fieldset><br>
                </form>  
        </div>

        EOD;
    }

}

?>