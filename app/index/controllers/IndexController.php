<?php

namespace Index\Controllers;

/**
 * Description of Iindex
 *
 * @author DAVID
 */
use System\Controller,
    System\Session,
    System\Model,
    System\View;

class IndexController extends Controller{
    
    private static $modelIndex;

    public function __construct() {
        self::$modelIndex = Model::loadModel(__FILE__);
    }

    public function index() {
        if(Session::get('sys_idUsuario')){  
            Session::set('sys_menu', $this->getMenu());
            View::render('index',false);
        }else{
            View::render('login',false);
        }
    }
    
}
