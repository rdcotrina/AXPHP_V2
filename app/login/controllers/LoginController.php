<?php

namespace Login\Controllers;

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
    
    public function index() {
        Obj()->View->render('index',false);
    }
    
    public function postLogin() {
        $data = self::$modelLogin->loginUser();
        
        if(isset($data['rowCount']) && $data['rowCount'] > 0){
            $data = $data['data'];
            Obj()->Session->set('sys_idUsuario', $data['id_usuario']);
            Obj()->Session->set('sys_usuario', $data['usuario']);
            Obj()->Session->set('sys_nombreUsuario', $data['nombre_completo']);
            self::$modelLogin->postLastLogin();
            /*los roles*/
            Obj()->Session->set('sys_roles', self::$modelLogin->getRoles());
            /*asignando rol por defecto*/
            $rol = Obj()->Session->get('sys_roles');
            Obj()->Session->set('sys_defaultRol',$rol[0]['id_rol']);
            Obj()->Session->set('sys_defaultNameRol',$rol[0]['rol']);

            /*
             * verifico si es SUPER ADMINISTRADOR (001) o ADMINISTRADOR (002)
             * esto servira para los reportes, si es super o adm tendra acceso a toda la informacion
             */
            Obj()->Session->set('sys_all','N');
            if(Obj()->Session->get('sys_defaultRol') == APP_COD_SADM || Session::get('sys_defaultRol') == APP_COD_ADM){
                Obj()->Session->set('sys_all','S');
            }
        }else{
            $data = $data['data'];
        }

        echo json_encode($data);
    }
    
    public function logout(){
        Obj()->Session->destroy();
        $result = array('result' =>1);
        echo json_encode($result);
    }
    
}
