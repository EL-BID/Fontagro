<?php

class Investigacion extends MY_Model {
    

    function __construct() {
          parent::__construct();
          $this->table = "Investigacion";
          $this->vista = "v_Investigacion";
          $this->idname = "id";
		  $this->eliminarSeguro = "SELECT * FROM Propuesta WHERE tipo_investigacion=?";
    }	
}

?>