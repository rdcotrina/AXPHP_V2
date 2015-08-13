<?php

namespace Index\Controllers;

/**
 * Description of Iindex
 *
 * @author DAVID
 */
use System\Controller;

class IndexController extends Controller{
    
    private static $modelIndex;

    public function __construct() {
        self::$modelIndex = Obj()->Model->loadModel(__FILE__);
    }

    public function index() {
        if(Obj()->Session->get('sys_idUsuario')){  
            Obj()->Session->set('sys_menu', $this->getMenu());
            Obj()->View->render('index',false);
        }else{
            Obj()->View->render('login',false);
        }
    }
    
}
