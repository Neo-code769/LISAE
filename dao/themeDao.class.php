<?php

class ThemeDao extends Dao {

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
                    $slot = $this->getListSlot($idActivity);
                    $activity = new RecurringActivity($idActivity, $name, $description, $detailedDescription, $slot);
                    
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
                    $slot = $this->getMyListSlotCollab($idActivity, $idUser);
                    $activity = new RecurringActivity($idActivity, $name, $description, $detailedDescription,$slot);
                    
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

    /***********************Recupération de la liste des activités personnelles d'un animateur *******************/

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
                    $slot = $this->getMyListSlotAnim($idActivity, $idUser);
                    $activity = new RecurringActivity($idActivity, $name, $description, $detailedDescription, $slot);
                    
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
 
    // requete pour créer un nouveau thème 

    public function insert($obj) : void{
        $sql = "INSERT INTO `theme` (`id_theme`,`name`, `color`, `image`, `description`, `detailedDescription`) VALUES (null, ?, ?, null, ?, ?);";
        $exec = (Dao::getConnexion())->prepare($sql);
        $exec->bindValue(1, $obj->get_name());
        $exec->bindValue(2, $obj->get_color());
        $exec->bindValue(3, $obj->get_description());
        $exec->bindValue(4, $obj->get_detailsDescription());
        try{
        $exec->execute();
        } catch (PDOException $e) {
            throw new LisaeException("Erreur",1);
        }
    }

    // requete pour modifier un thème
    public function update($idTheme) : void{
        $sql = "UPDATE `theme` SET id_theme=?, `name`=?,`color`=?,`description`=?,`detailedDescription`=? WHERE id_theme= $idTheme";
        $exec = (Dao::getConnexion())->prepare($sql);
        try {
            $exec->execute();
        }catch (PDOException $e) {
            throw new LisaeException("Erreur",1);
        }
        
    }

    // requete pour supprimer un thème
    public function delete($idTheme) : void{
        $pdo = Dao::getConnexion();
        $requete = $pdo->prepare("DELETE FROM `theme` WHERE id_theme= $idTheme");
        try {
            $requete->execute();
        }catch (PDOException $e) {
            throw new LisaeException("Erreur",1);
        }
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

  // requete pour vérifier que l'animateur n'a pas deja créé le meme créneau d'activité

    public function checkSlotExistAnim($nameActivity,$slotdateStart)
    {
        $sql = Dao::getConnexion();
        $requete = $sql->prepare(
        "SELECT * FROM host 
        WHERE slotDateStart = '$slotdateStart' AND
        (SELECT id_activity from activity where name = '$nameActivity')"
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

    // requete pour recupérer le nombre de participants à une activité

    public function getListParticipate($slotDateStart,$idActivity)
    {
        $sql = Dao::getConnexion();
        $requete = $sql->prepare(
            "SELECT id_user from participate
            where `slotDateStart`= '$slotDateStart'
            and `id_activity`= $idActivity");
        try {
            $requete->execute();
            $result = $requete->rowCount();
        }
        catch (PDOException $e) {
            throw new LisaeException("Erreur requête", 1);
        }
        return $result;
    }

    // requete pour récupérer sur quel theme l'animateur est référent

    public function getThemeForAnimator($idUser)
    {
        $pdo = Dao::getConnexion();
        $requete = $pdo->prepare (
            "SELECT theme.id_theme, theme.name FROM referto 
            INNER JOIN theme ON theme.id_theme = referto.id_theme
            WHERE id_user = $idUser");
        try {
            $requete->execute();
            while($donnees = $requete->fetch(PDO::FETCH_ASSOC))
            {
                $idTheme = $donnees['id_theme'];
                $nameTheme = $donnees['name'];
                $theme = new Theme($idTheme, $nameTheme,null,null,null,null);
            }
        }
        catch (PDOException $e) {
            throw new LisaeException("Erreur requête", 1);
        }
        return $list[]=[$theme,$requete->rowCount()];
    }

    public function getList(): array{
        return $tab=[];
    }	
    
    public function get(int $id) {
        return $tab=[];
    }	

}

?>