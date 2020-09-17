<?php

class Region extends MY_Model {
    

    function __construct() {
          parent::__construct();
          $this->table = "Region";
          $this->vista = "v_Region";
          $this->idname = "id";
		  $this->eliminarSeguro = "SELECT * FROM Item WHERE region=?";
    }


}

?>