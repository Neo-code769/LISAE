<?php

class UniqueActivity extends Activity{
    private $_idTheme;
    private $_externalContributor;
    function __construct($idTheme, $externalContributor,$idActivity,$name, $description, $detailedDescription, $minNumberPerson, $maxNumberPerson, $registrationDeadline, $unsubscribeDeadline)
    {
        $this->_idTheme= $idTheme;
        $this->_externatalContributor= $externalContributor;
        parent::__construct($idActivity,$name, $description, $detailedDescription, $minNumberPerson, $maxNumberPerson, $registrationDeadline, $unsubscribeDeadline);
    }

    
}