<?php 

class Slot
{
    private $_registrationDeadLine;
    private $_unsubscribeDeadLine;
    private $_place;
    private $_information;
    private $_slotDateTimeStart;
    private $_slotDateTimeEnd;
    private $_collabRegistered =[];
    private $_collabPresent= [];

    public function __construct($registrationDeadLine, $unsubscribeDeadLine, $place, $information, $slotDateTimeStart,$slotDateTimeEnd)
    {
        $this->_registrationDeadLine = $registrationDeadLine;
        $this->_unsubscribeDeadLine = $unsubscribeDeadLine;
        $this->_place = $place;
        $this->_information = $information;
        $this->_slotDateTimeStart = $slotDateTimeStart;
        $this->_slotDateTimeEnd = $slotDateTimeEnd;
    }

    public function addCollabRegister() {
    }

    public function addCollabPresent() {
    }

    public function removeCollabRegister() {
    }

    public function removeCollabPresent() {
    }


    /**
     * Get the value of _slotDateTimeStart
     */ 
    public function get_slotDateTimeStart()
    {
        setlocale(LC_TIME, ['fr', 'fra', 'fr_FR']);
        return strftime('%A %d %B %Y %H:%M', strtotime($this->_slotDateTimeStart));
    }

    /**
     * Get the value of _slotDateTimeEnd
     */ 
    public function get_slotDateTimeEnd()
    {
        return  strftime('%H:%M', strtotime($this->_slotDateTimeEnd));
    }
}