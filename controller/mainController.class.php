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
                            echo "Connexion réussie !";
                        } else {
                          throw new LisaeException("Le mail n'a pas été validé ! ");
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
      default:
        throw new LisaeException("ERR_CONTROLLER_USE_CASE");
    }
  }
}
