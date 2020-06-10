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
      "registration" => 5,
      "dashboard" => 6,
      "info" => 7,
      "softskill"=> 8,
      "jobcible"=>9,
      "eloce"=>10,
      "signUpActivity"=>11,
      "infoActivity"=>12
    ];
    parent::__construct();
  }

  public function run(): void
  {
    switch ($this->_case) {
      case 5:  // registrationCollab
    
          // On se place sur le bon formulaire grâce au "name" de la balise "input"
          if (isset($_POST['registration'])){
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
              $errorMess = $e->render();
              $regView = new RegistrationView();
              $regView->setSessionList((new SessionTrainingDao())->getSessionTrainingList());
              $regView->run("collab", $errorMess); 
              exit();
            }
          }else {
            $regView = new RegistrationView();
            $regView->setSessionList((new SessionTrainingDao())->getSessionTrainingList());
            $regView->run("collab"); 
          }

        break;

      case 6: //connexion dashboard

      //Liste Eloce

          //Appel de la fonction dao et instanciation des modéles des thèmes

      //Exemple test
      $collabView = new CollabView();
      $collabView->run("dashboard");
      break;
      
      case 7:
      $user = (new userDao())->get($_SESSION["id_user"]);
      $collabView = new CollabView();
      $collabView->setInfoUser($user);
      $collabView->run("infoUser");
      break;
      
      case 8:
       
        $softSkill = new SoftSkillView();
        $softSkill->run($content="");
        
      break;

      case 9:
       
        $jobCible = new JobCibleView();
        $jobCible->run($content="");
        
      break;

      case 10:
        $collabView = new CollabView();
        $collabView->setTheme((new ThemeDao())->getListTheme());
        $collabView->run($content="ListELOCE");
      break;

      case 11:

      break;

      case 12:
        
      break;
    }
  }
}
