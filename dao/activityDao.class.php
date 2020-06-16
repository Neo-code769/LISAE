<?php

class ActivityDao extends Dao {

    public function getListActivityUniqueForTheme($idTheme){
        $list = []; 
        $pdo = Dao::getConnexion();

        $requete = $pdo->prepare(
            "SELECT * FROM unique_activity 
            inner join activity ON unique_activity.id_activity = activity.id_activity 
            WHERE unique_activity.id_theme = $idTheme");
            try{
                $requete->execute();
                while($donnees = $requete->fetch(PDO::FETCH_ASSOC))
                {
                    $idActivity = $donnees['id_activity'];
                    $name = $donnees['name'];
                    $description = $donnees['description'];
                    $detailedDescription = $donnees['detailedDescription'];
                    $minNumberPerson = $donnees['minNumberPerson'];
                    $maxNumberPerson = $donnees['maxNumberPerson'];
                    $registrationDeadline = $donnees['registrationDeadline'];
                    $unsubscribeDeadline = $donnees['unsubscribeDeadline'];
                    $idTheme = $donnees['id_theme'];
                    $externalContributor = $donnees['externalContributor'];
                    $activity = new UniqueActivity($idActivity, $name, $description, $detailedDescription, $minNumberPerson, $maxNumberPerson, $registrationDeadline,$unsubscribeDeadline,$idTheme,$externalContributor);
                    $list[] = $activity;
                }

            } catch (PDOException $e) {
                echo " ERREUR REQUETE : " . $e->getMessage();
            die();
            }
        return $list;
    }

    public function getListActivityRecurringForTheme($idTheme){
        $list = []; 
        $pdo = Dao::getConnexion();

        $requete = $pdo->prepare(
            "SELECT * FROM recurring_activity 
            inner join activity ON recurring_activity.id_activity = activity.id_activity 
            WHERE recurring_activity.id_theme = $idTheme");
            try{
                $requete->execute();
                while($donnees = $requete->fetch(PDO::FETCH_ASSOC))
                {
                    $idActivity = $donnees['id_activity'];
                    $name = $donnees['name'];
                    $description = $donnees['description'];
                    $detailedDescription = $donnees['detailedDescription'];
                    $minNumberPerson = $donnees['minNumberPerson'];
                    $maxNumberPerson = $donnees['maxNumberPerson'];
                    $registrationDeadline = $donnees['registrationDeadline'];
                    $unsubscribeDeadline = $donnees['unsubscribeDeadline'];
                    $idTheme = $donnees['id_theme'];
                    $activity = new RecurringActivity($idActivity, $name, $description, $detailedDescription, $minNumberPerson, $maxNumberPerson, $registrationDeadline,$unsubscribeDeadline,$idTheme);
                    $list[] = $activity;
                }

            } catch (PDOException $e) {
                echo " ERREUR REQUETE : " . $e->getMessage();
            die();
            }
        return $list;
    }
    public function getList()
    {

    }		
    
    public function get(int $id)
    {

    }	
    public function insert($obj) : void	{
        $sql = "INSERT INTO activity VALUES (null, ?, ?, ?, ?, ?,?);";
        $exec = (Dao::getConnexion())->prepare($sql);
        $exec->bindValue(1, $obj->get_idTheme());
        $exec->bindValue(2, $obj->get_name());
        $exec->bindValue(3, $obj->get_color());
        $exec->bindValue(4, $obj->get_description());
        $exec->bindValue(5, $obj->get_detailsDescription());
        //var_dump($sql);
        try{
        $exec->execute();
        } 
        catch (PDOException $e) {
            //echo " echec lors de la création : " . $e->getMessage();
            //die();
            throw new LisaeException("Erreur",1);
        }
    }
    public function insertRecurringActivity($idTheme,$idActivity ) : void	
    {
        $sql = ("INSERT INTO `recurring_Activity` VALUES
        ( (SELECT id_activity from activity where id_activity = $idActivity),
         (SELECT id_theme from theme where id_theme = $idTheme))");
        $exec = (Dao::getConnexion())->prepare($sql);
        $exec->bindValue(1, $idTheme->get_idTheme());
        $exec->bindValue(2, $idActivity->get_name());
        $exec->bindValue(3, $idActivity->get_color());
        $exec->bindValue(4, $idActivity->get_description());
        $exec->bindValue(5, $idActivity->get_detailsDescription());
        //var_dump($sql);
        try{
        $exec->execute();
        } 
        catch (PDOException $e) {
            //echo " echec lors de la création : " . $e->getMessage();
            //die();
            throw new LisaeException("Erreur",1);
        }
    }
    // delete via son id
    public function delete(int $id )
    {

    }
    // update d'un objet
    public function update($obj ) 
    {

    }
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
                $activity = new Activity($idActivity,$name, null, null,null, null, null);
                $list[] = $activity;
            }
        }
        catch (PDOException $e) {
            throw new LisaeException("Erreur requête", 1);
        }
        return $list;
    }
    
}


?>