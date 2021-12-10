<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends MY_Controller {

	public function __construct(){
		parent::__construct();
		$this->setLayout('admin');
		$this->load->model('persona_model');
		$this->load->model('contacto_model');
		$this->load->model('carpeta_model');
		$this->load->model('archivo_model');
		$this->load->model('notificacion_model');
		$this->load->model('residuo_peligroso_model');
		$this->load->model('tran_residuo_model');
		$this->load->model('tran_vehiculo_model');
		$this->load->model('area_model');
		$this->load->model('emp_transportista_model');
		$this->load->model('emp_destino_model');
		$this->load->model('modalidad_model');
		$this->load->helper('download');
		$this->load->helper('file');
		$this->load->library('session');
		$this->load->library('email');
		$this->load->library('Excel');
		$this->load->library('MY_PDF');
		$this->load->library('MY_Output');
		$this->load->library('MY_Input');
		$this->load->helper('file');
		$this->load->helper('url');
	}

	public function recolector_index() {
		if ($this->session->userdata('tipo') == 1){
			$id_tipo_persona 			= 3;
			$lleno_datos 				= 1;	// <-- Mandamos 1 para que nos cargue solo a los clientes que ya cargaron sus datos
			$data["id"]					= $this->session->userdata('id');
			$data["tclientes"]			= $this->persona_model->obtienetodoclientes($id_tipo_persona,$lleno_datos);
			
			$this->load->view('administrador/recolector/index', $data);
		} else {
			$this->session->sess_destroy(); #destruye session
			redirect('home/index');
		}
		
	}
	
	public function recolector_consulta() {

		if ($this->session->userdata('tipo')==1){

			$data["recolectores"] = $this->persona_model->get_recolectores();
			$data["vehiculos"] = $this->tran_vehiculo_model->get_vehiculos();
			$data["tipo_vehiculos"] = $this->tran_vehiculo_model->get_tipo_vehiculos();
			$data["destinos"] = $this->emp_destino_model->get_destinos();

			if ($this->input->post()) {

				$data["nombre"] = $this->input->post("nombre_recolector");
				$data["correo"] = $this->input->post("correo");
				$data["clave"] = $this->input->post("clave2");
				$data["id_persona"] = $this->input->post("id_persona");

				if($data["id_persona"]) {
					$this->persona_model->update_recolector($data);
				} else {
					$this->persona_model->alta_recolector($data);
				}
				
				redirect('administrador/recolector_consulta');

			} else {

				$data["mensajes"] = $this->contacto_model->contador_mensajes(0);
				$data["clientes"] = $this->persona_model->obtiene_clientes_baja(3,1,1);
				$data["correo"] = $this->persona_model->getCorreos(3);

				$this->load->view("administrador/recolector/consulta", $data);
			}
		} else {
			redirect('home');
		}
		
	}

	public function recolector_delete($id) {
		$this->setLayout('empty');	
		if ($this->session->userdata('tipo')==1){

			if (@$id != null) {
				$this->persona_model->delete_recolector($id);
			}

			redirect('administrador/recolector_consulta');
		}
	}


	public function get_recolector() {
		$this->setLayout('empty');

		$recolector = $this->persona_model->get_recolector($this->input->post('id_persona'));
		
		echo json_encode($recolector);
	}

	public function recolector_vehiculo() {

		if ($this->session->userdata('tipo')==1){

			$data_view["recolectores"] = $this->persona_model->get_recolectores();
			$data_view["vehiculos"] = $this->tran_vehiculo_model->get_vehiculos();
			$data_view["tipo_vehiculos"] = $this->tran_vehiculo_model->get_tipo_vehiculos();
			$data_view["destinos"] = $this->emp_destino_model->get_destinos();

			if ($this->input->post()){
				$modelo = $this->input->post("modelo");
				$marca 	= $this->input->post("marca");
				$placa 	= $this->input->post("placa");
				$alias 	= $this->input->post("alias");
				$id_vehiculo = $this->input->post("id_vehiculo");
				$id_tipo_vehiculo = $this->input->post("id_tipo_vehiculo");
				$tipo_vehiculo = $this->input->post("tipo_vehiculo");

				$data["modelo"] = $modelo;
				$data["marca"] 	= $marca;
				$data["placa"] 	= $placa;
				$data["alias"] 	= $alias;
				$data["id_vehiculo"] = $id_vehiculo;
				$data["id_tipo_vehiculo"] = $id_tipo_vehiculo;
				$data["tipo_vehiculo"] = $tipo_vehiculo;

				if ($id_vehiculo == "nuevo") {
					if ($id_tipo_vehiculo == "otro_vehiculo") {
						$data["new_id_tipo"] = $this->tran_vehiculo_model->alta_tipo_vehiculo($data);
					}
					$this->tran_vehiculo_model->alta_vehiculo($data);
				} else {
					if ($id_tipo_vehiculo == "otro_vehiculo") {
						$data["new_id_tipo"] = $this->tran_vehiculo_model->alta_tipo_vehiculo($data);
					}
					$this->tran_vehiculo_model->update_vehiculo($data);
				}
				
				redirect('administrador/recolector_consulta');
			} else {
				
				$this->load->view('administrador/recolector/consulta', $data_view);
				
			}

		}
	}

	public function get_vehiculo() {
		$this->setLayout('empty');

		$vehiculo = $this->tran_vehiculo_model->get_vehiculo($this->input->post('id_vehiculo'));
		
		echo json_encode($vehiculo);
	}

	public function recolector_vehiculo_delete($id) {
		$this->setLayout('empty');	
		if ($this->session->userdata('tipo')==1){

			if (@$id != null) {
				$this->tran_vehiculo_model->delete_vehiculo($id);
			}

			redirect('administrador/recolector_consulta');
		}
	}

	public function recolector_destino() {

		if ($this->session->userdata('tipo')==1){

			$data_view["recolectores"] = $this->persona_model->get_recolectores();
			$data_view["vehiculos"] = $this->tran_vehiculo_model->get_vehiculos();
			$data_view["tipo_vehiculos"] = $this->tran_vehiculo_model->get_tipo_vehiculos();
			$data_view["destinos"] = $this->emp_destino_model->get_destinos();


			if ($this->input->post()) {
				
				$data["nombre_destino"] 	= $this->input->post("nombre_destino");
				$data["numero_autorizacion"]= $this->input->post("numero_autorizacion");
				$data["calle"] 				= $this->input->post("calle");
				$data["num_ext"] 			= $this->input->post("num_ext");
				$data["num_int"] 			= $this->input->post("num_int");
				$data["cp"] 				= $this->input->post("cp");
				$data["colonia"] 			= $this->input->post("colonia");
				$data["municipio"] 			= $this->input->post("municipio");
				$data["estado"] 			= $this->input->post("estado");
				$data["telefono"] 			= $this->input->post("telefono");
				$data["id_emp_dest"] 		= $this->input->post("id_emp_dest");

				if($data["id_emp_dest"]) {
					$this->emp_destino_model->update_destino($data);
				} else {
					$this->emp_destino_model->alta_destino($data);
				}

				redirect('administrador/recolector_consulta');
			}

			$this->load->view("administrador/recolector/consulta", $data_view);

		}
		
	}

	public function get_destino() {
		$this->setLayout('empty');

		$destino = $this->emp_destino_model->get_destino($this->input->post('id_destino'));
		
		echo json_encode($destino);
	}

	public function recolector_destino_delete($id) {
		$this->setLayout('empty');	
		if ($this->session->userdata('tipo')==1){

			if (@$id != null) {
				$this->emp_destino_model->delete_destino($id);
			}

			redirect('administrador/recolector_consulta');
		}
	}

	public function recolector_ver_manifiestos($id_persona=null) {
		$data["url_back"] = $this->session->set_userdata('url_back', 'manifiestos'); // URL hacia atrás 
		$data["recolector"]	= $this->persona_model->get_datos_empresa($this->session->userdata('id'));
		$data["vehiculos"] 	= $this->tran_vehiculo_model->get_vehiculos();

		//PDF
		$pdfpath = $_SERVER['DOCUMENT_ROOT'] . 'rgdiaz/img/pdf/rdiaztmp' . @$id_persona . '.pdf';
		if (file_exists($pdfpath)) {
			unlink($pdfpath);
		}

		if ($this->session->userdata('tipo') == 1){
			
			if ($this->input->post()){

				if ($this->input->post("identificador_folio") == ''){ // redirecciona cuando no se encuentra el identificador del folio
					redirect("admin/recolector/index");
				}

				$data["id_cliente"] = $this->input->post("id_persona");
				$data["cliente"] = $this->persona_model->get_datos_empresa($this->input->post("id_persona"));
				$data["bitacora"] = $this->tran_residuo_model->get_bitacora($data["id_cliente"]);
				
				$this->load->view("administrador/recolector/ver_manifiestos", $data);
			} elseif ($id_persona) {
				$data["id_cliente"] = $id_persona;
				$data["cliente"] = $this->persona_model->get_datos_empresa($id_persona);
				$data["bitacora"] = $this->tran_residuo_model->get_bitacora($data["id_cliente"]);
				
				$this->load->view("administrador/recolector/ver_manifiestos", $data);
			} else {
				redirect("admin/recolector/index");
			}
		
		}else{
			$this->session->sess_destroy(); #destruye session
			redirect('home/index');
		}
	
	}

	public function recolector_ver_manifiesto($id_cliente, $folio){
		$data["url_back"] = $this->session->userdata('url_back'); // URL hacia atrás 
 
		if ($this->session->userdata('tipo') == 1){

			$tran_resiudos 				= $this->tran_residuo_model->get_reg_tran_residuos($id_cliente, $folio);
			$data["cliente"] 			= $this->persona_model->get_datos_empresa($id_cliente);
			$manifiesto 				= $this->tran_residuo_model->get_manifiesto($id_cliente, $folio);
			$data["empresa_destino"] 	= $manifiesto->nombre_destino;
			$data["fecha_embarque"] 	= $manifiesto->fecha_embarque;
			$data["responsable_destino"]= $manifiesto->responsable_destino;
			$data["bitacora_manifiesto"]= $this->tran_residuo_model->get_bitacora_manifiesto($id_cliente, $folio);
			$data["responsable_tecnico"]= $this->tran_residuo_model->get_manifiesto($id_cliente, $folio)->responsable_tecnico;
			$data["recolector"]			= $this->persona_model->get_datos_empresa($this->session->userdata('id'));
			$data["vehiculos"] 			= $this->tran_vehiculo_model->get_vehiculos();
			$data["folio_identificador"]= $this->persona_model->get_datos_empresa($id_cliente)->identificador_folio . '-' . $folio; 

			$data["ruta"]				= $tran_resiudos->ruta;
			$data["observaciones"]		= $tran_resiudos->observaciones;
			$data["id_cliente"]			= $id_cliente;
			$data["folio"]				= $folio;

			$this->load->view("administrador/recolector/ver_manifiesto", $data);
		} else {
			$this->session->sess_destroy(); #destruye session
			redirect('home/index');
		}

	}

	public function recolector_crear_manifiesto($id_cliente) {
		if ($this->session->userdata('tipo') == 1){

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

				redirect("admin/recolector_crear_manifiestos" . "/" .  $id_cliente . "/" . $data["id_folio"]);

			} else {

				$data["id_cliente"] 		= $id_cliente;
				$data["empresa_destino"] 	= $this->emp_destino_model->get_tipo_emp_destino();
				$data["residuos"] 			= $this->residuo_peligroso_model->get_tipo_residuos();

				$this->load->view("administrador/recolector/crear_manifiesto", $data);
			}
		} else {
			$this->session->sess_destroy(); #destruye session
			redirect('home/index');
		}	
	
	}

	public function recolector_crear_manifiestos($id_cliente, $folio) {
		if ($this->session->userdata('tipo') == 1){

			$data["empresa_destino"] 	= $this->emp_destino_model->get_tipo_emp_destino();
			$data["residuos"] 			= $this->residuo_peligroso_model->get_tipo_residuos();
			$data["recolector"]			= $this->persona_model->get_datos_empresa($this->session->userdata('id'));
			$data["vehiculos"] 			= $this->tran_vehiculo_model->get_vehiculos();
			$data["cliente"] 			= $this->persona_model->get_datos_empresa($id_cliente);
			$data["id_cliente"] 		= $id_cliente;

			$folio_temp = $this->tran_residuo_model->get_bitacora_count($id_cliente) - 1;
			$data["folio_identificador"]= $this->persona_model->get_datos_empresa($id_cliente)->identificador_folio . '-' . $folio_temp;
			$data["folio"]				= $folio;
			$data["id_folio"]			= $folio; // Se necesita para inserción

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

				$this->load->view("administrador/recolector/crear_manifiestos", $data);
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
				$data["url"]				= $this->session->userdata('url');	

				$this->load->view("administrador/recolector/crear_manifiestos", $data);
			}

		} else {
			$this->session->sess_destroy(); #destruye session
			redirect('home/index');
		}	
	
	}

	public function recolector_terminar_manifiesto($id_cliente, $folio) {
		if ($this->session->userdata('tipo') == 1){
			$data["recolector"]	= $this->persona_model->get_datos_empresa($this->session->userdata('id'));
			$data["vehiculos"] 	= $this->tran_vehiculo_model->get_vehiculos();
			$data["cliente"] 	= $this->persona_model->get_datos_empresa($id_cliente);
			$folio_temp = $this->tran_residuo_model->get_bitacora_count($id_cliente) - 1;
			$data["folio_identificador"]= $this->persona_model->get_datos_empresa($id_cliente)->identificador_folio . '-' . $folio_temp;

			if ($this->input->post()) {

				$fecha_embarque 			= date_create_from_format("d/m/Y", $this->input->post("terminar_fecha"));
				$data["id_emp_destino"]		= $this->input->post("terminar_empresa_destino");
				$data["fecha_embarque"]		= date_format($fecha_embarque, "Y-m-d");
				$data["responsable_destino"]= $this->input->post("terminar_responsable");
				$data["responsable_tecnico"]= $this->input->post("terminar_responsable_tecnico");
				$data["persona_residuos"] 	= $this->input->post("terminar_persona_residuos");
				$data["cargo_persona"]		= $this->input->post("terminar_cargo_persona");

				$this->tran_residuo_model->terminar_manifiesto($id_cliente, $folio, $data);

				$data["id_cliente"] = $id_cliente;
				$data["bitacora"] = $this->tran_residuo_model->get_bitacora($id_cliente);
				
				$this->load->view("administrador/recolector/ver_manifiestos", $data);
			}

		} else { 
			$this->session->sess_destroy(); #destruye session
			redirect('home/index');
		}	
	
	}

	public function recolector_eliminar_tran_residuo($id_cliente, $folio) {
		if ($this->session->userdata('tipo') == 1){
			
			$this->tran_residuo_model->delete_tran_residuos($folio);

			$tran_resiudos 				= $this->tran_residuo_model->get_reg_tran_residuos($id_cliente, $folio);
			$data["cliente"] 			= $this->persona_model->get_datos_empresa($id_cliente);
			$data["recolector"]			= $this->persona_model->get_datos_empresa($this->session->userdata('id'));
			$data["fecha_embarque"]		= $tran_resiudos->fecha_embarque;
			$data["responsable_tecnico"]= $tran_resiudos->responsable_tecnico;
			$data["id_cliente"] 		= $id_cliente;
			$data["empresa_destino"] 	= $this->emp_destino_model->get_tipo_emp_destino();
			$data["residuos"] 			= $this->residuo_peligroso_model->get_tipo_residuos();
			$data["bitacora_manifiesto"]= $this->tran_residuo_model->get_bitacora_manifiesto($id_cliente, $folio);
			$data["ruta"]				= $tran_resiudos->ruta;
			$data["observaciones"]		= $tran_resiudos->observaciones;
			$data["folio"]				= $folio;
			$data["vehiculos"] 	= $this->tran_vehiculo_model->get_vehiculos();
			
			$this->load->view("administrador/recolector/crear_manifiestos", $data);
		} else {
			$this->session->sess_destroy(); #destruye session
			redirect('home/index');
		}	
	
	}

	public function recolector_generar_manifiesto($id_cliente, $folio) {
		$this->setLayout('recolector');
		$recolector 					= $this->tran_residuo_model->get_vehiculo($folio)->id_persona;
		$vehiculo 						= $this->tran_residuo_model->get_vehiculo($folio)->id_vehiculo;

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
		$data["datos_recolector"] 		= $this->persona_model->get_nombre_cliente($recolector);
		$data["vehiculos"] 				= $this->tran_vehiculo_model->get_vehiculos();
		$data["id_vehiculo"] 			= $this->persona_model->get_recolector_vehicle($recolector);

		$data["recolector_vehiculo"]	= $this->tran_vehiculo_model->get_folio_vehiculo($vehiculo); // en recolectores (usuario tipo 2) cp_empresa es el id del vehiculo
		$tran_resiudos 					= $this->tran_residuo_model->get_reg_tran_residuos($id_cliente, $folio);
		$data["ruta"]					= $tran_resiudos->ruta;
		$data["nombre_empresas"] 		= $this->persona_model->get_datos_empresas();

/*		echo "<pre>";
		print_r($data);
		echo "</pre>";*/

		$this->load->view("administrador/recolector/generar_manifiesto", $data);

	}

	public function identificador_duplicado(){ /// AJAX FUNCTION
		$this->setLayout('empty');
		if ($this->session->userdata('tipo') == 1){
			if ($this->input->post()) {
				$data['identificador_folio'] = $this->input->post('identificador_folio');

				$query = $this->persona_model->folio_duplicado_cliente($data);
				
				echo json_encode($query);
			}
		}
	}

	public function recolector_bitacora() {
		if ($this->session->userdata('tipo') == 1){
			$data["url_back"] = $this->session->set_userdata('url_back', 'recolector_bitacora'); // URL Hacía atras

			if ($this->input->post()){
				$fecha = date_create_from_format('d/m/Y', $this->input->post("fecha_embarque"));
				@$data["fecha"] = date_format($fecha, 'Y/m/d');
				$data["fecha_embarque"] = $this->input->post("fecha_embarque");
				$data["tipo"] = $this->input->post("tipo");

				$data["bitacora"] = $this->tran_residuo_model->recolector_bitacora_custom($data);
				
				$this->load->view("administrador/recolector/bitacora", $data);
			} else {

				$data["bitacora"] = $this->tran_residuo_model->recolector_bitacora();

				$this->load->view("administrador/recolector/bitacora", $data);
			}
		
		}else{
			$this->session->sess_destroy(); #destruye session
			redirect('home/index');
		}
	
	}

}

?>