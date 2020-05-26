<?php

class Controller{

    public function run()
    {
        //TODO TEST
        //$act1 = new Activity("Atelier CV", "hey", "heyyyy", 2, 3, "3 jours avant", "2 jours avant");
        //echo($act1->getName());

        //var_dump($_GET['action']);

        if(isset($_GET['action'])){
            switch ($_GET['action']) {
                
                //Collab
                case 'registrationCollab':
                    include 'view/registrationCollab.phtml';
                break;

                case 'addCollab':
                    $t = new Collaborator (htmlentities($_POST["firstname"]), htmlentities($_POST["lastname"]), htmlentities($_POST["birthdate"]), htmlentities($_POST["phoneNumber"]), htmlentities($_POST["mail"]), sha1($_POST["password"]),);
                    (new UserDao())->insert($t);
                    echo '<script type="text/javascript">window.alert("Bravo, votre compte a été crée !");</script>';
                    include 'view/loginPage.phtml';
                break;

                //Anim
                case 'registrationAnim':
                    include 'view/registrationAnim.phtml';
                break;

                case 'addAnim':
                    $t = new Animator (htmlentities($_POST["firstname"]), htmlentities($_POST["lastname"]), htmlentities($_POST["birthdate"]), htmlentities($_POST["phoneNumber"]), htmlentities($_POST["mail"]), sha1($_POST["password"]),);
                    (new UserDao())->insert($t);
                    echo '<script type="text/javascript">window.alert("Bravo, votre compte a été crée !");</script>';
                    include 'view/loginPage.phtml';
                break;

                //Admin
                case 'registrationAdmin':
                    include 'view/registrationAdmin.phtml';
                break;

                case 'addAdmin':
                    $t = new Admin (htmlentities($_POST["firstname"]), htmlentities($_POST["lastname"]), htmlentities($_POST["birthdate"]), htmlentities($_POST["phoneNumber"]), htmlentities($_POST["mail"]), sha1($_POST["password"]),);
                    (new UserDao())->insert($t);
                    echo '<script type="text/javascript">window.alert("Bravo, votre compte a été crée !");</script>';
                    include 'view/loginPage.phtml';
                break;

                //connexion
                case 'checkConnection':
                    $tab = new UserDao();
                    $tab->getSession($_POST["mail"], $_POST["password"]);
                    
                   /*  $tab->rowCount();
                    if(!empty(htmlentities($_POST["mail"])) AND !empty(sha1($_POST["password"])))
                    {
                        if($tab == 1)
                        {
                            $session = $tab->fetch(PDO::FETCH_ASSOC);
                            $_SESSION['id_user'] = $tab['id_user'];
                            $_SESSION['pseudo'] = $tab['pseudo'];
                            $_SESSION['password'] = $tab['password'];
                            $_SESSION['role'] = $tab['role'];
                            echo 'connexion réussie';
                        }  
                        else
                        {
                            echo "mauvais mot de passe ou pseudo !";
                        }
                    } else
                        {
                            echo "Tous le champs doivent être complétés !";
                        }     */     
                    
                default:
                    include 'view/loginPage.phtml';
                    break;
            }
        }else{
            include 'view/loginPage.phtml';
        }
        
    }

}
