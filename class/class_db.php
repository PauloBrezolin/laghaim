<?php

    class db
    {
        protected static $db;
        
        private function __construct()
        {
            
            global $conf;
            
            try
            {
                self::$db = new PDO('mysql:host=' . Config::DBCON_URL, Config::DBCON_USER, Config::DBCON_PASS);
                self::$db->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_SILENT );
            }
            catch (PDOException $e) 
            {
                self::$db == NULL;
            }
        }
        
        // get connection function. Static method - accessible without instantiation
        public static function getConnection() 
        {

            if (!self::$db) 
                new db();
            
            return self::$db;
        }        
    }
