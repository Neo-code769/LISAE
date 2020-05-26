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

//require_once 'exception/LisaeException.class.php'; TODO

require_once 'dao/Dao.class.php';
require_once 'dao/userDao.class.php';

require_once 'controller/controller.class.php';




/********** CODE PRINCIPAL **********/

// Création d'une instance de notre programme et du moteur SVG puis exécution.
$controller  = new Controller();
try {
	$controller->run();
}
catch (Exception $e) {
	die ($e->getMessage());
}
finally {
	exit();
}
