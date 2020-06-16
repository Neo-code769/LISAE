<?php
// typer les fcts
declare(strict_types=1);

// Liste des classes dans l'ordre des dépendances.

//require_once 'conf.php'; TODO

require_once 'model/user.class.php';
require_once 'model/activity.class.php';
require_once 'model/recurringActivity.class.php';
require_once 'model/animator.class.php';
require_once 'model/admin.class.php';
require_once 'model/collaborator.class.php';
require_once 'model/sessionTraining.class.php';
require_once 'model/slot.class.php';
require_once 'model/theme.class.php';

require_once 'exception/LisaeException.class.php';

require_once 'dao/dao.class.php';
require_once 'dao/userDao.class.php';
require_once 'dao/sessionTrainingDao.class.php';
require_once 'dao/themeDao.class.php';
require_once 'dao/slotDao.class.php';
require_once 'dao/activityDao.class.php';
require_once 'dao/presenceDao.class.php';

require_once 'controller/mainController.class.php';
require_once 'controller/userForm.php';
require_once 'controller/passwordController.php';
require_once 'controller/collabController.class.php';
require_once 'controller/animController.class.php';
require_once 'controller/adminController.class.php';


require_once 'view/lisaeTemplate.class.php';
require_once 'view/lisaeTemplateDisconnected.class.php';
require_once 'view/lisaeTemplateConnected.class.php';
require_once 'view/Activity/jobCibleView.php';
require_once 'view/Activity/softSkillView.php';
require_once 'view/loginPageView.class.php';
require_once 'view/registration/registrationView.class.php';
require_once 'view/Collaborator/CollabView.class.php';
require_once 'view/forgotPasswordView.class.php';
require_once 'view/changePasswordView.class.php';
require_once 'view/Animator/AnimatorView.class.php';

// PHPmailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/phpmailer/phpmailer/src/Exception.php';
require 'vendor/phpmailer/phpmailer/src/PHPMailer.php';
require 'vendor/phpmailer/phpmailer/src/SMTP.php';
require_once 'vendor/autoload.php'; 
require_once 'vendor/phpmailer/phpmailer/src/PHPMailer.php';

/********************************** */
/********** CODE PRINCIPAL **********/
/********************************** */

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
