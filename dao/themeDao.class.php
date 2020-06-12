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
                $idSlot=$donnees['id_slot'];
                $registrationDeadLine=$donnees['registrationDeadline'];
                $unsubscribeDeadLine=$donnees['unsubscribeDeadline'];
                $place=$donnees['place'];
                $information=$donnees['information'];
                $slotDateTimeStart=$donnees['slotDateStart'];
                $slotDateTimeEnd=$donnees['slotDateEnd'];
                $slot = new Slot($idSlot,$registrationDeadLine, $unsubscribeDeadLine, $place, $information, $slotDateTimeStart,$slotDateTimeEnd);
                $list[] = $slot;
            }
        }
        catch (PDOException $e) {
            throw new LisaeException("Erreur requête", 1);
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
    public function registrationActivity($idUser,$idActivity,$idSession,$idSlot) {
        $sql = "INSERT INTO `participate` 
        VALUES ( 
            $idUser, 
            $idActivity, 
            $idSession, 
            (SELECT slotDateStart from host WHERE id_slot = $idSlot),  
            (SELECT slotDateEnd from host where id_slot=$idSlot),
            null
            )";
        $exec = (Dao::getConnexion())->prepare($sql);
            try{
                $exec->execute();
            } 
            catch (PDOException $e) {
                var_dump($e->getMessage());
                throw new LisaeException("Erreur, vous êtes déjà inscrit",1);
            }
    }
    public function getMyListTheme()
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

                $activity = $this->getMyListActivity($idTheme);

                $theme = new Theme($idTheme, $name, $color, $description, $detailsDescription, $activity);
                $list[] = $theme;
            }

        } catch (PDOException $e) {
            echo " ERREUR REQUETE : " . $e->getMessage();
        die();
        }
    return $list;    
    }
    public function getMyListActivity($idTheme)
    {
        $list = []; 
        $pdo = Dao::getConnexion();

        $requete = $pdo->prepare(
            "SELECT * FROM activity 
            INNER JOIN recurring_activity on activity.id_activity = recurring_activity.id_activity
            INNER JOIN host on activity.id_activity = host.id_activity 
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
                    $idUser = $donnees['id_user'];
                    $slot = $this->getMyListSlot($idUser,$idActivity);
                    $activity = new RecurringActivity($idActivity, $name, $description, $detailedDescription, $minNumberPerson, $maxNumberPerson, $registrationDeadline,$unsubscribeDeadline, $slot);
                    
                    $list[] = $activity;
                }
            } catch (PDOException $e) {
                echo " ERREUR REQUETE : " . $e->getMessage();
            die();
            }
        return $list;
    }
    public function getMyListSlot($idUser, $idActivity)
    {
        $list = []; 
        $sql = Dao::getConnexion();
        $requete = $sql->prepare(
        "SELECT DISTINCT(host.id_slot), participate.id_user, participate.id_activity, participate.slotDateStart, participate.slotDateEnd FROM participate, host WHERE participate.id_user = $idUser AND participate.id_activity = $idActivity AND participate.slotDateStart = host.slotDateStart
        "
        );
        try {
            $requete->execute();
            while($donnees = $requete->fetch(PDO::FETCH_ASSOC))
            {
                $idUser=$donnees['id_user'];
                $idActivity=$donnees['id_activity'];
                $idSlot=$donnees['id_slot'];
                $slotDateTimeStart=$donnees['slotDateStart'];
                $slotDateTimeEnd=$donnees['slotDateEnd'];
                $slot = new Slot($idSlot,null, null, null, null, $slotDateTimeStart,$slotDateTimeEnd);
                $list[] = $slot;
            }
        }
        catch (PDOException $e) {
            throw new LisaeException("Erreur requête", 1);
        }
        return $list;
    }
    public function deregistrationSlot($id_user,$id_session,$idActivity, $idSlot)
    {
        $sql = "DELETE FROM `participate` WHERE `participate`.`id_user` = $id_user AND `participate`.`id_activity` = $idActivity AND `participate`.`id_session` = $id_session AND `participate`.`slotDateStart` = (SELECT slotDateStart from host WHERE id_slot = $idSlot)";
        //var_dump($sql);
        $exec = (Dao::getConnexion())->prepare($sql);
        try{
            $exec->execute();
        } 
        catch (PDOException $e) {
            var_dump($e->getMessage());
            throw new LisaeException("Erreur, vous êtes déjà inscrit",1);
        }
    }

    public function checkSlotExist($idUser,$idActivity,$idSession,$idSlot)
    {
        $sql = Dao::getConnexion();
        $requete = $sql->prepare(
        "SELECT * FROM participate 
        WHERE id_user = $idUser AND id_activity = $idActivity AND id_session = $idSession AND slotDateStart = (SELECT slotDateStart from host WHERE id_slot = $idSlot)"
        );
        try {
            $requete->execute();
            $result = $requete->rowCount();
        }
        catch (PDOException $e) {
            throw new LisaeException("Erreur requête", 1);
        }
        return $result;
    }  
}
?>