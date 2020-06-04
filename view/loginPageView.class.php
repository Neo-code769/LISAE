<?php

class LoginPageView extends LisaeTemplate {


    public function setBody($content) {
        echo <<<EOD
            <div id="title" class="container">
                <h2>Login Page</h2>
            </div>
                <div id="connexion" class="container">
                    <form action="./index.php/login/checkConnection" method="post">
                        <fieldset>
                        
                            <label for="email">E-mail:</label><br>
                            <input type="email" id="email" name="mail"><br><br>
                            <label for="mdp">Mot de passe:</label><br>
                            <input type="password" id="mdp" name="password"><br><br>
                            <input id="button" type="submit" value="Connexion"><br><br>
                        
                        <button id="button" value="Inscription"><a id="button" href="/index.php/collab/registration"> Inscription </a></button><br><br>
                        </fieldset><br>  
                    </form>
                        <div>
                            <p>
                                <a href="http://www.lisae.fr:8081/view/forgotPassword.php"> Mot de passe oublié </a>
                            </p>
                        </div>
            </div>
        EOD;
        
    }

}