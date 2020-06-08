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
    public function getList(): array
    {

    }		
    
    public function get(int $id)
    {

    }	
    
    public function insert($obj) : void	
    {

    }
    // delete via son id
    public function delete(int $id )
    {

    }
    // update d'un objet
    public function update($obj ) 
    {

    }
}


?>