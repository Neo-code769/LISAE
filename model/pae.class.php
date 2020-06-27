<?php 

class PAE {
    private $_idPae;
    private $_startDatePae;
    private $_endDatePae;

    public function __construct($idPae,$startDatePae, $endDatePae) {
            $this->_idPae = $idPae;
            $this->_startDatePae = $startDatePae;
            $this->_endDatePae = $endDatePae;
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
    public function get_endDatePae()
    {
        return $this->_endDatePae;
    }
    public function set_endDatePae($_endDatePae)
    {
        $this->_endDatePae = $_endDatePae;
        return $this;
    }

  

    /**
     * Get the value of _idPae
     */ 
    public function get_idPae()
    {
        return $this->_idPae;
    }
}