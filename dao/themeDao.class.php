<?php

class themeDao extends Dao {

    public function getListTheme()
    {
        $list = []; 
        $pdo = Dao::getConnexion();

        $requete = $pdo->prepare(
                "SELECT * FROM `theme`"
                );
        try{
            $requete->execute();
            while($donnees = $requete->fetch(PDO::FETCH_ASSOC))
            {
                //THEME
                $idTheme = $donnees['id_theme'];
                $name = $donnees['name'];
                $color = $donnees['color'];
                $description = $donnees['description'];
                $detailsDescription = $donnees['detailedDescription']; 

                $activity = $this->getListActivity($idTheme);

                $theme = new Theme($idTheme, $name, $color, $description, $detailsDescription, $activity);
                $list[] = $theme;
            }

        } catch (PDOException $e) {
            echo " ERREUR REQUETE : " . $e->getMessage();
        die();
        }
    return $list;    
    }
    public function getListActivity($idTheme)
    {
        $list = []; 
        $pdo = Dao::getConnexion();

        $requete = $pdo->prepare(
            "SELECT * FROM activity 
            INNER JOIN recurring_activity on activity.id_activity = recurring_activity.id_activity 
            WHERE id_theme= $idTheme");
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
                    $slot = $this->getListSlot($idActivity);
                    $activity = new RecurringActivity($idActivity, $name, $description, $detailedDescription, $minNumberPerson, $maxNumberPerson, $registrationDeadline,$unsubscribeDeadline, $slot);
                    
                    $list[] = $activity;
                }
            } catch (PDOException $e) {
                echo " ERREUR REQUETE : " . $e->getMessage();
            die();
            }
        return $list;
    }
    public function getListSlot($idActivity)
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
                $registrationDeadLine=$donnees['registrationDeadline'];
                $unsubscribeDeadLine=$donnees['unsubscribeDeadline'];
                $place=$donnees['place'];
                $information=$donnees['information'];
                $slotDateTimeStart=$donnees['slotDateStart'];
                $slotDateTimeEnd=$donnees['slotDateEnd'];
                $slot = new Slot($registrationDeadLine, $unsubscribeDeadLine, $place, $information, $slotDateTimeStart,$slotDateTimeEnd);
                $list[] = $slot;
            }
        }
        catch (PDOException $e) {
            throw new LisaeException("Erreur requête", 1);
        }
        return $list;
    }
    public function getListTheme2()
    {
        $list = []; 
        $pdo = Dao::getConnexion();

        $requete = $pdo->prepare(
            
                "SELECT activity.name, slotDateStart, slotDateEnd 
                FROM `theme`
                INNER JOIN recurring_activity on theme.id_theme = recurring_activity.id_theme
                INNER JOIN activity ON recurring_activity.id_activity = activity.id_activity
                INNER JOIN host on activity.id_activity = host.id_activity
                UNION
                SELECT activity.name, slotDateStart, slotDateEnd 
                FROM `theme`
                INNER JOIN unique_activity on theme.id_theme = unique_activity.id_theme
                INNER JOIN activity ON unique_activity.id_activity = activity.id_activity
                INNER JOIN host on activity.id_activity = host.id_activity"
                );
         try{
            $requete->execute();
            while($donnees = $requete->fetch(PDO::FETCH_ASSOC))
            {
                //THEME
                $idTheme = $donnees['id_theme'];
                $name = $donnees['name'];
                $color = $donnees['color'];
                $image = $donnees['image'];
                $descriptionTheme = $donnees['description'];
                $detailsDescriptionT = $donnees['detailedDescription'];

                //ACTIVITE
                $idActivity = $donnees['id_activity'];
                $name = $donnees['name'];
                $descriptionActivity = $donnees['description'];
                $detailedDescriptionA = $donnees['detailedDescription'];
                $minNumberPerson = $donnees['minNumberPerson'];
                $maxNumberPerson = $donnees['maxNumberPerson'];
                $registrationDeadline = $donnees['registrationDeadline'];
                $unsubscribeDeadline = $donnees['unsubscribeDeadline'];
                
                $activity = new Activity($idActivity, $name, $descriptionActivity, $detailedDescriptionA, $minNumberPerson, $maxNumberPerson, $registrationDeadline,$unsubscribeDeadline);
                $theme = new Theme($idTheme, $name, $color, $image, $descriptionTheme, $detailsDescriptionT ,$activity);
                $list[] = $theme;
            }

        } catch (PDOException $e) {
            echo " ERREUR REQUETE : " . $e->getMessage();
        die();
        }
    return $list;
    }

    public function getThemeActivity() 
    {
        $sql = (
            "SELECT activity.name, slotDateStart, slotDateEnd 
            FROM `theme`
            INNER JOIN recurring_activity on theme.id_theme = recurring_activity.id_theme
            INNER JOIN activity ON recurring_activity.id_activity = activity.id_activity
            INNER JOIN host on activity.id_activity = host.id_activity
            UNION
            SELECT activity.name, slotDateStart, slotDateEnd 
            FROM `theme`
            INNER JOIN unique_activity on theme.id_theme = unique_activity.id_theme
            INNER JOIN activity ON unique_activity.id_activity = activity.id_activity
            INNER JOIN host on activity.id_activity = host.id_activity"
            );
        $exec = (Dao::getConnexion())->prepare($sql);
        try {
            $exec->execute();
            return $exec;
            }
            catch (PDOException $e) {
                throw new LisaeException("Erreur", 1);
            }
    }

   

    public function getList(): array{
        return $tab=[];
    }	
    
    public function get(int $id) {
        return $tab=[];
    }	
    
    public function insert($obj) : void{

    }

    // delete via son id
    public function delete(int $id ){

    }

    // update d'un objet
    public function update($obj ){

    }

}
?>