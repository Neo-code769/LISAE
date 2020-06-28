<?php
//
//Administrator Type

class AdminController extends MainController {
  public function __construct()
  {

    $this->_listUseCases=
    [
      "registration" => 31,
      "createTheme" => 32,
      "createActivity"=>33,
      "createFormation"=>34,
      "createSession"=>35,
      "accountManagement"=>36,
      "collabManagement"=>37,
      "animManagement"=>38,
      "dashboard"=>39,
      "listTheme" => 40,
      "infoTheme" => 41,
      "deleteCollab"=>42,
      "deleteAnim"=>43,
      "listActivity"=>44,
      "infoActivity"=>45,
      "listSession" => 46,
      "infoSession" => 47,
      "listTraining" => 48,
      "infoTraining" => 49,
      "sendLinkAnim"=>50,
      "sendLinkAdmin"=>51
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
          (new UserDao())->insertReferToTheme($_POST['referAnimator']);
          header("Location:../admin/listTheme");
        } else {
          $adminview = new AdminView();
          $adminview->setUserList((new UserDao())->listAnim());
          $adminview->run("createTheme");
        }
      break;

      //Creation d'activité
      case 33: 
        if (isset($_POST['createActivity'])){
          $activity = new Activity(null,$_POST['name'],$_POST['description'],$_POST['detailedDescription'],null);


          //Traitement image 
          //Recupération de fichier
          $image=$_FILES['image']['tmp_name']; // 1. on récupère notre input de type FILE
        
          $fichierUpload=basename($_FILES['image']['name']); // 2. fonction basename : indispensable pour récupérer le fichier uploadé
        
            $cheminUpload="./upload/$fichierUpload";
        
          if(move_uploaded_file($_FILES['image']['tmp_name'], $cheminUpload))
          {
            $destinationImg="images/$fichierUpload";
                copy($cheminUpload,$destinationImg);
                unlink($cheminUpload);
          }
          $activity->set_image("../../".$destinationImg);
          
          //var_dump($activity);
          (new ActivityDao())->insert($activity);
          (new ActivityDao())->insertRecurringActivity($_GET['idTheme']);
          
          //Redirection
          header("Location:../admin/listTheme");

        } else {
          $adminview = new AdminView();
          $adminview->run("createActivity");
        }
      break;

      //Creation de formation
      case 34: 
        if (isset($_POST['createFormation'])){
          (new SessionTrainingDao())->insertTraining($_POST["name"]);
          header("Location:../admin/listTraining");
        } else {
        $adminview = new AdminView();
        $adminview->run("createFormation");
        }
      break;
  
      case 35: //Creation de session
        if (isset($_POST['createSession'])) {
          $session = new SessionTraining(null,$_GET['nTraining']. " " . $_POST['sessionNumber'],$_POST['startDateFormation'],$_POST['endDateFormation']);
          $pae1 = new Pae(null,$_POST['startDatePae1'],$_POST['endDatePae1']);
          $pae2 = new Pae(null,$_POST['startDatePae2'],$_POST['endDatePae2']);
          $pae3 = new Pae(null,$_POST['startDatePae3'],$_POST['endDatePae3']);
          (new SessionTrainingDao())->insert($session);
          (new SessionTrainingDao())->insertPae($pae1);
          (new SessionTrainingDao())->insertPae($pae2);
          (new SessionTrainingDao())->insertPae($pae3);
          header("Location:../admin/listTraining");
        } else {
        $adminview = new AdminView();
        $adminview->run("createSession");
        }
      break; 

      //Gestion des comptes utilisateurs
      case 36: 
        $adminview = new AdminView();
        $adminview->run("accountManagement");
      break;

      //Gestion des comptes collaborateur
      case 37: 
        $adminview = new AdminView();
        $userDao = new UserDao;
        $collabList = $userDao->getCollab();
        $adminview->getListCollab($collabList);
        $adminview->run("collabManagement");
      break;

      //Gestion des comptes animateur
      case 38: 
        $adminview = new AdminView();
        $user = new UserDao;
        $animList = $user->getAnim();
        $adminview->getListAnim($animList);
        $adminview->run("animManagement");
      break;

      // Tableau de bord
      case 39: 
        $adminview = new AdminView();
        $adminview->run("dashboard");
      break;

      // liste des thèmes
      case 40:
        $adminview = new AdminView();
        $themeDao = new ThemeDao();
        $themeList = $themeDao->getListTheme();
        $adminview->setListTheme($themeList);
        $adminview->run("listTheme");
      break;
         
    //info theme
    case 41:
      if (isset($_POST['updateTheme'])){ 
        (new ThemeDao())->updateTheme($_POST["name"],$_POST["color"],$_POST["description"],$_POST["detailedDescription"],$_GET["idTheme"]);
       header('Location:../../index.php/admin/listTheme');
      } elseif (isset($_POST['deleteTheme'])) {
        (new ThemeDao())->delete($_GET["idTheme"]);
        (new ActivityDao())->deleteThemeActivity($_GET["idTheme"]);
        (new UserDao())->deleteThemeReferTo($_GET["idTheme"]);
        header('Location:../../index.php/admin/listTheme');
      } elseif (isset($_POST['createRefer'])) {
        (new UserDao())-> updateReferToTheme($_POST['idUser'],$_GET["idTheme"]);
        header('Refresh:0');
      }
      elseif (isset($_POST['deleteRefer'])) {
        (new UserDao())->deleteReferToTheme($_POST['idUser'],$_GET["idTheme"]);
        header('Refresh:0');
     } else {
       $adminview = new AdminView();
       
       //Récupération des informations pour le thème
       $themeDao = new ThemeDao();
       $listTheme = $themeDao->getListTheme();
       foreach( $listTheme as $theme) {
          if ($theme -> get_idTheme() == $_GET['idTheme']){
           $infoTheme = $theme;
         }
       }

      $animDao = new UserDao();

      //Récupération des informations pour la liste des référents
      $referentList = $animDao->listAnimForTheme($_GET['idTheme']);
      $animList=$animDao->listAnim();

      //VUE
      $adminview->setInfoAnim($animList,$referentList);
      $adminview->setInfoTheme($infoTheme);
      $adminview->run("infoTheme");
      }
     break;

      // Suppression Collaborateur
      case 42:
        $user = new UserDao;
        $user->deleteParticipate($_GET['idUser']);
        $user->deleteTie($_GET['idUser']);
        $user->delete($_GET['idUser']);
        echo 'Collaborateur Supprimer';
        header("Location:../admin/accountManagement");

      break;

      // Suppression Animateur
      case 43:
        $user = new UserDao;
        $user->deleteReferto($_GET['idUser']);
        $user->deleteHost($_GET['idUser']);
        $user->delete($_GET['idUser']);
        echo 'Animateur Supprimer';
        header("Location:../admin/accountManagement");

      break;


      //listActivity
      case 44:
        $listActivity=(new themeDao())->getListActivity($_GET['idTheme']);
        $adminview = new AdminView();
        $adminview->setListActivity($_GET['nTheme'],$listActivity,$_GET['colorTheme']);
        $adminview->run("listActivity");
        //echo "hey";
      break;

      //infoActivity
      case 45:
        if (isset($_POST['updateActivity'])){ //Bouton de modification
          //Traitement image 
          //Recupération de fichier
          $activity = new Activity($_GET["idActivity"],$_POST["name"],$_POST["description"],$_POST["detailedDescription"],null);
          $image=$_FILES['image']['tmp_name']; // 1. on récupère notre input de type FILE (ici, avec l'attribut name="ID")
          if ($image != "") {
            $fichierUpload=basename($_FILES['image']['name']); // 2. fonction basename : indispensable pour récupérer le fichier uploadé 
            $cheminUpload="./upload/$fichierUpload";
               if( move_uploaded_file($_FILES['image']['tmp_name'], $cheminUpload)){
                $destinationImg="images/$fichierUpload";
                copy($cheminUpload,$destinationImg);
                unlink($cheminUpload);
              }  
              $activity->set_image("../../".$destinationImg);  
          } else {
            $activity->set_image((new ActivityDao())->getImage($_GET['idActivity']));
          }
          (new ActivityDao())->updateActivity($activity);
          echo "<html><script>window.alert('La modification a bien était effectué !');</script></html>";
          header("refresh:0");
          
        } elseif (isset($_POST['deleteActivity'])) { //Bouton de suppression 
          //Delete participate
          (new UserDao())->deleteParticipateForActivity($_GET["idActivity"]);
          //Delete host
          (new UserDao())->deleteHostForActivity($_GET["idActivity"]);
          //Delete reccuring activity
          (new ActivityDao())->deleteReccuringActivity($_GET["idActivity"]);
          //Delete activity
          (new ActivityDao())->delete($_GET["idActivity"]);
          //header('Location:../../index.php/admin/listTheme');  
        }else{
          $adminview = new AdminView();
          $themeDao = new ThemeDao;
          $listTheme = $themeDao->getListTheme();
          foreach( $listTheme as $theme) {
            foreach( $theme->get_activity() as $activity) {
              if ($activity->get_idActivity() == $_GET['idActivity']){
                $infoActivity = $activity;
                $infoTheme = $theme;
              }
            }
          }
          //var_dump($infoTheme, $infoActivity);
          $adminview->setInfoActivity($infoTheme, $infoActivity);
          $adminview->run("infoActivity");
        }
      break;

      case 46: // list Session
        $adminview = new AdminView();
        $sessionDao = new SessionTrainingDao();
        $sessionList = $sessionDao->getListSession($_GET['nTraining']);
        $adminview->setListSession($sessionList);
        $adminview->run("listSession");  
      break;

      case 47: //info Session (+delete Update)  
        if (isset($_POST['updateSession'])){ 
          (new SessionTrainingDao())->updateSession($_POST["startDateFormation"],$_POST["endDateFormation"],$_POST["name"], $_GET["idSession"]);
          (new SessionTrainingDao())->updatePae($_POST['startDatePae1'],$_POST['endDatePae1'],$_POST['idPae1']);
          (new SessionTrainingDao())->updatePae($_POST['startDatePae2'],$_POST['endDatePae2'],$_POST['idPae2']);
          (new SessionTrainingDao())->updatePae($_POST['startDatePae3'],$_POST['endDatePae3'],$_POST['idPae3']);
          echo "<html><script>window.alert('La modification est bien était effectué !');</script></html>";
          header("refresh:0");
          } elseif (isset($_POST['deleteSession'])) {
            (new SessionTrainingDao())->deleteParticipateForSession($_GET["idSession"]);
            (new SessionTrainingDao())->deletePae($_GET["idSession"]);
           (new SessionTrainingDao())->delete($_GET["idSession"]);
           (new SessionTrainingDao())->deletePae($_GET["idSession"]);          
           header('Location:../../index.php/admin/listTraining');     
        } else {  
         $adminview = new AdminView();
         $sessionDao = new SessionTrainingDao();
         $sessionList = $sessionDao->getListSession($_GET['nTraining']);
         $paeDao = new SessionTrainingDao();
         $paeList = $paeDao->getListPae($_GET['idSession']);
         foreach( $sessionList as $session) {
              if($session->getIdSession() == $_GET['idSession']){
                $infoSession = $session;
              }
          }
        $adminview->setInfoSessionPae($infoSession,$paeList);
        $adminview->run("infoSession");
      }
       break;

       case 48 : // list Formation
        $adminview = new AdminView();
        $trainingDao = new SessionTrainingDao();
        $trainingList = $trainingDao->getListTraining();
        $adminview->setListTraining($trainingList);
        $adminview->run("listTraining");  
      break;

      case 49: // info training
        if (isset($_POST['updateTraining'])){ 
          (new SessionTrainingDao())->updateTraining($_POST["name"], $_GET["idTraining"]);
          echo "<html><script>window.alert('La modification est bien était effectué !');</script></html>";
          header("refresh:0");
          } elseif (isset($_POST['deleteTraining'])) {
           (new SessionTrainingDao())->deleteTraining($_GET["idTraining"]);
           header('Location:../../index.php/admin/listTraining');    
          }else {
        $adminview = new AdminView();
        $trainingDao = new SessionTrainingDao();
        $trainingList = $trainingDao->getListTraining();
        foreach( $trainingList as $training) {
         if ($training["id_training"] == $_GET['idTraining']){
           $infoTraining = $training;
         }
       }  
        $adminview->setInfoTraining($infoTraining);
        $adminview->run("infoTraining");
      }
      break;

      default:
      (new LoginPageView())->run($content="");
        throw new LisaeException("Erreur");
      break;

      case 50: //lien a envoyé a l'animateur pour création compte
        if (isset($_POST['sendLinkAnim'])){
            $this->sendLinkAnim($_POST['mail']);
            echo 'Le lien a bien été envoyé pour la création de son compte';
            header('Location:../../index.php/admin/animManagement');
            exit();
        }else {
          $link = new AdminView();
          $link->run("sendLinkAnim");
        }
        break;
    
    case 51: //lien a envoyé a l'admin pour création compte
      if (isset($_POST['sendLinkAdmin'])){
          $this->sendLinkAdmin($_POST['mail']);
          echo 'Le lien a bien été envoyé pour la création de son compte';
          header('Location:../../index.php/admin/animManagement');
          exit();
      }else {
        $link = new AdminView();
        $link->run("sendLinkAdmin");
      }
      break;
    }
  }
  public function sendLinkAnim($emails) {
    try{
        $mail= new PHPMailer\PHPMailer\PHPMailer();
    
        $mail->isSMTP(); // Paramétrer le Mailer pour utiliser SMTP 
        $mail->Host = 'smtp.gmail.com'; // Spécifier le serveur SMTP
        $mail->SMTPAuth = true; // Activer authentication SMTP
        $mail->Username = 'contact.afpa.lisae@gmail.com'; // Votre adresse email d'envoi
        $mail->Password = 'AR3n96f4aQ'; // Le mot de passe de cette adresse email
        $mail->SMTPSecure = 'ssl'; // Accepter SSL
        $mail->Port = 465; 
    
        $mail->setFrom('contact.afpa.lisae@gmail.com', 'AFPA LISAE');
        $mail->addAddress($emails);  // Personnaliser l'adresse d'envoi  
        $mail->addReplyTo('contact.afpa.lisae@gmail.com', 'Information'); // L'adresse de réponse
        $message ="Création de votre compte d'animateur sur LISAE";
        $mail->Subject = utf8_decode($message);
        $link = "http://lisae.alafpa.fr/index.php/anim/registration";
        //$link = "http://www.lisae.fr:8081/index.php/anim/registration";
        $messageLink = "Cliquez sur ce lien pour accèder au formulaire de création de votre compte <br><br>";
        $mail->Body = utf8_decode($messageLink) . $link; // Creation page: "LISAE/registration/confirm-registration"
        $mail->isHTML(true);
        $mail->setLanguage('fr');
    
        if ($mail->send()) {
            echo 'Confirmation Message has been sent.';
        }else {
            echo 'Message was not sent.<br>';
            echo 'Mailer error: ' . $mail->ErrorInfo; 
        }
    
    } catch (Exception $e) {
        var_dump($e->getLine());
        throw new LisaeException("ERROR" . $e->getLine());
    }
  }

  public function sendLinkAdmin($emails) {
    try{
        $mail= new PHPMailer\PHPMailer\PHPMailer();
    
        $mail->isSMTP(); // Paramétrer le Mailer pour utiliser SMTP 
        $mail->Host = 'smtp.gmail.com'; // Spécifier le serveur SMTP
        $mail->SMTPAuth = true; // Activer authentication SMTP
        $mail->Username = 'contact.afpa.lisae@gmail.com'; // Votre adresse email d'envoi
        $mail->Password = 'AR3n96f4aQ'; // Le mot de passe de cette adresse email
        $mail->SMTPSecure = 'ssl'; // Accepter SSL
        $mail->Port = 465; 
    
        $mail->setFrom('contact.afpa.lisae@gmail.com', 'AFPA LISAE');
        $mail->addAddress($emails);  // Personnaliser l'adresse d'envoi  
        $mail->addReplyTo('contact.afpa.lisae@gmail.com', 'Information'); // L'adresse de réponse
        $message ="Création de votre compte d'administrateur sur LISAE";
        $mail->Subject = utf8_decode($message);
        $link = "http://lisae.alafpa.fr/index.php/admin/registration";
        //$link = "http://www.lisae.fr:8081/index.php/anim/registration";
        $messageLink = "Cliquez sur ce lien pour accèder au formulaire de création de votre compte <br><br>";
        $mail->Body = utf8_decode($messageLink) . $link; // Creation page: "LISAE/registration/confirm-registration"
        $mail->isHTML(true);
        $mail->setLanguage('fr');
    
        if ($mail->send()) {
            echo 'Confirmation Message has been sent.';
        }else {
            echo 'Message was not sent.<br>';
            echo 'Mailer error: ' . $mail->ErrorInfo; 
        }
    
    } catch (Exception $e) {
        var_dump($e->getLine());
        throw new LisaeException("ERROR" . $e->getLine());
    }
  }

}

