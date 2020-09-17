<?php

class EstadoIniciativa extends MY_Model {
    

    function __construct() {
          parent::__construct();
          $this->table = "Estado_Iniciativa";
          $this->vista = "v_Estado_Iniciativa";
          $this->idname = "id";
    }

    public function eliminarSeguro($id){
		return 'No se puede eliminar un elemento en uso';
	}
	
}

?>