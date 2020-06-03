<?php

class LoginPageView extends LisaeTemplate {


    public function setBody($content) {
        echo <<<EOD
        <body>
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
                            <input id="button" type="submit" value="Connexion">
                        
                        <button id="button" value="Inscription"><a id="button" href="./index.php/collab/registration"> Inscription </a></button>
                        </fieldset> 
                    </form><br>   
                </div>
        EOD;
    }

}