<?php

class Training
{
    private $_name;
    private $_label;
    private $_session = [];

    public function __construct($name, $label, $session)
    {
        $this->_name = $name;
        $this->_label = $label;
        $this->_session = $session;
    }
}