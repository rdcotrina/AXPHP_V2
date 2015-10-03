<?php

namespace Index\Models;

/**
 * Description of IndexModel
 *
 * @author DAVID
 */
class IndexModel {
    
    public function getMenu() {
        $query = "call sp_confUsuarioConsultas(:flag,:criterio1,:criterio2);";
        $parms = array(
            ':flag' => 3,
            ':criterio1' => Session::get('sys_defaultRol'),
            ':criterio2' => ''
        );
        $data = $this->queryAll($query, $parms);
        return $data;
    }
    
}
