<?php

class Mapa extends MY_Model {
    

    function __construct() {
          parent::__construct();
          $this->table = "Mapa";
          $this->vista = "v_Mapa";
          $this->idname = "idmapa";
    }


	public function obtener($idpropuesta, $idmapa){
		$retorno = array();
		$query = $this->db->query("SELECT * FROM {$this->table} a WHERE idpropuesta=? AND {$this->idname} = ?", array($idpropuesta, $idmapa));
		$result = $query->result_array();
		if(empty($result)){
			return array();
		}
		$retorno['idmapa'] = $idmapa;
		$retorno['idpropuesta'] = $result[0]['idpropuesta'];
		$paqueteLang = $this->getLanguages($idmapa);
		foreach($paqueteLang as $pl){
			$retorno['nombre_'.$pl['codlang']] = $pl['nombre'];
			$retorno['descripcion_'.$pl['codlang']] = $pl['descripcion'];
		}
		return $retorno;
	}
	

	public function getByIdPropuesta($idpropuesta){
		$query = $this->db->query("SELECT idmapa FROM {$this->table} a WHERE idpropuesta=? AND deleted IS NULL ORDER BY idmapa ASC", array($idpropuesta));
		$result = $query->result_array();
		if(empty($result)){
			return 0;
		}
		return $result[0]['idmapa'];
	}

	public function tienePpal($idpropuesta){
		$query = $this->db->query("SELECT idmapaelemento 
											FROM Mapa m 
											JOIN MapaElemento e ON m.idmapa=e.idmapa
											WHERE m.idpropuesta=? AND m.deleted IS NULL AND e.esppal=1", array($idpropuesta));
		$result = $query->result_array();
		if(empty($result)){
			return false;
		}
		return true;
	}
}

?>