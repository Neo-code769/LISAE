<?php

class UserDao extends Dao{

    public function getList(): array{
        return [];
    }
    public function get(int $id) {

    }
    //requete pour récupérer les informations d'un utilisateur

    public function getInfo($id){
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
            //echo " echec lors de la création : " . $e->getMessage();
            //die();
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

    // delete via son id
    public function delete(int $id ){

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

    public function update($obj){
        
    } 

    public function listAnim(){
        $list = []; 
        $sql = Dao::getConnexion();
        $requete = $sql->prepare(
        "SELECT id_user, LastName, FirstName FROM users where role='Animator' ");
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
}