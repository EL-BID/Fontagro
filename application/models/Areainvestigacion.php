<?php

class Areainvestigacion extends MY_Model {
    

    function __construct() {
          parent::__construct();
          $this->table = "Areainvestigacion";
          $this->vista = "v_Areainvestigacion";
		  $this->idname = "id";
		  $this->eliminarSeguro = "SELECT * FROM Propuesta WHERE idareainvestigacion=?";
    }


	public function migrar(){
		$query=$this->db->query("SELECT idpropuesta FROM Propuesta");
		$propuestas=$query->result_array();
		foreach($propuestas as $prop){
			$query=$this->db->query("SELECT codlang, area_investigacion FROM Propuesta_lang WHERE idpropuesta=?",$prop['idpropuesta']);
			$areas = $query->result_array();
			$areacod = Array();
			foreach($areas as $area){
				$areacod[$area['codlang']] = $area['area_investigacion'];
			}
			$query = $this->db->query("SELECT id FROM Areainvestigacion_lang WHERE codlang='es' AND nombre like ? ", trim($areacod['es']));
			$yaExiste = $query->result_array();
			if(empty($yaExiste)){
				$this->db->query("INSERT INTO Areainvestigacion(id) VALUES(null)");
				$idareainvestigacion = $this->db->insert_id();
				$this->db->query("INSERT INTO Areainvestigacion_lang(id, codlang, nombre) VALUES(?,?,?)", Array($idareainvestigacion, 'es', trim($areacod['es'])));
				$this->db->query("INSERT INTO Areainvestigacion_lang(id, codlang, nombre) VALUES(?,?,?)", Array($idareainvestigacion, 'en', trim($areacod['en'])));
				$this->db->query("UPDATE Propuesta SET idareainvestigacion=? WHERE idpropuesta=?", Array($idareainvestigacion, $prop['idpropuesta']));
			}else{
				$this->db->query("UPDATE Propuesta SET idareainvestigacion=? WHERE idpropuesta=?", Array($yaExiste[0]['id'], $prop['idpropuesta']));
			}

		}
	}
	
}

?>