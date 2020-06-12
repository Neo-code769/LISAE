<?php

class LoginPageView extends LisaeTemplateDisconnected {


    public function setBody($content) {
        echo <<<EOD
                <div id="connexion" class="container">
                    <form method="post">
                        <fieldset id="login">
                        
                            <label for="email">E-mail:</label><br>
                            <input type="email" id="email" name="mail" required><br><br>
                            <label for="mdp">Mot de passe:</label><br>
                            <input type="password" id="mdp" name="password" required><br><br>
                            <input id="button" type="submit" name="checkConnection" value="Connexion"><br><br>
                        
                        <button id="button" value="Inscription"><a id="button" href="/index.php/collab/registration"> Inscription </a></button><br><br>
                        </fieldset><br>  
                    </form>
                        <div>
                            <p style="font-size: 14px;"><a href="/index.php/password/reset"> Mot de passe oublié </a></p>
                        </div>
            </div>
        EOD;
        
    }

}