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
      "infoSlot"=>27
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
              //header('Refresh:2;url=../../index.php/anim/dashboard');
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

        /*$conn = new mysqli(host: "localhost", username: "root" , password: "", dbname:"lisae");
        $allData =  "";
        $sql = $conn->query("SELECT `name`, `participate.slotDateStart`, `Lastname`, `Firstname`, `PhoneNumber`, `presence` FROM activity 
        INNER JOIN participate ON activity.id_activity = participate.id_activity 
        INNER JOIN users ON participate.id_user = users.id_user 
        INNER JOIN host ON users.id_user = host.id_user");

        while($data = $sql->fetch_assoc())
          $allData .= $data['name'] . ',' . $data['slotDateStart'] . "," . $data['Lastname'] . "," . $data['Firstname'] . "," . $data['PhoneNumber']. "," . $data['presence'] . "\n";

        $response = "data:text/csv;charset=utf-8,NAME,SLOTDATE,LASTNAME,FIRSTNAME,PHONE,PRESENCE\n";
        $response .= $allData;

        echo '<a href="'.$response.'" download="presence.csv">Download</a>';*/

        $chemin="PHP://output";
        $nomFichier="presence.csv";
          header("Content-Type: text/csv"); //application/force-download
          header("Content-disposition: attachment; filename=$nomFichier");
        $fichier = fopen($chemin, "w");

            // Insert the UTF-8 BOM in the file
            fputs($fichier, $bom =( chr(0xEF) . chr(0xBB) . chr(0xBF) ));

        $export = new PresenceDao();
        $allData = $export->getPresence($_GET['idSlot']);

        fwrite($fichier,$allData);
        fclose($fichier);
        
        readfile($chemin);
      break;

      case 27: //infoSlot
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
        break;
    }
  }
}
