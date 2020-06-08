<?php

class sessionTrainingDao extends Dao{

    public function getList(): array{

        return [];
    }

    
    public function get(int $id) {
        return [];
    }
    
    public function insert($obj) :void
    {
    }

    public function insertForSession($obj/*le nom de la formation + numéro formation ex : "DWWM3"*/) :void
    {
        $separation = explode(" ", $obj);
        $sql = 
        "INSERT INTO `tie`
         
         VALUES (null, 
            (SELECT MAX(`id_user`) FROM users),
            (SELECT id_training FROM training WHERE training.name LIKE '$separation[0]%'),
            (SELECT id_session FROM session WHERE session_name = '$obj'))
        ";
        $exec = (Dao::getConnexion())->prepare($sql);
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

    }

    public function getSessionTrainingList() : array 
    {
        $list = []; 
        $sql = Dao::getConnexion();
        $requete = $sql->prepare(
        "SELECT session.session_name FROM session"
        );
        try {
            $requete->execute();
            while($donnees = $requete->fetch(PDO::FETCH_ASSOC))
            {
                $sessionName=$donnees['session_name'];
                $session = new SessionTraining($sessionName);
                $list[] = $session;
            }
        }
        catch (PDOException $e) {
            throw new LisaeException("Erreur requête", 1);
        }
        return $list;
    }
    
    // delete via son id
    public function delete(int $id ){

    } 

    // update d'un objet
    public function update($obj){
        
    } 

}