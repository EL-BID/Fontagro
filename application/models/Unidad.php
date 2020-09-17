<?php

class Unidad extends MY_Model {
    

    function __construct() {
          parent::__construct();
          $this->table = "Unidad";
          $this->vista = "v_Unidad";
		  $this->idname = "id";
		  $this->eliminarSeguro = "SELECT * FROM Tecnica WHERE unidad=?";
    }


	public function getAllByLangComp($codlang, $componente, $indicador){
		$filtrar = '';
		if(empty($componente) && empty($indicador)){
			return $this->getAllByLang($codlang);
		}else{
			if(empty($indicador)){
				$filtrar = 'AND t.componente IN (';
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
			}else{
				$filtrar = 'AND t.indicastandar IN (';
				$primero = true;
				foreach($indicador as $c){
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
		}
        $query=$this->db->query("SELECT ul.id as value, ul.nombre as label 
								FROM Tecnica t JOIN {$this->table}_lang ul ON t.unidad=ul.id
								WHERE ul.codlang=? {$filtrar} GROUP BY ul.id ORDER BY ul.nombre", array($codlang));
		$resultado=$query->result_array();
        return $resultado;
	}
	
	
}

?>