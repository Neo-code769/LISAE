<?php

class PresenceDao extends Dao {

    public function getPresence($activity) {

        $pdo = Dao::getConnexion();

                $requete = $pdo->prepare("SELECT `name`, `participate.slotDateStart`, `Lastname`, `Firstname`, `PhoneNumber`, `presence` FROM activity 
                        INNER JOIN participate ON activity.id_activity = participate.id_activity 
                        INNER JOIN users ON participate.id_user = users.id_user 
                        INNER JOIN host ON users.id_user = host.id_user");

                try{
                    $requete->execute();
                    $resImprimer=requete($requete);

                    while($ligneImprimer=mysql_fetch_assoc($requete)) {
                        $atelier=$ligneImprimer['name'];
                        $date=$ligneImprimer['slotDateStart'];
                        $nom=$ligneImprimer['Lastname'];
                        $prenom=$ligneImprimer['Firstname'];
                        $mobile=$ligneImprimer['PhoneNumber'];
                        $presence=$ligneImprimer['presence'];

                        $ligneFichier="$atelier;$date;$nom;$prenom;$mobile;$presence;";

                    } catch (PDOException $e) {
                        echo " ERREUR REQUETE : " . $e->getMessage();
                    die();
                    }
                }
                return $ligneFichier;
    }

}


?>