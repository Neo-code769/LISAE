<?php

class CollabView extends LisaeTemplateConnected {

    private $_infoUser;
    private $_sessionSlot;
    private $_eloce;
    private $_infoSlot;

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
                    $arr[]= ["idslot"=> $slot->get_idSlot(),
                    "color" => $theme->get_color(),
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
            $result .=
            "<div class='row justify-content-center'> 
                <div class='eloce' style='background-color:".$element["color"]."'>".$dateForm."-".$element["dte"]." - ".$element["nTheme"]." - ".$element["nActivity"]."</div>
                <a href='../collab/signUpSlot?idSlot=".$element["idslot"]."'><img src='../../images/add.png' alt='S'inscrire a l'atelier'></a>
                <a href='../collab/infoSlot?idSlot=".$element["idslot"]."'><img src='../../images/info.png' alt='S'inscrire a l'atelier'></a>
            </div>";
        }

        $this->_eloce = $result;
    }

    public function setInfoUser($info){
        $this->_infoUser = $info;
    }

    public function setInfoSlot($element){
        $result = 
        "<div class='eloce' style='background-color:".$element["color"]."'>".$element["dts"]."-".$element["dte"]." - ".$element["nTheme"]." - ".$element["nActivity"]."</div>";
        $result .=
        "<div><label>Information</label><p>".$element['information']."</p></div>";
        $result .=
        "<div><label>Lieu</label><p>".$element['place']."</p></div>";
        $this->_infoSlot = $result;
    }

    public function setBody($content) {

        switch ($content) {

            case "dashboard": include "dashboard.php";
            break;

            case "infoSlot": include "infoSlot.phtml";
            break;

            case "topics": include "topicsActivity.php";
            break;

            case "registration": include "registrationActivity.php";
            break; 

            case "ListELOCE":include "ListELOCE.phtml";
            break;
            
            case "infoUser": include "infoUser.phtml"; 
            break;

            default: include "dashboard.php";

        }
    }
}   

?>