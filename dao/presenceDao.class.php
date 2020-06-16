<?php

class PresenceDao extends Dao {

    public function getPresence($id_slot) {

        $pdo = Dao::getConnexion();

                $requete = $pdo->prepare("SELECT `name`, `participate.slotDateStart`, `Lastname`, `Firstname`, `PhoneNumber`, `presence` FROM activity 
                        INNER JOIN participate ON activity.id_activity = participate.id_activity 
                        INNER JOIN users ON participate.id_user = users.id_user 
                        INNER JOIN host ON users.id_user = host.id_user
                        WHERE id_slot = $id_slot");

                try{
                    $requete->execute();
                    $allData = "";

                    while($data = $pdo->fetch_assoc()) {
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