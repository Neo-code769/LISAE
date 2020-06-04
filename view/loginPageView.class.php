<?php

class LoginPageView extends LisaeTemplate {


    public function setBody($content) {
        echo <<<EOD
            <div id="title" class="container">
                <h2>Login Page</h2>
            </div>
                <div id="connexion" class="container">
                    <form method="post">
                        <fieldset>
                        
                            <label for="email">E-mail:</label><br>
                            <input type="email" id="email" name="mail" required><br><br>
                            <label for="mdp">Mot de passe:</label><br>
                            <input type="password" id="mdp" name="password" required><br><br>
                            <input id="button" type="submit" name="checkConnection" value="Connexion"><br><br>
                        
                        <button id="button" value="Inscription"><a id="button" href="/index.php/collab/registration"> Inscription </a></button><br><br>
                        </fieldset><br>
                        
                        <button id="button" value="ForgotPassword"><a id="button" href="C:\wamp64\www\LISAE\forgot-password"> Mot de passe oublié </a></button>
                    </form>  
                </div>
        EOD;
        
    }

}