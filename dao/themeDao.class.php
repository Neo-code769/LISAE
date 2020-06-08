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
        $sql = "SELECT `theme.name`, `recurring_activity.name`, `unique_activity.name` 
                FROM `unique_activity` INNER JOIN `theme` ON `theme.id_theme` = `unique_activity.id_theme`
                                       INNER JOIN `recurring_activity` ON `theme.id_theme` = `recurring_activity.id_theme`";
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