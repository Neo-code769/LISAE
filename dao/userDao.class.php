<?php

class UserDao extends Dao{

    public function getList(): array{
        return [];
    }
    public function get(int $id) {

    }
    //requete pour récupérer les informations d'un Collaborateur

    public function getInfoCollab($id){
        $pdo = Dao::getConnexion();

        $requete = $pdo->prepare("SELECT * FROM users WHERE id_user= $id");
            try{
                $requete->execute();
                while($donnees = $requete->fetch(PDO::FETCH_ASSOC))
                {
                    $idUser=$donnees['id_user'];
                    $lastname=$donnees['LastName'];
                    $firstname=$donnees['FirstName'];
                    $birthdate=$donnees['birthDate'];
                    $phoneNumber=$donnees['PhoneNumber'];
                    $mail=$donnees['mail'];
                    $password=$donnees['password'];
                    $user = new Collaborator($idUser,$lastname, $firstname, $birthdate, $phoneNumber, $mail, $password, null);
                }

            }  catch (PDOException $e) {
                echo " ERREUR REQUETE : " . $e->getMessage();
            die();
            }
        return $user;
    }

    //requete pour récupérer les informations d'un Animateur

    public function getInfoAnim($id){
        $pdo = Dao::getConnexion();

        $requete = $pdo->prepare("SELECT * FROM users WHERE id_user= $id");
            try{
                $requete->execute();
                while($donnees = $requete->fetch(PDO::FETCH_ASSOC))
                {
                    $idUser=$donnees['id_user'];
                    $lastname=$donnees['LastName'];
                    $firstname=$donnees['FirstName'];
                    $birthdate=$donnees['birthDate'];
                    $phoneNumber=$donnees['PhoneNumber'];
                    $mail=$donnees['mail'];
                    $password=$donnees['password'];
                    $user = new Animator($idUser,$lastname, $firstname, $birthdate, $phoneNumber, $mail, $password);
                }

            }  catch (PDOException $e) {
                echo " ERREUR REQUETE : " . $e->getMessage();
            die();
            }
        return $user;
    }
    //requete pour ajouter un utilisateur

    public function insert($obj) :void
    {
        $sql = "INSERT INTO `users` (`id_user`,`FirstName`, `LastName`, `birthDate`, `PhoneNumber`, `mail`, `role`, `password`) VALUES (null, ?, ?, ?, ?, ?, ?,?);";
        $exec = (Dao::getConnexion())->prepare($sql);
        $exec->bindValue(1, $obj->get_firstname());
        $exec->bindValue(2, $obj->get_lastname());
        $exec->bindValue(3, $obj->get_birthdate());
        $exec->bindValue(4, $obj->get_phoneNumber());
        $exec->bindValue(5, $obj->get_mail());
        $exec->bindValue(6, $obj->get_role());
        $exec->bindValue(7, $obj->get_password());
        //var_dump($sql);
        try{
        $exec->execute();
        }
        catch (PDOException $e) {
            throw new LisaeException("Erreur",1);
        }
    }
    
    // requete pour recuperer la mail et le password d'un users (pour variable session)

    public function getSessionUser($mail, $password)
    {
        $pdo = Dao::getConnexion();
        $requete = $pdo->prepare ("SELECT * FROM users where mail= '".$mail ."' and password= '". $password."'");
        try {
            $requete->execute();
            $session = $requete->fetch(PDO::FETCH_ASSOC);
        }catch (PDOException $e) {
            throw new LisaeException("Erreur",1);
        }

        $result = [
            "exist" => $requete->rowCount(),
            "id_user" => $session['id_user'], 
            "mail" => $session['mail'], 
            "password" => $session['password'],
            "role" => $session['role']
            ];

        return $result;
    }

    // requete pour recupérer le mail d'un user

    public function getMail($mail)
    {
        $pdo = Dao::getConnexion();
        $requete = $pdo->prepare ("SELECT * FROM users where mail= '".$mail ."'");
        try {
            $requete->execute();
            $listMail = $requete->fetch(PDO::FETCH_ASSOC);
        }catch (PDOException $e) {
            throw new LisaeException("Erreur",1);
        }
        $result = [
            "exist" => $requete->rowCount(),
            "mail" => $listMail['mail']
            ];

        return $result;
    }

    // requete pour recuperer si le mail a été confirmer

    public function getConfirmationMail($mail) 
    {
        $pdo = Dao::getConnexion();
        $requete = $pdo->prepare ("SELECT confirmMail FROM users WHERE mail = '$mail'");
        try {
            $requete->execute();
            $confirmMail = $requete->fetch(PDO::FETCH_ASSOC);
        }catch (PDOException $e) {
            throw new LisaeException("Erreur",1);
        }
        return $confirmMail['confirmMail'];
    }

    // requete pour modifier l'user si le mail a été confirmer

