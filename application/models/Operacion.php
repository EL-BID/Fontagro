<?php

class Operacion extends MY_Model {
    

    function __construct() {
          parent::__construct();
          $this->table = "Operacion";
          $this->vista = "v_Operacion";
          $this->idname = "id";
		  $this->eliminarSeguro = "SELECT * FROM Propuesta WHERE operacion=?";
    }	
}

?>