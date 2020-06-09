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

        $data = array(
            array(
                "title" => "Another title",
                "date"  => "Fri, 17 Jun 2011 08:55:57 +0200"
            ),
            array(
                "title" => "My title",
                "date"  => "Mon, 16 Jun 2010 06:55:57 +0200"
            )
        );

        function date_sort($a, $b) {
            return strtotime($a["dts"]) - strtotime($b["dts"]);
        }
        usort($arr, "date_sort");
        
        var_dump(strftime('%A %d %B %Y %H:%M', strtotime($arr[1]["dts"])));
        
            //setlocale(LC_TIME, ['fr', 'fra', 'fr_FR']);
            //strftime('%A %d %B %Y %H:%M', strtotime($y["dts"]));
        
        //var_dump($arr);

        /* $result .="<div class='eloce' style='background-color:".$theme->get_color()."'>".$slot->get_slotDateTimeStart()."-".$slot->get_slotDateTimeEnd()." - ".$theme->get_name()." - ".$activity->get_name()."</div>"; */

        //$this->_eloce = $result;
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