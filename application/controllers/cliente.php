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
			$areas = $this->residuo_peligroso_model->get_areas();
			$tipo_emp_transportista = $this->residuo_peligroso_model->get_tipo_emp_transportista();
			$tipo_emp_destino = $this->residuo_peligroso_model->get_tipo_emp_destino();
			$tipo_modalidad = $this->residuo_peligroso_model->get_tipo_modalidad();
			$data = array('carpetas'=> $carpetas,
						   'archivo'=>$archivos,
						   'numnoti'=>$total,
						   'id'=>$id,
						   'tipo_bitacora' => $tipo_bitacora,
						   'residuos' => $residuos,
						   'areas' => $areas,
						   'tipo_emp_transportista' => $tipo_emp_transportista,
						   'tipo_emp_destino' => $tipo_emp_destino,
						   'tipo_modalidad' => $tipo_modalidad
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

	public function cambia_status_notificacion(){
		if($this->input->post()) {
			#realizo mi consulta para cambiar el estatus de notificacion
			$status = $this->input->post('id_status_notificacion'); 
			$id = $this->input->post('recibe');
			$this->notificacion_model->cambia_status_notificacion($status,$id);
		}
	}

	public function guarda_bitacora_residuos()
	{
		if($this->input->post()){
			$id 				= $this->session->userdata('id');
			$residuo_post 		= $this->input->post('residuo');
			$clave 				= $residuo_post;
			$cantidad 			= $this->input->post('cantidad');
			$unidad 			= "Kg";
			$caracteristica 	= $this->input->post('caracteristica');
			$area_generacion 	= $this->input->post('area_generacion');
			$fecha_ingreso 		= date("Y-m-d", strtotime($this->input->post('fecha_ingreso')));
			$fecha_salida 		= date("Y-m-d", strtotime($this->input->post('fecha_salida')));
			$sig_manejo 		= $this->input->post('sig_manejo');
			$emp_tran 			= $this->input->post('emp_tran');
			$dest_final 		= $this->input->post('dest_final');
			$resp_tec 			= $this->input->post('resp_tec');
			$tipo_bitacora 		= $this->input->post('tipo_bitacora');
			$fecha_insercion 	= date("Y-m-d H:i:s");
			

			//Insertamos el registro en la base de datos
			$this->residuo_peligroso_model->inserta_residuo($residuo,
															$clave,
															$cantidad,
															$unidad,
															$caracteristica,
															$area_generacion,
															$fecha_ingreso,
															$fecha_salida,
															$sig_manejo,
															$emp_tran,
															$dest_final,
															$resp_tec,
															$tipo_bitacora,
															$fecha_insercion);
			
			// Obtenemos el id del registro recien creado
			$folio_prueba = $this->residuo_peligroso_model->get_id($residuo,
												   $clave,
												   $cantidad,
												   $unidad,
												   $caracteristica,
												   $area_generacion,
												   $fecha_ingreso,
												   $fecha_salida,
												   $sig_manejo,
												   $emp_tran,
												   $dest_final,
												   $resp_tec,
												   $tipo_bitacora,
												   $fecha_insercion);
			$folio = $folio_prueba->id_residuo_peligroso;

			//Insertamos en la tabla bitacora
			$this->bitacora_model->inserta_bitacora($id,$tipo_bitacora,$folio);
			redirect('cliente/ver_bitacora');
		}
	}

	public function update_bit(){
		if($this->input->post()){
			$id_bitacora = $this->input->post('id_residuo_peligroso');
			$id = $this->session->userdata('id');
			$status=0;
			$total=$this->notificacion_model->obtiene_noticliente($id,$status);
			$bitacora = $this->residuo_peligroso_model->get_bitacora($id_bitacora);
			$peligrosidad = $bitacora->caracteristica;
			$peligrosidad2 = explode(" ", $peligrosidad);
			$data = array(
						   'numnoti'=>$total,
						   'id'=>$id,
						   'bitacora' => $bitacora,
						   'peligrosidad' => $peligrosidad2
						 );

			$this->load->view('usuario/header_usuario',$data);
			$this->load->view('usuario/bitacora_residuos_update',$data);
			$datos_popover = $this->notificacion_model->get_new_noti($status,$id);
			// Obtenemos las bitacoras que hay
			$bitacoras = $this->bitacora_model->get_bitacoras();
			$data2 = array(
							'new_noti' =>$datos_popover,
							'bitacoras' =>$bitacoras
						  );
			$this->load->view('usuario/footer_usuario',$data2);
		}else{
			redirect('cliente/ver_bitacora');
		}	
			
	}


	public function guardar_registro_nueva()
	{
		if($this->input->post()){
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

			$data["tipo_bitacora"] = 1;
			$this->residuo_peligroso_model->inserta_residuo($data);
			
			$folio = $this->residuo_peligroso_model->get_id();		
			$this->bitacora_model->inserta_bitacora($id_persona,$tipo_bitacora,$folio);
			redirect('cliente/ver_bitacora');
			#die($caracteristicas_residuos);
		}
		else
		{
			redirect('cliente/ver_bitacora');
		}
	}

	public function update_bitacora_cliente(){
		if($this->input->post()){
			$id_residuo_peligroso = $this->input->post('id_residuo_peligroso');
			$residuo = $this->input->post('residuo');
			$otro_residuo = $this->input->post('otro_residuo');
			$cantidad = $this->input->post('cantidad');
			$unidad = $this->input->post('unidad');
			$caracteristica = $this->input->post('caracteristica');
			$area_generacion = $this->input->post('area_generacion');
			$otro_area = $this->input->post('otro_area');
			$fecha_ingreso = $this->input->post('fecha_ingreso');
			$fecha_salida = $this->input->post('fecha_salida');
			$emp_tran = $this->input->post('emp_tran');
			$otro_emp = $this->input->post('otro_emp');
			$no_auto = $this->input->post('no_auto');
			$folio_manifiesto = $this->input->post('folio');
			$dest_final = $this->input->post('dest_final');
			$otro_dest = $this->input->post('otro_dest');
			$no_auto_dest = $this->input->post('no_auto_dest');
			$sig_manejo = $this->input->post('sig_manejo');
			$otro_modalidad = $this->input->post('otro_modalidad');
			$resp_tec = $this->input->post('resp_tec');

			$nombre_residuo = "";
			$clave_residuo = "";
			if ($residuo == "Otro") {
				$nombre_residuo = $otro_residuo;
				$clave_residuo = $clave;
			} 
			if($residuo == "O1") {
				$nombre_residuo = "Aceite dieléctricos gastados";
				$clave_residuo = $residuo;
			} 
			if($residuo == "O2") {
				$nombre_residuo = "Aceites hidráulicos gastados";
				$clave_residuo = $residuo;
			} 
			if($residuo == "RPM/01") {
				$nombre_residuo = "Aceites lubricantes usados";
				$clave_residuo = $residuo;
			} 
			if($residuo == "RPM/04") {
				$nombre_residuo = "Acumuladores de vehículos automotrices conteniendo plomo";
				$clave_residuo = $residuo;				
			} 
			if($residuo == "RPM/07") {
				$nombre_residuo = "Aditamentos que contengan mercurio, cadmio plomo";
				$clave_residuo = $residuo;
			} 
			if($residuo == "RPM/05") {
				$nombre_residuo = "Baterías eléctricas a base de mercurio o de níquel-cadmio";
				$clave_residuo = $residuo;
			} 
			if($residuo == "O-1") {
				$nombre_residuo = "Combustóleo contaminado";
				$clave_residuo = "O";
			} 
			if($residuo == "O-2") {
				$nombre_residuo = "Diesel contaminado";
				$clave_residuo = "O";
			} 
			if($residuo == "RPM/02") {
				$nombre_residuo = "Disolventes orgánicos usados";
				$clave_residuo = $residuo;
			} 
			if($residuo == "RPM/08") {
				$nombre_residuo = "Fármacos";
				$clave_residuo = $residuo;
			} 
			if($residuo == "RPM/06") {
				$nombre_residuo = "Lámparas fluorescentes y de vapor de mercurio";
				$clave_residuo = $residuo;
			} 
			if($residuo == "L6") {
				$nombre_residuo = "Lodos aceitosos";
				$clave_residuo = $residuo;
			} 
			if($residuo == "RPM/09") {
				$nombre_residuo = "Plaguicidas y sus envases que contengan remanentes de los mismos";
				$clave_residuo = $residuo;
			} 
			if($residuo == "SO5") {
				$nombre_residuo = "Sólidos con metales pesados";
				$clave_residuo = $residuo;
			} 
			if($residuo == "SO2") {
				$nombre_residuo = "Sólidos de mantenimiento automotriz";
				$clave_residuo = $residuo;
			} 
			if($residuo == "SO4-1") {
				$nombre_residuo = "Sólidos impregnados con pintura";
				$clave_residuo = "SO4";
			} 
			if($residuo == "SO4-2") {
				$nombre_residuo = "Sólidos impregnados con sustancias químicas";
				$clave_residuo = "SO4";
			} 
			if($residuo == "S1") {
				$nombre_residuo = "Solventes orgánicos";
				$clave_residuo = $residuo;
			} 
			if($residuo == "C1") {
				$nombre_residuo = "Sustancias corrosivas  ácidos";
				$clave_residuo = $residuo;
			} 
			if($residuo == "C2") {
				$nombre_residuo = "Sustancias corrosivas  álcalis";
				$clave_residuo = $residuo;
			} 
			if($residuo == "SO1") {
				$nombre_residuo = "Telas o pieles impregnadas de residuos peligrosos";
				$clave_residuo = $residuo;
			}

			$nombre_empresa = "";
			$no_autorizacion_trans = "";
			if($emp_tran == "Otro")	{
				$nombre_empresa = $otro_emp;
				$no_autorizacion_trans = $no_auto;
			} elseif($emp_tran == "06-10-PS-I-01-2011") {
				$nombre_empresa = "Ricardo Díaz Virgen";
				$no_autorizacion_trans = $emp_tran;
			} elseif($emp_tran == "014-002-682-95") {
				$nombre_empresa = "Alicia Huerta Rodríguez";
				$no_autorizacion_trans = $emp_tran;
			} elseif($emp_tran == "21-015-PS-I-02-07") {
				$nombre_empresa = "Ecoltec S.A. de C.V.";
				$no_autorizacion_trans = $emp_tran;
			} elseif($emp_tran == "09-I-20-11") {
				$nombre_empresa = "EK Ambiental S.A. de C.V.";
				$no_autorizacion_trans = $emp_tran;
			}

			$destino_final = "";
			$no_autorizacion_dest = "";
			if($dest_final == "Otro")	{
				$destino_final = $otro_dest;
				$no_autorizacion_dest = $no_auto_dest;
			}else if($dest_final == "06-09-ll-01-2011"){
				$destino_final = "Ecoltec S.A. de C.V. (acopio)";
				$no_autorizacion_dest = $dest_final;
			}else if($dest_final == "6-IV-34-09"){
				$destino_final = "Ecoltec S.A. de C.V. (destino final)";
				$no_autorizacion_dest = $dest_final;
			}elseif($dest_final == "14-030B-PS-ll-43-07") {
				$destino_final = "Francisco Serrano Lomeli";
				$no_autorizacion_dest = $dest_final;
			} else if($dest_final == "14-98B-PS-ll-18-03") {
				$destino_final = "Alicia Huerta Rodriguez";
				$no_autorizacion_dest = $dest_final;
			} else if($dest_final == "14-II-06-11") {
				$destino_final = "EK Ambiental S.A. de C.V.";
				$no_autorizacion_dest = $dest_final;
			} else if($dest_final == "11-V-86-09") {
				$destino_final = "Sistema de Tratamiento Ambiental S.A. de C.V.";
				$no_autorizacion_dest = $dest_final;
			} else if($dest_final == "19-IV-78-11") {
				$destino_final = "Enertec Exports S. de R.L. de C.V.";
				$no_autorizacion_dest = $dest_final;
			}

			if($sig_manejo == "Otro") {
				$sig_manejo = $otro_modalidad;
			}

			$caracteristicas_residuos = "";
			foreach ($caracteristica as $row) {
				$caracteristicas_residuos .= $row." ";
			}

			//	Hacer la insercion en la base de datos

			//echo "Residuo: " . $residuo . " clave: " . $clave;
			//die();
			$this->residuo_peligroso_model->actualizar_registro($id_residuo_peligroso,
															$nombre_residuo,
															$clave_residuo,
															$cantidad,
															$unidad,
															$caracteristicas_residuos,
															$area_generacion,
															$fecha_ingreso,
															$fecha_salida,
															$sig_manejo,
															$nombre_empresa,
															$no_autorizacion_trans,
															$folio_manifiesto,
															$destino_final,
															$no_autorizacion_dest,
															$resp_tec,
															$tipo_bitacora,
															$fecha_insercion);
															
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
    	$this->load->view('usuario/exce');
		$ruta='application/views/usuario/exce.xls';
		header('Content-Description: File Transfer');
		header('Content-Type: application/octet-stream');
		header('Content-Disposition: attachment; filename='.basename($ruta));
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
