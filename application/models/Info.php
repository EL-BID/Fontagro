<?php

class Info extends MY_Model {
    

    function __construct() {
          parent::__construct();
          $this->table = "Info";
          $this->vista = "Info";
          $this->idname = "idinfo";
    }



	protected function getWhere($params){
		$search = $params['busqueda'];
		$where = "WHERE 1=1 ";
		if(!empty($search)){
			$where .= "AND (valor like '%".$this->db->escape_like_str($search)."%') ";
		}
		return $where;
	}

	
	public function actualizar($codlang, $codigo, $valor, $indice){
		$query=$this->db->query("REPLACE INTO {$this->table} (codlang, codigo, valor, indice) VALUES(?,?,?,?)", array($codlang, $codigo, $valor, $indice));			
	}

	public function obtenerByIndiceLang($codlang, $indice){
		$query=$this->db->query("SELECT codigo, valor FROM {$this->table} WHERE (codlang=? OR codlang='ni') AND (indice=? OR indice='all')", array($codlang, $indice));
		$resultado=$query->result_array();		
		$retorno=array();
		foreach($resultado as $res){
			$retorno[$res['codigo']] = $res['valor'];
		}
		return $retorno;
	}

	public function obtenerByIndice($indice){
		$query=$this->db->query("SELECT codlang, codigo, valor FROM {$this->table} WHERE (indice=? OR indice='all') ", array($indice));
		$resultado=$query->result_array();		
		$retorno=array();
		foreach($resultado as $res){
			$retorno[$res['codlang']][$res['codigo']] = $res['valor'];
		}
		return $retorno;
	}
}

?>