<?php

class sessionTrainingDao extends Dao{

    public function getList(): array{

        return [];
    }

    
    public function get(int $id) : array{
        return [];
    }
    
    public function insert($obj) :void
    {
    }

    public function insertForSession($obj) :void
    {
        $sql = 
        "INSERT INTO `tie` (`id_tie`),`id_user`,`id_training`,`id_session`) VALUES (null, ?,?,?);
        ";
        $exec = (Dao::getConnexion())->prepare($sql);
        $exec->bindValue(1, $obj->get_firstname());
        $exec->bindValue(2, $obj->get_lastname());
        $exec->bindValue(3, $obj->get_birthdate());
        $exec->bindValue(4, $obj->get_phoneNumber());
        //var_dump($sql);
        try{
        $exec->execute();
        } 
        catch (PDOException $e) {
            //echo " echec lors de la création : " . $e->getMessage();
            //die();
            throw new LisaeException("Erreur",1);
        }
    }

    public function select() : void 
    {

    }

    public function getSessionTrainingList() : array 
    {
        $list = []; 
        $sql = Dao::getConnexion();
        $requete = $sql->prepare(
        "SELECT training.name, session.session_number 
        FROM session INNER JOIN tie ON tie.id_session = session.id_session 
        INNER JOIN training ON training.id_training = tie.id_training"
        );
        try {
            $requete->execute();
            while($donnees = $requete->fetch(PDO::FETCH_ASSOC))
            {
                $trainingName=$donnees['name'];
                $sessionNumber=$donnees['session_number'];
                $session = new SessionTraining($sessionNumber,$trainingName);
                $list[] = $session;
            }
        }
        catch (PDOException $e) {
            throw new LisaeException("Erreur requête", 1);
        }
        return $list;
    }
    
    // delete via son id
    public function delete(int $id ){

    } 

    // update d'un objet
    public function update($obj){
        
    } 

}