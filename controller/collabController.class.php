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
      "registration" => 2
    ];
    parent::__construct();
  }

  public function run(): void
  {
    switch ($this->_case) {
      case 2:  // registrationCollab
    
          // On se place sur le bon formulaire grâce au "name" de la balise "input"
          if (isset($_POST['registration'])){
            try {
              $userForm =new UserForm($_POST);
              $collab =$userForm->createCollab();
              (new UserDao())->insert($collab);
              echo "Inscription réussie.. Redirection vers la page de connexion, veuillez patienter";
              header('Refresh:2;url=../../index.php');
              exit();
            } catch (LisaeException $e) {
              $errorMess = $e->render();
              (new RegistrationView())->run("collab", $errorMess);
              exit();
            }
          }else {
            (new RegistrationView())->run("collab");
          }

        break;

        
    }
  }
}
