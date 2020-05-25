<?php

class Training{
    private $_name;
    private $_label;
    private $_listSession = [];

    public function __construct($name, $label)
    {
        $this->_name=$name;
        $this->_label=$label;
    }
}
