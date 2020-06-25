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
      "infoSlot"=>12,
      "modifPhone"=>13,
      "modifMail"=>14,
      "deregistrationSlot"=>15,
      "listActivity"=>16
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

      case 6: //dashboard

      $collabView = new CollabView();
      $themeDao = new themeDao;
      $themeList = $themeDao->getMyListThemeCollab($_SESSION["id_user"]);
      $arr = [];
      foreach ($themeList as $theme) {
          foreach ($theme->get_activity() as $activity) {
              foreach($activity->get_slot() as $slot){
                    $arr[]= ["id_activity"=> $activity->get_idActivity(), 
                    "idslot"=> $slot->get_idSlot(),
                    "color" => $theme->get_color(),
                    "dts" => $slot->get_slotDateTimeStart(),
                    "dte" => $slot->get_slotDateTimeEndFormat(),
                    "nTheme" => $theme->get_name(),
                    "nActivity" => $activity->get_name()];             
              }
          }
      }
      $collabView->setMyTheme($arr);
      $collabView->run("dashboard");
      break;
      
      case 7: //Mon compte
      $user = (new userDao())->getInfoCollab($_SESSION["id_user"]);
      $collabView = new CollabView();
      $collabView->setInfoUser($user);
      $collabView->run("infoUser");
      break;
      
      case 8://SoftSkill
        $softSkill = new SoftSkillView();
        $softSkill->run("");
        
      break;

      case 9://Job cible
       
        $jobCible = new JobCibleView();
        $jobCible->run("");
        
      break;

      case 10://Liste Eloce 
        $collabView = new CollabView();

        $themeDao = new themeDao;
        $themeList = $themeDao->getListTheme();
        $arr = [];
        foreach ($themeList as $theme) {
            foreach ($theme->get_activity() as $activity) {
                foreach($activity->get_slot() as $slot){

                  $participateNumber = $themeDao->getListParticipate($slot->get_slotDateTimeStart(),$activity->get_idActivity());
                  if ($participateNumber < $slot->get_maxNumberPerson()) {
                    $complete = true;
                  }else {
                    $complete = false;
                  }

                  $arr[]= ["id_activity"=> $activity->get_idActivity(), 
                      "idslot"=> $slot->get_idSlot(),
                      "color" => $theme->get_color(),
                      "dts" => $slot->get_slotDateTimeStart(),
                      "dte" => $slot->get_slotDateTimeEndFormat(),
                      "nTheme" => $theme->get_name(),
                      "nActivity" => $activity->get_name(),
                      "complete" => $complete];
                }
            }
        }
        $collabView->setTheme($arr);

        $collabView->run("ListELOCE");
      break;

      case 11: //inscription Créneaux
        $collabView = new CollabView();
        try {
          //Test si la personne est déjà inscrite
          if ((new ThemeDao())->checkSlotExist($_SESSION["id_user"],$_GET["idActivity"],$_SESSION["id_session"],$_GET["idSlot"])!=0) {
            throw new LisaeException("Erreur vous êtes déjà inscrit à ce créneaux", 1);
          }
          (new ThemeDao())->registrationActivity($_SESSION["id_user"],$_GET["idActivity"],$_SESSION["id_session"],$_GET["idSlot"]);
          echo "<html><script>window.alert('Vous vous êtes bien inscrit ce créneaux !');</script></html>";
          header('Refresh:0;url=../../index.php/collab/eloce');
        } catch (LisaeException $e) {
          echo "<html><script>window.alert('Erreur vous êtes déjà inscrit a ce créneaux !');</script></html>";
          //$collabView->run("ListELOCE",$e->render());
          header('Refresh:0;url=../../index.php/collab/eloce');
        }
      break;

      case 12: //info Creneaux
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
                    "dtsf" => $slot->get_slotDateTimeStartFormat(),
                    "dtef" => $slot->get_slotDateTimeEndFormat(),
                    "dts" => $slot->get_slotDateTimeStart(),
                    "dte" => $slot->get_slotDateTimeEnd(),
                    "nTheme" => $theme->get_name(),
                    "nActivity" => $activity->get_name(),
                    "information" => $slot->get_information(),
                    "place" => $slot->get_place(),
                    "idActivity" => $activity->get_idActivity(),
                    "image" => $activity->get_image(),
                    "description"=> $activity->get_description(),
                    "detailedDescription"=>$activity->get_detailedDescription()
                    ]
                    ;
                    //var_dump($slotInfo);
                  }
                }
            }
        } 
        $collabView->setInfoSlot($slotInfo);
        $collabView->setInfoSlotButton($slotInfo);
        $collabView->run("infoSlot");

      break;


      case 13:  // Modification du télephone
        if (isset($_POST['modifPhone'])){
          $user = new userDao;
          $user->updatePhone($_POST["phoneNumber"], $_SESSION["id_user"]);
          echo 'Votre numero de telephone à bien été modifié !';
          header('Refresh:2;url=../index.php/collab/info');// TO FIX WITH DAVID
        }

      break;

      case 14: // Modification mail
          $user = new userDao;
          $user->updateMail($_POST["mail"], $_SESSION["id_user"]);
          // Envoi du mail de confirmation
          $user->resetMail($_SESSION["id_user"]);  
          parent::sendMailConfirmation($_POST["mail"]);
          //Redirection
          echo 'Votre mail à bien été modifié, veuillez le confirmer en cliquant sur le lien recu par mail !';
          header('Location:../../../../index.php/collab/dashboard');

      break;

      case 15 : //Désinscription créneaux
        $collabView = new CollabView();
        try {
          $slot = (new SlotDao())->get($_GET["idslot"]);
          $dts = new DateTime($slot->get_slotDateTimeStart());

          $tz_object = new DateTimeZone('europe/paris');
          $now = new DateTime();
          $now->setTimezone($tz_object);

          if ($now > $dts->modify("+". $slot->get_unsubscribeDeadLine()."day")) {
            throw new LisaeException("Erreur, le délai de désinscription est dépassé, veuillez contactez l'animateur en cas d'urgence", 1);
          }else{
            (new ThemeDao())->deregistrationSlot($_SESSION["id_user"],$_SESSION["id_session"],$_GET["idActivity"],$_GET["idslot"]);
            echo "<html><script>window.alert('Vous vous êtes bien désinscrit !');</script></html>";
            header('Refresh:0;url=../../index.php/collab/dashboard');
          }
        } catch (LisaeException $e) {
          $collabView->run("dashboard",$e->render());
        }
        
      break;
    
      case 16 : //tri par activité
        $collabView = new CollabView();
        $themeList = (new ThemeDao())->getListTheme();
        $listActivity = [];
        foreach ($themeList as $theme) {
            foreach ($theme->get_activity() as $activity) {
                foreach($activity->get_slot() as $slot){
                  if ($activity->get_idActivity() == $_GET["id_activity"]) {
                    $activityList= [
                    "idslot"=> $slot->get_idSlot(),
                    "color" => $theme->get_color(),
                    "dtsf" => $slot->get_slotDateTimeStartFormat(),
                    "dts" => $slot->get_slotDateTimeStart(),
                    "dte" => $slot->get_slotDateTimeEnd(),
                    "dtef" => $slot->get_slotDateTimeEndFormat(),
                    "nTheme" => $theme->get_name(),
                    "nActivity" => $activity->get_name(),
                    "information" => $slot->get_information(),
                    "place" => $slot->get_place(),
                    "idActivity" => $activity->get_idActivity()
                    ]
                    ;
                    $listActivity[] = $activityList;
                  }
                }
            }
         
          }
          //var_dump($listActivity);
          $collabView->setListForActivity($listActivity);
          $collabView->run("listActivity");
          
                 
    }
  }
}
