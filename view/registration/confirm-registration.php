<?php 

    require_once 'C:\wamp64\www\LISAE\controller\mainController.class.php';
    require_once 'C:\wamp64\www\LISAE\controller\userForm.php';
    require_once 'C:\wamp64\www\LISAE\controller\loginController.class.php';
    require_once 'C:\wamp64\www\LISAE\controller\collabController.class.php';
    require_once 'C:\wamp64\www\LISAE\controller\animController.class.php';
    require_once 'C:\wamp64\www\LISAE\controller\adminController.class.php';

    require_once 'C:\wamp64\www\LISAE\dao\Dao.class.php';
    require_once 'C:\wamp64\www\LISAE\dao\userDao.class.php';

    // TO FIX //
    $userDao = new userDao();
    $mail = $_GET['mail'];
    $userDao->setConfirmationMail($mail);
?>

    <div id="title" class="container">
        <h2>--- Confirmation de votre adresse e-mail ---</h2>
    </div>

    <div>
        <h3 style="margin-left: 70px;"> Votre compte à bien été activé !</h3><br>
        <h2 style="margin-left: 80px;">Bienvenue sur LISAE</h2>
        <button id="button" value="login" style="margin-left: 150px;"><a id="button" href="/index.php"> Connexion </a></button>
    </div>
    
