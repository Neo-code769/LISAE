<?php

class LoginPageView extends LisaeTemplateDisconnected {


    public function setBody($content) {
        echo <<<EOD
            <div id="menu">
                <ul>
                    <li id="signIn">
                    <a href="/index.php">Connexion</a>
                    </li>
                    <li id="signUp">
                    <a href="/index.php/collab/registration">Inscription</a>
                    </li>
                </ul>
                </div>
                <div id="connexion">
                    <form method="post">
                        <fieldset id="login">
                            <label for="email">E-mail:</label><br>
                            <input type="email" id="email" name="mail" required><br><br>
                            <label for="mdp">Mot de passe:</label><br>
                            <input type="password" id="mdp" name="password" required><br><br>
                            <input id="inputSubmit" type="submit" name="checkConnection" value="Connexion"><br>
                        </fieldset><br>  
                    </form>
                        <div>
                            <p style="font-size: 14px; text-align: center;"><a href="/index.php/password/reset"> Mot de passe oublié </a></p>
                        </div>
            </div>
        EOD;
        
    }

}