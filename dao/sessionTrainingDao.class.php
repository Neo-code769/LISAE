<?php

class SessionTrainingDao extends Dao{

    // requete pour attribuer une session de formation à un utilsateur

    public function insertForSession($obj/*le nom de la formation + numéro formation ex : "DWWM3"*/) :void
    {
        $separation = explode(" ", $obj);
        $sql = 
        "INSERT INTO `tie`       
         VALUES (null, 
            (SELECT MAX(`id_user`) FROM users),
            (SELECT id_training FROM training WHERE training.name LIKE '$separation[0]%'),
            (SELECT id_session FROM session WHERE session_name = '$obj'))
        ";
        $exec = (Dao::getConnexion())->prepare($sql);
        try{
        $exec->execute();
        } 
        catch (PDOException $e) {
            //echo " echec lors de la création : " . $e->getMessage();
            //die();
            throw new LisaeException("Erreur",1);
        }
    }

    //requete pour recuperer la liste des noms de sessions
    
    public function getSessionTrainingList() : array 
    {
        $list = []; 
        $sql = Dao::getConnexion();
        $requete = $sql->prepare(
        "SELECT session_name, id_session FROM session"
        );
        try {
            $requete->execute();
            while($donnees = $requete->fetch(PDO::FETCH_ASSOC))
            {
                $idSession=$donnees['id_session'];
                $sessionName=$donnees['session_name'];
                $session = new SessionTraining($idSession,$sessionName,null,null,null,null);
                $list[] = $session;
            }
        }
        catch (PDOException $e) {
            throw new LisaeException("Erreur requête", 1);
        }
        return $list;
    }

    // requete pour recuperer la session et le nom de session d'un utilisateur

    public function getSession($user){
        $sql = Dao::getConnexion();
        $requete = $sql->prepare(
        "SELECT session.id_session, session.session_name FROM session
        INNER JOIN tie on session.id_session = tie.id_session
         where id_user = $user"
        );
        try {
            $requete->execute();
            while($donnees = $requete->fetch(PDO::FETCH_ASSOC))
            {
                $idSession=$donnees['id_session'];
                $sessionName=$donnees['session_name'];
                $session = new SessionTraining($idSession, $sessionName,null,null,null,null);
            }
        }
        catch (PDOException $e) {
            throw new LisaeException("Erreur requête", 1);
        }
        return $session;
    }
    
    public function getList(): array{

        return [];
    }

    
    public function get(int $id) {
        return [];
    }  
    public function insertTraining($name){
        $sql = "INSERT INTO `training`(`id_training`,`name`) VALUES (null,?)";
        $exec = (Dao::getConnexion())->prepare($sql);
        try{ 
        $exec->execute([$name]);
        } 
        catch (PDOException $e) {
            throw new LisaeException("Erreur",1);
        }
    }
    public function insert($obj) :void{
        $sql = "INSERT INTO `session`(`id_session`, `StartDateFormation`, `endDateFormation`, `session_name`) VALUES (null,?,?,?)";
        $exec = (Dao::getConnexion())->prepare($sql);
        $exec->bindValue(1, $obj->get_startDateFormation());
        $exec->bindValue(2, $obj->get_endDateFormation());
        $exec->bindValue(3, $obj->get_nameSession());
        try{
        $exec->execute();
        } 
        catch (PDOException $e) {
            throw new LisaeException("Erreur",1);
        }
    }
    public function select() : void {

    }
    // delete via son id
    public function delete(int $idSession){
        $sql = "DELETE FROM `session` WHERE id_session = $idSession";
        $exec = (Dao::getConnexion())->prepare($sql);
        try{
        $exec->execute();
        } 
        catch (PDOException $e) {
            throw new LisaeException("Erreur",1);
        }
    } 
    public function deleteParticipateForSession($idSession){
        $sql = "DELETE FROM `participate` WHERE id_session = $idSession";
        $exec = (Dao::getConnexion())->prepare($sql);
        try{
        $exec->execute();
        } 
        catch (PDOException $e) {
            throw new LisaeException("Erreur",1);
        }
    } 
    public function deleteTraining($idTraining){
        $sql = "DELETE FROM `training` WHERE id_training = $idTraining";
        $exec = (Dao::getConnexion())->prepare($sql);
        try{
        $exec->execute();
        } 
        catch (PDOException $e) {
            throw new LisaeException("Erreur",1);
        }
    } 
    public function update($obj){

    }
    // update d'un objet
    public function updateSession($StartDateFormation,$endDateFormation, $sessionName,$idSession){
        $sql = "UPDATE `session` SET `StartDateFormation`='$StartDateFormation',`endDateFormation`='$endDateFormation',`session_name`='$sessionName' WHERE id_session = $idSession";
        $exec = (Dao::getConnexion())->prepare($sql);
        try{
        $exec->execute();
        } 
        catch (PDOException $e) {
            throw new LisaeException("Erreur",1);
        }
    }   
    public function updateTraining($name, $idTraining){
        $sql = "UPDATE `training` SET `name`='$name' WHERE id_training = $idTraining";
        $exec = (Dao::getConnexion())->prepare($sql);
        try{
        $exec->execute();
        } 
        catch (PDOException $e) {
            throw new LisaeException("Erreur",1);
        }
    }   
    public function getListSession($nTraining){
        $list = []; 
        $sql = Dao::getConnexion();
        $requete = $sql->prepare(
        "SELECT * FROM session
        WHERE SUBSTRING_INDEX(session_name,' ', 1) = '$nTraining'"
        );
        try {
            $requete->execute();
            while($donnees = $requete->fetch(PDO::FETCH_ASSOC))
            {
                $idSession=$donnees['id_session'];
                $sessionName=$donnees['session_name'];
                $startDateFormation=$donnees['StartDateFormation'];
                $endDateFormation=$donnees['endDateFormation'];
                $session = new SessionTraining($idSession,$sessionName,$startDateFormation,$endDateFormation);
                $list[] = $session;
            }
        }
        catch (PDOException $e) {
            throw new LisaeException("Erreur requête", 1);
        }
        return $list;
    }

