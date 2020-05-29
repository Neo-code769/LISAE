<?php

class LoginPageView extends LisaeTemplate {


    public function setBody($content) {
        echo <<<EOD
        <body>
            <div id="title" class="container">
                <h2>Login Page</h2>
            </div>
                <div id="connexion" class="container">
                    <fieldset>
                        <form action="./index.php/collab/checkConnection" method="post">
                            <label for="email">E-mail:</label><br>
                            <input type="email" id="email" name="mail"><br><br>
                            <label for="mdp">Mot de passe:</label><br>
                            <input type="password" id="mdp" name="password"><br><br>
                            <input id="button" type="submit" value="Connexion">
                        </form><br>
                        <button id="button" value="Inscription"><a id="button" href="./index.php/collab/registration"> Inscription </a></button>
                    </fieldset>    
                </div>
        EOD;
    }

}