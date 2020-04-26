<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Home extends CI_Controller {

	public function __construct(){ 
		parent::__construct();
		$this->load->model('persona_model');
		$this->load->model('contacto_model');
		$this->load->helper('download');
		$this->load->library('session');
		$this->load->library('email'); 
	}

	public function index()
	{	
		$this->load->view('home/header');
		$this->load->view('home/inicio');
		$this->load->view('home/footer');
	}

	public function nosotros()
	{
		$this->load->view('home/header');
		$this->load->view('home/nosotros');
		$this->load->view('home/footer');
	}

	public function contacto()
	{
		$this->load->view('home/header');
		$this->load->view('home/contacto');
		$this->load->view('home/footer');
	}

	public function recupera_password(){
		$this->load->view('home/header');
		$this->load->view('home/recupera_password');
		$this->load->view('home/footer');
	}

	public function sitios_interes(){
		$this->load->view('home/header');
		$this->load->view('home/sitios_interes');
		$this->load->view('home/footer');
	}

	public function sesion(){
		$this->load->view('home/header');
		$this->load->view('home/inicio_session');
		$this->load->view('home/footer');
	}

	public function index2(){
		$this->load->view('home/header2');
		$this->load->view('home/index2');
		$this->load->view('home/footer2');
	}

	public function login2(){
		$this->load->view('home/header2');
		$this->load->view('home/login2');
		$this->load->view('home/footer2');
	}

	public function login()
	{
		if($this->input->post())
		{
			$id_status_persona = 1;
			$login = $this->persona_model->login($this->input->post('correo'), $this->input->post('password'),$id_status_persona);
 
			if(!is_object($login)){
						//contraseña y/o usuario invalido
						
						$this->session->sess_destroy(); #destruye session
						redirect('home/index');	
			}else{
				//Login correcto
								$this->session->set_userdata('correo',$login->correo);
								$this->session->set_userdata('id',$login->id_persona);
								$this->session->set_userdata('empresa',$login->nombre_empresa);
								$this->session->set_userdata('nombre',$login->nombre);
								$this->session->set_userdata('status',$login->id_status_persona);
								$this->session->set_userdata('tipo',$login->id_tipo_persona);
								$this->session->set_userdata('completo',$login->lleno_datos);
								
								//	Sesion del Administrador
								if($this->session->userdata('status') == 1 && $this->session->userdata('tipo')==1){
									#	Cargar la vista de usuario
									redirect('administrador');
								}
								// Sesion del Auxiliar
								else if($this->session->userdata('status') == 1 && $this->session->userdata('tipo')==2){
									#	Cargar la vista de usuaria
									redirect('recolector');
								}
								// Sesion de Cliente 
								else if($this->session->userdata('status')== 1 && $this->session->userdata('tipo')==3){
									#	Cargar la vista de usuario
									redirect('cliente');
								}else{
									$this->session->sess_destroy(); #destruye session
									redirect('home/index');	
								}
								
			}
		}else{
			exit('Ocurrio un error contactar al administrador!!!..');
		}
	}

//	-- Metodo que inserta Mensajes de Contacto
	public function contacto_mensaje(){
		if($this->input->post()){
			$status = 0;	#	Mandamos el status del mensaje como no leido con 0
			$contacto = $this->contacto_model->insertacontacto($this->input->post('nombre'),
															   $this->input->post('telefono'),
															   $this->input->post('email'),
															   $this->input->post('asunto'),
															   $this->input->post('mensaje'),
															   $status);
			redirect('home');
		}
	}

//	--	Metodo que valida un usuario dado de alta
	public function valida_usuario(){
		if($this->input->post()){
			$id_status_persona = 1; // mandamos person con status igual a uno
			$login=$this->persona_model->login($this->input->post('correo'),
			 								   $this->input->post('password'),
			 								   $id_status_persona);
			 if(is_object($login)){
			 	$acceso = true;
			 	echo json_encode($acceso);
			 }else{
			 	$acceso = false;
			 	echo json_encode($acceso);
			 }
		}
	}
//	-- Metodo que destruye la sesion 
	public function logout()
	{
		//exit('entra a la funcion');
		$this->session->sess_destroy(); #destruye session
		redirect('home');
	}

}
