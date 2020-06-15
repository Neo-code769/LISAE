<?php

class ForgotPasswordView extends LisaeTemplateDisconnected {

    public function setBody($content) {
    echo <<<EOD
        <div id="title" class="container">
            <h2>Mot de passe oublié</h2><br><br>
        </div>
            <div class="panel">
                    <form method="post">
                            <label for="email">E-mail:</label>
                            <input type="email" name="mail"><br><br>
                            <input type="submit" name="forgotPassword" value="Renvoyer"><br><br>
                        <a id="button" href="../../index.php"> Connexion </a><br>
                    </form>  
            </div>
        EOD;
    }

}

?>