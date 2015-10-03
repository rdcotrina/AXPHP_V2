<?php



/**
 * Description of LoginModel
 *
 * @author DAVID
 */
namespace Login\Models;

use System\DataBase;

class LoginModel extends DataBase{
    
    private $flag;
    private $user;
    private $pass;

    public function __construct() {
        parent::__construct();
        $this->_getPost();
    }
    
    private function _getPost(){
        $this->flag = Obj()->Form->getPost('_flag');
        $this->user = Obj()->Aes->de(Obj()->Form->getPost('_user'));
        $this->pass = Obj()->Aes->de(Obj()->Form->getPost('_clave'));
    }

    public function loginUser(){
        $query = "call sp_loginConsultas(:flag,:user,:pass);";
        $parms = array(
            ':flag' => $this->flag,
            ':user' => $this->user,
            ':pass' => md5($this->pass.APP_PASS_KEY)
        );
        $data = $this->queryOne($query,$parms);
     
        return array('data'=>$data,'rowCount'=>$this->rowCount);
    }
    
    public function getRoles() {
        $query = "call sp_loginConsultas(:flag,:user,:pass);";
        $parms = array(
            ':flag' => 2,
            ':user' => Obj()->Session->get('sys_idUsuario'),
            ':pass' => ''
        );
        return $this->queryAll($query,$parms);
    }
    
    public function postLastLogin(){
        $query = "UPDATE ma_usuario SET ultimo_acceso = :fecha WHERE id_usuario = :usuario;";
        $parms = array(
            ':fecha'=> date('Y-m-d H:m:s'),
            ':usuario' => Obj()->Session->get('sys_idUsuario')
        );
        $data = $this->execute($query, $parms);
    }
    
}
