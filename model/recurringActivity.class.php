<?php

class RecurringActivity extends Activity{  
    private $_idUser;
    function __construct($idActivity, $name, $description, $detailedDescription, $minNumberPerson, $maxNumberPerson, $registrationDeadline, $unsubscribeDeadline, $slot,$idUser)
    {
        $this->_idUser = $idUser;
        parent::__construct($idActivity,$name, $description, $detailedDescription, $minNumberPerson, $maxNumberPerson, $registrationDeadline, $unsubscribeDeadline, $slot);
    }

    public function get_idUser()
    {
        return $this->_idUser;
    }

    public function set_idUser($_idUser)
    {
        $this->_idUser = $_idUser;

        return $this;
    }
}