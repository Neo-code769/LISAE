<?php

class themeDao extends Dao {

    public function getListTheme()
    {
        $sql = "SELECT `name` FROM theme ";
        $exec = (Dao::getConnexion())->prepare($sql);
        try {
            $exec->execute();
            return $exec;
            }
            catch (PDOException $e) {
                throw new LisaeException("Erreur", 1);
            }
    }

    public function getThemeActivity() 
    {
        $sql = "SELECT * FROM theme
        INNER JOIN recurring_activity ON recurring_activity.id_theme = theme.id_theme
        INNER JOIN activity ON activity.id_activity = recurring_activity.id_activity";
        $exec = (Dao::getConnexion())->prepare($sql);
        try {
            $exec->execute();
            return $exec;
            }
            catch (PDOException $e) {
                throw new LisaeException("Erreur", 1);
            }
    }

    public function getListSlot(){
        
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