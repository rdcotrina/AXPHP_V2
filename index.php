<?php

define('DS',DIRECTORY_SEPARATOR);
define('ROOT',  realpath(dirname(__FILE__)) . DS);

require_once (ROOT . 'config' . DS . 'config.php');

use System\Session,
    System\Request,
    System\Bootstrap;

try{
    
    Session::init();
    
    /*registro de clases*/
//    Registry::anonimous('DatabaseProvider');
//    Registry::anonimous('View');    
//
    Bootstrap::run(new Request); 
}  
catch (Exception $e){
    echo $e->getMessage();
}