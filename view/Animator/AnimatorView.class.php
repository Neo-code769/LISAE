<?php

class AnimatorView extends LisaeTemplateConnected {

    private $_mySlot;

    public function __construct()
    {
        parent::__construct();
    } 

    public function setBody($content) {

        switch ($content) {

            case "dashboard": include "dashboard.phtml";
            break;

            default: include "dashboard.phtml";

        }
    }

    public function setMyTheme($arr)
    {
        function date_sort2($a, $b) {
            return strtotime($a["dts"]) - strtotime($b["dts"]);
        }
        usort($arr, "date_sort2"); //Tri en ordre chronologique

        $result = "";
        foreach ($arr as $element) {
            setlocale(LC_TIME, ['fr', 'fra', 'fr_FR']);
            $dateForm =strftime('%A %d %B %Y %H:%M', strtotime($element["dts"]));
            $result .=
            "<div class='row justify-content-center'> 
            <a style='text-decoration: none;' href='../collab/infoSlot?idSlot=".$element["idslot"]."&id_activity=".$element["id_activity"]."'><div id='listELOCE' class='eloce' style='background-color:".$element["color"]."'>".$dateForm."-".$element["dte"]." - ".$element["nTheme"]." - ".$element["nActivity"]."</a></div>
                <a  id='info' href='../collab/infoSlot?idSlot=".$element["idslot"]."'><img src='../../images/info.png' alt='S'inscrire a l'atelier'></a>
            </div>";
        }

        $this->_mySlot = $result;
    }
}   

?>