<?php



/**
 * Description of LoginModel
 *
 * @author DAVID
 */
namespace Index\Models;

use System\DataBase;

class LoginModel extends DataBase{
    
    public function __construct() {
        parent::__construct();
    }
    
    public function getValidar(){
        $flag = AxForm::getPost('_flag');
        $user = Aes::de(AxForm::getPost('_user'));
        $pass = Aes::de(AxForm::getPost('_clave'));
        
        $query = "call sp_confUsuarioConsultas(:flag,:user,:pass);";
        $parms = array(
            ':flag' => $flag,
            ':user' => $user,
            ':pass' => md5($pass.APP_PASS_KEY)
        );
        $data = $this->queryOne($query,$parms);
        return $data;
        
    }
    
}
