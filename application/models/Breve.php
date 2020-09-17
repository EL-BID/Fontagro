<?php

class Breve extends MY_Model {
    

    function __construct() {
          parent::__construct();
          $this->table = "Breve";
          $this->vista = "v_Breve";
          $this->idname = "idbreve";
    }

	
	public function getByIdPais($idpais, $codlang){
		$query=$this->db->query("SELECT * FROM {$this->table} b JOIN Breve_lang bl ON b.idbreve=bl.idbreve WHERE idpais=? AND codlang=?", array($idpais, $codlang));
		$resultado=$query->result_array();
		if (!$resultado || empty($resultado)) {
		  return Array();
		}		
		return $resultado[0];
	}

}

?>