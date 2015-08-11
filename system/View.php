<?php

namespace System;

/**
 * Description of View
 *
 * @author DAVID
 */
use Exception,
    System\Request;

final class View {
    
    public static function render($vista='',$ajax = true){       
        $rutaLayout = array(
            'img' => BASE_URL .'public/theme/' . DEFAULT_LAYOUT . '/img/',
            'css' => BASE_URL .'public/theme/' . DEFAULT_LAYOUT . '/css/',
            'js' => BASE_URL .'public/theme/' . DEFAULT_LAYOUT . '/js/',
            'root' => BASE_URL
        );
        
        /*si llamada a vista es via ajax*/
        if($ajax && empty($vista)){
            /*detectar en que metodo se ejecuta render();*/
            $e = new Exception();
            $trace = $e->getTrace();
            $last_call = $trace[1]; /*trae datos de clase donde se ejecuta View->render()*/
            
            $vista = $last_call['function'];
        }
        
        $request = new Request();
        
        $urlVista = ROOT . DEFAULT_APP_FOLDER . DS . $request->getModule() . DS . 'views' . DS . $vista . '.phtml';
        
        if(is_readable($urlVista)){
            if($ajax){
                /*cuando peticion es via ajax no se necesita el header y el footer*/
                require_once ($urlVista);
            }else{
                require_once (ROOT . 'public'. DS .'theme' . DS . DEFAULT_LAYOUT . DS . 'header.php');
                require_once ($urlVista);
                require_once (ROOT . 'public'. DS .'theme' . DS . DEFAULT_LAYOUT . DS . 'footer.php');
            }
        }else{
            throw new Exception('Error: Vista <b>'.$urlVista.'</b> no encontrada .');
        }    
    }
    
}