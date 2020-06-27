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
    private $_session;
    private $_listActivity;
    private $_themes;
    private $_infoTheme;
    private $_activityList;
    private $_nameTheme;
    private $_infoActivity;

    public function __construct()
    {
        parent::__construct();
    } 

    public function setHeader($errorMess) {
        if ($_SESSION['role']!='Collaborator') {
            echo "Vous ne pouvez pas accéder a cette page !";
            header("Location:http://www.lisae.fr:8081/index.php");
        }
        echo <<<EOD
            <header>
                <div id="headerIMG">
                    <img src="/images/LISAE.png" alt="logo LISAE" />
                        <div class="buttons">
                            <a href="./dashboard"><button class="btn-hover color-1" style="text-decoration: none; color: black; font-size: 22px;">Tableau de Bord</button></a>
                            <a href="../collab/eloce"><button class="btn-hover color-1" style="text-decoration: none; color: black; font-size: 22px;"> Calendrier ELOCE</button></a>
                            <a href="../collab/theme"><button class="btn-hover color-1" style="text-decoration: none; color: black; font-size: 22px;">Thèmes</button></a>
                            <!-- <a href="../collab/softskill"><button class="btn-hover color-1" style="text-decoration: none; color: black; font-size: 22px;">Atelier Soft Skills</button></a> -->
                            <!-- <a href="../collab/jobcible"><button class="btn-hover color-1" style="text-decoration: none; color: black; font-size: 22px;">Atelier Job Cible</button></a> -->
                            <a href="../collab/info"><button class="btn-hover color-1" style="text-decoration: none; color: black; font-size: 22px;">Mon Compte</button></a>
                            <a href="../password/logout"><button class="btn-hover color-1" style="text-decoration: none; color: black; font-size: 22px;">Deconnexion</button></a>
                        </div>
                </div>
            </header>
            <div id="margin"></div>
            <body>
            EOD;
        echo "<p>".$errorMess."</p>";
    }

    public function setSlot($slotList){
        /* $result = "";
        foreach ($slotList as $slot) {
            $result .= "<li>".$slot->get_nameSession()."</li>";
        } */
        $result = var_dump($slotList);
        $this->_sessionSlot = $result;
    }

    public function setTheme($arr){

        function date_sort($a, $b) {
            return strtotime($a["dts"]) - strtotime($b["dts"]);
        }
        usort($arr, "date_sort"); //Tri en ordre chronologique

        $result = "";
        foreach ($arr as $element) {
            setlocale(LC_TIME, ['fr', 'fra', 'fr_FR']);
            $dateForm =utf8_encode(strftime('%A %d %B %Y %H:%M', strtotime($element["dts"])));
            if ($element["complete"]== true){
            $result .=
            "<div class='row justify-content-center'> 
                <a style='text-decoration: none;' href='../collab/infoSlot?idSlot=".$element["idslot"]."'>
                    <div id='listELOCE' class='eloce' style='background-color:".$element["color"]."'>
                    ".$dateForm."-".$element["dte"]." - ".$element["nTheme"]." - ".$element["nActivity"]."
                </a>
                    </div>
                <a  id='listActivity' href='../collab/listActivity?id_activity=".$element["id_activity"]."'>
                    <img src='../../images/dossier.png' alt='créneaux pour une activité'>
                </a>
                <a  id='info' href='../collab/infoSlot?idSlot=".$element["idslot"]."'>
                    <img src='../../images/info.png' alt='info d'un créneau'>
                </a>
                <a  id='signup' href='../collab/signUpSlot?idSlot=".$element["idslot"]."&idActivity=".$element["id_activity"]."'>
                    <img src='../../images/add.png' alt='S'inscrire a l'atelier'>
                </a>            
            </div>";
            }
            else {
                $result .=
                "<div class='row justify-content-center'> 
                <a style='text-decoration: none;' href=''><div id='listELOCE' class='eloce' style='background-color:".$element["color"]."'>".$dateForm."-".$element["dte"]." - ".$element["nTheme"]." - ".$element["nActivity"]."</a> <div style='margin-left:4%'> COMPLET</div></div>
                <a  id='listActivity' href=''><img src='../../images/dossier.png' alt='créneaux pour une activité'></a>
                <a  id='info' href=''><img src='../../images/info.png' alt='info d'un créneau'></a>
                <a  id='signup' href=''><img src='../../images/add.png' alt='S'inscrire a l'atelier'></a>          
                </div>";
            }
        }

        $this->_eloce = $result;
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
            $dateForm =utf8_encode(strftime('%A %d %B %Y %H:%M', strtotime($element["dts"])));
            $result .=
            "<div class='row justify-content-center'> 
            <a style='text-decoration: none;' href='../collab/infoSlot?idSlot=".$element["idslot"]."&id_activity=".$element["id_activity"]."'><div id='listELOCE' class='eloce' style='background-color:".$element["color"]."'>".$dateForm."-".$element["dte"]." - ".$element["nTheme"]." - ".$element["nActivity"]."</a></div>
                <a  id='info' href='../collab/infoSlot?idSlot=".$element["idslot"]."'><img src='../../images/info.png' alt='S'inscrire a l'atelier'></a>
            </div>";
        }

        $this->_mySlot = $result;
    }
    public function setInfoUser($user){
        $this->_firstName = $user->get_firstname();
        $this->_lastName = $user->get_lastname();
        $this->_birthDate = $user->get_birthdate();
        $this->_phoneNumber = $user->get_phoneNumber();
        $this->_mail = $user->get_mail();
        $this->_session = $_SESSION["session_name"];
    } 

    public function setInfoSlot($element){
        $result = 
        "<div class='eloce' style='background-color:".$element["color"]."'>".$element["dtsf"]."-".$element["dtef"]." - ".$element["nTheme"]." - ".$element["nActivity"]."</div><br>";
        $result .=
        "<div style='margin-left: 5%;'><label></label><img src='".$element['image']."'</img></div>";
        $result .=
        "<div style='margin-left: 5%;'><label>Description</label><p id='desc'>".$element['description']."</p></div>";
        $result .=
        "<div style='margin-left: 5%;'><label>Description détaillée</label><p id='desc'>".$element['detailedDescription']."</p></div>";
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
                "<div class='row justify-content-center'>
                <div id='listELOCE' class='eloce' style='background-color:".$activity["color"]."'>".$activity["dtsf"]."-".$activity["dtef"]." - ".$activity["nTheme"]." - ".$activity["nActivity"]."</div>
                <a id='signups' href='../collab/signUpSlot?idSlot=".$activity["idslot"]."&idActivity=".$activity["idActivity"]."'><img src='../../images/add.png' alt='S'inscrire a l'atelier'></a> 
                </div>";    
            }
        $this->_listActivity = $result;
    } 
    public function setInfoSlotButton($element){
        $result =
        "<a id='inputSubmit' style='text-decoration: none;' href='../../index.php/collab/signUpSlot?idSlot=".$element["idslot"]."&idActivity=".$element["idActivity"]."'>Inscription</a><br></br><br>";
        $result .=
        "<a id='inputSubmit' style='background-color: red; text-decoration: none;' href='../../index.php/collab/deregistrationSlot?idslot=".$element['idslot']."&idActivity=".$element["idActivity"]."'>Désinscription</a><br></br><br>";
        $this->_infoSlotButton = $result;
    }

    public function getTheme($themes){
        $result ="";
        foreach ($themes as $theme) {
            $result .=
            "<a href='../collab/infoTheme?idTheme=".$theme->get_idTheme()."'>
                <button class='btn' style='background-color:".$theme->get_color()."; color: black; font-size: 22px;'>
                ".$theme->get_name()."
                </button>
            </a>";
        }
        $this->_themes = $result;
    }
    
    public function setInfoTheme($theme){
            $result =
                "<div class='row justify-content-center'> 
                        <div id='listELOCE' class='eloce' style='background-color:".$theme->get_color()."'>
                            ".$theme->get_name()."
                        </div>
                </div><br>";
            $result .=
                "<h3>Objectifs :</h3>
                    <p>".$theme->get_description()."</p>
                <br>";
            $result .=
                "<h3>Contenu :</h3>
                <p>".$theme->get_detailsDescription()."</p>
                <br>";      
            $result .=
               "<a  id='btnActivity' href='./activityList?idTheme=".$theme->get_idTheme()."&nTheme=".$theme->get_name()."&colorTheme=".$theme->get_color()."'>Activités de ce Thème</a>";
            $this->_infoTheme = $result;
    }
    public function setInfoActivity($activity){
        $result =
            "<div class='row justify-content-center'> 
                    <div id='listELOCE' class='eloce'>
                        ".$activity->get_name()."
                    </div>
            </div><br>";
        $result .=
                "<img id='imgActivity' src='".$activity->get_image()."'</img>";
        $result .=
            "<h3>Objectifs :</h3>
                <p>".$activity->get_description()."</p>
            <br>";
        $result .=
            "<h3>Contenu :</h3>
            <p>".$activity->get_detailedDescription()."</p>
            <br>";   
       /*  $result .=   
        "<a  id='listActivity' href='../collab/listActivity?id_activity=".$activity["id_activity"]."'>
            <img src='../../images/dossier.png' alt='créneaux pour une activité'>
        </a>"; */
  
        $this->_infoActivity = $result;
    }
    public function setActivityList($nameTheme,$activityList,$colorTheme){
        $result ="";   
        foreach ($activityList as $activity) {
            $result .=
                "<a href='../collab/infoActivity?idActivity=".$activity->get_idActivity()."'>
                <button class='btn' style='background-color:".$colorTheme." color: black; font-size: 22px;'>
                    ".$activity->get_name()."
                    </button>
                </a>"; 
        }
            $this->_activityList = $result;
            $this->_nameTheme = $nameTheme;
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

            case "listActivity": include "listActivity.phtml"; 
            break;

            case "theme": include "theme.phtml";
            break;

            case "infoTheme": include "infoTheme.phtml";
            break;

            case "activityList": include "activityList.phtml";
            break;

            case "infoActivity": include "infoActivity.phtml";
            break;

            default: include "dashboard.php";

        }
    }
}   

?>