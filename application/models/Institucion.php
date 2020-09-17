<?php

class Institucion extends MY_Model {
    

    function __construct() {
          parent::__construct();
          $this->table = "Institucion";
          $this->vista = "v_Institucion";
		  $this->idname = "id";
		  $this->eliminarSeguro = "SELECT * FROM Item WHERE tipo_institucion=?";
    }

	
	public function getEstadistica($codlang){
		$query=$this->db->query("SELECT il.id, il.nombre, round(sum(aporte_contrapartida)) total
									FROM Item it
									JOIN Institucion_lang il ON it.tipo_institucion=il.id AND il.codlang=?
									GROUP BY il.id, il.nombre", Array($codlang));
		return $query->result_array();
	}
}

?>