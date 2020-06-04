<?php

class themeDao extends Dao {

    public function getListTheme()
    {
        $sql = "SELECT `name` FROM theme ";
        $exec = (Dao::getConnexion())->prepare($sql);
        try {
            $exec->execute();
            }
            catch (PDOException $e) {
                throw new LisaeException("Erreur", 1);
            }
    }

}

?>