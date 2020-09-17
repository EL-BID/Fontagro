<?php

class Estrategica extends MY_Model {
    

    function __construct() {
          parent::__construct();
          $this->table = "Estrategica";
          $this->vista = "v_Estrategica";
		  $this->idname = "id";
		  $this->eliminarSeguro = "SELECT * FROM Propuesta WHERE linea_estrategica=?";
    }	
}

?>