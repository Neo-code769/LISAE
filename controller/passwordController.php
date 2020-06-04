<?php
/*
* Collaborator Type
*/

class PasswordController extends MainController
{

  public function __construct()
  {
    $this->_listUseCases=
    [
      //Collab 
      "registration" => 2
    ];
    parent::__construct();
  }

  public function run(): void
  {
    switch ($this->_case) {
      case 2:  // forgotPassword
    
          // On se place sur le bon formulaire grâce au "name" de la balise "input"
          if (isset($_POST['forgotPassword'])){
            try {
              $userForm =new UserForm($_POST);
              $collab =$userForm->createCollab();
              (new UserDao())->insert($collab);
              (new SessionTrainingDao())->insertForSession($_POST['training']);
              $userForm->sendMailConfirmation(); // Envoi du mail de confirmation
              echo "Inscription réussie.. Redirection vers la page de connexion, veuillez patienter";
              header('Refresh:2;url=../../index.php');
              exit();
            } catch (LisaeException $e) {
              /*$errorMess = $e->render();
              $regView = new RegistrationView();
              $regView->setSessionList((new SessionTrainingDao())->getSessionTrainingList());
              $regView->run("collab"); 
              exit();*/
            }
          }else {
            /*$regView = new RegistrationView();
            $regView->setSessionList((new SessionTrainingDao())->getSessionTrainingList());
            $regView->run("collab"); */
          }

        break;

        
    }
  }
}