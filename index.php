<?php
// typer les fcts
declare(strict_types=1);

// Liste des classes dans l'ordre des dépendances.

//include 'conf.php'; TODO

include 'model/activity.class.php';

//include 'exception/LisaeException.class.php'; TODO

//include 'dao/Dao.class.php'; TODO

//include 'view/'; TDO

include 'controller/controller.class.php';




/********** CODE PRINCIPAL **********/

// Création d'une instance de notre programme et du moteur SVG puis exécution.
$controller  = new Controller();
try {
	$controller->run();
}
catch (Exception $e) {
	echo $e->getMessage();
}
