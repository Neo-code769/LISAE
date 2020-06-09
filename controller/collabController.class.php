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
      "theme"=> 8
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
          /* $listTheme=(new ThemeDAO())->getListTheme();
          
          //Lié les themes avec les activités
          foreach ($listTheme as $theme) {
            $theme->setActivity((new ActivityDAO())->getListUniqueActivityForTheme($theme->getName()));
          }

          //Lié les activité avec les créneaux
          foreach ($listTheme->getListActivity() as $activity) {
            $activity->setSlot(new SlotDAO())->getListSlotForActivity($activity->getId());
          } */

        //Ou faire une fonction directement rempli dans le dao


      //Exemple test
      $collabView = new CollabView();
      //$collabView->setSlot((new SlotDAO())->getListSlotForActivity(1));
      //$collabView->setTheme((new ThemeDao())->getListSlot(1));
      $collabView->setTheme((new ThemeDao())->getListTheme());
      //$collabView->setTheme((new ThemeDao())->getListActivity(1));
      $collabView->run("dashboard");
      break;
      
      case 7:
      $user = (new userDao())->get($_SESSION["id_user"]);
      $collabView = new CollabView();
      $collabView->setInfoUser($user);
      $collabView->run("infoUser");
      break;
      
      case 8:
       
        $testView = new ThemeView();
        $testView->run($content="");
        
      break;
    }
  }
}
