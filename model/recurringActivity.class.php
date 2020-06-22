<?php

class RecurringActivity extends Activity{  
    private $_image;
    function __construct($idActivity, $name, $description, $detailedDescription,$slot, $image)
    {
        parent::__construct($idActivity,$name, $description, $detailedDescription, $slot);
        $this->_image = $image;
    }
    public function get_image()
    {
        return $this->_image;
    }
}