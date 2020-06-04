<?php

class LoginController extends mainController {

    public function __construct()
    {
  /*       $this->_listUseCases=
    [
      "checkConnection" => 10
    ]; */
      parent::__construct();
    }

    public function run(): void
    {
        switch ($this->_case) {
                
               /*  case 10: //login  */
                  /* //var_dump($_POST['checkConnection']);
                  if (isset($_POST['checkConnection'])){
                    try {
                        $mail = htmlspecialchars($_POST["mail"]);
                        $password = sha1($_POST["password"]);
                        var_dump($mail, $password);
                        if (!empty($mail) and !empty($password)) {
                          $userDao = new UserDao();
                          $tab = $userDao->getSession($mail, $password);
                          $ckeckMail = $userDao->getConfirmationMail($mail);
                         
                              if ($tab['exist'] == 1) {
                                  if ($checkMail == true) {
                                      $_SESSION['id_user'] = $tab['id_user'];
                                      $_SESSION['mail'] = $tab['mail'];
                                      $_SESSION['password'] = $tab['password'];
                                      $_SESSION['role'] = $tab['role'];
                                      echo "Connexion réussie !";
                                  } else {
                                    throw new LisaeException("Le mail n'a pas été validé ! ");
                                  }
                              } else {
                                throw new LisaeException("Mauvais mot de passe ou mail !");
                                //echo '<script type="text/javascript">window.alert("Mauvais mot de passe ou pseudo !");</script>';
                                //header('Location:../index.php');
                              } 

                        } else {
                          throw new LisaeException("Veuillez remplir tous les champs !");
                        }
                      }  catch (LisaeException $e) {
                        $errorMess = $e->render();
                        (new LoginPageView())->run("",$errorMess);
                        exit();
                      }
                  } else {
                  (new LoginPageView())->run();
                  //header('Location:../index.php');
                  }
                  break;
          
        }
        
   } */

      // Verification de la confirmation du compte mail //
      private function checkConfirmation()
       {
           $confirmMail = false;
           
           $userDao = new UserDao();
           $result = $userDao->getConfirmationMail($_POST['mail']);
               if ($result = true) 
               {
                   $_confirmMail = true;
                   return $confirmMail;
               }else {
                   echo 'Veuillez confirmer votre adresse e-mail!' . 
                   $userForm = new UserForm($_POST);
                   $userForm->sendMailConfirmation();
               }
       }
}
