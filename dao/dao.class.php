<?php

abstract class Dao {
        
         const HOST = "mysql:host=localhost:3308";
        const DB_NAME = "lisae";
        const USER = "root";
        const PASSW = ""; 
       /*  const HOST = "mysql:host=185.98.131.94";
        const DB_NAME = "alafp1241787_16y2fld";
        const USER = "alafp1241787_16y2fld";
        const PASSW = "nD38kRymEh"; */
        private static $_conn = null;	
       
        public static function getConnexion() {
        
            if(is_null(self::$_conn))
            {
                try {
                self::$_conn = new PDO(
                self::HOST . ";dbname=" . self::DB_NAME,
                self::USER,
                self::PASSW);
                self::$_conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				self::$_conn->exec('SET Names UTF8');
                } catch (PDOException $e) {
                    throw new LisaeException("Echec connexion");
                }
            } 
            
            return self::$_conn;
        }
        public function __destruct() {
            // déconnexion de la bd
            self::$_conn = null;
        }
    abstract public function getList();		
    
    abstract public function get(int $id);	
    
    abstract public function insert($obj) : void;	
    // delete via son id
    abstract public function delete(int $id ); 
    // update d'un objet
    abstract public function update($obj ); 

    }
