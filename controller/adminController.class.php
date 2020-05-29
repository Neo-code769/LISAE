<?php
/*
* Administrator Type
*/

class AdminController extends MainController
{

  public function __construct()
  {
    $this->_listUseCases=
    [
      "registration" => 6, "add" => 7
    ];
    parent::__construct();
  }

  public function run(): void
  {
    switch ($this->_case) {
      
      //Admin
      case 6: // registrationAdmin
        (new RegistrationView())->run($content="");
        // include 'view/Registration/registrationAdmin.php';
      break;

      case 7: // addAdmin
        $t = new Admin (htmlentities($_POST["firstname"]), htmlentities($_POST["lastname"]), htmlentities($_POST["birthdate"]), htmlentities($_POST["phoneNumber"]), htmlentities($_POST["mail"]), sha1($_POST["password"]),);
        
        if(($_POST["password"]) == ($_POST["password2"])) { 
            (new UserDao())->insert($t);
            echo '<script type="text/javascript">window.alert("Bravo, votre compte a été crée !");</script>';
            (new LoginPageView())->run($content="");
            // include 'view/loginPage.php';
        }
        else {
            echo '<script type="text/javascript">window.alert("Veuillez entrer des mots de passe identique !");</script>';
            (new LoginPageView())->run($content="");
        }
      break;(new LoginPageView())->run($content="");

      default:
      (new LoginPageView())->run($content="");
        throw new LisaeException("Erreur");
    }
  }
}