    public function setConfirmationMail($mail)
    {
        $pdo = Dao::getConnexion();
        $requete = $pdo->prepare ("UPDATE users SET confirmMail = 1 WHERE mail = '$mail'");
        try {
            $requete->execute();
            echo 'Adresse mail du compte valide!';
        }catch (PDOException $e) {
            throw new LisaeException("Erreur",1);
        }
    }

    // requete pour modifier le password si oublié

    public function changePassword($password, $mail)
    {
        $pdo = Dao::getConnexion();
        $requete = $pdo->prepare ("UPDATE users SET `password`='".$password ."' WHERE mail= '".$mail ."'");
        var_dump($requete);
        try {
            $requete->execute();
        }catch (PDOException $e) {
            throw new LisaeException("Erreur",1);
        }
    }

    /******* DELETE COLLABORATEUR ********/

    public function deleteTie($idUser) {
        $sql = 
        "DELETE FROM `tie` WHERE id_user = $idUser";
        $exec = (Dao::getConnexion())->prepare($sql);
        try{
        $exec->execute();
        } 
        catch (PDOException $e) {
            throw new LisaeException("Erreur",1);
        }
    }

    public function deleteParticipate($idUser) {
        $sql = 
        "DELETE FROM `participate` WHERE id_user = $idUser";
        $exec = (Dao::getConnexion())->prepare($sql);
        try{
        $exec->execute();
        } 
        catch (PDOException $e) {
            throw new LisaeException("Erreur",1);
        }
    }

    public function deleteParticipateForActivity($idActivity) {
        $sql = 
        "DELETE FROM `participate` WHERE id_user = $idActivity";
        $exec = (Dao::getConnexion())->prepare($sql);
        try{
        $exec->execute();
        } 
        catch (PDOException $e) {
            throw new LisaeException("Erreur",1);
        }
    }

    /********** DELETE ANIMATEUR ************/

    public function deleteReferto($idUser) {
        $sql = 
        "DELETE FROM `referto` WHERE id_user = $idUser";
        $exec = (Dao::getConnexion())->prepare($sql);
        try{
        $exec->execute();
        } 
        catch (PDOException $e) {
            throw new LisaeException("Erreur",1);
        }
    }

    public function deleteHost($idUser) {
        $sql = 
        "DELETE FROM `host` WHERE id_user = $idUser";
        $exec = (Dao::getConnexion())->prepare($sql);
        try{
        $exec->execute();
        } 
        catch (PDOException $e) {
            throw new LisaeException("Erreur",1);
        }
    }

    public function deleteHostForActivity($idActivity) {
        $sql = 
        "DELETE FROM `host` WHERE id_user = $idActivity";
        $exec = (Dao::getConnexion())->prepare($sql);
        try{
        $exec->execute();
        } 
        catch (PDOException $e) {
            throw new LisaeException("Erreur",1);
        }
    }

    /********** DELETE UTILISATEUR ***********/
    public function delete(int $idUser){
        $sql = 
        "DELETE FROM `users` WHERE id_user = $idUser";
        $exec = (Dao::getConnexion())->prepare($sql);
        try{
        $exec->execute();
        } 
        catch (PDOException $e) {
            throw new LisaeException("Erreur",1);
        }
    } 

    // update numéro de téléphone (dans mon compte)
    
    public function updatePhone($phone, $user) {
        $pdo = Dao::getConnexion();
        $requete = $pdo->prepare("UPDATE `users` SET `PhoneNumber`=($phone) WHERE `id_user`= $user;");
        try {
            $requete->execute();
          } catch (PDOException $e) {
            echo " ERREUR REQUETE : " . $e->getMessage();
            }
    }

    // update mail (dans mon compte)

    public function updateMail($mail, $user) {
        $pdo = Dao::getConnexion();
        $requete = $pdo->prepare("UPDATE `users` SET `mail`=('$mail') WHERE `id_user`= $user;");
        try {
            $requete->execute();
          } catch (PDOException $e) {
            echo " ERREUR REQUETE : " . $e->getMessage();
            }
    }

    
    public function resetMail($user) {
        $pdo = Dao::getConnexion();
        $requete = $pdo->prepare("UPDATE `users` SET `confirmMail`= 0 WHERE `id_user`= $user;");
        try {
            $requete->execute();
          } catch (PDOException $e) {
            echo " ERREUR REQUETE : " . $e->getMessage();
            }
    }

