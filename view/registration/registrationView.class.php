<?php

class RegistrationView extends LisaeTemplate {


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