<?php

class LoginPageView extends LisaeTemplate {


    public function setBody($content) {
        echo <<<EOD
        <body>
            <div id="title" class="container">
                <div class="row">
                    <div class="col-xl-4">
                        <h2>Login Page</h2>
                    </div>
                </div>
            </div>
                <div id="connexion" class="row">
                    <div class="col-xl-4">
                    <fieldset>
                        <form action="./index.php/collab/checkConnection" method="post">
                            <label for="email">E-mail:</label><br>
                            <input type="email" id="email" name="mail"><br><br>
                            <label for="mdp">Mot de passe:</label><br>
                            <input type="password" id="mdp" name="password"><br><br>
                            <input type="submit" value="Connexion">
                        </form><br>
                        <button value="Inscription"><a href="./index.php/collab/registration"> Inscription </a></button>
                    </fieldset>   
                    </div> 
                </div>
        EOD;
    }

}