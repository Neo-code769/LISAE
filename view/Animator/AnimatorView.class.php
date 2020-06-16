<?php

class AnimatorView extends LisaeTemplateConnected {

    private $_infoUser;
    private $_sessionSlot;
    private $_eloce;
    private $_infoSlot;
    private $_infoSlotButton;
    private $_lastname;
    private $_firstName;
    private $_birthDate;
    private $_mail;
    private $_phoneNumber;
    private $_mySlot;
    private $_session;
    private $_listActivity;
    

    public function __construct()
    {
        parent::__construct();
    } 

    public function setBody($content) {

        switch ($content) {

            case "dashboard": include "dashboard.phtml";
            break;

            case "infoSlot": include "infoSlot.phtml";
            break;

            case "infoUser": include "infoUser.phtml";
            break;

            case "ListELOCE": include "listELOCE.phtml";
            break;

            case "createSlot": include "createSlot.phtml";

            

        }
    }

    public function setHeader($errorMess) {
        echo <<<EOD
            <header>
                <div id="headerIMG">
                    <img src="/images/LISAE.png" alt="logo LISAE" />
                        <div class="buttons">
                            <a href="./dashboard"><button class="btn-hover color-1" style="text-decoration: none; color: black; font-size: 24px;">Tableau de Bord</button></a>
                            <a href="../anim/eloce"><button class="btn-hover color-1" style="text-decoration: none; color: black; font-size: 24px;"> Calendrier ELOCE</button></a>
                            <a href="../anim/createSlot"><button class="btn-hover color-1" style="text-decoration: none; color: black; font-size: 24px;">Nouveau Créneau</button></a>
                            <a href="../anim/info"><button class="btn-hover color-1" style="text-decoration: none; color: black; font-size: 24px;">Mon Compte</button></a>
                            <a href="../password/logout"><button class="btn-hover color-1" style="text-decoration: none; color: black; font-size: 24px;">Deconnexion</button></a>
                        </div>
                </div>
                <div class="lifeline"></div>
            </header>
            <div id="margin"></div>
            <body>
            EOD;
        echo "<p>".$errorMess."</p>";
    }
    private $_activityList = null;

    public function setActivityList($activityList){
        $result = "";
        foreach ($activityList as $activity) {
            $result .= "<option value='".$activity->get_name()."'>".$activity->get_name()."</option>";
        }
        $this->_activityList = $result;
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
                        <a style='text-decoration: none;' href='../collab/infoSlot?idSlot=".$element["idslot"]."&id_activity=".$element["id_activity"]."'>
                        <div id='listELOCE' class='eloce' style='background-color:".$element["color"]."'>".$dateForm."-".$element["dte"]." - ".$element["nTheme"]." - ".$element["nActivity"]."
                        </a><div style='margin-left:5%'>".$element['participateNumber']."</div></div>
                        <a  id='info' href='../collab/infoSlot?idSlot=".$element["idslot"]."'><img src='../../images/info.png' alt='S'inscrire a l'atelier'></a>
                    </div>";
        }

        $this->_mySlot = $result;
    }

    public function setTheme($arr){

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
            <a style='text-decoration: none;' href='../anim/infoSlot?idSlot=".$element["idslot"]."'><div id='listELOCE' class='eloce' style='background-color:".$element["color"]."'>".$dateForm."-".$element["dte"]." - ".$element["nTheme"]." - ".$element["nActivity"]."</a></div>
            <a  id='listActivity' href='../anim/listActivity?id_activity=".$element["id_activity"]."'><img src='../../images/dossier.png' alt='créneaux pour une activité'></a>
            <a  id='info' href='../anim/infoSlot?idSlot=".$element["idslot"]."'><img src='../../images/info.png' alt='info d'un créneau'></a>
            </div>";
        }

        $this->_eloce = $result;
    }

    public function setInfoUser($user){
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
     public function setListForActivity($element) {
        setlocale(LC_TIME, ['fr', 'fra', 'fr_FR']);
        $result = "";
        foreach ($element as $activity) {
            $result .= 
                "<div id='listELOCE' class='eloce' style='background-color:".$activity["color"]."'>".strftime('%A %d %B %Y %H:%M', strtotime($activity["dts"]))."-".$activity["dte"]." - ".$activity["nTheme"]." - ".$activity["nActivity"]."</div> <a  id='signups' href='../collab/signUpSlot?idSlot=".$activity["idslot"]."&idActivity=".$activity["idActivity"]."'><img src='../../images/add.png' alt='S'inscrire a l'atelier'></a>"; 
                }
        $this->_listActivity = $result;
    } 
    public function setInfoSlotButton($element){
        $result =
        "<button id='retour'><a id='retour' style='text-decoration: none;' href='../../index.php/anim/signUpSlot?idSlot=".$element["idslot"]."&idActivity=".$element["idActivity"]."'>Inscription</a></button><br></br>";
        $result .=
        "<button id='retour'><a id='retour' style='text-decoration: none;' href='../../index.php/anim/deregistrationSlot?idslot=".$element['idslot']."&idActivity=".$element["idActivity"]."'>Désinscription</a></button><br></br>";
        $this->_infoSlotButton = $result;
    }
}   

?>