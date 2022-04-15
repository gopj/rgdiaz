<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Recolector extends MY_Controller {

	public function __construct(){
		parent::__construct();
		$this->setLayout('recolector');
		$this->load->model('persona_model');
		$this->load->model('contacto_model');
		$this->load->model('carpeta_model');
		$this->load->model('archivo_model');
		$this->load->model('notificacion_model');
		$this->load->model('residuo_peligroso_model');
		$this->load->model('tran_residuo_model');
		$this->load->model('tran_residuo_model');
		$this->load->model('tran_vehiculo_model');
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
			$data["tclientes"]			= $this->persona_model->obtienetodoclientes($id_tipo_persona, $lleno_datos);
			$data["recolector"]			= $this->persona_model->get_datos_empresa($this->session->userdata('id'));
			$data["vehiculos"] 			= $this->tran_vehiculo_model->get_vehiculos();
			
			$this->load->view("recolector/index", $data);
		}else{
			$this->session->sess_destroy(); #destruye session
			redirect('home/index');
		}
		
	}

	public function ver_manifiestos($id_persona=null) {
		$data["recolector"]	= $this->persona_model->get_datos_empresa($this->session->userdata('id'));
		$data["vehiculos"] 	= $this->tran_vehiculo_model->get_vehiculos();

		//PDF
		$pdfpath = $_SERVER['DOCUMENT_ROOT'] . "rgdiaz/img/pdf/rdiaztmp{@$id_persona}.pdf";
		if (file_exists($pdfpath)) {
			unlink($pdfpath);
		}

		if ($this->session->userdata('tipo') == 2){
			
			if ($this->input->post()){

				if ($this->input->post("identificador_folio") == ''){ // redirecciona cuando no se encuentra el identificador del folio
					redirect("recolector/index");
				}

				$data["id_cliente"] = $this->input->post("id_persona");
				$data["cliente"] = $this->persona_model->get_datos_empresa($this->input->post("id_persona"));

				$data["bitacora"] = $this->tran_residuo_model->get_bitacora($data["id_cliente"]);
				

				$this->load->view("recolector/ver_manifiestos", $data);


			} elseif ($id_persona) {
				$data["id_cliente"] = $id_persona;
				$data["cliente"] = $this->persona_model->get_datos_empresa($id_persona);

				$data["bitacora"] = $this->tran_residuo_model->get_bitacora($data["id_cliente"]);
				

				$this->load->view("recolector/ver_manifiestos", $data);

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

			$tran_resiudos 				= $this->tran_residuo_model->get_reg_tran_residuos($id_cliente, $folio);
			$data["cliente"] 			= $this->persona_model->get_datos_empresa($id_cliente);
			$manifiesto 				= $this->tran_residuo_model->get_manifiesto($id_cliente, $folio);
			$data["empresa_destino"] 	= $manifiesto->nombre_destino;
			$data["fecha_embarque"] 	= $manifiesto->fecha_embarque;
			$data["responsable_destino"]= $manifiesto->responsable_destino;
			$data["bitacora_manifiesto"]= $this->tran_residuo_model->get_bitacora_manifiesto($id_cliente, $folio);
			$data["recolector"]			= $this->persona_model->get_datos_empresa($this->session->userdata('id'));
			$data["vehiculos"] 			= $this->tran_vehiculo_model->get_vehiculos();
			$data["folio_identificador"]= $this->persona_model->get_datos_empresa($id_cliente)->identificador_folio . '-' . $folio; 

			$data["ruta"]				= $tran_resiudos->ruta;
			$data["observaciones"]		= $tran_resiudos->observaciones;
			$data["id_cliente"]			= $id_cliente;
			$data["folio"]				= $folio;

			$this->load->view("recolector/ver_manifiesto", $data);
		
		} else {
			$this->session->sess_destroy(); #destruye session
			redirect('home/index');
		}

	}

	public function crear_manifiesto($id_cliente) {

		if ($this->session->userdata('tipo') == 2){
			
			$data["empresa_destino"] 	= $this->emp_destino_model->get_tipo_emp_destino();
			$data["residuos"] 			= $this->residuo_peligroso_model->get_tipo_residuos();
			$data["recolector"]			= $this->persona_model->get_datos_empresa($this->session->userdata('id'));
			$data["vehiculos"] 			= $this->tran_vehiculo_model->get_vehiculos();
			$data["cliente"] 			= $this->persona_model->get_datos_empresa($id_cliente);

			if ($this->input->post()) {

				$data["folio"]				= $this->tran_residuo_model->get_bitacora_count($id_cliente); // Sacando count para folio automatico

				$fecha_embarque 			= date_create_from_format("d/m/Y", $this->input->post("fecha_embarque"));

				$data["id_cliente"] 		= $id_cliente;
				$data["id_recolector"] 		= $this->session->userdata("id");
				$data["id_emp_destino"]		= $this->input->post("empresa_destino");
				$data["residuo"]			= $this->input->post("residuo_peligroso");
				$data["fecha_embarque"]		= date_format($fecha_embarque, "Y-m-d");
				$data["responsable_destino"]= $this->input->post("responsable_destino");
				$data["ruta"]				= $this->input->post("ruta");
				$data["observaciones"]		= $this->input->post("observaciones");
				$data["residuo_cantidad"]	= $this->input->post("cantidad");
				$data["cont_cantidad"]		= $this->input->post("cantidad_envase");
				$data["cont_capacidad"]		= $this->input->post("capacidad_envase");
				$data["contenedor_tipo"]	= $this->input->post("tipoRadio");
				$data["etiqueta"]			= $this->input->post("etiqueta_check");
				$data["caracteristica_r"]	= $this->input->post("caracteristica_check");
				$data["id_vehiculo"]		= $this->input->post("id_vehiculo");

				$data["caracteristicas"] 	= "";
				$folio_temp = $this->tran_residuo_model->get_bitacora_count($id_cliente) - 1;
				$data["folio_identificador"]= $this->persona_model->get_datos_empresa($id_cliente)->identificador_folio . '-' . $data["folio"]; // Primera inserción de identificador de folio (no mover)

				foreach ($data["caracteristica_r"] as $key => $value) {
					$data["caracteristicas"] .= $value . " ";
				}

				// Inserta Folio
				$data["id_folio"] = $this->tran_residuo_model->inserta_tran_folio($data); // id_folio es el necesario para generacion automatica (no mover)
				// Inserta Manifiesto
				$this->tran_residuo_model->inserta_tran_residuo($data);

				$data["datos_persona"]		= '';
				$data["bitacora_manifiesto"]= $this->tran_residuo_model->get_bitacora_manifiesto($id_cliente, $data["folio"]);
				$data["fecha_embarque"]		= date_format($fecha_embarque, "d/m/Y");

				redirect("recolector/crear_manifiestos" . "/" .  $id_cliente . "/" . $data["id_folio"]);

			} else {

				$data["id_cliente"] 		= $id_cliente;
				$data["empresa_destino"] 	= $this->emp_destino_model->get_tipo_emp_destino();
				$data["residuos"] 			= $this->residuo_peligroso_model->get_tipo_residuos();


				$this->load->view("recolector/crear_manifiesto", $data);


			}

		} else {
			$this->session->sess_destroy(); #destruye session
			redirect('home/index');
		}	
	
	}

	public function crear_manifiestos($id_cliente, $folio) {

		if ($this->session->userdata('tipo') == 2){
			
			$data["empresa_destino"] 	= $this->emp_destino_model->get_tipo_emp_destino();
			$data["residuos"] 			= $this->residuo_peligroso_model->get_tipo_residuos();
			$data["recolector"]			= $this->persona_model->get_datos_empresa($this->session->userdata('id'));
			$data["vehiculos"] 			= $this->tran_vehiculo_model->get_vehiculos();
			$data["cliente"] 			= $this->persona_model->get_datos_empresa($id_cliente);
			$data["id_cliente"] 		= $id_cliente;

			$folio_temp = $this->tran_residuo_model->get_bitacora_count($id_cliente) - 1;
			$data["folio_identificador"]= $this->persona_model->get_datos_empresa($id_cliente)->identificador_folio . '-' . $folio_temp;
			$data["folio"]				= $folio;
			$data["id_folio"]			= $folio; //Se necesita para insereción 


			if ($this->input->post()) {

				$fecha_embarque 			= date_create_from_format("d/m/Y", $this->input->post("fecha_embarque"));

				$data["id_recolector"] 		= $this->session->userdata("id");
				$data["id_emp_destino"]		= $this->input->post("empresa_destino");
				$data["residuo"]			= $this->input->post("residuo_peligroso");
				$data["fecha_embarque"]		= date_format($fecha_embarque, "Y-m-d");
				$data["responsable_destino"]= $this->input->post("responsable_destino");
				$data["ruta"]				= $this->input->post("ruta");
				$data["observaciones"]		= $this->input->post("observaciones");
				$data["residuo_cantidad"]	= $this->input->post("cantidad");
				$data["cont_cantidad"]		= $this->input->post("cantidad_envase");
				$data["cont_capacidad"]		= $this->input->post("capacidad_envase");
				$data["contenedor_tipo"]	= $this->input->post("tipoRadio");
				$data["etiqueta"]			= $this->input->post("etiqueta_check");
				$data["caracteristica_r"]	= $this->input->post("caracteristica_check");
				
				$data["caracteristicas"] 	= "";

				foreach (@$data["caracteristica_r"] as $key => $value) {
					$data["caracteristicas"] .= $value . " ";
				}
				
				// // Actualza Folio
				$this->tran_residuo_model->update_folio($data); 

				$this->tran_residuo_model->inserta_tran_residuo($data);

				$data["bitacora_manifiesto"]= $this->tran_residuo_model->get_bitacora_manifiesto($id_cliente, $folio);

				
				$data["fecha_embarque"]		= date_format($fecha_embarque, "d/m/Y");


				$this->load->view("recolector/crear_manifiestos", $data);

			} else {

				$tran_resiudos 				= $this->tran_residuo_model->get_reg_tran_residuos($id_cliente, $folio);
				$fecha_embarque				= date_create_from_format("Y-m-d", $tran_resiudos->fecha_embarque);

				$data["fecha_embarque"]		= date_format($fecha_embarque, "d/m/Y");
				$data["responsable_destino"]= $tran_resiudos->responsable_destino;
				$data["id_emp_destino"]		= $tran_resiudos->id_tipo_emp_destino;
				$data["ruta"]				= $tran_resiudos->ruta;
				$data["observaciones"]		= $tran_resiudos->observaciones;
				$data["empresa_destino"] 	= $this->emp_destino_model->get_tipo_emp_destino();
				$data["residuos"] 			= $this->residuo_peligroso_model->get_tipo_residuos();
				$data["bitacora_manifiesto"]= $this->tran_residuo_model->get_bitacora_manifiesto($id_cliente, $folio);
				

				$this->load->view("recolector/crear_manifiestos", $data);


			}

		} else {
			$this->session->sess_destroy(); #destruye session
			redirect('home/index');
		}	
	
	}

	public function terminar_manifiesto($id_cliente, $folio) {

		if ($this->session->userdata('tipo') == 2){
			$data["recolector"]	= $this->persona_model->get_datos_empresa($this->session->userdata('id'));
			$data["vehiculos"] 	= $this->tran_vehiculo_model->get_vehiculos();
			$data["cliente"] 	= $this->persona_model->get_datos_empresa($id_cliente);
			$folio_temp = $this->tran_residuo_model->get_bitacora_count($id_cliente) - 1;
			$data["folio_identificador"]= $this->persona_model->get_datos_empresa($id_cliente)->identificador_folio . '-' . $folio_temp;
			$data["nombre_empresa"] 	= $this->persona_model->get_nombre_empresa($id_cliente);

			if ($this->input->post()) {

				$fecha_embarque 			= date_create_from_format("d/m/Y", $this->input->post("terminar_fecha"));
				$data["id_emp_destino"]		= $this->input->post("terminar_empresa_destino");
				$data["fecha_embarque"]		= date_format($fecha_embarque, "Y-m-d");
				$data["responsable_destino"]= $this->input->post("terminar_responsable");
				$data["responsable_tecnico"]= $this->input->post("terminar_responsable_tecnico");
				$data["persona_residuos"] 	= $this->input->post("terminar_persona_residuos");
				$data["cargo_persona"]		= $this->input->post("terminar_cargo_persona");
				$data["user_type"]			= $this->session->userdata('tipo');

				$this->tran_residuo_model->terminar_manifiesto($id_cliente, $folio, $data);

				$data["id_cliente"] = $id_cliente;
				$data["bitacora"] 	= $this->tran_residuo_model->get_bitacora($id_cliente);
				
				$this->load->view("recolector/ver_manifiestos", $data);


			}

		} else { 
			$this->session->sess_destroy(); #destruye session
			redirect('home/index');
		}	
	
	}

	public function eliminar_tran_residuo($id_cliente, $folio) {

		if ($this->session->userdata('tipo') == 2){

			$this->tran_residuo_model->delete_tran_residuos($folio);

			$tran_resiudos 				= $this->tran_residuo_model->get_reg_tran_residuos($id_cliente, $folio);
			$data["cliente"] 			= $this->persona_model->get_datos_empresa($id_cliente);
			$data["recolector"]			= $this->persona_model->get_datos_empresa($this->session->userdata('id'));
			$data["fecha_embarque"]		= $tran_resiudos->fecha_embarque;
			$data["responsable_destino"]= $tran_resiudos->responsable_destino;
			$data["id_cliente"] 		= $id_cliente;
			$data["empresa_destino"] 	= $this->emp_destino_model->get_tipo_emp_destino();
			$data["residuos"] 			= $this->residuo_peligroso_model->get_tipo_residuos();
			$data["bitacora_manifiesto"]= $this->tran_residuo_model->get_bitacora_manifiesto($id_cliente, $folio);
			$data["ruta"]				= $tran_resiudos->ruta;
			$data["observaciones"]		= $tran_resiudos->observaciones;
			$data["folio"]				= $folio;
			$data["vehiculos"] 			= $this->tran_vehiculo_model->get_vehiculos();
			
			$this->load->view("recolector/crear_manifiestos", $data);

		} else {
			$this->session->sess_destroy(); #destruye session
			redirect('home/index');
		}	
	
	}

	public function eliminar_ultimo_residuo($id_cliente, $folio, $id_tran_residuo) {

		if ($this->session->userdata('tipo') == 2){
			
						
			$this->tran_residuo_model->delete_tran_residuos($id_tran_residuo);
			$this->tran_residuo_model->delete_tran_folio($folio);

			redirect("recolector/ver_manifiestos/" . $id_cliente);

		} else {
			$this->session->sess_destroy(); #destruye session
			redirect('home/index');
		}	
	
	}

	public function generar_manifiesto($id_cliente, $folio) {
		$this->setLayout('empty');
		$data["id_cliente"] 			= $id_cliente;
		$data["folio"] 					= $folio;
		$data["folio_identificador"]	= $this->tran_residuo_model->get_folio_identificador($folio)->folio;
		$data["manifiesto"]				= $this->tran_residuo_model->get_manifiesto($id_cliente, $folio);
		$data["nombre_cliente"] 		= $this->persona_model->get_nombre_cliente($id_cliente);
		$data["cliente"] 				= $this->persona_model->get_datos_empresa($id_cliente);
		$data["nombre_empresa"] 		= $this->persona_model->get_nombre_empresa($id_cliente);
		$data["residuos_manifiesto"]	= $this->tran_residuo_model->get_residuos_manifiesto($id_cliente, $folio);
		$data["bitacora_manifiesto"]	= $this->tran_residuo_model->get_bitacora_manifiesto($id_cliente, $folio);
		$data["datos_empresa"] 			= $this->persona_model->get_datos_empresa($id_cliente);
		$data["datos_empresa_tran"] 	= $this->emp_transportista_model->get_datos_emp_trans(1);// default rdiaz
		$data["datos_empresa_destino"] 	= $this->emp_destino_model->get_destino($data["bitacora_manifiesto"][0]->id_tipo_emp_destino);
		$data["datos_recolector"] 		= $this->persona_model->get_nombre_cliente($this->session->userdata("id"));
		$data["vehiculos"] 				= $this->tran_vehiculo_model->get_vehiculos();
		$data["id_vehiculo"] 			= $this->persona_model->get_recolector_vehicle($this->session->userdata('id'));
		$data["recolector_vehiculo"]	= $this->tran_vehiculo_model->get_folio_vehiculo((int) $data["id_vehiculo"]->cp_empresa); // en recolectores (usuario tipo 2) cp_empresa es el id del vehiculo
		$tran_resiudos 					= $this->tran_residuo_model->get_reg_tran_residuos($id_cliente, $folio);
		$data["ruta"]					= $tran_resiudos->ruta;
		$data["nombre_empresas"] 		= $this->persona_model->get_datos_empresas();

		$this->load->view("recolector/generar_manifiesto.php", $data);

	}
	
	public function get_cliente() {
		$this->setLayout('empty');

		$cliente = $this->persona_model->obtiene_cliente($this->input->post('id_persona'));
		
		echo json_encode($cliente);
	}
	
	public function get_clave_residuo() {
		$this->setLayout('empty');

		$clave = $this->residuo_peligroso_model->get_tipo_residuo($this->input->post('id'));
		
		echo json_encode($clave);	
	}

	public function get_selected_vehicle(){
		$this->setLayout('empty');

		$id_vehiculo = $this->persona_model->get_recolector_vehicle($this->session->userdata('id'));

		echo json_encode($id_vehiculo);
	}

	public function register_vehicle(){
		if ($this->session->userdata('tipo') == 2){
			
			if ($this->input->post()) {
				$data['id_vehiculo'] = $this->input->post('id_vehiculo_recolector');
				$data['id_user']	 = $this->session->userdata('id');

				$this->persona_model->update_vehiculo_recolector($data);
			}		

			redirect("recolector");

		} else {
			$this->session->sess_destroy(); #destruye session
			redirect('home/index');
		}	
	}

	public function test() {

		$fecha = date_create_from_format("d/m/Y", "08/07/2018");

		echo date_format($fecha, "Y-m-d");

		$this->load->view("recolector/header_test");
		$this->load->view("recolector/test");
		$this->load->view("recolector/footer_test");
	}
}