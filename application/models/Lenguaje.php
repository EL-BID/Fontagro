<?php

class Lenguaje extends MY_Model {
    

    function __construct() {
          parent::__construct();
          $this->table = "Lenguaje";
          $this->vista = "Lenguaje";
          $this->idname = "idlenguaje";
          $this->order = "ORDER BY nombre ASC";
    }


	public function getByCodigo($codigo){
		$query=$this->db->query("SELECT * FROM {$this->vista} WHERE codlang=?", array($codigo));
			$resultado=$query->result_array();
		if (!$resultado || empty($resultado)) {
		  return Array();
		}		
		return $resultado[0];
	  }
}

?>