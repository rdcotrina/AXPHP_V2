<?php

namespace Index\Controllers;

/**
 * Maneja el login del usuario
 *
 * @author DAVID 
 * @copyright (c) 2015, RDCC
 */
use System\Controller;

final class LoginController extends Controller{
    
    private static $modelLogin;

    public function __construct() {
        self::$modelLogin = Obj()->Model->loadModel(__FILE__);
    }
    
    public function index() {}
    
    public function postLogin() {
        
    }
    
}
