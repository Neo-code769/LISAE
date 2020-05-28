<body>
    <h1>Inscription Collaborateur</h1>

        <fieldset>
            <form action="./index.php/collab/add" method="post">

                <label>Prenom :</label>
                <input type="text" name="firstname" required>

                <label>Nom :</label>
                <input type="text" name="lastname" required>

                <label>Date de naissance :</label>
                <input type="date" name="birthdate"  required>

                <label>Numero de telephone :</label>
                <input type="tel" name="phoneNumber" pattern="0[1-68]([-. ]?[0-9]{2}){4}" required>

                <label>E-mail :</label>
                <input type="email" name="mail" required>

                <label>Mot de passe :</label>
                <input type="password" name="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}" required>

                <label>Entrer le mot de passe à nouveau :</label>
                <input type="password" name="password2" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}" required>

                <input type="submit" value="Valider">
                <input type="reset" value="Annuler">
            </form>
        </fieldset><br>

        <button><a href="../../index.php">Retourner à l'accueil</a></button>

</body>