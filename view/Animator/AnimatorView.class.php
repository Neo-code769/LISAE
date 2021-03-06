<?php

class AnimatorView extends LisaeTemplateConnected {

    private $_infoUser;
    private $_sessionSlot;
    private $_eloce;
    private $_infoSlot1;
    private $_infoSlot2;
    private $_infoSlotButton;
    private $_lastname;
    private $_firstName;
    private $_birthDate;
    private $_mail;
    private $_phoneNumber;
    private $_mySlot;
    private $_session;
    private $_listActivity;
    private $_presence;
    private $_emargement;
    

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

            case "infoSlotEloce": include "infoSlotEloce.phtml";
            break;

            case "infoUser": include "infoUser.phtml";
            break;

            case "ListELOCE": include "ListELOCE.phtml";
            break;

            case "createSlot": include "createSlot.phtml";
            break;

            case "presence": include "presence.phtml";
            break;

            case "emargement": include "emargement.phtml";
            break;

        default: include "dashboard.phtml";
        
            

        }
    }

    public function setHeader($errorMess) {
        if ($_SESSION['role']!='Animator' && $_SESSION['role']!='Admin') {
            echo "Vous ne pouvez pas accéder a cette page !";
            header("Refresh:2;url=http://www.lisae.fr:8081/index.php");
        }
        echo <<<EOD
            <body>
            <header>
                    <div id="headerIMG">
                        <img style="float:left;" src="/images/LISAE.png" alt="logo LISAE" />
                        <div class="buttons">
                            <a href="./dashboard"><button class="btn-hover color-1" style="text-decoration: none; color: black;">Tableau de Bord</button></a>
                            <a href="../anim/eloce"><button class="btn-hover color-1" style="text-decoration: none; color: black;"> Calendrier ELOCE</button></a>
                            <a href="../anim/createSlot"><button class="btn-hover color-1" style="text-decoration: none; color: black;">Nouveau Créneau</button></a>
                            <a href="../anim/info"><button class="btn-hover color-1" style="text-decoration: none; color: black;">Mon Compte</button></a>
        EOD;
        if ($_SESSION['role']=='Admin') {
            echo "<a href='../../index.php/admin/dashboard'><button class='btn-hover color-1' style='text-decoration: none; color: black;'> Mode Admin</button></a>";
        }
        echo <<<EOD
                                <a href="../password/logout"><button class="btn-hover color-1" style="text-decoration: none; color: black;">Deconnexion</button></a>
                            </div>
                        </div>
                </header>
            EOD;
        echo "<p>".$errorMess."</p>";
        
    }
    
    private $_activityList = null;

    public function setActivityList($activityList){
        $result = "";
        foreach ($activityList as $activityList1) {
            foreach ($activityList1 as $activity) {
                if(!empty($activity)){
                    $result .= "<option value='".$activity->get_name()."'>".$activity->get_name()."</option>";
                }
            }
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
            $dateForm =utf8_encode(strftime('%A %d %B %Y %H:%M', strtotime($element["dts"])));
            
                $result .=
                "<div class='row justify-content-center' style='margin-bottom:1%'> 
                    <a style='text-decoration: none;' href='../anim/infoSlot?idSlot=".$element["idslot"]."&id_activity=".$element["id_activity"]."'>
                    <div id='listELOCE' class='eloce' style='background-color:".$element["color"]."'>".$dateForm."-".$element["dte"]." - ".$element["nTheme"]." - ".$element["nActivity"]."
                    </a><div style='margin-left:5%'>".$element['participateNumber']."</div></div>
                    <a  id='info' href='../anim/infoSlot?idSlot=".$element["idslot"]."&id_activity=".$element["id_activity"]."'><img src='../../images/info.png' alt='S'inscrire a l'atelier'></a>
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
            $dateForm =utf8_encode(strftime('%A %d %B %Y %H:%M', strtotime($element["dts"])));
            $result .=
            "<div class='row justify-content-center' style='margin-bottom:1%'> 
            <a style='text-decoration: none;' href='../anim/infoSlotEloce?idSlot=".$element["idslot"]."'><div id='listELOCE' class='eloce' style='background-color:".$element["color"]."'>".$dateForm."-".$element["dte"]." - ".$element["nTheme"]." - ".$element["nActivity"]."</a></div>
            <a  id='info' href='../anim/infoSlotEloce?idSlot=".$element["idslot"]."'><img src='../../images/info.png' alt='info d'un créneau'></a>
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
        if (array_key_exists('NameTheme',$_SESSION)) {
            $this->_myTheme = $_SESSION['NameTheme'];
        }else {
            $this->_myTheme = "Vous n'êtes réferent.e d'aucun thème";
        }
    } 

    public function setInfoSlot($element){
        $result1 = 
        "<div class='eloce' style='background-color:".$element["color"]."'>".$element["dtsf"]."-".$element["dtef"]." - ".$element["nTheme"]." - ".$element["nActivity"]."</div><br><br>";
        $result2 =
        "<div style='margin-left: 5%;'><label>Information </label><input style='margin-left:1%' type='text' name='information' style='width:40%;' value='".$element["information"]."'><br><br></div><br>
        <div style='margin-left: 5%;'><label>Lieu</label><input style='margin-left:1%' type='text' name='place' style='width:40%;' value='".$element["place"]."'><br><br></div>";
        
        $this->_infoSlot1 = $result1;
        $this->_infoSlot2 = $result2;
    }

     public function setListForActivity($element) {
        setlocale(LC_TIME, ['fr', 'fra', 'fr_FR']);
        $result = "";
        foreach ($element as $activity) {
            $result .= 
                "<div id='listELOCE' class='eloce' style='background-color:".$activity["color"]."'>".utf8_encode(strftime('%A %d %B %Y %H:%M', strtotime($activity["dts"])))."-".$activity["dte"]." - ".$activity["nTheme"]." - ".$activity["nActivity"]."</div> <a  id='signups' href='../collab/signUpSlot?idSlot=".$activity["idslot"]."&idActivity=".$activity["idActivity"]."'><img src='../../images/add.png' alt='S'inscrire a l'atelier'></a>"; 
                }
        $this->_listActivity = $result;
    } 

    public function setPresence($listUser){
        //var_dump($listUser);
        $result ="";
        foreach ($listUser as $user) {
            $check="";
            if ($user['presence']==1) {
                $check = "checked";
            }
            $result .="
            <tr>
                <td>".$user['Firstname']."</td>
                <td>".$user['Lastname']."</td>
                <td>".$user['PhoneNumber']."</td>
                <td>".$user['mail']."</td>
                <td>".$user['session_name']."</td>
                <td><input type='checkbox' name='check[]' value=".$user['id_user']." class='checkClass' $check ></td>
            </tr>";
        }
        $this->_presence=$result;
    }

    public function setEmargement($listUser){
        $result ="";
        foreach ($listUser as $user) {
            if ($user['presence']==1) {
            }
            $result .="
            <tr>
                <td>".$user['Firstname']."</td>
                <td>".$user['Lastname']."</td>
                <td>".$user['PhoneNumber']."</td>
                <td>".$user['session_name']."</td>
                <td> Emargement </td>
            </tr>";
        }
        $this->_emargement=$result;
    }
}   

?>