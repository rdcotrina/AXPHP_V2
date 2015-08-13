<?php

namespace System;

/**
 * Description of Controller
 *
 * @author DAVID
 */

abstract class Controller {
    
    /*
     * A cada clase hija se le obliga a tener un metodo index()
     */
    abstract public function index(); 
    
    final protected function redirect($ruta = false){
        if($ruta){
            header('location:' . BASE_URL . $ruta);
        }else{
            header('location:' . BASE_URL);
        }
    }
    
}
