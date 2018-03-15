<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Recolector extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('persona_model');
		$this->load->model('contacto_model');
		$this->load->model('carpeta_model');
		$this->load->model('archivo_model');
		$this->load->model('notificacion_model');
		$this->load->model('residuo_peligroso_model');
		$this->load->model('area_model');
		$this->load->model('emp_transportista_model');
		$this->load->model('emp_destino_model');
		$this->load->model('modalidad_model');
		$this->load->helper('download');
		$this->load->library('session');
		$this->load->library('email');
		$this->load->library('Excel');
		$this->load->library('MY_PDF');
		$this->load->library('MY_Output');
		$this->load->helper('file');
		$this->load->helper('url');
	}

	public function index(){
		if ($this->session->userdata('tipo') == 2){
			$data["mensajes"] = $this->contacto_model->contador_mensajes(0);
			$data["clientes"] = $this->persona_model->obtiene_clientes_baja(3,1,1);
			$data["correo"] = $this->persona_model->getCorreos();

		
			$this->load->view('recolector/header', $data);
			$this->load->view("recolector", $data);
			$this->load->view('recolector/footer', $data);	
		}else{
			$this->session->sess_destroy(); #destruye session
			redirect('home/index');
		}
		
	}

}