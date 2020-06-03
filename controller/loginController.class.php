<?php

class LoginController extends mainController {

    public function __construct()
    {
        $this->_listUseCases=
    [
      "checkConnection" => 10
    ];
      parent::__construct();
    }

    public function run(): void
    {
        switch ($this->_case) {
                
                case 10: //login 
                    $mail = htmlspecialchars($_POST["mail"]);
                    $password = sha1($_POST["password"]);
                    if (!empty($mail) and !empty($password)) {
                      $userDao = new UserDao();
                      $tab = $userDao->getSession($mail, $password);
                      //var_dump($tab);
            
                      if ($tab['exist'] == 1 && checkConfirmation() == true) {
                        $_SESSION['id_user'] = $tab['id_user'];
                        $_SESSION['mail'] = $tab['mail'];
                        $_SESSION['password'] = $tab['password'];
                        $_SESSION['role'] = $tab['role'];
                        echo '<script type="text/javascript">window.alert("Connexion réussie !");</script>';
                        (new LoginPageView())->run();
                      } else {
                        echo '<script type="text/javascript">window.alert("Mauvais mot de passe ou pseudo !");</script>';
                        (new LoginPageView())->run();
                        //header('Location:../index.php');
                      }
                    } else {
                      echo '<script type="text/javascript">window.alert("Tous le champs doivent être complétés !");</script>';
                      (new LoginPageView())->run();
                      //header('Location:../index.php');
                    }
                    break;
          
                default:
                  throw new LisaeException("Erreur");
        }
        
   }

      // Verification de la confirmation du compte mail //
      private function checkConfirmation()
       {
           $confirmMail = false;
           
           $userDao = new UserDao();
           $result = $userDao->getConfirmationMail();
               if ($result = true) 
               {
                   $_confirmMail = true;
                   return $confirmMail;
               }else {
                   echo 'Veuillez confirmer votre adresse e-mail! <a>' . $this->sendMailConfirmation(); . 'Cliquez sur ce lien pour renvoyer un e-mail de confirmation </a>';
               }
       }
}
