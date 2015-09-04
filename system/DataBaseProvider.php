<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace System;

/**
 * Description of DataBaseProvider
 *
 * @author DAVID
 */
final class DataBaseProvider extends PDO{
    
    private static $_instancias = array();
    
    public function __construct() {
        self::$_instancias[] = $this;
        if(count(self::$_instancias) == 1){
            parent::__construct(
                self::dns(), 
                DB_USER, 
                DB_PASS, 
                array(
                    PDO::ATTR_ERRMODE, 
                    PDO::ERRMODE_EXCEPTION,
                    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES '.DB_CHARSET
                )
            );
        }else{
            throw new Exception('Error: class Database ya se instancio; para acceder a la instancia ejecutar: Obj::run()->NOMBRE_REGISTRO');
        }
    }
    
    private static function dns(){
        switch (strtolower(DB_MOTOR)) {
            case 'mysql':
                $dsn = 'mysql:host='.DB_HOST.';port='.DB_PORT.';dbname='.DB_NAME.';';
                break;
            case 'sql':
                $dsn = 'sqlsrv:server='.DB_HOST.';Database='.DB_NAME.';';
                break;
            case 'oracle':
                $dsn = 'oci:dbname='.DB_NAME.';';
                break;
            case 'pgsql':
                $dsn = 'pgsql:host='.DB_HOST.';port='.DB_PORT.';dbname='.DB_NAME.';';
                break;
        }
        return $dsn;
    }
}