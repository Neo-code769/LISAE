<?php

abstract class Dao {
        
        const HOST = "mysql:host=localhost:3308";
        const DB_NAME = "lisae";
        const USER = "root";
        const PASSW = "";
        private static $_conn = null;	
    
        public static function getConnexion() {
        
            if(is_null(self::$_conn))
            {
                try {
                self::$_conn = new PDO(
                self::HOST . ";dbname=" . self::DB_NAME,
                self::USER,
                self::PASSW);
               // echo "<p>Succes connexion</p>";
                } catch (PDOException $e) {
                    //echo " echec lors de la connexion : " . $e->getMessage();
                    //die();
                    throw new LisaeException("Echec");
                }
            } 
            return self::$_conn;
        }
        public function __destruct() {
            // déconnexion de la bd
            //echo "<p>Deconnexion</>";
            self::$_conn = null;
        }
    abstract public function getList(): array;		
    
    abstract public function get(int $id);	
    
    abstract public function insert($obj) : void;	
    // delete via son id
    abstract public function delete(int $id ); 
    // update d'un objet
    abstract public function update($obj ); 

    /*abstract public function getListTheme();
    abstract public function getThemeActivity();*/

    }
