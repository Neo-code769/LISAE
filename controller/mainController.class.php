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
    if (session_status() == PHP_SESSION_NONE) {
      session_start();
    }
    if (array_key_exists('PATH_INFO', $_SERVER)) {
      $urlLinks = explode("/", $_SERVER['PATH_INFO']); // renvoie l'array avec : l'espace,du controller et du case de ma page et fait la concaténation avec le / (ex: collab/dashboard)
      $contStr = $urlLinks[count($urlLinks) - 2]; // renvoie le nom de mon controller (ex : collab)
      $this->_class = $contStr . self::CONTROLLER_SUFF; // renvoie le nom complet de mon controller (ex : collabController)
      $caseStr = $urlLinks[count($urlLinks) - 1]; //renvoie le nom de mon case (ex:dashboard)
      $this->_case = $this->_listUseCases[$caseStr]; // $this->listUsesCases = renvoie l'array des cases dans ce controller(ex :nom et chiffre des cases de mon collabController), $this->case = renvoie le chiffre du case de la page (ex : 6)
      // ex : 6 = va chercher dans l'array des cases le chiffre qui correspond au case[dashboard];
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
                $tab = $userDao->getSessionUser($mail, $password);
                $checkMail = $userDao->getConfirmationMail($mail);
                    if ($tab['exist'] == 1) {
                        if ($checkMail == 1) {
                            $_SESSION['id_user'] = $tab['id_user'];
                            $_SESSION['mail'] = $tab['mail'];
                            $_SESSION['password'] = $tab['password'];
                            $_SESSION['role'] = $tab['role'];
                           if ($_SESSION['role'] == 'Collaborator')
                            {
                              $promo= (new SessionTrainingDao())->getSession($_SESSION['id_user']);
                              $_SESSION['id_session'] = $promo->getIdSession(); 
                              $_SESSION['session_name'] = $promo->get_nameSession(); 
                              header('Location:../../index.php/collab/dashboard');
                              exit();
                            } elseif ($_SESSION['role'] == 'Animator')
                            {
                              $theme=(new ThemeDao())->getThemeForAnimator($_SESSION['id_user']);
                              if ($theme[0]>0) {
                                for ($i=1; $i < count($theme); $i++) { 
                                  $_SESSION['IdTheme'][] = $theme[$i]->get_idTheme();
                                  $_SESSION['NameTheme'][] = $theme[$i]->get_name();
                                }
                              }
                              header('Location:../../index.php/anim/dashboard');
                              exit();
                            }
                            elseif ($_SESSION['role'] == 'Admin');
                            {
                              $theme=(new ThemeDao())->getThemeForAnimator($_SESSION['id_user']);
                              if ($theme[0]>0) {
                                for ($i=1; $i < count($theme); $i++) { 
                                  $_SESSION['IdTheme'][] = $theme[$i]->get_idTheme();
                                  $_SESSION['NameTheme'][] = $theme[$i]->get_name();
                                }
                              }
                              header('Location:../../index.php/anim/dashboard');
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
          $link = "http://lisae.alafpa.fr/view/registration/confirm-registration.php?mail=" . $email; 
          //$link = "http://www.lisae.fr:8081/view/registration/confirm-registration.php?mail=" . $email; //script".'?verification_code='.urlencode($user_activation_hash); // verification code exemple
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

