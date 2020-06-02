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

    public function select() : void 
    {

    }

    public function getSessionTrainingList() : array 
    {
        $list = []; 
        $sql = Dao::getConnexion();
        $requete = $sql->prepare("SELECT `host.slotDate`, `activity.name`, `host.slotHour` 
                FROM `session` INNER JOIN `tie` ON `tie.id_session` = `session.id_session`
                                INNER JOIN `training` ON `training.id_training` = `tie.id_training` 
                WHERE `users.id_user` = `host.id_user` ");
        try {
            $requete->execute();
            while($donnees = $requete->fetch(PDO::FETCH_ASSOC))
            {
                $slotDate=$donnees['slotDate'];
                $name=$donnees['name'];
                $slotHour=$donnees['slotHour'];
                $id_session=$donnees['id_session'];
                $id_training=$donnees['id_training'];
                $id_user=$donnees['id_user'];
                $session = new SessionTraining();
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