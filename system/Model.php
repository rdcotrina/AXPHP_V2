<?php

namespace System;

/**
 * Description of Model
 *
 * @author DAVID
 */

use Exception;

class Model {
    
    final public static function loadModel($file,$mod='') {
        $module     = strtolower(substr(basename($file,'.php'),0,-10));
        $model      = (empty($mod))?$module:$mod;
        $nameModel  = Obj()->Tools->capitalize($model);

        $urlModel = ROOT . DEFAULT_APP_FOLDER . DS . $module . DS .'models' . DS . $nameModel.'Model.php';
        
        if(is_readable($urlModel)){
            require_once $urlModel;
            $class = '\\'.$nameModel.'\\Models\\'.$nameModel.'Model';    #clase con namespace
            
            return new $class();    /*retorna instancia del objeto*/
        }else{
            throw new Exception('Error: Modelo <b>'.$urlModel.'</b> no encontrado');
        }
    }
    
}
