<?php

class ForgotPasswordView extends LisaeTemplateDisconnected {

    public function setBody($content) {
    echo <<<EOD
        <div id="title">
            <h3>Mot de passe oublié</h3>
        </div>
            <div id="connexion">
                <form method="post">
                    <fieldset><br>
                        <label for="email">E-mail:</label><br>
                        <input type="email" id="email" name="mail"><br><br>
                        <input id="inputSubmit" type="submit" name="forgotPassword" value="Renvoyer"><br><br>
                </fieldset><br>
                    <a id="inputSubmit" style="text-decoration: none;" href="../../index.php"> Connexion </a><br><br>
                </form>  
        </div>
        EOD;
    }

}

?>