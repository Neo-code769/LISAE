<?php

class userDao extends Dao{

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

    public function getSessionList() : void 
    {
        $sql = "SELECT `host.slotDate`, `activity.name`, `host.slotHour` 
                FROM `session` INNER JOIN `tie` ON `tie.id_session` = `session.id_session`
                                INNER JOIN `training` ON `training.id_training` = `tie.id_user` 
                WHERE `users.id_user` = `host.id_user` ";
        $exec = (Dao::getConnexion())->prepare($sql);
        try {
        $exec->execute();
        }
        catch (PDOException $e) {
            throw new LisaeException("Erreur requête", 1);
        }
    }
    
    // delete via son id
    public function delete(int $id ){

    } 

    // update d'un objet
    public function update($obj){
        
    } 

}