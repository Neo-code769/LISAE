<?php
// typer les fcts
declare(strict_types=1);

// Liste des classes dans l'ordre des dépendances.

//require_once 'conf.php'; TODO

require 'vendor/autoload.php'; // PHPmailer
require 'vendor/phpmailer/src/PHPMailer.php';

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


/********** CODE PRINCIPAL **********/

$mail = new PHPMailer;
$mail->setFrom('from@example.com', 'Your Name');
$mail->addAddress('myfriend@example.net', 'My Friend');
$mail->Subject  = 'First PHPMailer Message';
$mail->Body     = 'Hi! This is my first e-mail sent through PHPMailer.';
if(!$mail->send()) {
  echo 'Message was not sent.';
  echo 'Mailer error: ' . $mail->ErrorInfo;
} else {
  echo 'Message has been sent.';
}

/*(new CollabView())->run('dashboard');*/ // Test Template CollabView

// Création d'une instance de notre programme et du moteur SVG puis exécution.

/*try {
	$controllerName = (new MainController())->getClassName();
	$controller = new $controllerName();
	$controller->run();
}
catch (LisaeException $e) {
	die ($e->render());
}
finally {
	exit();
}*/
