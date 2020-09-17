<?php

class OrganismoSugerido extends MY_Model {
    

    function __construct() {
          parent::__construct();
          $this->table = "Organismo_Sugerido";
          $this->vista = "v_Organismo_Sugerido";
          $this->idname = "idsugerido";
    }



	protected function getWhere($params){
		$search = $params['busqueda'];
		$where = "WHERE 1=1 ";
		if(!empty($search)){
			$where .= "AND (nombre like '%".$this->db->escape_like_str($search)."%' OR nombre_largo like '%".$this->db->escape_like_str($search)."%' OR usuario like '%".$this->db->escape_like_str($search)."%' OR pais like '%".$this->db->escape_like_str($search)."%' ) ";
		}
		return $where;
	}

	public function setAprobado($idsugerido){
		$query=$this->db->query("UPDATE {$this->table} SET aprobado=1 WHERE {$this->idname}=?",$idsugerido);
	}

	public function setRechazado($idsugerido, $motivo){
		$query=$this->db->query("UPDATE {$this->table} SET aprobado=0, motivo=? WHERE {$this->idname}=?", Array($motivo, $idsugerido));
	}
}

?>
