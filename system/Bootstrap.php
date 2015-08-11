<?php

namespace System;

/**
 * Description of Bootstrap
 *
 * @author DAVID
 */
use Exception;

final class Bootstrap {
    
    public static function run(Request $peticion) {
        $module     = $peticion->getModule();
        $controller = $peticion->getController() . 'Controller';
        $method     = $peticion->getMethod();
        $args       = $peticion->getArgs(); 
        $filter     = $peticion->getController() . 'Filter';
        $namespace  = '\\'.$peticion->getController().'\\Controllers\\'.$controller;    #namespace del ocntrolador
        
        $urlController  = ROOT . DEFAULT_APP_FOLDER . DS . $module. DS . 'controllers' . DS . $controller . '.php';
        $urlFilter      = ROOT . DEFAULT_APP_FOLDER . DS . $module. DS . 'filters' . DS . $filter . '.php';
        
        /*cargando trait filter q contiene validacion de formulario*/
        if (is_readable($urlFilter)) {
            require_once ($urlFilter);
        }
        
        if (is_readable($urlController)) {
            require_once ($urlController);
            $controller = new $namespace;   #instanciando clase con namespace
            
            if (!is_callable(array($controller, $method))) {
                throw new Exception('Error de M&eacute;todo: <b>'.$method.'</b> no encontrado.');
            }

            if (isset($args)) {
                call_user_func_array(array($controller, $method), $args);
            } else {
                call_user_func(array($controller, $method));
            }
            
            
        } else {
            throw new Exception('Error de Controlador: <b>'.$urlController.'</b> no encontrado.');
        }
        
    }
    
}
