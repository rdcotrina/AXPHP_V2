<?php

define('DS',DIRECTORY_SEPARATOR);
define('ROOT',  realpath(dirname(__FILE__)) . DS);

require_once (ROOT . 'config' . DS . 'config.php');

use System\Registry;

try{
    /*registro de clases*/
    Registry::addClass('Registry','\\System\\Registry');
    Registry::addClass('Model','\\System\\Model');
    Registry::addClass('View','\\System\\View');    
    Registry::addClass('Session','\\System\\Session');
    Registry::addClass('Request','\\System\\Request');
    Registry::addClass('Bootstrap','\\System\\Bootstrap');
    Registry::addClass('Tools','\\System\\Tools');
    Registry::addClass('Aes','\\Libs\\Aes');
    Registry::addClass('AesCtr','\\Libs\\AesCtr');
    Registry::addClass('Form','\\Libs\\Form');
    
    Obj()->Session->init();
    
    Obj()->Bootstrap->run(); 
}catch (Exception $e){
    echo $e->getMessage();
}