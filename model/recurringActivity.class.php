<?php

class RecurringActivity extends Activity{  
    function __construct($idActivity, $name, $description, $detailedDescription, $registrationDeadline, $unsubscribeDeadline, $slot)
    {
        parent::__construct($idActivity,$name, $description, $detailedDescription,$registrationDeadline, $unsubscribeDeadline, $slot);
    }
}