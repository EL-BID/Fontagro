<?php

class Componente extends MY_Model {
    

    function __construct() {
          parent::__construct();
          $this->table = "Componente";
          $this->vista = "v_Componente";
		  $this->idname = "id";
		  $this->eliminarSeguro = "SELECT * FROM Tecnica WHERE componente=?";
    }

    
	
}

?>