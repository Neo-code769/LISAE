<?php

class ActivityDao extends Dao {

    // requete création d'une activity(brouillon)

    public function insert($obj) : void	{
        $sql = "INSERT INTO activity VALUES (null, ?, ?, ?, null);";
        $exec = (Dao::getConnexion())->prepare($sql);
        $exec->bindValue(1, $obj->get_name());
        $exec->bindValue(2, $obj->get_description());
        $exec->bindValue(3, $obj->get_detailedDescription());
        //$exec->bindValue(4, $obj->get_image());
        var_dump($exec);
        try{
        $exec->execute();
        } 
        catch (PDOException $e) {
            throw new LisaeException("Erreur",1);
        }
    }

    // requete création d'une recurring activity avec les données d'une activity(brouillon)

    public function insertRecurringActivity($idTheme) : void	
    {
        $sql = ("INSERT INTO `recurring_Activity` VALUES
        ( (SELECT MAX(id_activity) from activity),
         (SELECT id_theme from theme where id_theme = $idTheme))");
        $exec = (Dao::getConnexion())->prepare($sql);
        try{
        $exec->execute();
        } 
        catch (PDOException $e) {
            throw new LisaeException("Erreur",1);
        }
    }
    // requete pour modifier une activity



    // requete pour supprimer un activity


    
    // requete pour recuperer le nom et l'id des activités pour faire l'insert d'un créneau d'activité (partie anim)

    public function getActivityList() : array 
    {
        $list = []; 
        $sql = Dao::getConnexion();
        $requete = $sql->prepare(
        "SELECT name, id_activity FROM activity");
        try {
            $requete->execute();
            while($donnees = $requete->fetch(PDO::FETCH_ASSOC))
            {
                $idActivity=$donnees['id_activity'];
                $name=$donnees['name'];
                $activity = new Activity($idActivity,$name, null, null,null);
                $list[] = $activity;
            }
        }
        catch (PDOException $e) {
            throw new LisaeException("Erreur requête", 1);
        }
        return $list;
    }
    public function getList() {

    }		 
    public function get(int $id){

    }     
    // delete via son id
    public function delete(int $id) {

    }
    // update d'un objet
    public function update($obj) {

    }
}


?>