<?php

class RecurringActivity extends Activity{  
    function __construct($idActivity, $name, $description, $detailedDescription, $minNumberPerson, $maxNumberPerson, $registrationDeadline, $unsubscribeDeadline, $slot)
    {
        parent::__construct($idActivity,$name, $description, $detailedDescription, $minNumberPerson, $maxNumberPerson, $registrationDeadline, $unsubscribeDeadline, $slot);
    }
}