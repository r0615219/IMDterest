<?php
namespace Imdterest;


    abstract class Db
    {
        private static $conn = null;

        public static function getInstance()
        {
            if (isset(self::$conn)) {
                return self::$conn;
            } else {
                //self::$conn = new \PDO('mysql:host=localhost; dbname=lisawo1q_imdterest', 'lisawo1q_imd', 'imdterest');
                self::$conn = new \PDO('mysql:host=localhost; dbname=imdterest', 'root', '');

                return self::$conn;
            }
        }
    }
