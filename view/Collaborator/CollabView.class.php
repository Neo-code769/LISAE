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
                <div id='listELOCE' class='eloce' style='background-color:".$element["color"]."'>".$dateForm."-".$element["dte"]." - ".$element["nTheme"]." - ".$element["nActivity"]."</div>
                <a  id='signup' href='../collab/signUpSlot?idSlot=".$element["idslot"]."&idActivity=".$element["id_activity"]."'><img src='../../images/add.png' alt='S'inscrire a l'atelier'></a>
                <a  id='info' href='../collab/infoSlot?idSlot=".$element["idslot"]."'><img src='../../images/info.png' alt='S'inscrire a l'atelier'></a>
            </div>";
        }

        $this->_eloce = $result;
    }

    public function setInfoUser($info){
        $this->_infoUser = $info;
    }

    /****** REQUETE INFO USER PIERRE BULLSHIT ******/

    public function setInfoLastname($id) {
        $pdo = Dao::getConnexion();

        $requete = $pdo->prepare("SELECT lastname FROM users WHERE id_user=$id");
        try {
            $requete->execute();
            while($donnees = $requete->fetch(PDO::FETCH_ASSOC)) {
                $result = $donnees['lastname'];
            }
        }   catch (PDOException $e) {
            echo " ERREUR REQUETE : " . $e->getMessage();
            die();
            }
        return $result;
    }

    public function setInfoFirstname($id) {
        $pdo = Dao::getConnexion();

        $requete = $pdo->prepare("SELECT firstname FROM users WHERE id_user=$id");
        try {
            $requete->execute();
            while($donnees = $requete->fetch(PDO::FETCH_ASSOC)) {
                $result = $donnees['firstname'];
            }
        }   catch (PDOException $e) {
            echo " ERREUR REQUETE : " . $e->getMessage();
            die();
            }
        return $result;
    }

    public function setInfoBirthdate($id) {
        $pdo = Dao::getConnexion();

        $requete = $pdo->prepare("SELECT birthdate FROM users WHERE id_user=$id");
        try {
            $requete->execute();
            while($donnees = $requete->fetch(PDO::FETCH_ASSOC)) {
                $result = $donnees['birthdate'];
            }
        }   catch (PDOException $e) {
            echo " ERREUR REQUETE : " . $e->getMessage();
            die();
            }
        return $result;
    }

    public function setInfoPhone($id) {
        $pdo = Dao::getConnexion();

        $requete = $pdo->prepare("SELECT PhoneNumber FROM users WHERE id_user=$id");
        try {
            $requete->execute();
            while($donnees = $requete->fetch(PDO::FETCH_ASSOC)) {
                $result = $donnees['PhoneNumber'];
            }
        }   catch (PDOException $e) {
            echo " ERREUR REQUETE : " . $e->getMessage();
            die();
            }
        return $result;
    }

    public function setInfoMail($id) {
        $pdo = Dao::getConnexion();

        $requete = $pdo->prepare("SELECT mail FROM users WHERE id_user=$id");
        try {
            $requete->execute();
            while($donnees = $requete->fetch(PDO::FETCH_ASSOC)) {
                $result = $donnees['mail'];
            }
        }   catch (PDOException $e) {
            echo " ERREUR REQUETE : " . $e->getMessage();
            die();
            }
        return $result;
    }

    /******************************/

    public function setInfoSlot($element){
        $result = 
        "<div class='eloce' style='background-color:".$element["color"]."'>".$element["dts"]."-".$element["dte"]." - ".$element["nTheme"]." - ".$element["nActivity"]."</div><br>";
        $result .=
        "<div style='margin-left: 5%;'><label>Information</label><p id='desc'>".$element['information']."</p></div><br>";
        $result .=
        "<div style='margin-left: 5%;'><label>Lieu</label><p id='desc'>".$element['place']."</p></div>";
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