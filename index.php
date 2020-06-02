<?php
// typer les fcts
declare(strict_types=1);

// Liste des classes dans l'ordre des dépendances.

//require_once 'conf.php'; TODO

require_once 'model/user.class.php';
require_once 'model/activity.class.php';
require_once 'model/animator.class.php';
require_once 'model/admin.class.php';
require_once 'model/collaborator.class.php';
require_once 'model/session.class.php';
require_once 'model/slot.class.php';
require_once 'model/theme.class.php';
require_once 'model/training.class.php';

require_once 'exception/LisaeException.class.php'; //TODO

require_once 'dao/Dao.class.php';
require_once 'dao/userDao.class.php';

//require_once 'controller/controller.class.php';
require_once 'controller/mainController.class.php';
require_once 'controller/userForm.php';
require_once 'controller/collabController.class.php';
require_once 'controller/animController.class.php';
require_once 'controller/adminController.class.php';

require_once 'view/lisaeTemplate.class.php';
require_once 'view/loginPageView.class.php';
require_once 'view/registration/registrationView.class.php';
require_once 'view/Collaborator/CollabView.class.php';

// PHPmailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/phpmailer/phpmailer/src/Exception.php';
require 'vendor/phpmailer/phpmailer/src/PHPMailer.php';
require 'vendor/phpmailer/phpmailer/src/SMTP.php';
require_once 'vendor/autoload.php'; 
require_once 'vendor/phpmailer/phpmailer/src/PHPMailer.php';

/********** CODE PRINCIPAL **********/

/*(new CollabView())->run('dashboard');*/ // Test Template CollabView

// Création d'une instance de notre programme et du moteur SVG puis exécution.

////////////////////////////////////////////////
// Test PHPMailer

$mail= new PHPMailer();

/* 
$mail->SMTPDebug = SMTP::DEBUG_SERVER;
$mail->isSMTP(); // Paramétrer le Mailer pour utiliser SMTP 
$mail->Host = 'mail.LISAE.fr'; // Spécifier le serveur SMTP
$mail->SMTPAuth = true; // Activer authentication SMTP
$mail->Username = 'toto@gmail.com'; // Votre adresse email d'envoi
$mail->Password = 'mdp'; // Le mot de passe de cette adresse email
$mail->SMTPSecure = 'ssl'; // Accepter SSL
$mail->Port = 465; */

$mail->setFrom('Stone-82@hotmail.fr', 'Pierre Trublereau');
$mail->addAddress('pierre.trublereau@gmail.com', 'Pierre Trublereau');
$mail->Subject = 'Confirmation Mail';
$mail->Body = 'Hi! This is my first e-mail sent through PHPMailer.';
$mail->isHTML(true);
$mail->setLanguage('fr', '/optional/path/to/language/directory/');
if(!$mail->send()) {
  echo 'Message was not sent.<br>';
  echo 'Mailer error: ' . $mail->ErrorInfo;
} else {
  echo 'Message has been sent.';
}

//////////////////////////////////////////

try {
	$controllerName = (new MainController())->getClassName();
	$controller = new $controllerName();
	$controller->run();
}
catch (LisaeException $e) {
	die ($e->render());
}
finally {
	exit();
}
