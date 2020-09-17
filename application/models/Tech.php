<?php

class Tech extends MY_Model {
    

    function __construct() {
          parent::__construct();
          $this->table = "Tech";
          $this->vista = "v_Tech";
          $this->idname = "idtech";
    }



	protected function getWhere($params){
		$adonde = " WHERE 1=1 ";
		if(!empty($params['busqueda'])){
			$adonde .= "AND (titulo_simple like '%".$this->db->escape_like_str($params['busqueda'])."%' OR identificador like '%".$this->db->escape_like_str($params['busqueda'])."%' OR url like '%".$this->db->escape_like_str($params['busqueda'])."%' OR titulo like '%".$this->db->escape_like_str($params['busqueda'])."%' OR tech_titulo like '%".$this->db->escape_like_str($params['busqueda'])."%' ) ";
		}
		if($this->session->userdata('role')==4){
			$adonde .= " AND idwebstory IN (SELECT w.idwebstory FROM Propuesta_usuario p JOIN Webstory w ON p.idpropuesta=w.idpropuesta WHERE w.deleted IS NULL AND idusuario=".$this->session->userdata('idusuario').") ";
		}
		return $adonde;
	}
    
    protected function validar($id, $data){
        $retorno = parent::validar($id, $data);
        if(!empty($retorno)) return $retorno;
		
        $consulta = $this->db->query("SELECT * FROM {$this->table} w WHERE w.idwebstory = ?", array($data['idwebstory']['val']));
        $result = $consulta->result_array();
        if (!$result || empty($result)) {
			return ''; 
		}else{            
            if(sizeof($result)==1 && $result[0][$this->idname] == $id){ //estoy modificando el mismo 
                return ''; 
			}
			if($id==0 && !empty($result[0]['deleted'])){
				$this->db->query("DELETE FROM {$this->table} WHERE idwebstory = ? AND deleted IS NOT NULL", array($data['idwebstory']['val']));
				return '';
			}
            return 'tech de webstory duplicado';
        }             
	}

	public function getByIdWebstory($idwebstory){
		$query = $this->db->query("SELECT idtech FROM Tech t WHERE t.idwebstory = ? AND t.deleted IS NULL", array($idwebstory));
		$result = $query->result_array();
		if(!$result || empty($result)) {
			return 0; 
		}
		return $result[0]['idtech'];
	}


	public function getByPropuesta($idpropuesta, $codlang){
		$query = $this->db->query("SELECT idtech, wl.tech_titulo 
										FROM Tech t 
										JOIN Webstory w ON w.idwebstory=t.idwebstory
										JOIN Webstory_lang wl ON wl.idwebstory=w.idwebstory AND codlang=?
										WHERE t.habilitado=1 AND w.idpropuesta=? AND w.deleted IS NULL AND t.deleted IS NULL AND wl.tech_titulo<>'' ", array($codlang, $idpropuesta));
		return $query->result_array();		
	}

	public function getTodos($lang){
		$query = $this->db->query("SELECT w.foto_principal, wl.tech_titulo, t.idtech
									FROM Webstory w
									JOIN Webstory_lang wl ON w.idwebstory=wl.idwebstory	AND wl.codlang=?
									JOIN Tech t ON t.idwebstory = w.idwebstory							
									WHERE t.habilitado=1 AND w.deleted IS NULL AND t.deleted IS NULL ORDER BY t.idtech DESC", array($lang));
		return $query->result_array();	

	}
}

?>