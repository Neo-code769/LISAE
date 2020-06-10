<?php 

class SessionTraining
{
    private $_idSession;
    private $_nameSession;
    private $_startDateFormation;
    private $_endDateFormation;
    private $_startDatePae;
    private $_endDatePae;

    public function __construct( $idSession, $nameSession, $startDateFormation=null, $endDateFormation=null, $startDatePae=null, $endDatePae=null)
    {
        $this->_idSession = $idSession;
        $this->_nameSession = $nameSession;
        $this->_startDateFormation = $startDateFormation;
        $this->_endDateFormation = $endDateFormation;
        $this->_startDatePae = $startDatePae;
        $this->_endDatePae = $endDatePae;
    }

    public function get_startDateFormation()
    {
        return $this->_startDateFormation;
    }

    public function set_startDateFormation($_startDateFormation)
    {
        $this->_startDateFormation = $_startDateFormation;

        return $this;
    }
 
    public function get_endDateFormation()
    {
        return $this->_endDateFormation;
    }

    public function set_endDateFormation($_endDateFormation)
    {
        $this->_endDateFormation = $_endDateFormation;

        return $this;
    }

    public function get_endDatePae()
    {
        return $this->_endDatePae;
    }

    public function set_endDatePae($_endDatePae)
    {
        $this->_endDatePae = $_endDatePae;

        return $this;
    }

    public function get_startDatePae()
    {
        return $this->_startDatePae;
    }

    public function set_startDatePae($_startDatePae)
    {
        $this->_startDatePae = $_startDatePae;

        return $this;
    }

    public function get_referent()
    {
        return $this->_referent;
    }

    public function set_referent($_referent)
    {
        $this->_referent = $_referent;

        return $this;
    }

    /**
     * Get the value of _nameSession
     */ 
    public function get_nameSession()
    {
        return $this->_nameSession;
    }

    /**
     * Set the value of _nameSession
     *
     * @return  self
     */ 
    public function set_nameSession($_nameSession)
    {
        $this->_nameSession = $_nameSession;

        return $this;
    }
 
    public function getIdSession()
    {
        return $this->idSession;
    }

    public function setIdSession($idSession)
    {
        $this->idSession = $idSession;

        return $this;
    }
}  