<?php

class Componente extends MY_Model {
    

    function __construct() {
          parent::__construct();
          $this->table = "Componente";
          $this->vista = "v_Componente";
          $this->idname = "id";
    }



	protected function getWhere($params){
		$search = $params['busqueda'];
		$where = "WHERE 1=1 ";
		if(!empty($search)){
			$where .= "AND (nombre like '%".$this->db->escape_like_str($search)."%') ";
		}
		return $where;
	}

	protected function getWhereObligado(){
		return '';
	}

    
    protected function validar($id, $data){
        $sar = parent::validar($id, $data);
        if(!empty($sar)){
            return $sar;
		}   	
		return '';       
	}

    public function eliminarSeguro($id){
		$query=$this->db->query("SELECT * FROM Tecnica WHERE componente=?",$id);
		$resultado=$query->result_array();
		if(empty($resultado)){
			$query=$this->db->query("DELETE FROM {$this->table}_lang WHERE {$this->idname}=?",$id);
			$query=$this->db->query("DELETE FROM {$this->table} WHERE {$this->idname}=?",$id);
			if($this->loggear){
				$this->db->query("INSERT INTO Logs(entidad, sentencia, idusuario, idprincipal, funcion) VALUES(?,?,?,?,?) ", Array($this->table, "DELETE FROM {$this->table} WHERE {$this->idname}={$id}", $this->session->userdata('idusuario'), $id, 'eliminarSeguro') );
			}
			return '';
		}else{
			return 'No se puede eliminar un elemento en uso';
		}
	}
	
}

?>