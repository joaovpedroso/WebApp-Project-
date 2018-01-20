<?php

class Conecta {
    
    public static $host = "localhost";
    public static $user = "root";
    public static $pass = "";
    public static $db = "webapp";
    public static $pdo;
       
    public static function getPdo(){
        
        if( !isset( self::$pdo ) ) {
            $codificacao = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8');
            self::$pdo = new PDO('mysql:host=localhost;dbname=webapp', 'root', '', $codificacao);
            self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            self::$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
            
        }
        return self::$pdo;
    }
    
}

