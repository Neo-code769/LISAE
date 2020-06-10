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
      "signUpSlot"=>11,
      "infoSlot"=>12
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
              //var_dump($collab);
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
      $user = (new userDao())->getInfo($_SESSION["id_user"]);
      $collabView = new CollabView();
      $collabView->setInfoUser($user);
      $collabView->run("infoUser");
      break;
      
      case 8:
       
        $softSkill = new SoftSkillView();
        $softSkill->run("");
        
      break;

      case 9:
       
        $jobCible = new JobCibleView();
        $jobCible->run("");
        
      break;

      case 10:
        $collabView = new CollabView();
        $collabView->setTheme((new ThemeDao())->getListTheme());
        $collabView->run("ListELOCE");
      break;

      case 11:
        $collabView = new CollabView();
        try {
          (new ThemeDao())->registrationActivity($_SESSION["id_user"],$_SESSION["id_session"],$_GET["idActivity"],$_GET["idSlot"]);
          header('Location:../../index.php/collab/eloce');
        } catch (LisaeException $e) {
          $collabView->run("ListELOCE",$e->render());
        }
      break;

      case 12:
        $collabView = new CollabView();
        $themeList = (new ThemeDao())->getListTheme();
        $arr = [];
        foreach ($themeList as $theme) {
            foreach ($theme->get_activity() as $activity) {
                foreach($activity->get_slot() as $slot){
                  if ($slot->get_idSlot() == $_GET["idSlot"]) {
                    $slotInfo= [
                    "idslot"=> $slot->get_idSlot(),
                    "color" => $theme->get_color(),
                    "dts" => $slot->get_slotDateTimeStartFormat(),
                    "dte" => $slot->get_slotDateTimeEnd(),
                    "nTheme" => $theme->get_name(),
                    "nActivity" => $activity->get_name(),
                    "information" => $slot->get_information(),
                    "place" => $slot->get_place()
                    ]
                    ;
                  }
                }
            }
        } 
        $collabView->setInfoSlot($slotInfo);
        $collabView->run("infoSlot");
      break;
    }
  }
}
