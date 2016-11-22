<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Cliente extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('persona_model');
		$this->load->model('contacto_model');
		$this->load->model('carpeta_model');
		$this->load->model('archivo_model');
		$this->load->model('notificacion_model');
		$this->load->model('residuo_peligroso_model');
		$this->load->model('bitacora_model');
		$this->load->model('area_model');
		$this->load->model('emp_transportista_model');
		$this->load->model('emp_destino_model');
		$this->load->model('modalidad_model');
		$this->load->helper('download');
		$this->load->library('Excel');
		$this->load->library('session');
		$this->load->library('email');
	}

	#	Metodo index carga la vista principal del cliente
	public function index(){

		if($this->session->userdata('tipo')==3){
			$id = $this->session->userdata('id');
			$ruta = "clientes/".$id;
			$ruta_carpeta = $ruta;
			$status=0;
			$anterior=$this->carpeta_model->obtieneunacarpeta($ruta_carpeta);
			$raiz="clientes/";
			$total=$this->notificacion_model->obtiene_noticliente($id,$status);
			$carpetas=$this->carpeta_model->obt_carpeta_personal($ruta);
			$archivos=$this->archivo_model->obtienearchivos($ruta_carpeta);
			$datos=$this->persona_model->obtiene_cliente($id);
			$data = array('carpetas'=> $carpetas,
						   'archivo'=>$archivos,
						   'numnoti'=>$total,
						   'anterior'=>$anterior,
						   'raiz'=>$raiz,
						   'id'=>$id,
						   'datos'=>$datos
							);
			$this->load->view('usuario/header_usuario',$data);
			$this->load->view('usuario/carpeta_usuario',$data); // aqui es donde se carga el numero de notificaciones
			$datos_popover = $this->notificacion_model->get_new_noti($status,$id);
			// Obtenemos las bitacoras que hay
			$bitacoras = $this->bitacora_model->get_bitacoras();
			$data2 = array(
							'new_noti' =>$datos_popover,
							'bitacoras' =>$bitacoras
						  );
			$this->load->view('usuario/footer_usuario',$data2);// aqui se carga el modal de notficaciones
		}else{
			$this->session->sess_destroy(); #destruye session
			redirect('home/index');
		}
	}

	public function carpeta_compartida(){

		if($this->session->userdata('tipo')==3){
			$id = $this->session->userdata('id');
			$ruta = "administrador/1/Documentos de RDiaz";
			$ruta_carpeta = $ruta;
			$status=0;
			$total=$this->notificacion_model->obtiene_noticliente($id,$status);
			$carpetas=$this->carpeta_model->obt_carpeta_personal($ruta);
			$archivos=$this->archivo_model->obtienearchivos($ruta_carpeta);
			$datos=$this->persona_model->obtiene_cliente($id);
			$data = array( 
							'carpetas'=> $carpetas,
							'archivo'=>$archivos,
							'numnoti'=>$total,
							'id'=>$id,
							'datos'=>$datos
						);
			$this->load->view('usuario/header_usuario',$data);
			$this->load->view('usuario/carpeta_compartida',$data); // aqui es donde se carga el numero de notificaciones
			$datos_popover = $this->notificacion_model->get_new_noti($status,$id);
			// Obtenemos las bitacoras que hay
			$bitacoras = $this->bitacora_model->get_bitacoras();
			$data2 = array(
							'new_noti' =>$datos_popover,
							'bitacoras' =>$bitacoras
						  );
			$this->load->view('usuario/footer_usuario',$data2);// aqui se carga el modal de notficaciones
		}else{
			$this->session->sess_destroy(); #destruye session
			redirect('home/index');
		}
	}


	#	Metodo para validar el correo valido de un usuario
	public function valida_usuario_correo(){
		if($this->input->post()){
			$recupera = $this->persona_model->recupera_corr($this->input->post('correo'));
			if(is_object($recupera)){
				$acceso = true;
				echo json_encode($acceso);
			}else{
				$acceso = false;
				echo json_encode($acceso);
			}
		}
	}

	#	Metodo para restablecer contraseña de cliente y mandar correo de conformacion
	public function rest_contra(){
		if($this->input->post()){
			$correo = $this->input->post('correo');

			#-------------  CREACION DE CONTRASEÑA TEMPORAL  ------------------------
			$str = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";
			$psw_nva = ""; #password nueva
			for($i=0;$i<8;$i++) {
				$psw_nva .= substr($str,rand(0,62),1);
			}
			$cambia_psw = $this->persona_model->cambia_psw($psw_nva,$correo);
			#	---------------------------------------------------------------------

			#------------  ENVIO DE CORREO DE CONFIRMACION  -------------------------

			$correo = $this->input->post('correo'); 
			$de = "diaz281@yahoo.com.mx";
			$para = "$correo";
			$asunto = "RDÍAZ Servicios Integrales en Materia Ambiental";
			$mensaje = "Has echo una peticion para recuperar contraseña de acceso al sistema.<br/>\n";
			$mensaje .= "Se te ha generado una contraseña de acceso. \n";
			$mensaje .= "Tus datos de acceso son:<br/>\n";
			$mensaje .= "Cuenta de usuario: $correo <br/> Contraseña: $psw_nva";

			
			$cabeceras = "MIME-Version: 1.0\r\n";
			$cabeceras .= "Content-type: text/html; charset=iso-8859-1\r\n";
			$cabeceras .= "From: $de\r\n";

			if(mail($para,$asunto,$mensaje,$cabeceras)){
				$respuesta = true;
				echo json_encode($respuesta);
			}else{
				$respuesta = false;
				echo json_encode($respuesta);
			}
		}
	}

	public function act_password(){
		$id = $this->session->userdata('id');
		$status=0;
		$total=$this->notificacion_model->obtiene_noticliente($id,$status);
		$data = array(
					'numnoti'=>$total,
					'id'=>$id
					);
			$this->load->view('usuario/header_usuario',$data);
			$this->load->view('usuario/act_password');
			$datos_popover = $this->notificacion_model->get_new_noti($status,$id);
			// Obtenemos las bitacoras que hay
			$bitacoras = $this->bitacora_model->get_bitacoras();
			$data2 = array(
							'new_noti' =>$datos_popover,
							'bitacoras' =>$bitacoras
						  );
			$this->load->view('usuario/footer_usuario',$data2);// aqui se carga el modal de notficaciones
	}

	public function update_password(){
		$id_persona = $this->input->post('id_persona');
		$password = $this->input->post('password');
		// actualizamos en la base de datos
		$update = $this->persona_model->update_password($id_persona,$password);

		if($update){
			$respuesta = true;
			echo json_encode($respuesta);
		}else{
			$respuesta = false;
			echo json_encode($respuesta);
		}
	}

	public function regisdatos_persona()
	{
		if ($this->session->userdata('tipo')==3){
			if ($this->input->post()) {
				$completo = 1;
				$this->persona_model->regisdatos_persona($this->input->post('nombre'),
														 $this->input->post('telefono_personal'),
														 $this->input->post('telefono_personal_alt'),
														 $this->input->post('password'),
														 $this->input->post('nombre_empresa'),
														 $this->input->post('calle_empresa'),
														 $this->input->post('correo_empresa'),
														 $this->input->post('cp_empresa'),
														 $this->input->post('colonia_empresa'),
														 $this->input->post('numero_empresa'),
														 $this->input->post('id_persona'),
														 $this->input->post('municipio'),
														 $this->input->post('estado'),
														 $this->input->post('telefono_empresa'),
														 $completo);
				$password=$this->input->post('password');
				$correo=$this->session->userdata('correo');
				$status=1;
				$login=$this->persona_model->login($correo,$password,$status);
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
								else if($this->session->userdata('status')== 1 && $this->session->userdata('tipo')==2){
									#	Cargar la vista de usuaria
									redirect('administrador/auxiliar');
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

			}
			else{
				redirect('home/index');
			}
		}else{
			$this->session->sess_destroy(); #destruye session
			redirect('home/index');
		}
	}

	
		public function versubcarpeta()
	{
		$status = 0;
		$id = $this->session->userdata('id');
		$total=$this->notificacion_model->obtiene_noticliente($id,$status);
		$id_persona=$this->input->post('id_persona');
		$direccion=$this->input->post('ruta_carpeta');
		$anterior=$this->carpeta_model->obtieneunacarpeta($this->input->post('ruta_carpeta'));
		$raiz="clientes/";
		$subcarpetas=$this->carpeta_model->obtienesubcarpeta($this->input->post('ruta_carpeta'));
		$archivos=$this->archivo_model->obtienearchivos($this->input->post('ruta_carpeta'));
		$id_tipo_persona=3;
		$id_status_persona=1;
		$mensajesnuevos = $this->contacto_model->contador_mensajes($status);
		$cliente=$this->persona_model->obtiene_clientes($id_tipo_persona,$id_status_persona);
				#$todosmensajes = $this->contacto_model->mensajescontacto();
				$data = array(
					'mensajes'=> $mensajesnuevos,
					#'mensajitos' => $todosmensajes,
					'numnoti'=>$total,
					'id'=>$id
				);
				$id_tipo_persona=3;
				$id_status_persona=1;
				$data2 = array( 
					'clientes' => $cliente,
								'carpetas'=> $subcarpetas,
								'direccion'=> $direccion,
								'id_persona'=> $id_persona,
								'archivo'=>$archivos,
								'anterior'=>$anterior,
								'raiz'=>$raiz,
								'id'=>$id

				);
	
			$this->load->view('usuario/header_usuario',$data);
			$this->load->view('usuario/carpeta_usuario',$data2);

			$datos_popover = $this->notificacion_model->get_new_noti($status,$id);
			// Obtenemos las bitacoras que hay
			$bitacoras = $this->bitacora_model->get_bitacoras();
			$data2 = array(
							'new_noti' =>$datos_popover,
							'bitacoras' =>$bitacoras
						  );
		$this->load->view('usuario/footer_usuario',$data2);
	}

		public function mis_datos()
	{
		$id_persona =$this->session->userdata('id');
		$id=$id_persona;
		$status=0;
		$total=$this->notificacion_model->obtiene_noticliente($id,$status);
		$datos=$this->persona_model->obtiene_cliente($id_persona);
		$data = array(
					  'cliente' => $datos,
					  'numnoti'=>$total,
					  'id'=>$id 
					 );
		$this->load->view('usuario/header_usuario',$data);
		$this->load->view('usuario/mis_datos',$data);

		$datos_popover = $this->notificacion_model->get_new_noti($status,$id);
			// Obtenemos las bitacoras que hay
			$bitacoras = $this->bitacora_model->get_bitacoras();
			$data2 = array(
							'new_noti' =>$datos_popover,
							'bitacoras' =>$bitacoras
						  );
		$this->load->view('usuario/footer_usuario',$data2);
	}

	public function actualizadatos_persona(){	
		if($this->input->post()){
		$this->persona_model->actualizadatos_persona($this->input->post('id_persona'),
													 $this->input->post('nombre'),
													 $this->input->post('correo'),
													 $this->input->post('telefono_personal'),
													 $this->input->post('telefono_personal_alt'),
													 $this->input->post('nombre_empresa'),
													 $this->input->post('calle_empresa'),
													 $this->input->post('correo_empresa'),
							 						 $this->input->post('cp_empresa'),
							 						 $this->input->post('colonia_empresa'),
							 						 $this->input->post('numero_empresa'),
							 						 $this->input->post('municipio'),
							 						 $this->input->post('estado'),
							 						 $this->input->post('telefono_empresa'));
		redirect('cliente/mis_datos');
		}else{
			redirect('cliente/mis_datos');
		}
	}

	public function ver_bitacora(){
		$id = $this->session->userdata('id');
		$ruta = "clientes/".$id;
		$ruta_carpeta = $ruta;
		$status=0;
		$total=$this->notificacion_model->obtiene_noticliente($id,$status);
		$carpetas=$this->carpeta_model->obt_carpeta_personal($ruta);
		$archivos=$this->archivo_model->obtienearchivos($ruta_carpeta);
		$data = array('carpetas'=> $carpetas,
					   'archivo'=>$archivos,
					   'numnoti'=>$total,
					   'id'=>$id
					 );
		$this->load->view('usuario/header_usuario',$data);
		#	Obtengo todos los registros de residuos peligrosos
			$residuos_peligrosos = $this->residuo_peligroso_model->get_residuos($id);
			$data3 = array(
				'residuos' => $residuos_peligrosos
			);
		$this->load->view('usuario/bitacora',$data3);
		$datos_popover = $this->notificacion_model->get_new_noti($status,$id);
			// Obtenemos las bitacoras que hay
			$bitacoras = $this->bitacora_model->get_bitacoras();
			$data2 = array(
							'new_noti' =>$datos_popover,
							'bitacoras' =>$bitacoras
						  );
			$this->load->view('usuario/footer_usuario',$data2);
	}

	public function bitacora(){
		$tipo_bitacora = $this->input->post('id_bitacora');
		$id = $this->session->userdata('id');
		$ruta = "clientes/".$id;
		$ruta_carpeta = $ruta;
		$status=0;
		$total=$this->notificacion_model->obtiene_noticliente($id,$status);
		$carpetas=$this->carpeta_model->obt_carpeta_personal($ruta);
		$archivos=$this->archivo_model->obtienearchivos($ruta_carpeta);
		$residuos = $this->residuo_peligroso_model->get_tipo_residuos();
		$areas = $this->area_model->get_areas();
		$tipo_emp_transportista = $this->emp_transportista_model->get_tipo_emp_transportista();
		$tipo_emp_destino = $this->emp_destino_model->get_tipo_emp_destino();
		$tipo_modalidad = $this->modalidad_model->get_tipo_modalidad();
		
		$data = array(
			'carpetas' 		=> $carpetas,
			'archivo' 		=> $archivos,
			'numnoti' 		=> $total,
			'id' 			=> $id,
			'tipo_bitacora' => $tipo_bitacora,
			'residuos' 		=> $residuos,
			'areas' 		=> $areas
		);

		$this->load->view('usuario/header_usuario',$data);
		$this->load->view('usuario/nuevo_registro',$data);
		$datos_popover = $this->notificacion_model->get_new_noti($status,$id);
		// Obtenemos las bitacoras que hay
		$bitacoras = $this->bitacora_model->get_bitacoras();
		$data2 = array(
						'new_noti' =>$datos_popover,
						'bitacoras' =>$bitacoras
					  );
		$this->load->view('usuario/footer_usuario',$data2);
	}

	public function nuevo_registro() {

		if($this->input->post()){
			$id_persona = $this->input->post('id_persona');
			$id_bitacora = $this->input->post('id_bitacora');
			$status = 0;
			$mensajesnuevos = $this->contacto_model->contador_mensajes($status);
			$residuos = $this->residuo_peligroso_model->get_tipo_residuos();
			$areas = $this->area_model->get_areas();
			$tipo_emp_transportista = $this->emp_transportista_model->get_tipo_emp_transportista();
			$tipo_emp_destino = $this->emp_destino_model->get_tipo_emp_destino();
			$tipo_modalidad = $this->modalidad_model->get_tipo_modalidad();
			$total					= $this->notificacion_model->obtiene_noticliente($id_persona,$status);

			$data = array(
				'mensajes'=> $mensajesnuevos,
				'numnoti' => $total,
				'id'  => $id_persona

			);
			$this->load->view('usuario/header_usuario',$data);
			$data2 = array(
				'id_persona'	=> $id_persona,
				'residuos' 		=> $residuos,
				'areas' 		=> $areas);

			#	Obtengo a todos mis clientes para seleccionar uno en opcion dar de baja y los mando al modal
			$id_tipo_persona=3;
			$id_status_persona=1;
				// Mandar una variable para selecciar solo a los clientes que ya llenaron su info
			$lleno_datos = 1;
			$cliente_baja=$this->persona_model->obtiene_clientes_baja($id_status_persona,$id_tipo_persona,$lleno_datos);
			$correo_clientes = $this->persona_model->getCorreos($id_tipo_persona);
			$data3 = array(
				'clientes' => $cliente_baja,
				'correo' => $correo_clientes,
				'id_persona' => $id_persona
			);
			$this->load->view('usuario/nuevo_registro',$data2);
			//$this->load->view('usuario/footer_usuario',$data3);
		}
		else
		{
			redirect('usuario/bitacora');
		}
	}

	public function bitacora_actualiza_reg(){

		if ($this->input->post()) {
			if ($this->input->post('residuos_to_update') != NULL ) {

		
				$id_bitacora 			= $this->input->post('id_residuo_peligroso');
				$id 					= $this->session->userdata('id');
				$status 				= 0;
				$total					= $this->notificacion_model->obtiene_noticliente($id,$status);
				$ruta 					= "clientes/".$id;
				$ruta_carpeta 			= $ruta;
				$carpetas 				= $this->carpeta_model->obt_carpeta_personal($ruta);
				$archivos 				= $this->archivo_model->obtienearchivos($ruta_carpeta);

				$tipo_emp_transportista = $this->emp_transportista_model->get_tipo_emp_transportista();
				$tipo_emp_destino 		= $this->emp_destino_model->get_tipo_emp_destino();
				$tipo_modalidad 		= $this->modalidad_model->get_tipo_modalidad();
				$actualizar_registros	= $this->input->post("residuos_to_update");
				
				$data = array(
					'carpetas' 				=> $carpetas,
					'archivo' 				=> $archivos,
					'numnoti' 				=> $total,
					'id' 					=> $id,
					'tipo_emp_transportista'=> $tipo_emp_transportista,
					'tipo_emp_destino' 		=> $tipo_emp_destino,
					'tipo_modalidad' 		=> $tipo_modalidad,
					'actualizar_registros' 	=> $actualizar_registros
				);

				$this->load->view('usuario/header_usuario',$data);
				$this->load->view('usuario/actualizar_registros',$data);
				$datos_popover = $this->notificacion_model->get_new_noti($status,$id);
				$bitacoras = $this->bitacora_model->get_bitacoras();


				$data2 = array(
					'new_noti' =>$datos_popover,
					'bitacoras' =>$bitacoras
				);
				$this->load->view('usuario/footer_usuario',$data2);
			} else {
				redirect("cliente/ver_bitacora");
			}
		}

	}

	public function cambia_status_notificacion(){
		if($this->input->post()) {
			#realizo mi consulta para cambiar el estatus de notificacion
			$status = $this->input->post('id_status_notificacion'); 
			$id = $this->input->post('recibe');
			$this->notificacion_model->cambia_status_notificacion($status,$id);
		}
	}

	public function update_bit( $id_bit ){
		if( ($this->input->post()) || ($id_bit != null) ) {

			$id_tipo_persona=3; // para la función de correo en el header
			$id_status_persona=1; // para la función de correo en el footer

			$id_bitacora 			= $id_bit;
			$id 					= $this->session->userdata('id');
			$status 				= 0;
			$total					= $this->notificacion_model->obtiene_noticliente($id,$status);
			$bitacora 				= $this->residuo_peligroso_model->get_bitacora($id_bitacora);
			$peligrosidad 			= $bitacora->caracteristica;
			$peligrosidad2 			= explode(" ", $peligrosidad);

			$bitacora 				= $this->residuo_peligroso_model->get_ident_residuo($id_bit);

			$residuos 				= $this->residuo_peligroso_model->get_tipo_residuos();
			$areas 					= $this->area_model->get_areas();
			$tipo_emp_transportista = $this->emp_transportista_model->get_tipo_emp_transportista();
			$tipo_emp_destino 		= $this->emp_destino_model->get_tipo_emp_destino();
			$tipo_modalidad 		= $this->modalidad_model->get_tipo_modalidad();

			$status = 0;
			$mensajesnuevos = $this->contacto_model->contador_mensajes($status);

			$data = array(
				'numnoti'=>$total,
				'id'=>$id,
				'mensajes' => $mensajesnuevos,
				'peligrosidad' => $peligrosidad2,
				'residuos' => $residuos,
				'areas' => $areas,
				'tipo_emp_transportista' => $tipo_emp_transportista,
				'tipo_emp_destino' => $tipo_emp_destino,
				'tipo_modalidad' => $tipo_modalidad,
				'bitacora' => $bitacora
			);

			$this->load->view('usuario/header_usuario',$data);
			$this->load->view('usuario/modificar_bitacora',$data);
			
			$datos_popover = $this->notificacion_model->get_new_noti($status,$id);
			
			// Obtenemos las bitacoras que hay
			$bitacoras = $this->bitacora_model->get_bitacoras();
			
			$cliente 			= $this->persona_model->obtiene_clientes($id_tipo_persona, $id_status_persona);
			$correo_clientes 	= $this->persona_model->getCorreos($id_tipo_persona);

			$data2 = array(
					'new_noti' =>$datos_popover,
					'bitacoras' =>$bitacoras,
					'clientes' => $cliente,
					'correo' => $correo_clientes
			);

			$this->load->view('usuario/footer_usuario',$data2);
		}else{
			redirect('cliente/ver_bitacora');
		}	
			
	}

	public function guardar_registro_nueva() {
		if ( $this->input->post() ) {
			$data["id_persona"] 		= $this->input->post('id_persona');
			$data["residuo"] 			= $this->input->post('residuo');
			$data["otro_residuo"] 		= $this->input->post('otro_residuo');
			$data["clave"] 				= $this->input->post('clave');
			$data["cantidad"] 			= $this->input->post('cantidad');
			$data["unidad"] 			= $this->input->post('unidad');
			$data["caracteristica"] 	= $this->input->post('caracteristica');
			$data["area_generacion"] 	= $this->input->post('area_generacion');
			$data["otro_area"] 			= $this->input->post('otro_area');
			$data["fecha_ingreso"] 		= $this->input->post('fecha_ingreso');
			$data["fecha_insercion"] 	= date("Y-m-d H:i:s");

			//Residuo					
			if ($data["residuo"] != "Otro") {
				$id_residuo = explode(",", $data["residuo"]);
				$data["residuo"] = $id_residuo[0];
			} 
			
			//Caracteristicas
			$data["caracteristicas_residuos"] = "";
			foreach ($data["caracteristica"] as $row) {
				$data["caracteristicas_residuos"] .= $row . " ";
			}
			unset($data["caracteristica"]);

			$data["tipo_bitacora"] = 1;
			$this->residuo_peligroso_model->inserta_residuo($data);
			
			$folio = $this->residuo_peligroso_model->get_id();		
			$this->bitacora_model->inserta_bitacora($data["id_persona"], $data["tipo_bitacora"], $folio);
			redirect('cliente/ver_bitacora');

		} else {
			redirect('cliente/ver_bitacora');
		} 
	}

	public function actualizar_registros() {
		if ( $this->input->post() ) {

			$data["id_persona"] 		= $this->input->post('id_persona');
			$data["fecha_salida"] 		= $this->input->post('fecha_salida');
			$data["emp_tran"] 			= $this->input->post('emp_tran');
			$data["otro_emp"] 			= $this->input->post('otro_emp');
			$data["no_auto"] 			= $this->input->post('no_auto');
			$data["folio_manifiesto"]	= $this->input->post('folio');
			$data["dest_final"] 		= $this->input->post('dest_final');
			$data["otro_dest"] 			= $this->input->post('otro_dest');
			$data["no_auto_dest"] 		= $this->input->post('no_auto_dest');
			$data["sig_manejo"] 		= $this->input->post('sig_manejo');
			$data["otro_modalidad"]		= $this->input->post('otro_modalidad');
			$data["resp_tec"] 			= $this->input->post('resp_tec');
			$data["registros"]			= explode(" ", $this->input->post('registros'));

			// Empresa transportista
			if($data["emp_tran"] != "Otro")	{
				$id_emp_tran = explode(",", $data["emp_tran"]);
				$data["emp_tran"] = $id_emp_tran[0];
			} 

			// Empresa de destino
			if($data["dest_final"] != "Otro")	{
				$id_emp_final = explode(",", $data["emp_tran"]);
				$data["dest_final"] = $id_emp_final[0];
			}

			$this->residuo_peligroso_model->actualizar_registros($data);
			
			redirect('cliente/ver_bitacora');
		} else {
			redirect('cliente/ver_bitacora');
		} 
	}

	public function update_bitacora_cliente(){
		if($this->input->post()){

			$data["id_residuo_peligroso"]= $this->input->post('id_residuo_peligroso');
			$data["id_persona"] 		= $this->input->post('id_persona');
			$data["residuo"] 			= $this->input->post('residuo');
			$data["otro_residuo"] 		= $this->input->post('otro_residuo');
			$data["clave"] 				= $this->input->post('clave');
			$data["cantidad"] 			= $this->input->post('cantidad');
			$data["unidad"] 			= $this->input->post('unidad');
			$data["caracteristica"] 	= $this->input->post('caracteristica');
			$data["area_generacion"] 	= $this->input->post('area_generacion');
			$data["otro_area"] 			= $this->input->post('otro_area');
			$data["fecha_ingreso"] 		= $this->input->post('fecha_ingreso');
			$data["fecha_salida"] 		= $this->input->post('fecha_salida');
			$data["emp_tran"] 			= $this->input->post('emp_tran');
			$data["otro_emp"] 			= $this->input->post('otro_emp');
			$data["no_auto"] 			= $this->input->post('no_auto');
			$data["folio_manifiesto"]	= $this->input->post('folio');
			$data["dest_final"] 		= $this->input->post('dest_final');
			$data["otro_dest"] 			= $this->input->post('otro_dest');
			$data["no_auto_dest"] 		= $this->input->post('no_auto_dest');
			$data["sig_manejo"] 		= $this->input->post('sig_manejo');
			$data["otro_modalidad"]		= $this->input->post('otro_modalidad');
			$data["resp_tec"] 			= $this->input->post('resp_tec');

			//Residuo					
			if ($data["residuo"] != "Otro") {
				$id_residuo = explode(",", $data["residuo"]);
				$data["residuo"] = $id_residuo[0];
			} 
			
			//Caracteristicas
			$data["caracteristicas_residuos"] = "";
			foreach ($data["caracteristica"] as $row) {
				$data["caracteristicas_residuos"] .= $row . " ";
			}
			unset($data["caracteristica"]);
			
			// Empresa transportista
			if($data["emp_tran"] != "Otro")	{
				$id_emp_tran = explode(",", $data["emp_tran"]);
				$data["emp_tran"] = $id_emp_tran[0];
			} 

			// Empresa de destino
			if($data["dest_final"] != "Otro")	{
				$id_emp_final = explode(",", $data["dest_final"]);
				$data["dest_final"] = $id_emp_final[0];
			}

			$this->residuo_peligroso_model->actualizar_registro($data);
															
			redirect('cliente/update_bit');
		}else{
			redirect('cliente/update_bit');
		}
	}

	public function eliminar_bit($id){
		$this->residuo_peligroso_model->delete_residuo($id);

		redirect('cliente/ver_bitacora');
	}

	public function generar_excel()
	{
		if($this->input->post()){
			$id=$this->session->userdata('id');
			$nombre_empresa = $this->persona_model->get_nombre_empresa($id);
			$this->load->view('usuario/exce');
			$ruta='application/views/usuario/exce.xls';
			$fecha=date("d-M-Y");
			header('Content-Description: File Transfer');
			header('Content-Type: application/octet-stream');
			header('Content-Disposition: attachment; filename='.$nombre_empresa."_{$fecha}.xls");
			header('Content-Transfer-Encoding: binary');
			header('Expires: 0');
			header('Cache-Control: must-revalidate');
			header('Pragma: public');
			header('Content-Length: ' . filesize($ruta));
			ob_clean();
			flush();
			readfile($ruta);
			exit;	
		}
	}	
}
