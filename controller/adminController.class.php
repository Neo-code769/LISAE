<?php
/*
* Administrator Type
*/

class AdminController extends MainController
{

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
      "deleteCollab"=>40,
      "deleteAnim"=>41,
      "listTheme" => 42,
      "listActivity"=>43
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
          var_dump($theme);
          (new ThemeDao())->insert($theme);
          (new UserDao())->insertReferToTheme($_POST['referAnimator']);
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
          $image=$_FILES['image']['tmp_name']; // 1. on récupère notre input de type FILE (ici, avec l'attribut name="ID")
        
          $fichierUpload=basename($_FILES['image']['name']); // 2. fonction basename : indispensable pour récupérer le fichier uploadé
        
            $cheminUpload="./upload/$fichierUpload";
        
          if(move_uploaded_file($_FILES['image']['tmp_name'], $cheminUpload))
          {
            $destinationImg="./images/$fichierUpload";
                copy($cheminUpload,$destinationImg);
                unlink($cheminUpload);
          }
          $activity->set_image($destinationImg);
          
          //var_dump($activity);
          (new ActivityDao())->insert($activity);
          (new ActivityDao())->insertRecurringActivity($_GET['idTheme']);
          
          //Redirection
          header("Location:../../admin/Dashboard");

        } else {
          $adminview = new AdminView();
          $adminview->run("createActivity");
        }
      break;

      //Creation de formation
      case 34: 
        $adminview = new AdminView();
        $adminview->run("createFormation");
      break;

      //Creation de session
      case 35: 
        $adminview = new AdminView();
        $adminview->run("createSession");
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
        $result = $adminview->getListCollab($collabList);

        /*if (isset($_POST['deleteUser'])){
          $users= $userDao->getCollab();
            foreach ($users as $user) {
              $idUsers[] = $user['id_user'];
            }
          if(isset($_POST['check'])) {
            foreach($_POST['check'] as $idUser){
              $userDao->delete($user);
            } 
          }
          header("Refresh:0;");
        }*/
        
        $adminview->run("collabManagement");
      break;

      //Gestion des comptes animateur
      case 38: 
        $adminview = new AdminView();
        $user = new UserDao;
        $animList = $user->getAnim();
        $result = $adminview->getListAnim($animList);

        if (isset($_POST['deleteUser'])){
          foreach($_POST['check'] as $user['id_user']){
            $user->delete($user['id_user']);
          }
        }

        $adminview->run("animManagement");
      break;

      // Tableau de bord
      case 39: 
        $adminview = new AdminView();
        $adminview->run("dashboard");
      break;

      // Suppression Collaborateur
      case 40:
        $user = new UserDao;
        $user->deleteParticipate($_GET['idUser']);
        $user->deleteTie($_GET['idUser']);
        $user->delete($_GET['idUser']);
        echo 'Collaborateur Supprimer';
        header("Location:../admin/accountManagement");

      break;

      // Suppression Animateur
      case 41:
        $user = new UserDao;
        $user->deleteReferto($_GET['idUser']);
        $user->deleteHost($_GET['idUser']);
        $user->delete($_GET['idUser']);
        echo 'Animateur Supprimer';
        header("Location:../admin/accountManagement");

      break;
      
      // liste des thèmes
      case 42:
        $adminview = new AdminView();
        $themeDao = new ThemeDao();
        $themeList = $themeDao->getListTheme();
        $adminview->setListTheme($themeList);
        $adminview->run("listTheme");
      break;

      //listActivity
      case 43:
        $listActivity=(new themeDao())->getListActivity($_GET['idTheme']);
        $adminview = new AdminView();
        $adminview->setListActivity($_GET['nTheme'],$listActivity,$_GET['colorTheme']);
        $adminview->run("listActivity");
        //echo "hey";
      break;


      default:
      (new LoginPageView())->run($content="");
        throw new LisaeException("Erreur");
      break;
    }

  }
}
