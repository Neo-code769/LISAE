<?php
/*
* Collaborator Type
*/

class PasswordController extends MainController
{

  public function __construct()
  {
    $this->_listUseCases=
    [
      //Collab 
      "reset" => 2,
      "change" => 3,
      "logout" => 4
    ];
    parent::__construct();
  }

  public function run(): void
  {
    switch ($this->_case) {
      case 2:  // forgotPassword
          // On se place sur le bon formulaire grâce au "name" de la balise "input"
          if (isset($_POST['forgotPassword'])){
            try {
              $userDao = new UserDao();
              $mail = $userDao->getMail($_POST['mail']);
              if($mail==null) {
                throw new LisaeException("Le mail n'existe pas");
              } else {
              $this->sendMailPassword($_POST['mail']);
              echo 'Un lien vous a été envoyé par mail pour changer de mot de passe';
              header('Refresh:2;url=../../index.php');
              exit();
              }
            } catch (LisaeException $e) {
              $errorMess = $e->render();
              $regView = new ForgotPasswordView();
              $regView->run("", $errorMess);
              exit();
            }
          }else {
            $password = new ForgotPasswordView();
            $password->run("");
          }

      break;

      case 3: // changePassword

        if (isset($_POST['changePassword'])) {
          try {
            if($_POST['password'] == $_POST['password2']) {
              $password = sha1($_POST["password"]);
              $userDao = new UserDao();
              $userDao->changePassword($password, $_GET['mail']);
              echo 'Mot de passe modifié!';
              //header('Refresh:2;url=../../index.php');
            }else {
              throw new LisaeException('Les mots de passe ne correspondent pas!');
            }
          }catch (LisaeException $e) {
            $errorMess = $e->render();
            $regView = new ChangePasswordView();
            $regView->run("", $errorMess);
            exit();
          }
        }else {
          $password = new ChangePasswordView();
          $password->run("");
        }
      break;

    case 4: //Logout
      $_SESSION = array();
      unset($_SESSION['id_user']);
      unset($_SESSION['mail']);
      unset($_SESSION['password']);
      unset($_SESSION['role']);
      unset($_SESSION['id_session']);
      unset($_SESSION['session_name']);
      unset($_SESSION['IdTheme']);
      unset($_SESSION['NameTheme']);
      session_destroy();
      header('Location:../../index.php');
    break;
  

  }
  }
  public function sendMailPassword($email) {
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
        $mail->Subject = 'Changement de mot de passe - AFPA-LISAE';
        $link = "http://lisae.alafpa.fr/index.php/password/change?mail=" . $email;
        //$link = "http://www.lisae.fr:8081/index.php/password/change?mail=" . $email;
        $mail->Body = "Cliquez sur ce lien pour changer votre mot de passe <br><br>" . $link; // Creation page: "LISAE/registration/confirm-registration"
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
