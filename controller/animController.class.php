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
      "dashboard" => 22,
      "info" => 23,
      "eloce"=>24,
      "createSlot" => 25,
      "export"=>26,
      "infoSlot"=>27,
      "infoSlotEloce"=>28,
      "presence"=>29, 
      "emargement"=>30
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
        $animView = new AnimatorView();
        $themeDao = new themeDao;
        $themeList = $themeDao->getMyListThemeAnim($_SESSION["id_user"]);
        $arr = [];
        foreach ($themeList as $theme) {
            foreach ($theme->get_activity() as $activity) {
              foreach($activity->get_slot() as $slot){

                $participateNumber = $themeDao->getListParticipate($slot->get_slotDateTimeStart(),$activity->get_idActivity())."/".$slot->get_maxNumberPerson();
                

                $arr[]= ["id_activity"=> $activity->get_idActivity(), 
                    "idslot"=> $slot->get_idSlot(),
                    "color" => $theme->get_color(),
                    "dts" => $slot->get_slotDateTimeStart(),
                    "dte" => $slot->get_slotDateTimeEndFormat(),
                    "nTheme" => $theme->get_name(),
                    "nActivity" => $activity->get_name(),
                    "participateNumber" => $participateNumber];
              }
            }
        }
        $animView->setMyTheme($arr);
        $animView->run("dashboard");
      break;

    
      case 23:
        $user = (new userDao())->getInfo($_SESSION["id_user"]);
        $animView = new AnimatorView();
        $animView->setInfoUser($user);
        $animView->run("infoUser");
        break;

      case 24://Liste Eloce 
        $animView = new AnimatorView();

        $themeDao = new themeDao;
        $themeList = $themeDao->getListTheme();
        $arr = [];
        foreach ($themeList as $theme) {
            foreach ($theme->get_activity() as $activity) {
                foreach($activity->get_slot() as $slot){
                    $participateNumber = $themeDao->getListParticipate($slot->get_slotDateTimeStart(),$activity->get_idActivity());
                    if ($participateNumber < $slot->get_maxNumberPerson()) {
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
        }
        $animView->setTheme($arr);

        $animView->run("ListELOCE");
      break;

      case 25: //creation d'un créneau
         if (isset($_POST['createSlot'])){
          try {
            if ((new ThemeDao())->checkSlotExistAnim($_POST["activityName"], $_POST["slotDateStart"])!=0) {
              throw new LisaeException("Erreur vous avez déjà crée ce créneaux d'activité", 1);
            } elseif ($_POST["slotDateStart"] > $_POST["slotDateEnd"] ) {
              throw new LisaeException("Erreur dates incorrectes", 1);
            } else { $slot = new Slot(null,$_POST["registrationDeadline"], $_POST["unsubscribeDeadline"], $_POST["place"], $_POST["information"], $_POST["slotDateStart"],$_POST["slotDateEnd"], $_POST["minNumberPerson"], $_POST["maxNumberPerson"]);
              (new SlotDao())->insertSlot($slot,$_SESSION["id_user"], $_POST["activityName"]);
              echo "Création réussie.. Redirection vers la page de connexion, veuillez patienter";
              header('Refresh:2;url=../../index.php/anim/dashboard');
            }
          } catch (LisaeException $e) {
            $errorMess = $e->render();
            $animView = new AnimatorView();
            $animView->setActivityList((new ActivityDao())->getActivityList());
            $animView->run("createSlot", $errorMess); 
            exit();
          }  
        }else {
            $animView = new AnimatorView();
            $animView->setActivityList((new ActivityDao())->getActivityList());
            $animView->run("createSlot");
      }
      
      break;

      case 26:

        $chemin="output/presence.csv";
        $nomFichier="presence.csv";
        $headers1 = ["AFPA", "BALMA"];
        $blank = [""];
        $headers2 = ["THEME", "ACTIVITE", "DATE", "\n"];
        $user = ["NOM", "PRENOM", "TELEPHONE", "SESSION", "PRESENCE"];
          header("Content-Type: text/csv"); 
          header("Content-disposition: attachment; filename=$nomFichier");
        $fichier = fopen($chemin, "w"); 
        
        $themeList = (new ThemeDao())->getListTheme();
        $arr = [];
        foreach ($themeList as $theme) {
            foreach ($theme->get_activity() as $activity) {
                foreach($activity->get_slot() as $slot){
                  if ($slot->get_idSlot() == $_GET["id_slot"]) {
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
                    "idActivity" => $activity->get_idActivity()
                    ]
                    ;
                    //var_dump($slotInfo);
                  }
                }
            }
        } 
        
        $export = new PresenceDao();
        $allData = $export->getPresence($_GET['id_slot']);

        fputcsv($fichier, $headers1);
        fputcsv($fichier, $headers2);
        fwrite($fichier,$slotInfo["nTheme"]. ",");
        fwrite($fichier,$slotInfo["nActivity"] . ",");
        fwrite($fichier, $slotInfo['dts'] . "\n");
        fputcsv($fichier, $blank);
        fputcsv($fichier, $user);
        fwrite($fichier,$allData);
        fclose($fichier);
        
        readfile($chemin);

      break;

      case 27: //infoSlot
        if (isset($_POST["deleteSlot"])) {
          (new SlotDao())->deleteSlotParticipate($_GET["idSlot"]);
          (new SlotDao())->deleteSlotHost($_GET["idSlot"]);
          header('Location:../../index.php/anim/dashboard');
        } else {
          $animView = new AnimatorView();
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
                      "idActivity" => $activity->get_idActivity()
                      ]
                      ;
                      //var_dump($slotInfo);
                    }
                  }
              }
          }
          
        $animView->setInfoSlot($slotInfo);
        $animView->setInfoSlotButton($slotInfo);
        $animView->run("infoSlot");
      }
      break;

      case 28 : // infoSlotEloce
        $animView = new AnimatorView();
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
                    "idActivity" => $activity->get_idActivity()
                    ]
                    ;
                    //var_dump($slotInfo);
                  }
                }
            }
        } 
        $animView->setInfoSlot($slotInfo);
        $animView->setInfoSlotButton($slotInfo);
        $animView->run("infoSlotEloce");
        break;

      case 29: //Presence
        $animView = new AnimatorView();

        //Pour l'affichage de l'info
        $themeList = (new ThemeDao())->getListTheme();
        $arr = [];
        foreach ($themeList as $theme) {
            foreach ($theme->get_activity() as $activity) {
                foreach($activity->get_slot() as $slot){
                  if ($slot->get_idSlot() == $_GET["id_slot"]) {
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
                    "idActivity" => $activity->get_idActivity()
                    ]
                    ;
                    //var_dump($slotInfo);
                  }
                }
            }
        } 
        $animView->setInfoSlot($slotInfo);

        $presenceDao= new PresenceDao();
        //Pour Affichage du tableau de présence
        $animView->setPresence($presenceDao->getTabPresence($_GET["id_slot"]));

        //Pour update la table participate et valider les présents

        if (isset($_POST['checkPresence'])){

          $users=$presenceDao->getTabPresence($_GET["id_slot"]);
          foreach ($users as $user) {
            $idUsers[] = $user['id_user'];
          }
          if(isset($_POST['check'])){
            $idUsersNoCheck = array_diff($idUsers,$_POST['check']);
          }else{$idUsersNoCheck=$idUsers;}            
          
          //var_dump($idUsersNoCheck);

          if(isset($_POST['check'])){
            foreach($_POST['check'] as $idUser){
              $presenceDao->updatePresence($idUser, $_GET['id_slot']);
            }
          }
          foreach($idUsersNoCheck as $idUser){
            $presenceDao->updatePresenceNo($idUser, $_GET['id_slot']);
          }
          header("Refresh:0;");
        }
        
        $animView->run("presence");
        break;

        case 30: // Feuille d'emargement

          $animView = new AnimatorView();

          //Pour l'affichage de l'info
          $themeList = (new ThemeDao())->getListTheme();
          $arr = [];
          foreach ($themeList as $theme) {
              foreach ($theme->get_activity() as $activity) {
                  foreach($activity->get_slot() as $slot){
                    if ($slot->get_idSlot() == $_GET["id_slot"]) {
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
                      "idActivity" => $activity->get_idActivity()
                      ]
                      ;
                      //var_dump($slotInfo);
                    }
                  }
              }
          } 
          $animView->setInfoSlot($slotInfo);

          //Pour Affichage du tableau de présence
          $animView->setEmargement((new PresenceDao())->getTabPresence($_GET["id_slot"]));

          $animView->run("emargement");

        break;
    }
  }
}
