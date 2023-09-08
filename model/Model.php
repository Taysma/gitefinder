<?php
abstract class Model {
    private static $db;

    private static function setDb()
    {
        try {
            self::$db = new PDO('mysql:host=db5014396242.hosting-data.io;dbname=dbs11972850;charset=UTF8', 'dbu3444147','S006482o&');
        } catch(PDOException $e){
            echo "Erreur :" . $e->getMessage();
        }
    }

    protected function getDb()
    {
        if(self::$db == null){
            self::setDb();
        }
        return self::$db;
    }
}