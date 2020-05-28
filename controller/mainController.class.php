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
        (new LoginPageView())->run('loginpage');
        /* include "view/loginPage.phtml"; */
        break;

      default:
        throw new LisaeException("ERR_CONTROLLER_USE_CASE");
    }
  }
}
