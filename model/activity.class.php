<?php
class Activity{
    private $_idActivity;
    private $_name;
    private $_description;
    private $_detailedDescription;
    private $_minNumberPerson;
    private $_maxNumberPerson;
    private $_image;
    private $_registrationDeadline;
    private $_unsubscribeDeadline;
    private $_slot = [];

    function __construct($idActivity,$name, $description, $detailedDescription, $minNumberPerson, $maxNumberPerson, $registrationDeadline, $unsubscribeDeadline,$slot)
    {
        $this->_slot=$slot;
        $this->_idActivity=$idActivity;
        $this->_name=$name;
        $this->_description=$description;
        $this->_detailedDescription=$detailedDescription;
        $this->_minNumberPerson=$minNumberPerson;
        $this->_maxNumberPerson=$maxNumberPerson;
        $this->_image=null;
        $this->_registrationDeadline=$registrationDeadline;
        $this->_unsubscribeDeadline=$unsubscribeDeadline;
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

    public function get_minNumberPerson()
    {
        return $this->_minNumberPerson;
    }

    public function get_maxNumberPerson()
    {
        return $this->_maxNumberPerson;
    }

    public function get_image()
    {
        return $this->_image;
    }

    public function get_registrationDeadline()
    {
        return $this->_registrationDeadline;
    }

    public function get_unsubscribeDeadline()
    {
        return $this->_unsubscribeDeadline;
    }

    public function get_slot()
    {
        return $this->_slot;
    }
}
