<?php

class Participacion extends MY_Model {
    

    function __construct() {
          parent::__construct();
          $this->table = "Participacion";
          $this->vista = "v_Participacion";
          $this->idname = "id";
		  $this->eliminarSeguro = "SELECT * FROM  Item WHERE participacion=?";
    }	
}

?>