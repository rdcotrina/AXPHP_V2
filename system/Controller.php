<?php

namespace System;

/**
 * Description of Controller
 *
 * @author DAVID
 */

abstract class Controller {
    
    abstract public function index(); 
    
    protected function redirect($ruta = false){
        if($ruta){
            header('location:' . BASE_URL . $ruta);
        }else{
            header('location:' . BASE_URL);
        }
    }
    
}
