<?php
/*
* Collaborator Type
*/

class CollabController extends MainController
{

  public function __construct()
  {
    parent::__construct();
  }

  public function run(): void
  {
    switch ($this->_case) {
      case 2:  // registrationCollab
        include 'view/Collaborator/registrationCollab.phtml';
        break;

      case 3:  // addCollab
        //Exemple Erreur:
        //throw new ExceptionLisae("Error", 4);

        //Ici instanciation userForm
        $t = new Collaborator(htmlentities($_POST["firstname"]), htmlentities($_POST["lastname"]), htmlentities($_POST["birthdate"]), htmlentities($_POST["phoneNumber"]), htmlentities($_POST["mail"]), sha1($_POST["password"]), sha1($_POST["password2"]));

        if (($_POST["password"]) == ($_POST["password2"])) {
          (new UserDao())->insert($t);
          echo '<script type="text/javascript">window.alert("Bravo, votre compte a été crée !");</script>';
          include 'view/loginPage.phtml';
        } else {
          echo '<script type="text/javascript">window.alert("Veuillez entrer des mots de passe identique !");</script>';
        }
        break;

      case 4:  // registrationAnim
        include 'view/Animator/registrationAnim.phtml';
        break;

      case 5:  // addAnim
        $t = new Animator(htmlentities($_POST["firstname"]), htmlentities($_POST["lastname"]), htmlentities($_POST["birthdate"]), htmlentities($_POST["phoneNumber"]), htmlentities($_POST["mail"]), sha1($_POST["password"]),);

        if (($_POST["password"]) == ($_POST["password2"])) {
          (new UserDao())->insert($t);
          echo '<script type="text/javascript">window.alert("Bravo, votre compte a été crée !");</script>';
          include 'view/loginPage.phtml';
        } else {
          echo '<script type="text/javascript">window.alert("Veuillez entrer des mots de passe identique !");</script>';
        }
        break;

      //Admin
      case 6: // registrationAdmin
        include 'view/Administrator/registrationAdmin.phtml';
      break;

      case 7: // addAdmin
        $t = new Admin (htmlentities($_POST["firstname"]), htmlentities($_POST["lastname"]), htmlentities($_POST["birthdate"]), htmlentities($_POST["phoneNumber"]), htmlentities($_POST["mail"]), sha1($_POST["password"]),);
        
        if(($_POST["password"]) == ($_POST["password2"])) { 
            (new UserDao())->insert($t);
            echo '<script type="text/javascript">window.alert("Bravo, votre compte a été crée !");</script>';
            include 'view/loginPage.phtml';
        }
        else {
            echo '<script type="text/javascript">window.alert("Veuillez entrer des mots de passe identique !");</script>';
        }
      break;

    //CONNEXION
      case 8: // checkConnection
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
                include "view/loginPage.phtml";
            }
        } else
          {
              echo '<script type="text/javascript">window.alert("Tous le champs doivent être complétés !");</script>';
              include "view/loginPage.phtml";
          }
      break;

      default:
        throw new LisaeException("Erreur");
    }
  }
}
