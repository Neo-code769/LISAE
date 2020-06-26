<?php 

class SessionTraining
{
    private $_idSession;
    private $_nameSession;
    private $_startDateFormation;
    private $_endDateFormation;

    public function __construct( $idSession, $nameSession, $startDateFormation, $endDateFormation)
    {
        $this->_idSession = $idSession;
        $this->_nameSession = $nameSession;
        $this->_startDateFormation = $startDateFormation;
        $this->_endDateFormation = $endDateFormation;
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
        return $this->_idSession;
    }

    public function setIdSession($idSession)
    {
        $this->idSession = $idSession;

        return $this;
    }
}  