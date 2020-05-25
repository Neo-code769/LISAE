<?php 

class Session
{
    private $_num;
    private $_startDateFormation;
    private $_endDateFormation;
    private $_startDatePae;
    private $_endDatePae;
    private $_collaborator = [];
    private $_animator;

    public function __construct($num, $startDateFormation, $endDateFormation, $startDatePae, $endDatePae, $collaborator, $animator)
    {
        $this->_num = $num;
        $this->_startDateFormation = $startDateFormation;
        $this->_endDateFormation = $endDateFormation;
        $this->_startDatePae = $startDatePae;
        $this->_endDatePae = $endDatePae;
        $this->_collaborator = $collaborator;
        $this->_animator = $animator;
    }

    public function get_num()
    {
        return $this->_num;
    }
 
    public function set_num($_num)
    {
        $this->_num = $_num;

        return $this;
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

    public function get_collaborator()
    {
        return $this->_collaborator;
    }
 
    public function set_collaborator($_collaborator)
    {
        $this->_collaborator = $_collaborator;

        return $this;
    }

    public function get_animator()
    {
        return $this->_animator;
    }

    public function set_animator($_animator)
    {
        $this->_animator = $_animator;

        return $this;
    }
}  