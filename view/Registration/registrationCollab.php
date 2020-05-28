<body>

        <div id="title" class="container">
            <div class="row">
                <div class="col-xl-4">
                    <h2>Inscription Collaborateur</h2>
                </div>
            </div>
        </div>

        <div id="registration" class="row">
            <div class="col-xl-4">
                <fieldset>
                    <form action="./index.php/collab/add" method="post">

                        <label>Prenom :</label>
                        <input type="text" name="firstname" pattern="[A-Z][a-z]+" title="Le prénom ne doit pas contenir de chiffres et doit commencer par une majuscule." required>

                        <label>Nom :</label>
                        <input type="text" name="lastname" pattern="[A-Z][a-z]+" title="Le nom ne doit pas contenir de chiffres et doit commencer par une majuscule." required>

                        <label>Date de naissance :</label>
                        <input type="date" name="birthdate"  required>

                        <label>Numero de telephone :</label>
                        <input type="tel" name="phoneNumber" validationMessage="ezrzer" pattern="0[1-68]([-. ]?[0-9]{2}){4}" title="Le numero de téléphone doit contenir 10 chiffres." required>

                        <label>E-mail :</label>
                        <input type="email" name="mail" required>

                        <label>Mot de passe :</label>
                        <input type="password" name="password" pattern="(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z]).{6,}" title="Le mot de passe doit contenir au moins une lettre Majuscule, une lettre minuscule, un chiffre et faire au moins 6 caractères." required>

                        <label>Entrer le mot de passe à nouveau :</label>
                        <input type="password" name="password2" pattern="(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z]).{6,}" title="Le mot de passe doit contenir au moins une lettre Majuscule, une lettre minuscule, un chiffre et faire au moins 6 caractères." required>

                        <input type="submit" value="Valider">
                        <input type="reset" value="Annuler">
                    </form>
                </fieldset><br>

                <button><a href="../../index.php">Retourner à l'accueil</a></button>
            </div>
        </div>
</body>