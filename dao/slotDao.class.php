<?php

class slotDao extends Dao {

    public function getListSlot(){
        
    }

    public function getList(): array{
        return $tab=[];
    }	
    
    public function getListSlotForActivity($NameActivity)
    {
        $list = []; 
        $sql = Dao::getConnexion();
        $requete = $sql->prepare(
        "SELECT * FROM host 
        INNER JOIN activity ON activity.id_activity = host.id_activity
        WHERE activity.name = $NameActivity"
        );
        try {
            $requete->execute();
            while($donnees = $requete->fetch(PDO::FETCH_ASSOC))
            {
                $sessionName=$donnees['session_name'];
                $session = new SessionTraining($sessionName);
                $list[] = $session;
            }
        }
        catch (PDOException $e) {
            throw new LisaeException("Erreur requête", 1);
        }
        return $list;
    }
    
    public function get(int $id) : array{
        return $tab=[];
    }	
    
    public function insert($obj) : void{

    }

    // delete via son id
    public function delete(int $id ){

    }

    // update d'un objet
    public function update($obj ){

    }
}

?>