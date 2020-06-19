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
      "registration" => 31,
      "createTheme" => 32,
      "createActivity"=>33,
      "dashboard"=>34
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
      break;

      // creation d'un theme
      case 32: 
        if (isset($_POST['createTheme'])){
        $theme = new Theme(null,$_POST['name'],$_POST['color'],$_POST['description'],$_POST['detailedDescription'],null);
          (new ThemeDao())->insert($theme);
          
        } else {
          $adminview = new AdminView();
          $adminview->setUserList((new UserDao())->listAnim());
          $adminview->run("createTheme");
        }
      break;

      case 33: 
        $adminview = new AdminView();
        $adminview->run("createActivity");
      break;

      case 34: 
        $adminview = new AdminView();
        $adminview->run("dashboard");
      break;

      default:
      (new LoginPageView())->run($content="");
        throw new LisaeException("Erreur");
      break;
    }

  }
}
