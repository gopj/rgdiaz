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

			$id_tipo_persona 			= 3;
			$lleno_datos 				= 1;	// <-- Mandamos 1 para que nos cargue solo a los clientes que ya cargaron sus datos
			$data["id"]					= $this->session->userdata('id');
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

	public function ver_manifiestos($id_persona=null) {

		if ($this->session->userdata('tipo') == 2){

			if ($this->input->post()){
				$data["id_cliente"] = $this->input->post("id_persona");

				$data["bitacora"] = $this->tran_residuo_model->get_bitacora($data["id_cliente"]);
				
				$this->load->view("recolector/header");
				$this->load->view("recolector/ver_manifiestos", $data);
				$this->load->view("recolector/footer");
			} elseif ($id_persona) {
				$data["id_cliente"] = $id_persona;

				$data["bitacora"] = $this->tran_residuo_model->get_bitacora($data["id_cliente"]);
				
				$this->load->view("recolector/header");
				$this->load->view("recolector/ver_manifiestos", $data);
				$this->load->view("recolector/footer");
			} else {
				redirect("recolector/index");
			}
		
		}else{
			$this->session->sess_destroy(); #destruye session
			redirect('home/index');
		}
	
	}

	public function ver_manifiesto($id_cliente, $folio){
 
		if ($this->session->userdata('tipo') == 2){

			$data["empresa_destino"] 	= $this->tran_residuo_model->get_manifiesto($id_cliente, $folio)->empresa_destino;
			$data["fecha_embarque"] 	= $this->tran_residuo_model->get_manifiesto($id_cliente, $folio)->fecha_ingreso;
			$data["bitacora_manifiesto"]= $this->tran_residuo_model->get_bitacora_manifiesto($id_cliente, $folio);
			$data["responsable_tecnico"]= $this->tran_residuo_model->get_manifiesto($id_cliente, $folio)->responsable_tecnico;
			$data["id_cliente"]			= $id_cliente;

			$this->load->view("recolector/header");
			$this->load->view("recolector/ver_manifiesto", $data);
			$this->load->view("recolector/footer");
		
		} else {
			$this->session->sess_destroy(); #destruye session
			redirect('home/index');
		}

	}

	public function crear_manifiesto($id_cliente) {

		if ($this->session->userdata('tipo') == 2){

			if ($this->input->post()) {

				$folio = $this->tran_residuo_model->get_bitacora_count($id_cliente)+1;

				$data["empresa_destino"] 	= $this->emp_destino_model->get_tipo_emp_destino();
				$data["residuos"] 			= $this->residuo_peligroso_model->get_tipo_residuos();
				

				$data["id_cliente"] 		= $id_cliente;
				$data["id_emp_destino"]		= $this->input->post("empresa_destino");
				$data["residuo"]			= $this->input->post("residuo_peligroso");
				$data["fecha_embarque"]		= $this->input->post("fecha_embarque");
				$data["responsable_tecnico"]= $this->input->post("responsable_tecnico");
				$data["cantidad"]			= $this->input->post("cantidad");
				$data["unidad"]				= $this->input->post("unidadRadio");
				$data["cantidad_contenedor"]= $this->input->post("cantidad_tipo");
				$data["contenedor"]			= $this->input->post("tipoRadio");
				$data["caracteristica_r"]	= $this->input->post("caracteristica_check");
				$data["caracteristicas"] 	= "";
				$data["folio"]				= $folio;
				
				foreach ($data["caracteristica_r"] as $key => $value) {
					$data["caracteristicas"] .= $value . " ";
				}

				$this->tran_residuo_model->inserta_tran_residuo($data);

				$data["bitacora_manifiesto"] = $this->tran_residuo_model->get_bitacora_manifiesto($id_cliente, $folio);

				$this->load->view("recolector/header");
				$this->load->view("recolector/crear_manifiestos", $data);
				$this->load->view("recolector/footer");

			} else {

				$data["id_cliente"] 		= $id_cliente;
				$data["empresa_destino"] 	= $this->emp_destino_model->get_tipo_emp_destino();
				$data["residuos"] 			= $this->residuo_peligroso_model->get_tipo_residuos();

				$this->load->view("recolector/header");
				$this->load->view("recolector/crear_manifiesto", $data);
				$this->load->view("recolector/footer");

			}

		} else {
			$this->session->sess_destroy(); #destruye session
			redirect('home/index');
		}	
	
	}

	public function crear_manifiestos($id_cliente, $folio) {

		if ($this->session->userdata('tipo') == 2){

			if ($this->input->post()) {
				
				$folio = $this->tran_residuo_model->get_bitacora_count($id_cliente);

				$data["empresa_destino"] 	= $this->emp_destino_model->get_tipo_emp_destino();
				$data["residuos"] 			= $this->residuo_peligroso_model->get_tipo_residuos();

				$data["id_cliente"] 		= $id_cliente;
				$data["id_emp_destino"]		= $this->input->post("empresa_destino");
				$data["residuo"]			= $this->input->post("residuo_peligroso");
				$data["fecha_embarque"]		= $this->input->post("fecha_embarque");
				$data["responsable_tecnico"]= $this->input->post("responsable_tecnico");
				$data["cantidad"]			= $this->input->post("cantidad");
				$data["unidad"]				= $this->input->post("unidadRadio");
				$data["cantidad_contenedor"]= $this->input->post("cantidad_tipo");
				$data["contenedor"]			= $this->input->post("tipoRadio");
				$data["caracteristica_r"]	= @$this->input->post("caracteristica_check");
				$data["caracteristicas"] 	= "";
				$data["folio"]				= $folio;

				foreach (@$data["caracteristica_r"] as $key => $value) {
					$data["caracteristicas"] .= $value . " ";
				}
				
				$this->tran_residuo_model->update_prev_reg($id_cliente, $folio, $data);

				$this->tran_residuo_model->inserta_tran_residuo($data);

				$data["bitacora_manifiesto"] = $this->tran_residuo_model->get_bitacora_manifiesto($id_cliente, $folio);

				$this->load->view("recolector/header");
				$this->load->view("recolector/crear_manifiestos", $data);
				$this->load->view("recolector/footer");
			} else {
				$tran_resiudos 				= $this->tran_residuo_model->get_reg_tran_residuos($id_cliente, $folio);
				$data["fecha_embarque"]		= $tran_resiudos->fecha_ingreso;
				$data["responsable_tecnico"]= $tran_resiudos->responsable_tecnico;
				$data["id_cliente"] 		= $id_cliente;
				$data["empresa_destino"] 	= $this->emp_destino_model->get_tipo_emp_destino();
				$data["residuos"] 			= $this->residuo_peligroso_model->get_tipo_residuos();
				$data["bitacora_manifiesto"]= $this->tran_residuo_model->get_bitacora_manifiesto($id_cliente, $folio);
				$data["folio"]				= $folio;
				
				$this->load->view("recolector/header");
				$this->load->view("recolector/crear_manifiestos", $data);
				$this->load->view("recolector/footer");

			}

		} else {
			$this->session->sess_destroy(); #destruye session
			redirect('home/index');
		}	
	
	}

	public function terminar_manifiesto($id_cliente, $folio) {

		if ($this->session->userdata('tipo') == 2){

			$data["fecha_embarque"]		= $this->input->post("fecha_embarque");
			$data["responsable_tecnico"]= $this->input->post("responsable_tecnico");

			$this->tran_residuo_model->update_prev_reg($id_cliente, $folio, $data);

			$this->tran_residuo_model->terminar_manifiesto($id_cliente, $folio);


			$data["id_cliente"] = $this->input->post("id_persona");

			$data["bitacora"] = $this->tran_residuo_model->get_bitacora($data["id_cliente"]);
			
			$this->load->view("recolector/header");
			$this->load->view("recolector/ver_manifiestos/" . $id_cliente	, $data);
			$this->load->view("recolector/footer");

		} else {
			$this->session->sess_destroy(); #destruye session
			redirect('home/index');
		}	
	
	}

	public function eliminar_tran_residuo($id_cliente, $folio, $id_tran_residuo) {

		if ($this->session->userdata('tipo') == 2){
			
			$this->tran_residuo_model->delete_tran_residuos($id_tran_residuo);

			$tran_resiudos 				= $this->tran_residuo_model->get_reg_tran_residuos($id_cliente, $folio);
			$data["fecha_embarque"]		= $tran_resiudos->fecha_ingreso;
			$data["responsable_tecnico"]= $tran_resiudos->responsable_tecnico;
			$data["id_cliente"] 		= $id_cliente;
			$data["empresa_destino"] 	= $this->emp_destino_model->get_tipo_emp_destino();
			$data["residuos"] 			= $this->residuo_peligroso_model->get_tipo_residuos();
			$data["bitacora_manifiesto"]= $this->tran_residuo_model->get_bitacora_manifiesto($id_cliente, $folio);
			$data["folio"]				= $folio;
			
			$this->load->view("recolector/header");
			$this->load->view("recolector/crear_manifiestos", $data);
			$this->load->view("recolector/footer");

		} else {
			$this->session->sess_destroy(); #destruye session
			redirect('home/index');
		}	
	
	}

	public function get_cliente() {
		
		$cliente = $this->persona_model->obtiene_cliente($this->input->post('id_persona'));
		
		echo json_encode($cliente);
	}
	
	public function get_clave_residuo() {

		$clave = $this->residuo_peligroso_model->get_tipo_residuo($this->input->post('id'));
		
		echo json_encode($clave);	
	}
}