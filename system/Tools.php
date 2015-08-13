<?php

namespace System;

/**
 * Description of Tools
 *
 * @author DAVID
 */
final class Tools {
    
    /*
     * Devuelve una cadena desde texto: dato\dato\dato
     */
    public static function getStringUrl($class,$indice) {
        $cad = explode('\\', $class);
        return $cad[$indice];
    }
    
    public static function capitalize($cadena){
        $c = strtoupper (substr($cadena, 0,1));
        $d = strtolower(substr($cadena, 1));
        
        $r = $c.$d;
        
        return $r;
    }
    
}
