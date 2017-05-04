<?php
    abstract class Db
    {
        private static $conn = null;
        
        public static function getInstance()
        {
            if (isset(self::$conn)) {
                return self::$conn;
            } else {
                self::$conn = new PDO('mysql:host=localhost; dbname=imdterest', 'root', '');
                //self::$conn = new PDO('mysql:host=localhost; dbname=caroli1q_imdterest', 'caroli1q_imd', 'imdterest');
                return self::$conn;
            }
        }
    }