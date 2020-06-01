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
        if (array_key_exists("error",$_GET)) {
          (new RegistrationView())->run("registration","<p style='background-color: red;'>Erreur saisi collab</p>");
        }
        (new RegistrationView())->run("registration");
        break;

      case 3:  // addCollab
        $errorMess = "insertion ok";
        try {
          $userForm =new UserForm($_POST);
          $collab =$userForm->getCollab();
          (new UserDao())->insert($collab);
        } catch (LisaeException $e) {
          $errorMess = $e->render();
          header("Location:../collab/registration?error");
          exit();
        }
        echo "Inscription réussie.. Redirection vers la page de connexion, veuillez patienter";
        header('Refresh:2;url=../../index.php');
        exit();
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
              (new LoginPageView())->run();
            } else {
              echo '<script type="text/javascript">window.alert("Mauvais mot de passe ou pseudo !");</script>';
              (new LoginPageView())->run();
              //header('Location:../index.php');
            }
          } else {
            echo '<script type="text/javascript">window.alert("Tous le champs doivent être complétés !");</script>';
            (new LoginPageView())->run();
            //header('Location:../index.php');
          }
          break;

      default:
        throw new LisaeException("Erreur");
    }
  }
}
