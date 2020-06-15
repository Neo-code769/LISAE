<?php

class themeDao extends Dao {

    /*********************Recuperation de la liste des activités ELOCE********************/

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
                    $registrationDeadline = $donnees['registrationDeadline'];
                    $unsubscribeDeadline = $donnees['unsubscribeDeadline'];
                    $slot = $this->getListSlot($idActivity);
                    $activity = new RecurringActivity($idActivity, $name, $description, $detailedDescription, $registrationDeadline,$unsubscribeDeadline, $slot);
                    
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
                $minNumberPerson = $donnees['minNumberPerson'];
                $maxNumberPerson = $donnees['maxNumberPerson'];
                $slot = new Slot($idSlot,$registrationDeadLine, $unsubscribeDeadLine, $place, $information, $slotDateTimeStart,$slotDateTimeEnd,$minNumberPerson,$maxNumberPerson);
                $list[] = $slot;
            }
        }
        catch (PDOException $e) {
            throw new LisaeException("Erreur requête", 1);
        }
        return $list;
    }    

    /***********************Recupération de la liste des activités personneles d'Eloce d'un collaborateur *******************/
    public function getMyListThemeCollab($idUser)
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

                $activity = $this->getMyListActivityCollab($idTheme, $idUser);

                $theme = new Theme($idTheme, $name, $color, $description, $detailsDescription, $activity);
                $list[] = $theme;
            }

        } catch (PDOException $e) {
            echo " ERREUR REQUETE : " . $e->getMessage();
        die();
        }
    return $list;    
    }
    public function getMyListActivityCollab($idTheme, $idUser)
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
                    $registrationDeadline = $donnees['registrationDeadline'];
                    $unsubscribeDeadline = $donnees['unsubscribeDeadline'];
                    $slot = $this->getMyListSlotCollab($idActivity, $idUser);
                    $activity = new RecurringActivity($idActivity, $name, $description, $detailedDescription, $registrationDeadline,$unsubscribeDeadline, $slot);
                    
                    $list[] = $activity;
                }
            } catch (PDOException $e) {
                echo " ERREUR REQUETE : " . $e->getMessage();
            die();
            }
        return $list;
    }
    public function getMyListSlotCollab($idActivity, $idUser)
    {
        $list = []; 
        $sql = Dao::getConnexion();
        $requete = $sql->prepare(
        "SELECT DISTINCT(host.id_slot), participate.slotDateStart, participate.slotDateEnd, host.minNumberPerson, host.maxNumberPerson FROM participate, host WHERE participate.id_activity = $idActivity AND participate.id_user = $idUser AND participate.slotDateStart = host.slotDateStart
        "
        );
        try {
            $requete->execute();
            while($donnees = $requete->fetch(PDO::FETCH_ASSOC))
            {
                $idSlot=$donnees['id_slot'];
                $slotDateTimeStart=$donnees['slotDateStart'];
                $slotDateTimeEnd=$donnees['slotDateEnd'];
                $minNumberPerson = $donnees['minNumberPerson'];
                $maxNumberPerson = $donnees['maxNumberPerson'];
                $slot = new Slot($idSlot,null, null, null, null, $slotDateTimeStart,$slotDateTimeEnd, $minNumberPerson, $maxNumberPerson);
                $list[] = $slot;
            }
        }
        catch (PDOException $e) {
            throw new LisaeException("Erreur requête", 1);
        }
        return $list;
    }
    /***********************Recupération de la liste des activités personneles d'Eloce d'un animateur *******************/
    public function getMyListThemeAnim($idUser)
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

                $activity = $this->getMyListActivityAnim($idTheme, $idUser);

                $theme = new Theme($idTheme, $name, $color, $description, $detailsDescription, $activity);
                $list[] = $theme;
            }

        } catch (PDOException $e) {
            echo " ERREUR REQUETE : " . $e->getMessage();
        die();
        }
    return $list;    
    }
    public function getMyListActivityAnim($idTheme, $idUser)
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
                    $registrationDeadline = $donnees['registrationDeadline'];
                    $unsubscribeDeadline = $donnees['unsubscribeDeadline'];
                    $slot = $this->getMyListSlotAnim($idActivity, $idUser);
                    $activity = new RecurringActivity($idActivity, $name, $description, $detailedDescription,  $registrationDeadline,$unsubscribeDeadline, $slot);
                    
                    $list[] = $activity;
                }
            } catch (PDOException $e) {
                echo " ERREUR REQUETE : " . $e->getMessage();
            die();
            }
        return $list;
    }
    public function getMyListSlotAnim($idActivity, $idUser)
    {
        $list = []; 
        $sql = Dao::getConnexion();
        $requete = $sql->prepare(
        "SELECT * FROM host WHERE id_activity = $idActivity AND id_user = $idUser"
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
                $minNumberPerson = $donnees['minNumberPerson'];
                $maxNumberPerson = $donnees['maxNumberPerson'];
                $slot = new Slot($idSlot,$registrationDeadLine, $unsubscribeDeadLine, $place, $information, $slotDateTimeStart,$slotDateTimeEnd,$minNumberPerson, $maxNumberPerson,);
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
        $sql = "INSERT INTO `theme` (`id_theme`,`name`, `color`, `image`, `description`, `detailedDescription`) VALUES (null, ?, ?, null, ?, ?);";
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

    // delete via son id
    public function delete(int $id ){

    }

    // update d'un objet
    public function update($obj ){

    }
    //requete d'inscription d'un collaborateur à un créneau d'activité
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

    // requete de désinscription d'un collaborateur à un créneau d'activité
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

    // requete pour vérifier que le collaborateur n'est pas deja inscrit à un créneau d'activité
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

    public function getListParticipate($slotDateStart,$idActivity)
    {
        $sql = Dao::getConnexion();
        $requete = $sql->prepare(
            "SELECT id_user from participate
            where `slotDateStart`= '$slotDateStart'
            and `id_activity`= $idActivity
            ");
        //var_dump($requete);
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
// essaie requete pour max nombre personner créneaux : select COUNT(id_user) from activity Inner join participate on activity.id_activity = participate.id_activity where activity.id_activity =1 group by maxNumberPerson HAVING max(maxNumberPerson)
?>