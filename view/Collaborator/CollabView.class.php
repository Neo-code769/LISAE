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

        $arr = [];
        foreach ($themeList as $theme) {
            foreach ($theme->get_activity() as $activity) {
                foreach($activity->get_slot() as $slot){
                    $arr[]=["color" => $theme->get_color(),
                    "dts" => $slot->get_slotDateTimeStart(),
                    "dte" => $slot->get_slotDateTimeEnd(),
                    "nTheme" => $theme->get_name(),
                    "nActivity" => $activity->get_name()];
                }
            }
        } 

        function date_sort($a, $b) {
            return strtotime($a["dts"]) - strtotime($b["dts"]);
        }
        usort($arr, "date_sort"); //Tri en ordre chronologique

        $result = "";
        foreach ($arr as $element) {
            setlocale(LC_TIME, ['fr', 'fra', 'fr_FR']);
            $dateForm =strftime('%A %d %B %Y %H:%M', strtotime($element["dts"]));
            $result .="<div class='eloce' style='background-color:".$element["color"]."'>".$dateForm."-".$element["dte"]." - ".$element["nTheme"]." - ".$element["nActivity"]."</div>";
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