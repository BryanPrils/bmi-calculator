<?php

class database
{


    private static $dbName = 'bmi-calculator';
    private static $dbHost = 'localhost:3306';
    private static $dbUsername = 'root';
    private static $dbUserPassword = '';

    private static $cont = null;

    public function __construct()
    {
        die('Init function is not allowed');
    }

    public static function connect()
    {

// One connection through whole application
        if (null == self::$cont) {
            try {
                self::$cont = new PDO("mysql:host=" . self::$dbHost . ";" . "dbname=" . self::$dbName, self::$dbUsername, self::$dbUserPassword);
//$dbnameok = checkDB(2);
//self::$cont =  new PDO( "mysql:host=".self::$dbHost.";"."dbname=".$dbnameok, self::$dbUsername, self::$dbUserPassword);
            } catch (PDOException $e) {
                die($e->getMessage());
            }
        }
        return self::$cont;
    }

    public static function disconnect()
    {
        self::$cont = null;
    }
}