    public function getListTraining(){
        $list = []; 
        $sql = Dao::getConnexion();
        $requete = $sql->prepare(
        "SELECT * FROM `training`"
        );
        try {
            $requete->execute();
            while($donnees = $requete->fetch(PDO::FETCH_ASSOC))
            {
                $idTraining=$donnees['id_training'];
                $name=$donnees['name'];
                $list[] = $donnees;
            }
            
        }
        catch (PDOException $e) {
            throw new LisaeException("Erreur requête", 1);
        }
        return $list;
    }

    public function getListPae($idSession){
        $list = []; 
        $sql = Dao::getConnexion();
        $requete = $sql->prepare(
        "SELECT * FROM `pae` WHERE id_session = $idSession"
        );
        try {
            $requete->execute();
            while($donnees = $requete->fetch(PDO::FETCH_ASSOC))
            {
                $idPae=$donnees['id_pae'];
                $startDatePae=$donnees['startDatePae'];
                $endDatePae=$donnees['endDatePae'];
                $pae = new Pae($idPae, $startDatePae, $endDatePae);
                $list[] = $pae;
            }
        }
        catch (PDOException $e) {
            throw new LisaeException("Erreur requête", 1);
        }
        return $list;
    }
    public function insertPae($obj) :void{
        $sql = "INSERT INTO `pae`(`id_pae`, `startDatePae`, `endDatePae`, id_session) VALUES (null,?,?,(SELECT MAX(id_session) from session)) ";
        $exec = (Dao::getConnexion())->prepare($sql);
        $exec->bindValue(1, $obj->get_startDatePae());
        $exec->bindValue(2, $obj->get_endDatePae());
        try{
            $exec->execute();
        } 
        catch (PDOException $e) {
            throw new LisaeException("Erreur",1);
        }
    }
    public function updatePae($startDatePae, $endDatePae,$idPae) :void{
        $sql = "UPDATE `pae` SET startDatePae='$startDatePae', `endDatePae`='$endDatePae' WHERE id_pae =$idPae ";
        $exec = (Dao::getConnexion())->prepare($sql);
        try{
            $exec->execute();
        } 
        catch (PDOException $e) {
            throw new LisaeException("Erreur",1);
        }
    }
    public function deletePae($idSession){
        $sql = "DELETE FROM `pae` WHERE id_session = $idSession";
        $exec = (Dao::getConnexion())->prepare($sql);
        try{
        $exec->execute();
        } 
        catch (PDOException $e) {
            throw new LisaeException("Erreur",1);
        }
    } 
} 