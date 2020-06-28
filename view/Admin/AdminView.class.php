<?php

class AdminView extends LisaeTemplateConnected {
    private $_userList;
    private $_themeList;
    private $_collabList;
    private $_animList;
    private $_listTheme;
    private $_infoTheme;
    private $_listActivity;
    private $_nameTheme;
    private $_colorTheme;
    private $_infoActivity;
    private $_sessionList;
    private $_infoSession;
    private $_trainingList;
    private $_infoTraining;
    private $_infoAnim;

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
            <body id="admin">
                    <header>
                        <div id="headerIMG">
                            <img style="float:left" src="/images/LISAE.png" alt="logo LISAE" />
                            <div class="buttons">
                                <a href="../admin/listTheme"><button class="btn-hover color-1" style="text-decoration: none; color: black;">Thèmes</button></a>
                                <a href="../admin/listTraining"><button class="btn-hover color-1" style="text-decoration: none; color: black;">Formation</button></a>
                                <a href="../admin/accountManagement"><button class="btn-hover color-1" style="text-decoration: none; color: black;">Gestion Compte</button></a>
                                <a href="../anim/dashboard"><button class="btn-hover color-1" style="text-decoration: none; color: black;"> Mode Animateur</button></a>
                                <a href="../password/logout"><button class="btn-hover color-1" style="text-decoration: none; color: black;">Deconnexion</button></a>
                            </div>
                        </div>
                    </header>
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

            case "listSession": include "listSession.phtml";
            break;

            case "infoSession": include "infoSession.phtml";
            break;

            case "listTraining": include "listTraining.phtml";
            break;

            case "infoTraining": include "infoTraining.phtml";
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
                    
