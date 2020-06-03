<?php

class ForgotPasswordView extends LisaeTemplate {


    public function setBody($content) {
        echo <<<EOD
            <div id="title" class="container">
                <h2>Mot de passe oublié</h2>
            </div>

                <div id="connexion" class="container">
                    <form method="post">
                        <fieldset>
                        
                            <label for="email">E-mail:</label><br>
                            <input type="email" id="email" name="mail"><br><br>
                            <input id="button" type="submit" value="Connexion"><br><br>
                        
                        <button id="button" value="Connexion"><a id="button" href="C:\wamp64\www\LISAE\index.php"> Connexion </a></button><br><br>

                        </fieldset><br>
                        
                        <button id="button" value="ForgotPassword"><a id="button" href="C:\wamp64\www\LISAE\forgot-password"> Mot de passe oublié </a></button>
                    </form>  
                </div>
        EOD;
        
    }

}

?>