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
      "registration" => 31
    ];
    parent::__construct();
  }

  public function run(): void
  {
    switch ($this->_case) {
      
      //Admin
      case 31:  // registrationAnim
        if (isset($_POST['registration'])){
          try {
            $userForm =new UserForm($_POST);
            $admin =$userForm->createAdministrator();
            (new UserDao())->insert($admin);
            $userForm->sendMailConfirmation(); // Envoi du mail de confirmation
            echo "Inscription réussie.. Redirection vers la page de connexion, veuillez patienter";
            header('Refresh:2;url=../../index.php');
            exit();
          } catch (LisaeException $e) {
            $errorMess = $e->render();
            (new RegistrationView())->run("admin", $errorMess);
            exit();
          }
        }else {
          (new RegistrationView())->run("admin");
        }

      default:
      (new LoginPageView())->run($content="");
        throw new LisaeException("Erreur");
    }
  }
}
