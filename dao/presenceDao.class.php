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

    public function getPresence($slotDateStart,$id_activity) {

        $pdo = Dao::getConnexion();

        /* $requete = $pdo->prepare("SELECT `name`, `participate.slotDateStart`, `Lastname`, `Firstname`, `PhoneNumber`, `presence` FROM activity 
                        INNER JOIN participate ON activity.id_activity = participate.id_activity 
                        INNER JOIN users ON participate.id_user = users.id_user 
                        INNER JOIN host ON users.id_user = host.id_user
                        WHERE id_slot = $id_slot"); */

        $requete = $pdo->prepare(
            "SELECT activity.name, participate.slotDateStart, users.Lastname, users.Firstname, users.PhoneNumber, participate.presence 
            FROM activity 
            INNER JOIN participate ON activity.id_activity = participate.id_activity 
            INNER JOIN users ON participate.id_user = users.id_user 
            INNER JOIN host ON host.slotDateStart = participate.slotDateStart
            WHERE slotDateStart ='2020-06-09 13:00:00' AND activity.id_activity = 1");

        var_dump($requete);

        try{
            $requete->execute();
            $allData = "";

            while($data = $requete->fetch(PDO::FETCH_ASSOC)) {
                $allData .= $data['name'] . ',' . $data['slotDateStart'] . "," . $data['Lastname'] . "," . $data['Firstname'] . "," . $data['PhoneNumber']. "," . $data['presence'] . "\n";
            }
        }catch (PDOException $e) {
                echo " ERREUR REQUETE : " . $e->getMessage();
            die();
        }
        
        return $allData;
    }

}
?>