                    <a  id='listActivity' href='./listActivity?idTheme=".$theme->get_idTheme()."&nTheme=".$theme->get_name()."&colorTheme=".substr($theme->get_color(),1)."'><img src='../../images/dossier.png' alt='créneaux pour une activité'></a>
                    <a  id='info' href='../admin/infoTheme?idTheme=".$theme->get_idTheme()."'><img src='../../images/info.png' alt='info d'un créneau'></a>
            </div>";
        }
        $this->_listTheme = $result;
    }

    public function getListCollab($collabList) {
        $result ="";
        foreach ($collabList as $user) {
            $result .="
        <tr>
            <td>".$user['Firstname']."</td>
            <td>".$user['Lastname']."</td>
            <td>".$user['PhoneNumber']."</td>
            <td>".$user['mail']."</td>
            <td>".$user['session']."</td>
            <td><a style='color: red;' href='../admin/deleteCollab?idUser=".$user['id_user']."'> X </a></td>
        </tr>";
        }
        $this->_collabList = $result;
    }

    public function getListAnim($animList) {
        $result ="";
        foreach ($animList as $user) {
            $result .="
        <tr>
            <td>".$user['Firstname']."</td>
            <td>".$user['Lastname']."</td>
            <td>".$user['PhoneNumber']."</td>
            <td>".$user['mail']."</td>
            <td><a style='color: red;' href='../admin/deleteAnim?idUser=".$user['id_user']."'> X </a></td>
        </tr>";
        }
        $this->_animList = $result;
    }
    public function setInfoTheme($theme){
        $result1 = "";
            $result =
                "<div class='row justify-content-center'> 
                        <div id='listELOCE' class='eloce' style='background-color:".$theme->get_color()."'>
                            ".$theme->get_name()."
                        </div>
                </div><br>";
            $result .=
                "<div style='margin-left: 5%;'>
                    <label>Nom :</label>
                    <input type='text' name='name' value='".$theme->get_name()."'>
                </div><br>";
            $result .=
                "<div style='margin-left: 5%;'>
                    <label>Color :</label>
                    <input type='color' name='color' value='".$theme->get_color()."'>
                </div><br>";    
            $result .=
                "<div style='margin-left: 5%;'>
                    <label>Description du thème :</label>
                    <textarea name='description' cols='60' rows='7'>".$theme->get_description()."</textarea><br><br>
                </div><br>";
            $result .=
                '<div style="margin-left: 5%;">
                    <label>Description détaillée :</label>
                    <textarea name="detailedDescription" cols="60" rows="7">'.$theme->get_detailsDescription().'</textarea><br><br>
                </div><br>';        
        $this->_infoTheme = $result;
        
    }

    public function setInfoAnim($animList,$referentList){
        //Animateur référent 1
        $result = "
        <div style='margin-left: 5%;'>
        ";
        
        $result .="
        <table style ='border-collapse: collapse; border:1px solid black; '>
            <tr>
                <th style='width: 80%;'>Referent(s)</th>
                <th style='width: 20%;'></th>
            </tr>
        "; 

        //Supprimer référent
        foreach ($referentList as $referent) {
            if (isset($referentList)) {
                $result .= "
                <tr>
                    <td style='width: 80%;'>".$referent->get_lastname()." ".$referent->get_firstname()."</td>
                    <td style='width: 20%;'>
                        <form method='post'>
                            <input type='hidden' name='idUser' value='".$referent->get_idUser()."'>
                            <input id='inputSubmit' style='background-color:red;font-size:80%;padding-left:7%'' type='submit' name='deleteRefer' value = 'Supprimer'>
                        </form>
                    </td>
                </tr>";
            }else {
                $result .="Pas de référent pour ce théme";
            }
        }

        //Ajout autre referéent

        //Afficher autre référent
        $otherAnimator = array_udiff($animList, $referentList,
        function ($obj_a, $obj_b) {
            return $obj_a->get_idUser() - $obj_b->get_idUser();
        }
        );

        $result .="<tr><form method='post'><td style='width: 80%;'><select name='idUser'>";
        foreach ($otherAnimator as $anim) {
            $result .= "<option value='".$anim->get_idUser()."'>".$anim->get_lastname()." ".$anim->get_firstname()."</option>";
        }
        $result .="</td><td style='width: 20%;'><input id='inputSubmit' style='font-size:80%;padding-left:7%'' type='submit' name='createRefer' value = 'Ajouter'></td></form></tr>";

        $result .='</table></div><br>'; 

        $this->_infoAnim = $result;
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

    public function setListSession($sessionList){
        $result ="";
        foreach ($sessionList as $session) {
            $result .=
            "<div class='row justify-content-center'> 
                    <div id='listELOCE' class='eloce' style='background-color:grey'>
                        ".$session->get_nameSession()."
                    </div>
                    <a  id='info' href='./infoSession?idSession=".$session->getIdSession()."&nTraining=".$_GET['nTraining']."'><img src='../../images/info.png' alt='info d'une session de formation'></a>   
            </div>";
        }
        $this->_sessionList = $result;
    }

    public function setListTraining($trainingList){
        $result ="";
        foreach ($trainingList as $training) {
            $result .=
            "<div class='row justify-content-center'> 
                    <div id='listELOCE' class='eloce' style='background-color:grey'>
                        ".$training["name"]."
                    </div>
                    <a  id='listSession' href='./listSession?nTraining=".$training['name']."'><img src='../../images/dossier.png' alt='créneaux pour une formation'></a>
                    <a  id='info' href='./infoTraining?idTraining=".$training['id_training']."'><img src='../../images/info.png' alt='info d'une formation'></a>   
            </div>";
        }
        $this->_trainingList = $result;
    } 

    public function setInfoTraining($training){
        $result =
        "<div class='row justify-content-center'> 
            <div id='listELOCE' class='eloce' style='background-color:green'>
                ".$training["name"]."
            </div>
        </div><br>";
        $result .=
            "<div style='margin-left: 5%;'>
                <label>Nom de la formation</label>
                <input type='text' name='name' value='".$training["name"]."'>
            </div><br>";
        $this->_infoTraining = $result;
    }
    
    public function setInfoSessionPae($session, $pae){
        $result =
            "<div class='row justify-content-center'> 
                <div id='listELOCE' class='eloce' style='background-color:grey'>
                    ".$session->get_nameSession()."
                </div>
            </div><br>";
        $result .=
                '<input type="number" hidden name="idPae1" value='.$pae[0]->get_idPae().'>
                <input type="number" hidden name="idPae2" value='.$pae[1]->get_idPae().'>
                <input type="number" hidden name="idPae3" value='.$pae[2]->get_idPae().'>';
        $result .=
            "<div style='margin-left: 5%;'>
                <label>Nom de la formation:</label>
                <input type='text' name='name' value='".$session->get_nameSession()."'>
            </div><br>";
        $result .=
            "<div style='margin-left: 5%;'>
                <label>Début de la formation :</label>
                <input type='date' name='startDateFormation' value='".$session->get_startDateFormation()."'>
            </div><br>";
        $result .=
            "<div style='margin-left: 5%;'>
                <label>Fin de la formation : </label><br>
                <input type='date' name='endDateFormation' value='".$session->get_endDateFormation()."'>
            </div><br>";
        $result .=
            "<div style='margin-left: 5%;'>
                <label>Début de la première PAE :</label>
                <input type='date' name='startDatePae1' value='".$pae[0]->get_startDatePae()."'>
            </div><br>"; 
        $result .=
            "<div style='margin-left: 5%;'>
                <label>Fin de la première PAE :</label>
                <input type='date' name='endDatePae1' value='".$pae[0]->get_endDatePae()."'>
            </div><br>";
        $result .=
            "<div style='margin-left: 5%;'>
                <label>Début de la deuxième PAE :</label>
                <input type='date' name='startDatePae2' value='".$pae[1]->get_startDatePae()."'>
            </div><br>"; 
        $result .=
            "<div style='margin-left: 5%;'>
                <label>Fin de la deuxième PAE :</label>
                <input type='date' name='endDatePae2' value='".$pae[1]->get_endDatePae()."'>
            </div><br>";  
        $result .=
            "<div style='margin-left: 5%;'>
                <label>Début de la troisième PAE :</label>
                <input type='date' name='startDatePae3' value='".$pae[2]->get_startDatePae()."'>
            </div><br>"; 
        $result .=
            "<div style='margin-left: 5%;'>
                <label>Fin de la troisième PAE :</label>
                <input type='date' name='endDatePae3' value='".$pae[2]->get_endDatePae()."'>
            </div><br>";     
        $this->_infoSession = $result;

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
            <img id = 'imgActivity' src=".$activity->get_image()."></img><br>
            <label>Changer d'image :</label>
            <input class='upload' type='file' name='image'><br><br>
            </div><br>";
        $result .=
            "<div style='margin-left: 5%;'>
                <label>Nom :</label>
                <input type='text' name='name' value='".$activity->get_name()."'>
            </div><br>";
        $result .=
            "<div style='margin-left: 5%;'>
                <label>Description de l'activité :</label>
                <textarea name='description' cols='60' rows='7'>".$activity->get_description()."</textarea><br><br>
            </div><br>";
        $result .=
            '<div style="margin-left: 5%;">
                <label>Description détaillée :</label>
                <textarea name="detailedDescription" cols="60" rows="7">'.$activity->get_detailedDescription().'</textarea><br><br>
            </div><br>';   
            $this->_infoActivity = $result;
    }

}   

?>