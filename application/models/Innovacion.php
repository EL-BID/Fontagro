<?php

class Innovacion extends MY_Model {
    

    function __construct() {
          parent::__construct();
          $this->table = "Innovacion";
          $this->vista = "v_Innovacion";
		  $this->idname = "id";
		  $this->eliminarSeguro = "SELECT * FROM Propuesta WHERE tipo_innovacion=?";
    }
}

?>