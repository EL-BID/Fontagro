<?php

class Indicastandar extends MY_Model {
    

    function __construct() {
          parent::__construct();
          $this->table = "Indicastandar";
          $this->vista = "v_Indicastandar";
		  $this->idname = "id";
		  $this->eliminarSeguro = "SELECT * FROM Tecnica WHERE indicastandar=?";
    }



	public function getAllByLangComp($codlang, $componente){
		$filtrar = '';
		if(!empty($componente)){
			$filtrar = 'AND i.componente IN (';
			$primero = true;
			foreach($componente as $c){
				$valor = is_array($c)? $c['value']: $c;
				if(is_numeric($valor)){
					if($primero){
						$primero=false;					
					}else{
						$filtrar .= ',';
					}				
					$filtrar .= $valor;
				}				
			}
			$filtrar .= ')';
		}
        $query=$this->db->query("SELECT il.id as value, il.nombre as label 
								FROM {$this->table} i JOIN {$this->table}_lang il ON i.id=il.id
								WHERE il.id<>9 AND il.codlang=? {$filtrar} ORDER BY il.nombre", array($codlang));
		$resultado=$query->result_array();
        return $resultado;
    }
}

?>