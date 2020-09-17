<?php

class Sector extends MY_Model {
    

    function __construct() {
          parent::__construct();
          $this->table = "Sector";
          $this->vista = "v_Sector";
		  $this->idname = "id";
		  $this->eliminarSeguro = "SELECT * FROM Propuesta_Sector WHERE idsector=?";
    }


	public function getSectorPropuesta($idpropuesta){
		$query=$this->db->query("SELECT * FROM Propuesta_Sector WHERE idpropuesta=?", Array($idpropuesta));
		$resultado=$query->result_array();
		$retorno = Array();
		foreach($resultado as $res){
			$retorno[$res['idsector']] = $res;
		}
		return $retorno;
	}

	public function actualizarPropuesta($idpropuesta, $sectores){
		$this->db->query("DELETE FROM Propuesta_Sector WHERE idpropuesta=?", Array($idpropuesta));
		if(empty($sectores)){
			return;
		}
		foreach($sectores as $idsector){
			$this->db->query("INSERT INTO Propuesta_Sector(idsector, idpropuesta) VALUES(?,?)", Array($idsector, $idpropuesta));
		}
	}
	
}

?>