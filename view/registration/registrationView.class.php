<?php

class RegistrationView extends LisaeTemplate {

    private $_sessionList = null;

    public function setSessionList($sessionList){
        $this->_sessionList = $sessionList;
    }

    public function setBody($content) {
        switch ($content) {
            case 'collab':
                $sessionList = $this->_sessionList;
                include "registrationCollab.phtml";
                break;

            case 'anim':
                include "registrationAnim.phtml";
                break;

            case 'admin':
                include "registrationAdmin.phtml";
                break;
            
            default:
                break;
        }
        
    }

}