<?php

namespace System;

/**
 * Description of Singleton
 *
 * @author DAVID
 */
final class Singleton {
    
    private static $_instancia;
    private $_data;
    
    /*singleton*/
    public static function getInstancia(){
        if(!self::$_instancia instanceof self){
            self::$_instancia = new Singleton();
        }
        return self::$_instancia;
    }
    
    public function __set($name, $value) {
        $this->_data[$name] = $value;
    }
    
    public function __get($name) {
        if(isset($this->_data[$name])){            
            return $this->_data[$name];
        }else{
            return false;
        }
    }
    
    /*Evita que el objeto se pueda clonar*/
    public function __clone()
    {
        throw new Exception('La clonación de este objeto no está permitida', E_USER_ERROR);
    }
    
}
