<?php
/*
* animator Type
*/

class AnimController extends MainController
{

  public function __construct()
  {
    $this->_listUseCases=
    [
      //Anim
      "registration" => 4, "add" => 5
    ];
    parent::__construct();
  }

  public function run(): void
  {
    switch ($this->_case) {

      case 4:  // registrationAnim
        (new RegistrationView())->run($content="");
        // include 'view/Registration/registrationAnim.php';
        break;

      case 5:  // addAnim
        $t = new Animator(htmlentities($_POST["firstname"]), htmlentities($_POST["lastname"]), htmlentities($_POST["birthdate"]), htmlentities($_POST["phoneNumber"]), htmlentities($_POST["mail"]), sha1($_POST["password"]),);

        if (($_POST["password"]) == ($_POST["password2"])) {
          (new UserDao())->insert($t);
          echo '<script type="text/javascript">window.alert("Bravo, votre compte a été crée !");</script>';
          (new LoginPageView())->run($content="");
          // include 'view/loginPage.php';
        } else {
          echo '<script type="text/javascript">window.alert("Veuillez entrer des mots de passe identique !");</script>';
        }
        break;

      default:
        throw new LisaeException("Erreur");
    }
  }
}