<?php
class Activity{
    private $_idActivity;
    private $_name;
    private $_description;
    private $_detailedDescription;
    private $_image;
    private $_slot = [];

    function __construct($idActivity,$name, $description, $detailedDescription, $slot)
    {
        $this->_slot=$slot;
        $this->_idActivity=$idActivity;
        $this->_name=$name;
        $this->_description=$description;
        $this->_detailedDescription=$detailedDescription;
        $this->_image=null;
    }

    public function get_idActivity()
    {
        return $this->_idActivity;
    }
 
    public function get_name()
    {
        return $this->_name;
    }

    public function get_description()
    {
        return $this->_description;
    }

    public function get_detailedDescription()
    {
        return $this->_detailedDescription;
    }

    public function get_image()
    {
        return $this->_image;
    }

    public function get_slot()
    {
        return $this->_slot;
    }
}
