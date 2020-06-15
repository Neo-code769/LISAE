<?php

class LoginPageView extends LisaeTemplateDisconnected {

    private $_sessionList = null;

    public function setSessionList($sessionList){
        $result = "";
        foreach ($sessionList as $session) {
            $result .= "<option value='".$session->get_nameSession()."'>".$session->get_nameSession()."</option>";
        }
        $this->_sessionList = $result;
    }

    public function setBody($content) {
        echo '<div class="panel">
                <ul class="panel__menu" id="menu">
                    <hr>
                    <li id="signIn">
                    <a href="#">Connexion</a>
                    </li>
                    <hr>
                    <li id="signUp">
                    <a href="#">Inscription</a>
                    </li>
                </ul>
            <div class="panel__wrap">
                <div class="panel__box" class="active" id="signInBox">
                    <form method="post">
                        <label for="email"> Email </label>
                            <input type="email" name="mail" required>
                        <label for="mdp">Mot de passe </label> 
                            <input type="password" name="password" required>
                        <input type="submit" value="Connexion" name="checkConnection"><br>
                            <a id="panel_a" href="/index.php/password/reset"> Mot de passe oublié </a><br>
                    </form><br>
                </div>
                    <div class="panel__box" id="signUpBox">
                    <form method="post">
                        <label> Prenom </label>
                            <input type="text" name="firstname" pattern="[A-Z][a-z]+" title="Le prénom ne doit pas contenir de chiffres et doit commencer par une majuscule.">
                        <label> Nom </label>
                            <input type="text" name="lastname" pattern="[A-Z][a-z]+" title="Le nom ne doit pas contenir de chiffres et doit commencer par une majuscule.">
                        <label> Date de Naissance </label>
                            <input type="date" name="birthdate">
                        <label> Numero de télephone </label>
                            <input type="tel" name="phoneNumber" pattern="0[1-68]([-. ]?[0-9]{2}){4}" title="Le numero de téléphone doit contenir 10 chiffres.">
                        <label> Email </label>
                            <input type="email" name="mail">
                        <label> Mot de passe </label>
                            <input type="password" name="password" pattern="(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z]).{6,}" title="Le mot de passe doit comporter au minimum 6 caractères et contenir une majuscule, une minuscule et un chiffre." required>
                        <label> Confirmer Mot de passe </label>
                            <input type="password" name="password2" pattern="(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z]).{6,}" title="Le mot de passe doit comporter au minimum 6 caractères et contenir une majuscule, une minuscule et un chiffre." required>
                        <label >Session de formation </label>
                            <select name="training"> '
                            .$this->_sessionList.
                            '</select><br><br>
                        <input type="submit" value="Inscription" name="registration"><br>
                    </form>
                    </div>
                </div>
            </div>
            </div>';
    }



}