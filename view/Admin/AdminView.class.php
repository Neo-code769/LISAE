<?php

class AdminView extends LisaeTemplateConnected {
    private $_userList;
    private $_themeList;
    private $_listCollab;
    private $_listAnim;
    private $_listTheme;
    private $_infoTheme;
    private $_listActivity;
    private $_nameTheme;
    private $_colorTheme;
    private $_infoActivity;

    public function __construct()
    {
        parent::__construct();
    } 

    public function setHeader($errorMess) {
        if ($_SESSION['role']!='Admin') {
            echo "Vous ne pouvez pas accéder a cette page !";
            header("Refresh:2;url=http://www.lisae.fr:8081/index.php");
        }
        echo <<<EOD
            <header>
                <div id="headerIMG">
                    <img src="/images/LISAE.png" alt="logo LISAE" />
                        <div class="buttons">
                        
                        <a href="../admin/listTheme"><button class="btn-hover color-1" style="text-decoration: none; color: black; font-size: 24px;">Thèmes</button></a>
                            <a href="../admin/createFormation"><button class="btn-hover color-1" style="text-decoration: none; color: black; font-size: 24px;">Créer Formation</button></a>
                            <a href="../admin/createSession"><button class="btn-hover color-1" style="text-decoration: none; color: black; font-size: 24px;">Créer Session</button></a>
                            <a href="../anim/dashboard"><button class="btn-hover color-1" style="text-decoration: none; color: black; font-size: 24px;"> Mode Animateur</button></a>
                            <a href="../password/logout"><button class="btn-hover color-1" style="text-decoration: none; color: black; font-size: 24px;">Deconnexion</button></a>
                            <a href="../admin/accountManagement"><button class="btn-hover color-1" style="text-decoration: none; color: black; font-size: 24px;">Gestion Compte</button></a>
                        </div>
                </div>
                <div class="lifeline"></div>
            </header>
            <div id="margin"></div>
            <body id="admin">
            EOD;
        echo "<p>".$errorMess."</p>";
    }

    public function setBody($content) {

        switch ($content) {

            case "dashboard": include "dashboard.php";
            break;

            case "createTheme": include "createTheme.phtml";
            break;

            case "createActivity": include "createActivity.phtml";
            break;

            case "createFormation": include "createFormation.phtml";
            break;

            case "createSession": include "createSession.phtml";
            break;

            case "accountManagement": include "accountManagement.phtml";
            break;

            case "collabManagement": include "collabManagement.phtml";
            break;

            case "animManagement": include "animManagement.phtml";
            break;

            case "listTheme": include "listTheme.phtml";
            break;

            case "infoTheme": include "infoTheme.phtml";
            break;
            
            case "listActivity": include "listActivity.phtml";
            break;

            case "infoActivity": include "infoActivity.phtml";
            break;

            default: include "dashboard.php";

        }
    }
  
    public function setUserList($userList){
        $result = "";
        foreach ($userList as $user) {
            $result .= "<option value='".$user->get_idUser()."'>".$user->get_lastname()." ".$user->get_firstname()."</option>";
        }
        $this->_userList = $result;
    }

    public function setThemeList($themeList){
        $result ="";
        foreach ($themeList as $theme) {
            $result .="<option value='".$theme->get_idTheme()."'>".$theme->get_name()."</option>";
        }
        $this->_themeList = $result;
    }

    public function setListTheme($listTheme){
        $result ="";
        //var_dump($listTheme);
        foreach ($listTheme as $theme) {
            $result .=
            "<div class='row justify-content-center'> 
                    <div id='listELOCE' class='eloce' style='background-color:".$theme->get_color()."'>
                        ".$theme->get_name()."
                    </div>
                    
                    <a  id='listActivity' href='./listActivity?idTheme=".$theme->get_idTheme()."&nTheme=".$theme->get_name()."&colorTheme=".$theme->get_color()."'><img src='../../images/dossier.png' alt='créneaux pour une activité'></a>
                    <a  id='info' href='../admin/infoTheme?idTheme=".$theme->get_idTheme()."'><img src='../../images/info.png' alt='info d'un créneau'></a>
            </div>";
        }
        $this->_listTheme = $result;
    }
    public function getListCollab($list) {
        $result ="";
        foreach ($list as $user) {
            $result .="
        <tr>
            <td>".$user['Firstname']."</td>
            <td>".$user['Lastname']."</td>
            <td>0".$user['PhoneNumber']."</td>
            <td>".$user['mail']."</td>
            <td>".$user['session']."</td>
            <td><a style='color: red;' href='../admin/deleteCollab?idUser=".$user['id_user']."'> X </a></td>
        </tr>";
        }
        $this->_listCollab = $result;
    }

    public function getListAnim($list) {
        $result ="";
        foreach ($list as $user) {
            $result .="
        <tr>
            <td>".$user['Firstname']."</td>
            <td>".$user['Lastname']."</td>
            <td>0".$user['PhoneNumber']."</td>
            <td>".$user['mail']."</td>
            <td><a style='color: red;' href='../admin/deleteAnim?idUser=".$user['id_user']."'> X </a></td>
        </tr>";
        }
        $this->_listAnim = $result;
    }
    public function setInfoTheme($theme){
            $result =
            "<div class='row justify-content-center'> 
                    <div id='listELOCE' class='eloce' style='background-color:".$theme->get_color()."'>
                        ".$theme->get_name()."
                    </div>
            </div>";
            $result .=
            "<div style='margin-left: 5%;'><label>Nom</label><input type='text' name='name' value='".$theme->get_name()."'></div><br>";
            $result .=
                "<div style='margin-left: 5%;'><label>Color</label><input type='color' name='color' value='".$theme->get_color()."'></div><br>";    
            $result .=
                "<div style='margin-left: 5%;'><label>Description</label><input type='text' name='description' value='".$theme->get_description()."'</div><br>";
            $result .=
                "<div style='margin-left: 5%;'><label>Description détaillée</label><input type='text' name='detailedDescription' value='".$theme->get_detailsDescription()."'></div><br>";      
        
        $this->_infoTheme = $result;
    }

    public function setListActivity($nameTheme,$listActivity,$colorTheme){
        $result ="";
        //var_dump($listActivity);
        foreach ($listActivity as $activity) {
            $result .=
            "<div class='row justify-content-center'> 
                <div id='listELOCE' class='eloce' style='background-color:".$colorTheme."'>
                    ".$activity->get_name()."
                </div><a  id='info' href='./infoActivity?idActivity=".$activity->get_idActivity()."'><img src='../../images/info.png' alt='info d'un créneau'></a>
            </div>";
        }
        $this->_listActivity = $result;
        $this->_nameTheme = $nameTheme;
    }

    public function setInfoActivity($theme, $activity){
        $result =
        "<div class='row justify-content-center'> 
                <div id='listELOCE' class='eloce' style='background-color:".$theme->get_color()."'>
                    ".$theme->get_name()."
                </div>
        </div><br>";
        $result .=
            "<div style='margin-left: 5%;'>
                <label>Nom</label>
                <input type='text' name='name' value='".$activity->get_name()."'>
            </div><br>";
        $result .=
            "<div style='margin-left: 5%;'>
                <label>Description</label>
                <input type='text' name='description' value='".$activity->get_description()."'>
            </div><br>";
        $result .=
            "<div style='margin-left: 5%;'>
                <label>Description détaillée</label>
                <input type='text' name='detailedDescription' value='".$activity->get_detailedDescription()."'>
            </div><br>";   
    $this->_infoActivity = $result;
}

}   

?>