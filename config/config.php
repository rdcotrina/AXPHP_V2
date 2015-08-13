<?php

define('BASE_URL','http://'.$_SERVER['HTTP_HOST'].'/AXPHP_V2/');            #raiz del proyecto
define('DEFAULT_APP_FOLDER','app');                                         #carpeta de la aplicacion
define('DEFAULT_MODULE','index');                                           #nodulo por defecto
define('DEFAULT_CONTROLLER','index');                                       #controlador por defecto
define('DEFAULT_METHOD','index');                                           #metodo por defecto
define('DEFAULT_LAYOUT','smartadmin');                                      #nombre de template html

define('APP_NAME','AXPHP FW V2');
define('APP_SLOGAN','MY CREACION');
define('APP_COMPANY','www.axphp.com');
define('APP_KEY','adABKCDLZEFXGHIJ');                                       #llave para AES
define('APP_PASS_KEY','99}dF7EZbnbXOkojf&dzvxd5q#guPbPK1spU75Jm|N79Ii7PK'); #llave para concatenar al md5
define('APP_COD_SADM','0001');                                              #codigo de superadministrador
define('APP_COD_ADM','0002');                                               #codigo de admnistrador
define('APP_COPY','AX FRAMEWORK');
define('APP_LANG','ES');                                                    #idioma del sistema

define('DB_ENTORNO','D');                                                   #D=DESARROLLO, P=PRODUCCION
define('DB_MOTOR','mysql');
define('DB_HOST','localhost');
define('DB_USER','root');
define('DB_PASS','');
define('DB_NAME','ax_v2');

define('DB_PORT','3306');
define('DB_CHARSET','utf8');
define('DB_COLLATION','utf8_unicode_ci');

/*autolod para el system*/
function autoloadCore($class){
    $cad = explode('\\', $class);
    if(isset($cad[1])){
        if(file_exists(ROOT . 'system' . DS . $cad[1].'.php')){
            require_once (ROOT . 'system' . DS . $cad[1].'.php');
        }
    }
}

//function autoloadLibs($class){
//    if(file_exists(ROOT . 'libs' . DS . $class . DS . $class.'.php')){
//        require_once (ROOT . 'libs' . DS . $class . DS . $class.'.php');
//    }
//}

/*se registra la funcion autoload*/
spl_autoload_register('autoloadCore'); 
//spl_autoload_register('autoloadLibs');



use System\Obj;
/*
 * Funcion que retorna objeto con el cual permite acceder a todas las clases registradas
 * Es de ambito general, funciona en todo el sistema
 */
function Obj(){
    return Obj::run();
}

require_once ROOT.'lang/php/lang_'.APP_LANG.'.php';
