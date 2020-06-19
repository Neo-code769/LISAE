<?php

class SessionTrainingDao extends Dao{

    // requete pour attribuer une session de formation à un utilsateur

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

    //requete pour recuperer la liste des noms de sessions
    
    public function getSessionTrainingList() : array 
    {
        $list = []; 
        $sql = Dao::getConnexion();
        $requete = $sql->prepare(
        "SELECT session_name, id_session FROM session"
        );
        try {
            $requete->execute();
            while($donnees = $requete->fetch(PDO::FETCH_ASSOC))
            {
                $idSession=$donnees['id_session'];
                $sessionName=$donnees['session_name'];
                $session = new SessionTraining($idSession,$sessionName);
                $list[] = $session;
            }
        }
        catch (PDOException $e) {
            throw new LisaeException("Erreur requête", 1);
        }
        return $list;
    }

    // requete pour recuperer la session et le nom de session d'un utilisateur

    public function getSession($user){
        $sql = Dao::getConnexion();
        $requete = $sql->prepare(
        "SELECT session.id_session, session.session_name FROM session
        INNER JOIN tie on session.id_session = tie.id_session
         where id_user = $user"
        );
        try {
            $requete->execute();
            while($donnees = $requete->fetch(PDO::FETCH_ASSOC))
            {
                $idSession=$donnees['id_session'];
                $sessionName=$donnees['session_name'];
                $session = new SessionTraining($idSession, $sessionName);
            }
        }
        catch (PDOException $e) {
            throw new LisaeException("Erreur requête", 1);
        }
        return $session;
    }
    
    public function getList(): array{

        return [];
    }

    
    public function get(int $id) {
        return [];
    }  
    public function insert($obj) :void{
     
    }
    public function select() : void {

    }
    // delete via son id
    public function delete(int $id ){

    } 
    // update d'un objet
    public function update($obj){
        
    } 
  
}