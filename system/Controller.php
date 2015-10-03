<?php

namespace System;

/**
 * Description of Controller
 *
 * @author DAVID
 */
use Exception;

abstract class Controller {
    
    /*
     * A cada clase hija se le obliga a tener un metodo index()
     */
    abstract public function index(); 
    
    final protected function loadController($class){
        $nameController  = Obj()->Tools->capitalize($class);

        $url = ROOT . DEFAULT_APP_FOLDER . DS . strtolower($class) . DS .'controllers' . DS . $nameController.'Controller.php';
        
        if(is_readable($url)){
            require_once $url;
            $class = '\\'.$nameController.'\\Controllers\\'.$nameController.'Controller';    #clase con namespace
            
            return new $class();    /*retorna instancia del objeto*/
        }else{
            throw new Exception('Error: Controlador <b>'.$url.'</b> no encontrado');
        }
    }

    final protected function redirect($ruta = false){
        if($ruta){
            header('location:' . BASE_URL . $ruta);
        }else{
            header('location:' . BASE_URL);
        }
    }
    
}
