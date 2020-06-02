<?php

class userDao extends Dao{

    public function getList(): array{

        return [];
    }

    
    public function get(int $id) : array{
        return [];
    }
    
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

    public function select() : void 
    {
        $sql = "SELECT `host.slotDate`, `activity.name`, `host.slotHour` 
                FROM `activity` INNER JOIN `host` ON `activity.id_activity` = `host.id_activity`
                                INNER JOIN `users` ON `host.id_user` = `users.id_user` 
                WHERE `users.id_user` = `host.id_user` ";
        $exec = (Dao::getConnexion())->prepare($sql);
        try {
        $exec->execute();
        }
        catch (PDOException $e) {
            throw new LisaeException("Erreur", 1);
        }
    }

    public function getSession($mail, $password)
    {
        $pdo = Dao::getConnexion();
        $requete = $pdo->prepare ("SELECT * FROM users where mail= '".$mail ."' and password= '". $password."'");
        try {
            $requete->execute();
            //var_dump($requete);
            $session = $requete->fetch(PDO::FETCH_ASSOC);
            //var_dump($session['mail']);
        }catch (PDOException $e) {
            //throw new Exception("Requête vers la base de données éronnée");
            //die();
            throw new LisaeException("Erreur",1);
        }

        $result = [
            "exist" => $requete->rowCount(),
            "id_user" => $session['id_user'], 
            "mail" => $session['mail'], 
            "password" => $session['password'],
            "role" => $session['role']
            ];

        //var_dump($result);
        return $result;

    }
    public function getMail($mail)
    {
        $pdo = Dao::getConnexion();
        $requete = $pdo->prepare ("SELECT * FROM users where mail= '".$mail ."'");
        try {
            $requete->execute();
            //var_dump($requete);
            $listMail = $requete->fetch(PDO::FETCH_ASSOC);
        }catch (PDOException $e) {
            //throw new Exception("Requête vers la base de données éronnée");
            //die();
            throw new LisaeException("Erreur",1);
        }

        $result = [
            "exist" => $requete->rowCount(),
            "mail" => $listMail['mail']
            ];

        //var_dump($result);
        return $result;
    }
    // delete via son id
    public function delete(int $id ){

    } 

    // update d'un objet
    public function update($obj){
        
    } 

}