<?php

class SlotDao extends Dao {

    public function getListSlot(){
        
    }

    public function getList(): array{
        return $tab=[];
    }	
    
    public function getListSlotForActivity($idActivity)
    {
        $list = []; 
        $sql = Dao::getConnexion();
        $requete = $sql->prepare(
        "SELECT * FROM host 
        WHERE id_activity = $idActivity"
        );
        try {
            $requete->execute();
            while($donnees = $requete->fetch(PDO::FETCH_ASSOC))
            {
                $registrationDeadLine=$donnees['registrationDeadline'];
                $unsubscribeDeadLine=$donnees['unsubscribeDeadline'];
                $place=$donnees['place'];
                $information=$donnees['information'];
                $slotDateTimeStart=$donnees['slotDateStart'];
                $slotDateTimeEnd=$donnees['slotDateEnd'];
                $slot = new Slot($registrationDeadLine, $unsubscribeDeadLine, $place, $information, $slotDateTimeStart,$slotDateTimeEnd);
                $list[] = $slot;
            }
        }
        catch (PDOException $e) {
            throw new LisaeException("Erreur requête", 1);
        }
        return $list;
    }
    
    public function get(int $id) {
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