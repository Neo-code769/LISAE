<?php

class Controller{

    public function __construct()
    {
        
    }

    public function run()
    {
        //TODO TEST
        //$act1 = new Activity("Atelier CV", "hey", "heyyyy", 2, 3, "3 jours avant", "2 jours avant");
        //echo($act1->getName());

        //var_dump($_GET['action']);

        if(isset($_GET['action'])){
            switch ($_GET['action']) {
                
                //INSCRIPTION
                //Collab
                case 'registrationCollab':
                    require 'view/registrationCollab.phtml';
                break;

                case 'addCollab':
                    //Exemple Erreur:
                    //throw new ExceptionLisae("Error", 4);

                    //Ici instanciation userForm
                    $t = new Collaborator (htmlentities($_POST["firstname"]), htmlentities($_POST["lastname"]), htmlentities($_POST["birthdate"]), htmlentities($_POST["phoneNumber"]), htmlentities($_POST["mail"]), sha1($_POST["password"]), sha1($_POST["password2"]));

                    if(($_POST["password"]) == ($_POST["password2"])) { 
                        (new UserDao())->insert($t);
                        echo '<script type="text/javascript">window.alert("Bravo, votre compte a été crée !");</script>';
                        require 'view/loginPage.phtml';
                    }
                    else {
                        echo '<script type="text/javascript">window.alert("Veuillez entrer des mots de passe identique !");</script>';
                    }
                break;

                //Anim
                case 'registrationAnim':
                    require 'view/registrationAnim.phtml';
                break;

                case 'addAnim':
                    $t = new Animator (htmlentities($_POST["firstname"]), htmlentities($_POST["lastname"]), htmlentities($_POST["birthdate"]), htmlentities($_POST["phoneNumber"]), htmlentities($_POST["mail"]), sha1($_POST["password"]),);
                    
                    if(($_POST["password"]) == ($_POST["password2"])) { 
                        (new UserDao())->insert($t);
                        echo '<script type="text/javascript">window.alert("Bravo, votre compte a été crée !");</script>';
                        require 'view/loginPage.phtml';
                    }
                    else {
                        echo '<script type="text/javascript">window.alert("Veuillez entrer des mots de passe identique !");</script>';
                    }
                break;

                //Admin
                case 'registrationAdmin':
                    require 'view/registrationAdmin.phtml';
                break;

                case 'addAdmin':
                    $t = new Admin (htmlentities($_POST["firstname"]), htmlentities($_POST["lastname"]), htmlentities($_POST["birthdate"]), htmlentities($_POST["phoneNumber"]), htmlentities($_POST["mail"]), sha1($_POST["password"]),);
                    
                    if(($_POST["password"]) == ($_POST["password2"])) { 
                        (new UserDao())->insert($t);
                        echo '<script type="text/javascript">window.alert("Bravo, votre compte a été crée !");</script>';
                        require 'view/loginPage.phtml';
                    }
                    else {
                        echo '<script type="text/javascript">window.alert("Veuillez entrer des mots de passe identique !");</script>';
                    }
                break;

                //CONNEXION
                case 'checkConnection':
                    $mail = htmlspecialchars($_POST["mail"]);
                    $password = sha1($_POST["password"]);
                    if(!empty($mail) AND !empty($password))
                    {
                        $userDao = new UserDao();
                        $tab=$userDao->getSession($mail, $password);
                        //var_dump($tab);

                        if($tab['exist'] == 1)
                        {
                            $_SESSION['id_user'] = $tab['id_user'];
                            $_SESSION['mail'] = $tab['mail'];
                            $_SESSION['password'] = $tab['password'];
                            $_SESSION['role'] = $tab['role'];
                            echo '<script type="text/javascript">window.alert("Connexion réussie !");</script>';
                        }  
                        else
                        {
                            echo '<script type="text/javascript">window.alert("Mauvais mot de passe ou pseudo !");</script>';
                            require "view/loginPage.phtml";
                        }
                    } else
                        {
                            echo '<script type="text/javascript">window.alert("Tous le champs doivent être complétés !");</script>';
                            require "view/loginPage.phtml";
                        }
                    break;
                default:
                    require 'view/loginPage.phtml';
                    break;
            }
        }else{
            require 'view/loginPage.phtml';
        }
        
    }

}
