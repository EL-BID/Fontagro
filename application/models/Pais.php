<?php

class Pais extends MY_Model {
    

    function __construct() {
          parent::__construct();
          $this->table = "Pais";
          $this->vista = "v_Pais";
		  $this->idname = "id";
		  $this->eliminarSeguro = "SELECT * FROM Item WHERE pais=?";
    }


	public function getByCode($code, $codlang){
		$query=$this->db->query("SELECT * FROM {$this->table} p JOIN Pais_lang pl ON p.id=pl.id WHERE code=? AND codlang=?", array($code, $codlang));
		$resultado=$query->result_array();
		if (!$resultado || empty($resultado)) {
		  return Array();
		}		
		return $resultado[0];
	}

	public function getPaisesMiembro($codlang){
		$query=$this->db->query("SELECT * FROM {$this->table} p JOIN Pais_lang pl ON p.id=pl.id WHERE esmiembro=1 AND codlang=? ORDER BY pl.nombre ASC", array($codlang));
		$resultado=$query->result_array();	
		return $resultado;
	}

	public function getPaisStat($idpais){
		$query=$this->db->query("SELECT SUM(aporte_contrapartida) contribucion FROM Item WHERE deleted IS NULL AND pais=? AND idpropuesta IN (SELECT idpropuesta FROM Propuesta WHERE deleted is null)", array($idpais));
		$resultado=$query->result_array();	
		$retorno = Array('contribucion'=>$resultado[0]['contribucion']);

		$query=$this->db->query("SELECT SUM(total) participacion 
		FROM Propuesta 
		WHERE deleted IS NULL AND idpropuesta IN (SELECT idpropuesta FROM Item Where pais=? AND deleted is null)", array($idpais));
		$resultado=$query->result_array();	
		$retorno['participacion']=$resultado[0]['participacion'];

		return $retorno;
	}
	
}

?>
