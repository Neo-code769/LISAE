<?php

class ActivityDao extends Dao {

    // requete création d'une activity

    public function insert($obj) : void	{
        $sql = "INSERT INTO activity VALUES (null, ?, ?, ?, ?);";
        $exec = (Dao::getConnexion())->prepare($sql);
        $exec->bindValue(1, $obj->get_name());
        $exec->bindValue(2, $obj->get_description());
        $exec->bindValue(3, $obj->get_detailedDescription());
        $exec->bindValue(4, $obj->get_image());
        //var_dump($exec);
        try{
        $exec->execute();
        } 
        catch (PDOException $e) {
            throw new LisaeException("Erreur",1);
        }
    }

    // requete création d'une recurring activity avec les données d'une activity

    public function insertRecurringActivity($idTheme) : void 
    {
        $sql = ("INSERT INTO `recurring_Activity` VALUES
        ((SELECT MAX(id_activity) from activity),$idTheme)");
        $exec = (Dao::getConnexion())->prepare($sql);
        try{
        $exec->execute();
        } 
        catch (PDOException $e) {
            throw new LisaeException("Erreur",1);
        }
    }
    public function update($id){

    }
    // requete pour modifier une activity d'un thème
    public function updateActivity($activity) {
        $name = $activity->get_name();
        $description = $activity->get_description();
        $detailedDescription = $activity->get_detailedDescription();
        $image = $activity->get_image();
        $idActivity = $activity->get_idActivity();
        $sql = "UPDATE `activity` SET `name`='".$name."',`description`=\"$description\",`detailedDescription`=\"$detailedDescription\",`image`='".$image."' WHERE id_activity = $idActivity";
        $exec = (Dao::getConnexion())->prepare($sql);
        try{
        $exec->execute();
        } 
        catch (PDOException $e) {
            throw new LisaeException("Erreur",1);
        }
    }
    // requete pour modifier une activity recurrente d'un thème

    public function updateRecurringActivity($idActivity) {
        $sql = "UPDATE `activity` SET `id_activity`=(SELECT MAX(id_activity) from activity), id_theme =(SELECT id_theme from theme where id_activity = $idActivity)";
        $exec = (Dao::getConnexion())->prepare($sql);
        try{
        $exec->execute();
        } 
        catch (PDOException $e) {
            throw new LisaeException("Erreur",1);
        }
    }

    // requete pour supprimer un activity d'un thème
    public function delete($idActivity) : void{
        $pdo = Dao::getConnexion();
        $requete = $pdo->prepare("DELETE FROM `activity` WHERE id_activity= $idActivity");
        try {
            $requete->execute();
        }catch (PDOException $e) {
            throw new LisaeException("Erreur",1);
        }
    }

    // requete pour supprimer un activity recurring activity d'un thème
    public function deleteRecurringActivity($idTheme) : void{
        $pdo = Dao::getConnexion();
        $requete = $pdo->prepare("DELETE FROM `referto` WHERE (MAX)id_theme = $idTheme)");
        try {
            $requete->execute();
        }catch (PDOException $e) {
            throw new LisaeException("Erreur",1);
        }
    }
    
    // requete pour recuperer le nom et l'id des activités pour faire l'insert d'un créneau d'activité (partie anim)

    public function getActivityList($idTheme) : array 
    {
        $list = []; 
        $sql = Dao::getConnexion();
        $requete = $sql->prepare(
        "SELECT name, activity.id_activity FROM activity
        INNER JOIN recurring_activity ON recurring_activity.id_activity = activity.id_activity
        WHERE id_theme = $idTheme
        ");
        try {
            $requete->execute();
            //var_dump($requete);
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
    public function deleteThemeActivity($idTheme) : void{
        $sql = "DELETE FROM `recurring_activity` WHERE id_theme= $idTheme";
        $exec = (Dao::getConnexion())->prepare($sql);
        try {
            $exec->execute();
            var_dump($sql);
        }catch (PDOException $e) {
            throw new LisaeException("Erreur",1);
        }
    }

    public function deleteReccuringActivity($idActivity) : void{
        $sql = "DELETE FROM `recurring_activity` WHERE id_activity= $idActivity";
        $exec = (Dao::getConnexion())->prepare($sql);
        try {
            $exec->execute();
            //var_dump($sql);
        }catch (PDOException $e) {
            throw new LisaeException("Erreur",1);
        }
    }

    public function getNameActivity($idSlot) {
        $sql = Dao::getConnexion();
        $requete = $sql->prepare("SELECT `name` FROM `activity` 
        INNER JOIN `host` ON activity.id_activity = host.id_activity 
        WHERE id_slot= $idSlot");
        try {
            $requete->execute();
            while($donnees= $requete->fetch(PDO::FETCH_ASSOC)) {
                $name = $donnees["name"];
            }
            //var_dump($sql);
        }catch (PDOException $e) {
            throw new LisaeException("Erreur",1);
        }
        return $name;
    }
    public function getImage($idActivity) {
        $sql = Dao::getConnexion();
        $requete = $sql->prepare(
        "SELECT `image` FROM `activity` 
        WHERE id_activity= $idActivity");
        try {
            $requete->execute();
            while($donnees = $requete->fetch(PDO::FETCH_ASSOC))
            {
                $image = $donnees["image"]; 
            }
        }
        catch (PDOException $e) {
            throw new LisaeException("Erreur requête", 1);
        }
        return $image;
    }
}

     
       
?>