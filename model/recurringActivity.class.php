<?php

class RecurringActivity extends Activity{
    private $_idTheme;
    function __construct($idTheme, $idActivity, $name, $description, $detailedDescription, $minNumberPerson, $maxNumberPerson, $registrationDeadline, $unsubscribeDeadline)
    {
        $this->_idTheme= $idTheme;
        parent::__construct($idActivity,$name, $description, $detailedDescription, $minNumberPerson, $maxNumberPerson, $registrationDeadline, $unsubscribeDeadline);
    }
}