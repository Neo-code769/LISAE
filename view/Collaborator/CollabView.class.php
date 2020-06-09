<?php

class CollabView extends LisaeTemplateConnected {

    private $_infoUser;
    private $_sessionSlot;
    private $_eloce;

    public function __construct()
    {
        parent::__construct();
    } 

    public function setSlot($slotList){
        /* $result = "";
        foreach ($slotList as $slot) {
            $result .= "<li>".$slot->get_nameSession()."</li>";
        } */
        $result = var_dump($slotList);
        $this->_sessionSlot = $result;
    }

    public function setTheme($themeList){
        //TEST
        /* $result = var_dump($themeList);
        foreach ($themeList as $theme) {
            var_dump($theme->get_activity());
        }  */

        //APP
        $result = "";
        foreach ($themeList as $theme) {
            foreach ($theme->get_activity() as $activity) {
                foreach($activity->get_slot() as $slot){
                    $result .="<li>".$slot->get_slotDateTimeStart()."-".$slot->get_slotDateTimeEnd()." - ".$theme->get_name()." - ".$activity->get_name()."</li>";
                }
            }
        }
        $this->_eloce = $result;
    }

    public function setInfoUser($info){
        $this->_infoUser = $info;
    }

    public function setBody($content) {

        switch ($content) {

            case "dashboard": include "dashboard.php";
            break;

            case "infoActivity": include "infoActivity.php";
            break;

            case "topics": include "topicsActivity.php";
            break;

            case "registration": include "registrationActivity.php";
            break; 

            case "ListELOCE":include "ListELOCE.php";
            break;
            
            case "infoUser": include "infoUser.phtml"; 
            break;

            default: include "dashboard.php";

        }
    }
}   

?>