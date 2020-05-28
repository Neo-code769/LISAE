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

require_once 'view/lisaeTemplate.class.php';
require_once 'view/loginPageView.class.php';
require_once 'view/Registration/registrationView.class.php';
require_once 'view/Collaborator/CollabView.class.php';

//require_once 'controller/controller.class.php';
require_once 'controller/mainController.class.php';
require_once 'controller/collabController.class.php';
require_once 'controller/animController.class.php';
require_once 'controller/adminController.class.php';






/********** CODE PRINCIPAL **********/

/*(new CollabView())->run('dashboard');*/ // Test Template CollabView

// Création d'une instance de notre programme et du moteur SVG puis exécution.
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
