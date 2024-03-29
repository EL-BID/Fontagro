<?php

class Tema extends MY_Model {
    

    function __construct() {
          parent::__construct();
          $this->table = "Tema";
          $this->vista = "v_Tema";
		  $this->idname = "id";
		  $this->eliminarSeguro = "SELECT * FROM Propuesta_Tema WHERE idtema=?";
    }

	public function getTemasPropuesta($idpropuesta){
		$query=$this->db->query("SELECT * FROM Propuesta_Tema WHERE idpropuesta=?", Array($idpropuesta));
		$resultado=$query->result_array();
		$retorno = Array();
		foreach($resultado as $res){
			$retorno[$res['idtema']] = $res;
		}
		return $retorno;
	}

	public function getTemasPerfil($idperfil){
		$query=$this->db->query("SELECT * FROM Perfil_Tema WHERE idperfil=?", Array($idperfil));
		$resultado=$query->result_array();
		$retorno = Array();
		foreach($resultado as $res){
			$retorno[$res['idtema']] = $res;
		}
		return $retorno;
	}

	public function getTemasPerfilTexto($idperfil){
		$query=$this->db->query("SELECT * FROM Perfil_Tema pt
									JOIN Tema_lang tl ON pt.idtema=tl.id AND tl.codlang='es' WHERE idperfil=?", Array($idperfil));		
		return $query->result_array();
	}

	public function getTemasPropuestaTexto($idpropuesta, $codlang){
		$query=$this->db->query("SELECT * FROM Propuesta_Tema pt
									JOIN Tema_lang tl ON pt.idtema=tl.id AND tl.codlang=? WHERE idpropuesta=?", Array($codlang, $idpropuesta));		
		return $query->result_array();
	}

	public function actualizarPropuesta($idpropuesta, $temas){
		$this->db->query("DELETE FROM Propuesta_Tema WHERE idpropuesta=?", Array($idpropuesta));
		if(empty($temas)){
			return;
		}
		foreach($temas as $idtema){
			$this->db->query("INSERT INTO Propuesta_Tema(idtema, idpropuesta) VALUES(?,?)", Array($idtema, $idpropuesta));
		}
	}

	public function getByPropuestaVista($idpropuesta, $lang){
		$query=$this->db->query("SELECT tl.id, nombre 
									FROM Propuesta_Tema pt
									JOIN Tema_lang tl ON pt.idtema=tl.id
									WHERE idpropuesta=? AND codlang=? ", array($idpropuesta, $lang));
		$resultado=$query->result_array();
		return $resultado;
	}

	
}

?>