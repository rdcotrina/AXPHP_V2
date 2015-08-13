<?php

namespace System;

/**
 * Description of Bootstrap
 *
 * @author DAVID
 */
use Exception;

final class Bootstrap {
    
    public static function run() {
        $module     = Obj()->Request->getModule();
        $controller = Obj()->Tools->capitalize(Obj()->Request->getController()) . 'Controller';
        $method     = Obj()->Request->getMethod();
        $args       = Obj()->Request->getArgs(); 
        $filter     = Obj()->Tools->capitalize(Obj()->Request->getController()) . 'Filter';
        $namespace  = '\\'.Obj()->Tools->capitalize(Obj()->Request->getController()).'\\Controllers\\'.$controller;    #namespace del ocntrolador
        
        $urlController  = ROOT . DEFAULT_APP_FOLDER . DS . $module. DS . 'controllers' . DS . $controller . '.php';
        $urlFilter      = ROOT . DEFAULT_APP_FOLDER . DS . $module. DS . 'filters' . DS . $filter . '.php';
        
        /*cargando trait filter q contiene validacion de formulario*/
        if (is_readable($urlFilter)) {
            require_once ($urlFilter);
        }
        
        if (is_readable($urlController)) {
            require_once ($urlController);
            Obj()->Registry->addClass($controller,$namespace); #registro de clase
            
            if (!is_callable(array(Obj()->$controller, $method))) {
                throw new Exception('Error de M&eacute;todo: <b>'.$method.'</b> no encontrado.');
            }

            if (isset($args)) {
                call_user_func_array(array(Obj()->$controller, $method), $args);
            } else {
                call_user_func(array(Obj()->$controller, $method));
            }
            
            
        } else {
            throw new Exception('Error de Controlador: <b>'.$urlController.'</b> no encontrado.');
        }
        
    }
    
}
