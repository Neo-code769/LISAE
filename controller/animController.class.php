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
      "registration" => 21,
      "dashboard" => 22
    ];
    parent::__construct();
  }

  public function run(): void
  {
    switch ($this->_case) {

      case 21:  // registrationAnim
        if (isset($_POST['registration'])){
          try {
            $userForm =new UserForm($_POST);
            $anim =$userForm->createAnimator();
            (new UserDao())->insert($anim);
            $userForm->sendMailConfirmation(); // Envoi du mail de confirmation
            echo "Inscription réussie.. Redirection vers la page de connexion, veuillez patienter";
            header('Refresh:2;url=../../index.php');
            exit();
          } catch (LisaeException $e) {
            $errorMess = $e->render();
            (new RegistrationView())->run("anim", $errorMess);
            exit();
          }
        }else {
          (new RegistrationView())->run("anim");
        }

      break;

      case 22: //Dashboard
      $animatorView = new AnimatorView();
      //$animatorView->setMyTheme((new ThemeDao())->getMyListTheme($_SESSION["id_user"]));
      $animatorView->run("dashboard");
      break;
    }
  }
}
