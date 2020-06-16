<?php

class RecurringActivity extends Activity{  
    function __construct($idActivity, $name, $description, $detailedDescription,$slot)
    {
        parent::__construct($idActivity,$name, $description, $detailedDescription, $slot);
    }
}