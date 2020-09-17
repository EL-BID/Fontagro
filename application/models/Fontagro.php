<?php

class Fontagro extends MY_Model {
    

    function __construct() {
          parent::__construct();
          $this->table = "Fontagro";
          $this->vista = "Fontagro";
          $this->idname = "idfontagro";
    }



	protected function getWhere($params){
		$search = $params['busqueda'];
		$where = "WHERE 1=1 ";
		if(!empty($search)){
			$where .= " ";
		}
		return $where;
	}

	
}

?>