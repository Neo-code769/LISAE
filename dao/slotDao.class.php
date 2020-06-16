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
                $idSlot=$donnees['id_slot'];
                $registrationDeadLine=$donnees['registrationDeadline'];
                $unsubscribeDeadLine=$donnees['unsubscribeDeadline'];
                $place=$donnees['place'];
                $information=$donnees['information'];
                $slotDateTimeStart=$donnees['slotDateStart'];
                $slotDateTimeEnd=$donnees['slotDateEnd'];
                $minNumberPerson = $donnees['minNumberPerson'];
                $maxNumberPerson = $donnees['maxNumberPerson'];
                $slot = new Slot($idSlot,$registrationDeadLine, $unsubscribeDeadLine, $place, $information, $slotDateTimeStart,$slotDateTimeEnd,$minNumberPerson, $maxNumberPerson);
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
    public function insertSlot($obj,$idUser,$name) : void{
        $sql = "INSERT INTO host (`id_slot`, `id_user`, `id_activity`, `registrationDeadline`, `unsubscribeDeadline`, `place`, `information`, `slotDateStart`, `slotDateEnd`, `minNumberPerson`, `maxNumberPerson`) VALUES (null,$idUser,(select id_activity from activity where name = '$name'),?,?, ?, ?, ?, ?,?,?);";
        $exec = (Dao::getConnexion())->prepare($sql);
        $exec->bindValue(1, $obj->get_registrationDeadLine());
        $exec->bindValue(2, $obj->get_unsubscribeDeadLine());
        $exec->bindValue(3, $obj->get_place());
        $exec->bindValue(4, $obj->get_information());
        $exec->bindValue(5, $obj->get_slotDateTimeStart());
        $exec->bindValue(6, $obj->get_slotDateTimeEnd());
        $exec->bindValue(7, $obj->get_minNumberPerson());
        $exec->bindValue(8, $obj->get_maxNumberPerson());
       
        try{
        $exec->execute();
        var_dump($exec);
        } 
        catch (PDOException $e) {
            //echo " echec lors de la création : " . $e->getMessage();
            //die();
            throw new LisaeException("Erreur",1);
        }
    }
    

    // delete via son id
    public function delete(int $id ){

    }

    // update d'un objet
    public function update($obj ){

    }
}


?>