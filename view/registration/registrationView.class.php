<?php

class RegistrationView extends LisaeTemplate {

    private $_sessionList = null;

    public function setSessionList($sessionList){
        $result = "";
        foreach ($sessionList as $session) {
            $result .= "<option value=''>".$session->get_nameTraining().$session->get_num()."</option>";
        }
        $this->_sessionList = $result;
    }

    public function setBody($content) {
        switch ($content) {
            case 'collab':
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