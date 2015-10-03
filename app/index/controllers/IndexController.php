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
    
    private static $login;

    public function __construct() {
        self::$modelIndex = Obj()->Model->loadModel(__FILE__);
        self::$login = $this->loadController('Login');
    }

    public function index() {
        //Obj()->Session->destroy();
        if(Obj()->Session->get('sys_idUsuario')){  
            Obj()->Session->set('sys_menu', $this->getMenu());
            Obj()->View->render('index',false);
        }else{
            self::$login->index();
        }
    }
    
}
