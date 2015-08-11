<?php

namespace System;

/**
 * Description of Model
 *
 * @author DAVID
 */

use System\Tools,
    Exception;

class Model {
    
    public static function loadModel($file='',$mod='') {
        $module     = strtolower(substr(basename($file,'.php'),0,-10));
        $model      = (empty($mod))?$module:$mod;
        $nameModel  = Tools::capitalize($model);

        $urlModel = ROOT . DEFAULT_APP_FOLDER . DS . $module . DS .'models' . DS . $nameModel.'Model.php';
        
        if(is_readable($urlModel)){
            require_once $urlModel;
            $class = 'new \\'.$nameModel.'\\Models\\'.$nameModel.'Model();';
            
            return eval($class);    /*retorna instancia del objeto*/
        }else{
            throw new Exception('Error: Modelo <b>'.$urlModel.'</b> no encontrado');
        }
    }
    
}