    // Recupere tous les collaborateurs
    public function getCollab() {
        $list = [];
        $pdo = Dao::getConnexion();
        $requete = $pdo->prepare("SELECT users.id_user, LastName, FirstName, PhoneNumber, mail, session_name 
        FROM `users` INNER JOIN `tie` ON users.id_user = tie.id_user 
        INNER JOIN `session` ON tie.id_session = session.id_session
        WHERE `role` = 'Collaborator'");
        try {
            $requete->execute();
            while($donnees = $requete->fetch(PDO::FETCH_ASSOC)) {
                $list[] = ['id_user'=> $donnees["id_user"], 'Lastname'=> $donnees["LastName"], 'Firstname'=> $donnees["FirstName"], 'PhoneNumber'=> $donnees["PhoneNumber"], 'mail'=> $donnees["mail"], 'session'=> $donnees["session_name"]];
            }
        } catch (PdoException $e) {
            echo " ERREUR REQUETE : " . $e->getMessage();
        }
        return $list;
    }

    // Recupere tous les animateurs
    public function getAnim() {
        $pdo = Dao::getConnexion();
        $requete = $pdo->prepare("SELECT * FROM users WHERE `role` = 'Animator' OR `role` = 'Admin'");
        try {
            $requete->execute();
            while($donnees = $requete->fetch(PDO::FETCH_ASSOC)) {
                $list[] = ['id_user'=> $donnees["id_user"], 'Lastname'=> $donnees["LastName"], 'Firstname'=> $donnees["FirstName"], 'PhoneNumber'=> $donnees["PhoneNumber"], 'mail'=> $donnees["mail"]];
            }
        } catch (PdoException $e) {
           
            echo " ERREUR REQUETE : " . $e->getMessage();
        }
        return $list;
    }

    public function update($obj){
        
    } 
    public function listAnimForTheme($idTheme){
        $list = []; 
        $sql = Dao::getConnexion();
        $requete = $sql->prepare(
        "SELECT users.id_user, LastName, FirstName FROM users
        inner join referto on users.id_user = referto.id_user
        and id_theme = $idTheme");
        try {
            $requete->execute();
            //var_dump($requete);
            while($donnees = $requete->fetch(PDO::FETCH_ASSOC))
            {
                $lastName = $donnees["LastName"];
                $firstName = $donnees["FirstName"];
                $idUser = $donnees["id_user"];
                $user = new Animator( $idUser,$lastName,$firstName, null, null, null,null);
                $list[]=$user;
            }
        }
        catch (PDOException $e) {
            throw new LisaeException("Erreur requête", 1);
        }
        //var_dump($list);
        return $list;
    }
    // requete pour recuperer le nom et prenom de l'animateur pour la liste déroulante de la création d'un thème
    public function listAnim(){
        $list = []; 
        $sql = Dao::getConnexion();
        $requete = $sql->prepare(
        "SELECT id_user, LastName, FirstName 
        FROM users 
        where role='Animator' or role='Admin' 
        ");
        try {
            $requete->execute();
            while($donnees = $requete->fetch(PDO::FETCH_ASSOC))
            {
                $lastName = $donnees["LastName"];
                $firstName = $donnees["FirstName"];
                $idUser = $donnees["id_user"];
                $user = new Animator( $idUser,$lastName,$firstName, null, null, null,null);
                $list[]=$user;    
            }
        }
        catch (PDOException $e) {
            throw new LisaeException("Erreur requête", 1);
        }
        return $list;
    }

    //requete pour ajouter un référent d'un thème aprés la création d'un thème 
    public function insertReferToTheme($idUser){
        $sql = 
        "INSERT INTO `referto`
            VALUES(
            (SELECT MAX(id_theme) from theme),
            $idUser)
        ";
        $exec = (Dao::getConnexion())->prepare($sql);
        try{
        $exec->execute();
        } 
        catch (PDOException $e) {
            throw new LisaeException("Erreur",1);
        }   
    }

    //requete pour modifier un référent d'un thème aprés la modification d'un thème 

    public function updateReferToTheme($idUser,$idTheme){
        $sql = 
        "INSERT INTO `referto`
        VALUES($idTheme,$idUser)
        ";
        $exec = (Dao::getConnexion())->prepare($sql);
        try{
        $exec->execute();
        //var_dump($exec);
        } 
        catch (PDOException $e) {
            throw new LisaeException("Erreur",1);
        }   
    }

    //requete pour supprimer un référent d'un thème aprés la suppression d'un thème 

    public function deleteReferToTheme($idUser,$idTheme){
        $sql = 
        "DELETE FROM `referto` 
        WHERE id_user = $idUser
        AND id_theme = $idTheme
        ";
        $exec = (Dao::getConnexion())->prepare($sql);
        try{
        $exec->execute();
        } 
        catch (PDOException $e) {
            throw new LisaeException("Erreur",1);
        }   
    }
    public function deleteThemeReferTo($idTheme) : void{
        $sql = "DELETE FROM `referto` WHERE id_theme= $idTheme";
        $exec = (Dao::getConnexion())->prepare($sql);
         try {
             $exec->execute();
             var_dump($sql);
         }catch (PDOException $e) {
             throw new LisaeException("Erreur",1);
         }
     }
}