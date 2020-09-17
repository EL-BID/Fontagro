<?php

class Estado extends MY_Model {
    

    function __construct() {
          parent::__construct();
          $this->table = "Estado";
          $this->vista = "v_Estado";
		  $this->idname = "id";
		  $this->eliminarSeguro = "SELECT * FROM Propuesta WHERE estado=?";
    }



	


    
	
}

?>