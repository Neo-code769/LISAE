<?php 

class Slot
{
    private $_registrationDeadLine;
    private $_unsubscribeDeadLine;
    private $_place;
    private $_information;
    private $_slotDate;
    private $_slotHour;
    private $_collabRegistered =[];
    private $_collabPresent= [];

    public function __construct($registrationDeadLine, $unsubscribeDeadLine, $place, $information, $slotDate,
     $slotHour, $collabRegistered,$collabPresent)
    {
        $this->_registrationDeadLine = $registrationDeadLine;
        $this->_unsubscribeDeadLine = $unsubscribeDeadLine;
        $this->_place = $place;
        $this->_information = $information;
        $this->_slotDate = $slotDate;
        $this->_slotHour = $slotHour;
        $this->_collabRegistered = $collabRegistered;
        $this->_collabPresent = $collabPresent;
    }

    public function addCollabRegister()
    {

    }
    public function addCollabPresent()
    {

    }
    public function removeCollabRegister()
    {

    }
    public function removeCollabPresent()
    {

    }
}