<?php

class Solucion extends MY_Model {
    

    function __construct() {
          parent::__construct();
          $this->table = "Solucion";
          $this->vista = "v_Solucion";
          $this->idname = "id";
		  $this->eliminarSeguro = "SELECT * FROM Propuesta WHERE solucion=?";
    }
}

?>