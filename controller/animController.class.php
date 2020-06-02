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
      "registration" => 11
    ];
    parent::__construct();
  }

  public function run(): void
  {
    switch ($this->_case) {

      case 11:  // registrationAnim
        if (isset($_POST['registration'])){
          try {
            $userForm =new UserForm($_POST);
            $anim =$userForm->createAnim();
            (new UserDao())->insert($anim);
            echo "Inscription réussie.. Redirection vers la page de connexion, veuillez patienter";
            header('Refresh:2;url=../../index.php');
            exit();
          } catch (LisaeException $e) {
            $errorMess = $e->render();
            (new RegistrationView())->run("registration", $errorMess);
            exit();
          }
        }else {
          (new RegistrationView())->run("registration");
        }

      break;
    }
  }
}
