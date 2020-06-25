<?php

class SlotDao extends Dao {

    // requete pour inserer un nouveau creneau d'activité

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
        } 
        catch (PDOException $e) {
            //echo " echec lors de la création : " . $e->getMessage();
            //die();
            throw new LisaeException("Erreur",1);
        }
    }
    
    // Suppression d'un créneau d'une activité(table participate)

    public function deleteSlotHost($idSlot){
        $sql = 
        "DELETE from host WHERE id_slot =$idSlot";
        $exec = (Dao::getConnexion())->prepare($sql);
        try{
            $exec->execute();
        } 
        catch (PDOException $e) {
            var_dump($e->getMessage());
            throw new LisaeException("Erreur, vous êtes déjà inscrit",1);
        } 
    }

    // Suppression d'un créneau d'une activité(table participate)

    public function deleteSlotParticipate($idSlot){
        $sql = 
        "DELETE from participate WHERE participate.slotDateStart = (SELECT slotDateStart FROM host WHERE id_slot = $idSlot) ";
        $exec = (Dao::getConnexion())->prepare($sql);
        try{
            $exec->execute();
        } 
        catch (PDOException $e) {
            var_dump($e->getMessage());
            throw new LisaeException("Erreur, vous êtes déjà inscrit",1);
        }
    
    }

     // modification d'un créneau d'une activité(table host)

    public function updateSlotHost($slotDateStart,$slotDateEnd) {
        $sql = 
        "UPDATE `host` SET slotDateStart = $slotDateStart, slotDateEnd = $slotDateEnd";
        $exec = (Dao::getConnexion())->prepare($sql);
        try{
            $exec->execute();
        } 
        catch (PDOException $e) {
            var_dump($e->getMessage());
            throw new LisaeException("Erreur, vous êtes déjà inscrit",1);
        }
    }

    // modification d'un créneau d'une activité(table participate)

    public function updateSlotParticipate($slotDateStart,$slotDateEnd) {
        $sql = 
        "UPDATE participate SET slotDateStart = $slotDateStart, slotDateEnd = $slotDateEnd";
        $exec = (Dao::getConnexion())->prepare($sql);
        try{
            $exec->execute();
        } 
        catch (PDOException $e) {
            var_dump($e->getMessage());
            throw new LisaeException("Erreur, vous êtes déjà inscrit",1);
        }
    }

    public function updateSlotInfo($info, $place, $idslot) {
        $sql = 
        "UPDATE host SET information = '$info', place = '$place' WHERE id_slot = $idslot";
        $exec = (Dao::getConnexion())->prepare($sql);
        try{
            $exec->execute();
        } 
        catch (PDOException $e) {
            var_dump($e->getMessage());
            throw new LisaeException("Erreur",1);
        }
    }

    public function get(int $idSlot)
    {
        $sql = Dao::getConnexion();
        $requete = $sql->prepare(
        "SELECT * FROM host 
        WHERE id_slot = $idSlot"
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
                $slot = new Slot($idSlot,$registrationDeadLine, $unsubscribeDeadLine, $place, $information, $slotDateTimeStart,$slotDateTimeEnd,$minNumberPerson,$maxNumberPerson);
            }
        }
        catch (PDOException $e) {
            throw new LisaeException("Erreur requête", 1);
        }
        return $slot;
    } 


    public function insert($obj) : void{

    }
    public function getList(): array{
        return $tab=[];
    }	  
    public function delete(int $id ) {

    }
    // update d'un objet
    public function update($obj ){

    }
}

?>