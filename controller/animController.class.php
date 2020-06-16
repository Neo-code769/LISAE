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
      "export"=>26,
      "createSlot" => 25
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
                      $arr[]= ["id_activity"=> $activity->get_idActivity(), 
                      "idslot"=> $slot->get_idSlot(),
                      "color" => $theme->get_color(),
                      "dts" => $slot->get_slotDateTimeStart(),
                      "dte" => $slot->get_slotDateTimeEnd(),
                      "nTheme" => $theme->get_name(),
                      "nActivity" => $activity->get_name()];             
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
                      "dte" => $slot->get_slotDateTimeEnd(),
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
              $animView = new AnimatorView();
              $createslot = [];
              (new SlotDao())->insert($createslot);
              $animView->run("createSlot");
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
        $allData = $export->getPresence();

        fwrite($fichier,$allData);
        fclose($fichier);
        
        readfile($chemin);
    }
  }
}
