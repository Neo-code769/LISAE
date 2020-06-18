<?php

class PresenceDao extends Dao {

    public function getList(): array{

        return [];
    }

    
    public function get(int $id) {
        return [];
    }
    
    public function insert($obj) :void
    {
    }

    // delete via son id
    public function delete(int $id ){

    } 

    // update d'un objet
    public function update($obj){
        
    } 

    public function getPresence($idSlot) {

        $pdo = Dao::getConnexion();

        $requete = $pdo->prepare(
            "SELECT Lastname, Firstname, session_name, name, PhoneNumber, participate.slotDateStart, slotDateEnd, presence FROM users
            INNER JOIN participate ON participate.id_user = users.id_user
            INNER JOIN activity ON activity.id_activity = participate.id_activity
            INNER JOIN session on participate.id_session = session.id_session
            WHERE participate.slotDateStart = (SELECT slotDateStart FROM host WHERE id_slot = $idSlot)"     // Ajouter presence
        );

        //var_dump($requete);

        try{
            $requete->execute();
            $allData = "";

            while($data = $requete->fetch(PDO::FETCH_ASSOC)) {
                $allData .= $data['Lastname'] . "," . $data['Firstname'] . ",0" . $data['PhoneNumber'] . "," . $data['session_name'] . "," . $data['presence'] . "\n";
            }
        }catch (PDOException $e) {
                echo " ERREUR REQUETE : " . $e->getMessage();
            die();
        }
        
        return $allData;
    }
    public function getTabPresence($idSlot) {
        
        $list = []; 
        $sql = Dao::getConnexion();
        $requete = $sql->prepare(
           " SELECT users.id_user, Lastname, Firstname, PhoneNumber, session_name, presence FROM users
            INNER JOIN participate ON participate.id_user = users.id_user
            INNER JOIN activity ON activity.id_activity = participate.id_activity
            INNER JOIN session on participate.id_session = session.id_session
            WHERE participate.slotDateStart = (SELECT slotDateStart FROM host WHERE id_slot = $idSlot)"
        );
        try {
            $requete->execute();
            while($donnees = $requete->fetch(PDO::FETCH_ASSOC))
            {
                $list[] = ['id_user'=> $donnees["id_user"],'Lastname'=> $donnees["Lastname"], 'Firstname'=> $donnees["Firstname"],'PhoneNumber'=> $donnees["PhoneNumber"],'session_name'=> $donnees["session_name"],'presence'=> $donnees["presence"]
                ];
            }
        }
        catch (PDOException $e) {
            throw new LisaeException("Erreur requête", 1);
        }
        return $list;
    }
    public function updatePresence($idUser,$idSlot) {
        $sql = 
        "UPDATE `participate` SET `presence`=1 
        WHERE id_user= $idUser
        AND participate.slotDateStart = (SELECT slotDateStart FROM host WHERE id_slot = $idSlot) ";
        $exec = (Dao::getConnexion())->prepare($sql);
       try{
           $exec->execute();
       } 
       catch (PDOException $e) {
           var_dump($e->getMessage());
           throw new LisaeException("Erreur, vous êtes déjà inscrit",1);
       }
    }
}
?>