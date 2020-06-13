<?php

class CollabView extends LisaeTemplateConnected {

    private $_infoUser;
    private $_sessionSlot;
    private $_eloce;
    private $_infoSlot;
    private $_infoSlotButton;
    private $_lastName;
    private $_firstName;
    private $_birthDate;
    private $_mail;
    private $_phoneNumber;
    private $_mySlot;

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
                    $arr[]= ["id_activity"=> $activity->get_idActivity(), 
                    "idslot"=> $slot->get_idSlot(),
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
            <a style='text-decoration: none;' href='../collab/infoSlot?idSlot=".$element["idslot"]."'><div id='listELOCE' class='eloce' style='background-color:".$element["color"]."'>".$dateForm."-".$element["dte"]." - ".$element["nTheme"]." - ".$element["nActivity"]."</a></div>
            <a  id='signup' href='../collab/signUpSlot?idSlot=".$element["idslot"]."&idActivity=".$element["id_activity"]."'><img src='../../images/add.png' alt='S'inscrire a l'atelier'></a>
            <a  id='info' href='../collab/infoSlot?idSlot=".$element["idslot"]."'><img src='../../images/info.png' alt='S'inscrire a l'atelier'></a>
            </div>";
        }

        $this->_eloce = $result;
    }
    public function setMyTheme($themeList)
{
        $arr = [];
        foreach ($themeList as $theme) {
            foreach ($theme->get_activity() as $activity) {
                foreach($activity->get_slot() as $slot){
                    $arr[]= ["id_activity"=> $activity->get_idActivity(), 
                    "idslot"=> $slot->get_idSlot(),
                    "id_user"=> $_SESSION["id_user"],
                    "color" => $theme->get_color(),
                    "dts" => $slot->get_slotDateTimeStart(),
                    "dte" => $slot->get_slotDateTimeEnd(),
                    "nTheme" => $theme->get_name(),
                    "nActivity" => $activity->get_name()];
                    }
                }
            } 
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
            <a style='text-decoration: none;' href='../collab/infoSlot?idSlot=".$element["idslot"]."&id_user=".$element["id_user"]."&id_activity=".$element["id_activity"]."'><div id='listELOCE' class='eloce' style='background-color:".$element["color"]."'>".$dateForm."-".$element["dte"]." - ".$element["nTheme"]." - ".$element["nActivity"]."</a></div>
                <a  id='info' href='../collab/infoSlot?idSlot=".$element["idslot"]."'><img src='../../images/info.png' alt='S'inscrire a l'atelier'></a>
            </div>";
        }

        $this->_mySlot = $result;
    }
    public function setInfoUser($user){
        //$this->_infoUser = "<p>".$user->get_lastname()."<p>";
        $this->_firstName = $user->get_firstname();
        $this->_lastName = $user->get_lastname();
        $this->_birthDate = $user->get_birthdate();
        $this->_phoneNumber = $user->get_phoneNumber();
        $this->_mail = $user->get_mail();
    } 

    public function setInfoSlot($element){
        $result = 
        "<div class='eloce' style='background-color:".$element["color"]."'>".$element["dtsf"]."-".$element["dte"]." - ".$element["nTheme"]." - ".$element["nActivity"]."</div><br>";
        $result .=
        "<div style='margin-left: 5%;'><label>Information</label><p id='desc'>".$element['information']."</p></div><br>";
        $result .=
        "<div style='margin-left: 5%;'><label>Lieu</label><p id='desc'>".$element['place']."</p></div>";
        $this->_infoSlot = $result;
    }

    public function setInfoSlotButton($element){
        $result =
        "<button id='retour'><a id='retour' style='text-decoration: none;' href='../../index.php/collab/signUpSlot?idSlot=".$element["idslot"]."&idActivity=".$element["idActivity"]."'>Inscription</a></button><br></br>";
        $result .=
        "<button id='retour'><a id='retour' style='text-decoration: none;' href='../../index.php/collab/deregistrationSlot?idslot=".$element['idslot']."&idActivity=".$element["idActivity"]."'>Désinscription</a></button><br></br>";
        $this->_infoSlotButton = $result;
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