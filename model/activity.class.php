<?php
class Activity{
    private $_name;
    private $_description;
    private $_detailedDescription;
    private $_minNumberPerson;
    private $_maxNumberPerson;
    private $_image;
    private $_registrationDeadline;
    private $_unsubscribeDeadline;
    private $_slot = [];

    function __construct($name, $description, $detailedDescription, $minNumberPerson, $maxNumberPerson, $registrationDeadline, $unsubscribeDeadline)
    {
        $this->_name=$name;
        $this->_description=$description;
        $this->_detailedDescription=$detailedDescription;
        $this->_minNumberPerson=$minNumberPerson;
        $this->_maxNumberPerson=$maxNumberPerson;
        $this->_image=null;
        $this->_registrationDeadline=$registrationDeadline;
        $this->_unsubscribeDeadline=$unsubscribeDeadline;
    }

    public function getName()
    {
        return $this->_name;
    }

    public function addSlot()
    {
        #TODO
    }

    public function removeSlot()
    {
        #TODO
    }
}
