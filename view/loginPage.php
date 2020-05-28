<body>
        <h1>Login Page</h1>

        <div id="connexion" class="row">
            <div class="col-md-4">
            <fieldset>
                <form action="./index.php/collab/checkConnection" method="post">
                    <label for="email">E-mail:</label><br>
                    <input type="email" id="email" name="mail"><br>
                    <label for="mdp">Mot de passe:</label><br>
                    <input type="password" id="mdp" name="password"><br><br>
                    <input type="submit" value="Connexion">
                </form><br>

                    <button value="Inscription"><a href="./index.php/collab/registration"> Inscription </a></button>

            </fieldset>   
            </div> 
        </div>
</body>