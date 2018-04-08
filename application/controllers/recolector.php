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
		$this->load->model('tran_residuo_model');
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
			$data["id_tipo_persona"] 	= 2;
			$data["mensajes"] 			= $this->contacto_model->contador_mensajes(0);
			$data["clientes"] 			= $this->persona_model->obtiene_clientes_baja(3,1,1);
			$data["correo"] 			= $this->persona_model->getCorreos($data["id_tipo_persona"]);
			$data["id"]					= $this->session->userdata('id');
			$data["status"] 			= 0;
			$data["numnoti"] 			= $this->notificacion_model->obtiene_noticliente($data["id"],$data["status"]);
			$data["new_noti"] 			= $this->notificacion_model->get_new_noti($data["status"],$data["id"]);
			$id_tipo_persona = 3;
			$lleno_datos = 1;	// <-- Mandamos 1 para que nos cargue solo a los clientes que ya cargaron sus datos
			$data["tclientes"]			= $this->persona_model->obtienetodoclientes($id_tipo_persona,$lleno_datos);
			//$data["bitacora"]			= $this->tran_residuo_model->get_residuos($id_persona);

			$this->load->view('recolector/header', $data);
			$this->load->view("recolector/index", $data);
			$this->load->view('recolector/footer', $data);	
		}else{
			$this->session->sess_destroy(); #destruye session
			redirect('home/index');
		}
		
	}

	public function get_bitacora() {
		
		$bitacora = $this->tran_residuo_model->get_bitacora($this->input->post('id_persona'));

		/*print_r($bitacora);

		die();*/
		
		echo json_encode($bitacora);


	}

}