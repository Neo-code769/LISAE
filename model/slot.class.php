<?php 

class Slot
{
    private $_idSlot;
    private $_registrationDeadLine;
    private $_unsubscribeDeadLine;
    private $_place;
    private $_information;
    private $_slotDateTimeStart;
    private $_slotDateTimeEnd;
    private $_minNumberPerson;
    private $_maxNumberPerson;
    private $_collabRegistered =[];
    private $_collabPresent= [];

    public function __construct($idSlot,$registrationDeadLine, $unsubscribeDeadLine, $place, $information, $slotDateTimeStart,$slotDateTimeEnd, $minNumberPerson, $maxNumberPerson)
    {
        $this->_idSlot = $idSlot;
        $this->_registrationDeadLine = $registrationDeadLine;
        $this->_unsubscribeDeadLine = $unsubscribeDeadLine;
        $this->_place = $place;
        $this->_information = $information;
        $this->_slotDateTimeStart = $slotDateTimeStart;
        $this->_slotDateTimeEnd = $slotDateTimeEnd;
        $this->_minNumberPerson=$minNumberPerson;
        $this->_maxNumberPerson=$maxNumberPerson;
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
        return $this->_slotDateTimeStart;
    }

    public function get_slotDateTimeStartFormat()
    {
        setlocale(LC_TIME, ['fr', 'fra', 'fr_FR']);
        return strftime('%A %d %B %Y %H:%M', strtotime($this->_slotDateTimeStart));
    }
    public function get_slotDateTimeEnd()
    {
        return $this->_slotDateTimeStart;
    }
    public function get_slotDateTimeEndFormat()
    {
        return  strftime('%H:%M', strtotime($this->_slotDateTimeEnd));
    }

    public function get_idSlot()
    {
        return $this->_idSlot;
    }

    public function set_idSlot($_idSlot)
    {
        $this->_idSlot = $_idSlot;

        return $this;
    }

    /**
     * Get the value of _information
     */ 
    public function get_information()
    {
        return $this->_information;
    }

    /**
     * Get the value of _place
     */ 
    public function get_place()
    {
        return $this->_place;
    }
    
    public function get_minNumberPerson()
    {
        return $this->_minNumberPerson;
    }

    public function get_maxNumberPerson()
    {
        return $this->_maxNumberPerson;
    }


    public function get_registrationDeadLine()
    {
        return $this->_registrationDeadLine;
    }

    public function get_unsubscribeDeadLine()
    {
        return $this->_unsubscribeDeadLine;
    }
}