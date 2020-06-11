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
      "deregistrationSlot"=>15
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
      //$collabView->setInfoUser($user);
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
          (new ThemeDao())->registrationActivity($_SESSION["id_user"],$_GET["idActivity"],$_SESSION["id_session"],$_GET["idSlot"]);
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
                    "dtsf" => $slot->get_slotDateTimeStartFormat(),
                    "dts" => $slot->get_slotDateTimeStart(),
                    "dte" => $slot->get_slotDateTimeEnd(),
                    "nTheme" => $theme->get_name(),
                    "nActivity" => $activity->get_name(),
                    "information" => $slot->get_information(),
                    "place" => $slot->get_place(),
                    "idActivity" => $activity->get_idActivity()
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
        if (isset($_POST['modifMail'])){
          $user = new userDao;
          $user->updateMail($_POST["mail"], $_SESSION["id_user"]);
          echo 'Votre mail à bien été modifié, veuillez le confirmer en cliquant sur le lien recu par mail !';
          header('Location:../../index.php');
          // Envoi du mail de confirmation
          $user->resetMail($_SESSION["id_user"]);  
          $userForm->sendMailConfirmation($_POST["mail"]);
        }

      break;

      case 15 : //Désinscription créneaux
        $collabView = new CollabView();
        try {
          (new ThemeDao())->deregistrationSlot($_SESSION["id_user"],$_SESSION["id_session"],$_GET["idActivity"],$_GET["idslot"]);
          header('Location:../../index.php/collab/eloce');
        } catch (LisaeException $e) {
          $collabView->run("ListELOCE",$e->render());
        }
        
      break;

    }
  }
}
