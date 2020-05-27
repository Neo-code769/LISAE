<?php
/*
* Collaborator Type
*/

class CollabController extends MainController{

	public function __construct() { 
    parent::__construct();
  }

  public function run () : void {
    switch ($this->_case) {
      case 2 :  // list types
        $list = (new UserDao())->getList();
        //var_dump ($list);
        include "view/type/listTypes.phtml";
        break;

      case 3 :  // form Add Type
        include "view/type/addTypeForm.phtml";
        break;

      case 4 :  // Add Type
        $id = (new TypeDao())->getLastId();
        $t = new Type ($id, htmlentities($_POST["name"]), htmlentities($_POST["desc"]));
        (new TypeDao())->insert($t);
        $list = (new TypeDao())->getList();
        include "view/type/listTypes.phtml";
        break;

      case 5 :  // delete all Types
        (new TypeDao())->deleteAll();
        $list = (new TypeDao())->getList();
        include "view/index.phtml";
        break;

      default:
        throw new MainException (ERR_CONTROLLER_USE_CASE);
        
    }
  }
 
}

?>