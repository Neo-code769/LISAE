<?php
/*
* Controller 
*/
class MainController
{
  const CONTROLLER_SUFF = "Controller";
  protected $_listUseCases;
  protected $_case = 1;
  protected $_class = null;

  public function __construct()
  {
    /*var_dump($_SERVER['PATH_INFO']);*/
    if (array_key_exists('PATH_INFO', $_SERVER)) {
      $urlLinks = explode("/", $_SERVER['PATH_INFO']);
      $contStr = $urlLinks[count($urlLinks) - 2];
      $this->_class = $contStr . self::CONTROLLER_SUFF;
      $caseStr = $urlLinks[count($urlLinks) - 1];
      $this->_case = $this->_listUseCases[$caseStr];
    }
  }

  public function getClassName()
  {
    return $this->_class == null ? get_class() : $this->_class;
  }

  public function run(): void
  {
    switch ($this->_case) {
      case 1:
        
        if (isset($_POST['checkConnection'])){
          try {
              $mail = htmlspecialchars($_POST["mail"]);
              $password = sha1($_POST["password"]);
              if (!empty($mail) and !empty($password)) {
                $userDao = new UserDao();
                $tab = $userDao->getSession($mail, $password);
                $checkMail = $userDao->getConfirmationMail($mail);
                    if ($tab['exist'] == 1) {
                        if ($checkMail == 1) {
                            $_SESSION['id_user'] = $tab['id_user'];
                            $_SESSION['mail'] = $tab['mail'];
                            $_SESSION['password'] = $tab['password'];
                            $_SESSION['role'] = $tab['role'];
                           if ($_SESSION['role'] == 'Collaborator')
                            {
                              header('Location:../../index.php/collab/dashboard');
                              exit();
                            } elseif ($_SESSION['role'] == 'Animator')
                            {
                              header('Location:../../index.php/anim/dashboard');
                              exit();
                            }
                            elseif ($_SESSION['role'] == 'Admin');
                            {
                              header('Location:../../index.php/admin/dashboard');
                              exit();
                            } 
                        } else {
                          $this->sendMailConfirmation($mail);
                          throw new LisaeException("Le mail n'a pas été validé ! Un mail vient de vous être renvoyé !");
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
        (new LoginPageView())->run("");
        //header('Location:../index.php');
        }
        break;
      case 2:
        (new forgotPasswordView())->run($content="");
        break;

      default:
        throw new LisaeException("ERR_CONTROLLER_USE_CASE");
    }
  }

  public function sendMailConfirmation($email) 
  {
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
          $mail->addAddress($email);  // Personnaliser l'adresse d'envoi  
          $mail->addReplyTo('contact.afpa.lisae@gmail.com', 'Information'); // L'adresse de réponse
          $mail->Subject = 'Confirmation de votre Mail - AFPA-LISAE';
          $link = "http://www.lisae.fr:8081/view/registration/confirm-registration.php?mail=" . $email; //script".'?verification_code='.urlencode($user_activation_hash); // verification code exemple
          $mail->Body = "Veuillez confirmer votre adresse en mail en cliquant sur ce lien:<br><br>". ' '.$link; // Creation page: "LISAE/registration/confirm-registration"
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

