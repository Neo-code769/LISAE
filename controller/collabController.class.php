<?php
/*
* Collaborator Type
*/

class CollabController extends MainController
{

  public function __construct()
  {
    $this->_listUseCases=
    [
      //Collab 
      "registration" => 2, "add" => 3
    ];
    parent::__construct();
  }

  public function run(): void
  {
    switch ($this->_case) {
      case 2:  // registrationCollab
        include 'view/Registration/registrationCollab.php';
        break;

      case 3:  // addCollab
        //Exemple Erreur:
        //throw new ExceptionLisae("Error", 4);
        //new UserForm($_POST)
        //Ici instanciation userForm
        
        /*$t = new Collaborator(htmlentities($_POST["firstname"]), htmlentities($_POST["lastname"]), htmlentities($_POST["birthdate"]), htmlentities($_POST["phoneNumber"]), htmlentities($_POST["mail"]), sha1($_POST["password"]), sha1($_POST["password2"]));

         if (($_POST["password"]) == ($_POST["password2"])) {
          (new UserDao())->insert($t);
          include 'view/loginPage.phtml';
          //echo '<script type="text/javascript">window.alert("Bravo, votre compte a été crée !");</script>';
        } else {
          echo '<script type="text/javascript">window.alert("Veuillez entrer des mots de passe identique !");</script>';
        } */
        $errorMess = "insertion ok";
        try {
          $userForm =new UserForm($_POST);
          $collab =$userForm->getCollab();
          (new UserDao())->insert($collab);
        } catch (LisaeException $e) {
          $errorMess = $e->render();
        }
        (new LoginPageView())->run('loginpage',$errorMess);
        
        break;

        case 8:
          $mail = htmlspecialchars($_POST["mail"]);
          $password = sha1($_POST["password"]);
          if (!empty($mail) and !empty($password)) {
            $userDao = new UserDao();
            $tab = $userDao->getSession($mail, $password);
            //var_dump($tab);
  
            if ($tab['exist'] == 1) {
              $_SESSION['id_user'] = $tab['id_user'];
              $_SESSION['mail'] = $tab['mail'];
              $_SESSION['password'] = $tab['password'];
              $_SESSION['role'] = $tab['role'];
              echo '<script type="text/javascript">window.alert("Connexion réussie !");</script>';
              include "view/loginPage.php";
            } else {
              echo '<script type="text/javascript">window.alert("Mauvais mot de passe ou pseudo !");</script>';
              include "view/loginPage.php";
              //header('Location:../index.php');
            }
          } else {
            echo '<script type="text/javascript">window.alert("Tous le champs doivent être complétés !");</script>';
            include "view/loginPage.php";
            //header('Location:../index.php');
          }
          break;

      default:
        throw new LisaeException("Erreur");
    }
  }
}
