<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of RideShareDb
 *
 * @author fkabakci
 */
class RideShareDb {
    
    public static $dsn = 'mysql:host=localhost;dbname=carpooldb';
    public static $dbusername = 'root';
    public static $dbpassword = '1234';
    
    final public static function connect() {       
        return new PDO(RideShareDb::$dsn, RideShareDb::$dbusername, RideShareDb::$dbpassword);
    }
   
    public static function insert($query) {
        return RideShareDb::connect()->exec($query);
    }
   
    public static function select($query) {
        $db = RideShareDb::connect();
        
        $select = $db->prepare($query);
        $select->execute();  
        $row = $select->fetch(PDO::FETCH_ASSOC);
        return $row;
    }
   
    public static function selectRows($query) {
        $db = RideShareDb::connect();
        $select = $db->prepare($query);
        $select->execute();  
        return $select;
    }
}
