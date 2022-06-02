<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Usuario extends MY_Controller {

	public function __construct(){
		parent::__construct();
		$this->setLayout('usuario');
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

	#	Metodo index carga la vista principal del cliente
	public function index(){
		if ($this->session->userdata('tipo')==3) {
			$id = $this->session->userdata('id');
			$ruta = "clientes/".$id;
			$ruta_carpeta = $ruta;
			$anterior=$this->carpeta_model->obtieneunacarpeta($ruta_carpeta);
			$raiz="clientes/";
			$total=$this->notificacion_model->obtiene_noticliente($id,$status=0);
			$carpetas=$this->carpeta_model->obt_carpeta_personal($ruta);
			$archivos=$this->archivo_model->obtienearchivos($ruta_carpeta);
			$datos=$this->persona_model->obtiene_cliente($id);
			$data = array(
				'carpetas'=> $carpetas,
				'archivo'=> $archivos,
				'numnoti'=> $total,
				'anterior'=> $anterior,
				'raiz'=> $raiz,
				'id'=> $id,
				'datos'=> $datos
			);

			$this->load->view('usuario/carpeta_usuario',$data); // aqui es donde se carga el numero de notificaciones
			$datos_popover = $this->notificacion_model->get_new_noti($status=0,$id);
			
			// Obtenemos las bitacoras que hay
			$data2 = array(
				'new_noti' =>$datos_popover,
			);
		} else {
			$this->session->sess_destroy(); #destruye session
			redirect('home/sesion');
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

			$this->load->view('usuario/carpeta_compartida',$data); // aqui es donde se carga el numero de notificaciones
			$datos_popover = $this->notificacion_model->get_new_noti($status,$id);

		
			$data2 = array(
				'new_noti' =>$datos_popover,
			);
		}else{
			$this->session->sess_destroy(); #destruye session
			redirect('home/sesion');
		}
	}


	# Metodo para validar el correo valido de un usuario
	public function valida_usuario_correo(){
		$this->setLayout('empty');
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

	public function descargar(){
		$name=$this->input->post('nombre');
		$ruta=$this->input->post('ruta_archivo');
		header('Content-Description: File Transfer');
		header('Content-Type: application/octet-stream');
		header('Content-Disposition: attachment; filename='.basename($ruta));
		header('Content-Transfer-Encoding: binary');
		header('Expires: 0');
		header('Cache-Control: must-revalidate');
		header('Pragma: public');
		header('Content-Length:' . filesize($ruta));
		ob_clean();
		flush();
		readfile($ruta);
		exit;	
	}

	#	Metodo para restablecer contraseña de cliente y mandar correo de conformacion
	public function rest_contra(){
		$this->setLayout('empty');
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
		
			$para 	= $correo . ", " . "diaz281@yahoo.com.mx, rigediaz@hotmail.com";
			$asunto = "RDíaz - Cambio de contraseña";

			$this->email->from('admin@rdiaz.mx', 'Admin RDíaz');
			$this->email->to($para); 
			$this->email->cc(''); 
			$this->email->bcc('');

			$image = "http://rdiaz.mx/img/logo_mini.png"; // image path

			$mensaje = "
			<html>
				<head> </head>
				<body>
					<br>
					Has echo una peticion para recuperar contraseña de acceso al sistema. <br>
					Se te ha generado una contraseña de acceso. <br>

					Datos de acceso <br>
					---------------------------------------------- <br>
					Usuario: {$correo} <br>
					Contraseña: {$psw_nva}	<br>
					
					<br> <br>
					<img href='http://rdiaz.mx/' src='{$image}' alt='Logo' />
				</body>
			</html>
			";

			$this->email->subject($asunto);
			$this->email->message($mensaje);
			$this->email->set_mailtype('html');

			$this->email->send();
			//-------------------------------------------------------------


			if($this->email->send()){
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

			$this->load->view('usuario/act_password');
			$datos_popover = $this->notificacion_model->get_new_noti($status,$id);
			// Obtenemos las bitacoras que hay
			$bitacoras = $this->residuo_peligroso_model->get_bitacora($id);
			$data2 = array(
							'new_noti' =>$datos_popover,
							'bitacoras' =>$bitacoras
						  );
	}

	public function update_password(){
		$this->setLayout('empty');
		
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
														 $this->input->post('numero_registro_ambiental'),
														 $this->input->post('id_persona'),
														 $this->input->post('municipio'),
														 $this->input->post('estado'),
														 $this->input->post('telefono_empresa'),
														 $completo);
				$password=$this->input->post('password');
				$correo=$this->session->userdata('correo');
				$status=1;
				$login=$this->persona_model->login($correo,$password,$status);


				#------------  ENVIO DE CORREO DE CONFIRMACION  -------------------------

				$para 	= $correo . ", " . "diaz281@yahoo.com.mx, rigediaz@hotmail.com";
				$asunto = "RDíaz - Alta completada";

				$this->email->from('admin@rdiaz.mx', 'Admin RDíaz');
				$this->email->to($para); 
				$this->email->cc(''); 
				$this->email->bcc('');

				$image = "http://rdiaz.mx/img/logo_mini.png"; // image path

				$mensaje = "
				<html>
					<head> </head>
					<body>
						<br>
						La alta de cliente ha quedado registrada. <br>

						Usuario: {$correo} <br>
						Contraseña: {$psw_nva}	<br>
						<br>

						Favor de utilizar el siguiente link para iniciar sesión: http://rdiaz.mx

						<br> <br>
						<img href='http://rdiaz.mx/' src='{$image}' alt='Logo' />
					</body>
				</html>
				";

				$this->email->subject($asunto);
				$this->email->message($mensaje);
				$this->email->set_mailtype('html');

				$this->email->send();
				//------------------------------------------------------------
			}
			else{
				$this->session->sess_destroy(); #destruye session
				redirect('home/sesion');
			}
		}else{
			$this->session->sess_destroy(); #destruye session
			redirect('home/sesion');
		}
	}

	
	public function versubcarpeta() {
		if($this->session->userdata('tipo')==3){
			if($this->input->post()){

				$data['id_persona'] = $this->input->post('id_persona');
				$data['direccion'] = $this->input->post('ruta_carpeta'); // Direccion de carpeta
				
				$ruta_split = explode('/', $data['direccion']);
				
				if (count($ruta_split) < 3){
					redirect('usuario');
				}
	
				$ruta = explode("/", $data['direccion']);
				$data['direccion_real'] ="";
				foreach ($ruta as $r) {
					$data['direccion_real']  .= $r . "/";
				}
				$data['anterior'] = $this->carpeta_model->obtieneunacarpeta($data['direccion']);
				$data['raiz'] ='clientes/';
				$data['carpetas'] = $this->carpeta_model->obtienesubcarpeta($data['direccion']);
				$data['archivo'] = $this->archivo_model->obtienearchivos($data['direccion']);

				$this->load->view('usuario/subcarpeta',$data);
			}else{
				redirect('usuario');
			}
		} else {
			$this->session->sess_destroy();
			redirect('home/sesion');
		}
	}

	public function mis_datos() {
		if($this->session->userdata('tipo')==3){
			$id_persona = $this->session->userdata('id');

			$data['id'] = $id_persona;
			$data['numnoti'] = $this->notificacion_model->obtiene_noticliente($id_persona,$status = 0);
			$data['cliente'] = $this->persona_model->obtiene_cliente($id_persona);
			$data['new_noti'] = $this->notificacion_model->get_new_noti($status,$id_persona);
			$data['bitacoras'] = $this->residuo_peligroso_model->get_bitacora($id_persona);

			$this->load->view('usuario/mis_datos',$data);
		} else {
			$this->session->sess_destroy();
			redirect('home/sesion');
		}
	}

	public function actualizadatos_persona(){
		if($this->session->userdata('tipo')==3){
			if($this->input->post()){

				$data['id_persona'] 				= $this->input->post('id_persona');
				$data['nombre_empresa'] 			= $this->input->post('nombre_empresa');
				$data['numero_registro_ambiental'] 	= $this->input->post('numero_registro_ambiental');
				$data['email_empresa'] 				= $this->input->post('email_empresa');
				$data['telefono_empresa'] 			= $this->input->post('telefono_empresa');
				$data['telefono_personal'] 			= $this->input->post('telefono_contacto');
				$data['telefono_personal_alt']		= $this->input->post('telefono_contacto_alt');
				$data['identificador_folio'] 		= $this->input->post('identificador_folio');
				$data['calle_empresa'] 				= $this->input->post('calle_empresa');
				$data['numero_empresa'] 			= $this->input->post('numero_empresa');
				$data['cp_empresa'] 				= $this->input->post('cp_empresa');
				$data['colonia_empresa'] 			= $this->input->post('colonia_empresa');
				$data['estado'] 					= $this->input->post('estado');
				$data['municipio'] 					= $this->input->post('municipio');
				$data['nombre_contacto'] 			= $this->input->post('nombre_contacto');

				$this->persona_model->actualizadatos_persona($data);

				redirect('usuario/mis_datos');
			}else{
				redirect('usuario/mis_datos');
			}
		} else {
			$this->session->sess_destroy(); #destruye session
			redirect('home/sesion');
		}
	}

	public function ver_bitacora(){
		if ($this->session->userdata('tipo')==3){
			
			$data['id_persona'] = $this->session->userdata('id');

			//PDF
			$pdfpath = $_SERVER['DOCUMENT_ROOT'] . "rgdiaz/img/pdf/rdiaztmp" . $data['id_persona'] . ".pdf";
			#$pdfpath = $_SERVER['DOCUMENT_ROOT'] . "img/pdf/rdiaztmp" . $data['id_persona'] . ".pdf";
			if (file_exists($pdfpath)) {
				unlink($pdfpath);
			}

			$data['nombre_cliente'] = $this->persona_model->get_nombre_cliente($data['id_persona']);
			$data['nombre_empresa'] = $this->persona_model->get_nombre_empresa($data['id_persona']);
			$data['residuos'] = $this->residuo_peligroso_model->get_residuos($data['id_persona']);

			$this->load->view('usuario/bitacora',$data);
		} else {
			$this->session->sess_destroy(); #destruye session
			redirect('home/sesion');
		}
	}

	public function bitacora(){
		
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
			'residuos' 		=> $residuos,
			'areas' 		=> $areas
		);

		$this->load->view('usuario/nuevo_registro',$data);
		$datos_popover = $this->notificacion_model->get_new_noti($status,$id);
		// Obtenemos las bitacoras que hay
		$bitacoras = $this->residuo_peligroso_model->get_bitacora($id);
		$data2 = array(
			'new_noti' =>$datos_popover,
			'bitacoras' =>$bitacoras
		);
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

			$data2 = array(
				'id_persona'	=> $id_persona,
				'residuos' 		=> $residuos,
				'areas' 		=> $areas
			);

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
		} else {
			redirect('usuario/bitacora');
		}
	}

	public function bitacora_actualiza_reg(){

		if ($this->input->post()) {
			if ($this->input->post('residuos_to_update') != NULL ) {

		
				$id_bitacora 			= $this->input->post('id_residuo_peligroso');
				$id_persona				= $this->session->userdata('id');
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
				$siguiente_folio 		= $this->residuo_peligroso_model->get_siguiente_folio($id);
				
				$data = array(
					'carpetas' 				=> $carpetas,
					'archivo' 				=> $archivos,
					'numnoti' 				=> $total,
					'id' 					=> $id,
					'tipo_emp_transportista'=> $tipo_emp_transportista,
					'tipo_emp_destino' 		=> $tipo_emp_destino,
					'tipo_modalidad' 		=> $tipo_modalidad,
					'actualizar_registros' 	=> $actualizar_registros,
					'siguiente_folio'		=> $siguiente_folio
				);

	
				$this->load->view('usuario/actualizar_registros',$data);
				$datos_popover = $this->notificacion_model->get_new_noti($status,$id);
				$bitacoras = $this->residuo_peligroso_model->get_bitacora($id);


				$data2 = array(
					'new_noti' =>$datos_popover,
					'bitacoras' =>$bitacoras
				);

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

	public function count_notifications(){
		$this->setLayout('empty');
		$id = $this->session->userdata('id');
		$datos_popover = $this->notificacion_model->obtiene_noticliente($id, $status=0);

		echo json_encode($datos_popover);
	}

	public function get_notifications(){
		$this->setLayout('empty');
		$id = $this->session->userdata('id');
		$datos_popover = $this->notificacion_model->get_new_noti($status=0,$id);

		echo json_encode($datos_popover);
	}

	public function read_notifications(){
		$this->setLayout('empty');
		$id = $this->session->userdata('id');
		$this->notificacion_model->cambia_status_notificacion($status=1,$id);
		echo json_encode('done');
	}

	public function update_bit($id_persona = null, $id_bit = null){
		if ($this->session->userdata('tipo') == 3) {
		
			if(($this->input->post()) || ($id_bit != null) ){
			
				$id_tipo_persona=3; // para la función de correo en el header
				$id_status_persona=1; // para la función de correo en el footer

				$bitacora 				= $this->residuo_peligroso_model->get_ident_residuo($id_bit);
				
				$id_bitacora 			= $id_bit;
				$id 					= $this->session->userdata('id');
				$status 				= 0;
				$total					= $this->notificacion_model->obtiene_noticliente($id,$status);
				$peligrosidad 			= $bitacora->caracteristica;
				$peligrosidad2 			= explode(" ", $peligrosidad);

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
					'id_persona'=>$id_persona,
					'mensajes' => $mensajesnuevos,
					'peligrosidad' => $peligrosidad2,
					'residuos' => $residuos,
					'areas' => $areas,
					'tipo_emp_transportista' => $tipo_emp_transportista,
					'tipo_emp_destino' => $tipo_emp_destino,
					'tipo_modalidad' => $tipo_modalidad,
					'bitacora' => $bitacora,
					'id_bitacora' => $id_bit
				);


				$this->load->view('usuario/modificar_bitacora',$data);
				$datos_popover = $this->notificacion_model->get_new_noti($status,$id);
				
				// Obtenemos las bitacoras que hay				
				$cliente 			= $this->persona_model->obtiene_clientes($id_tipo_persona, $id_status_persona);
				$correo_clientes 	= $this->persona_model->getCorreos($id_tipo_persona);

				$data2 = array(
						'new_noti' =>$datos_popover,
						'clientes' => $cliente,
						'correo' => $correo_clientes
				);
				
			}else{
				redirect('administrador/bitacora/' . $id_bitacora );
			}	
		} else {
			$this->session->sess_destroy();
			redirect('home');
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

			$this->residuo_peligroso_model->inserta_residuo($data);
			
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
				$id_emp_final = explode(",", $data["dest_final"]);
				$data["dest_final"] = $id_emp_final[0];
			}

			$this->residuo_peligroso_model->actualizar_registros($data);
			
			redirect('cliente/ver_bitacora');
		} else {
			redirect('cliente/ver_bitacora');
		} 
	}

	public function update_bitacora_cliente(){
		$id_persona = $this->input->post('id_persona');

		if ($this->session->userdata('tipo') == 2) {

			if($this->input->post()){
				$data["id_residuo_peligroso"]= $this->input->post('id_bitacora');
				$data["id_persona"] 		= $id_persona;
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

				$data['residuo'] = $this->residuo_peligroso_model->tipo_residuo($data);
				$data['area_generacion'] = $this->area_model->_area($data);
				$data['emp_tran'] = $this->emp_transportista_model->_emp_tran($data);
				$data['dest_final'] = $this->emp_destino_model->_emp_dest($data);
				$data['sig_manejo'] = $this->modalidad_model->_modalidad($data);

				$this->residuo_peligroso_model->actualizar_registro($data);
																
				redirect('usuario/ver_bitacora/' . $id_persona);
			}else{
				redirect('usuario/ver_bitacora/' . $id_persona);
			}
		} else {
			redirect('usuario/ver_bitacora/' . $id_persona);
		}
	}

	public function eliminar_bit($id_persona, $id_residuo_peligroso){
		$this->residuo_peligroso_model->delete_residuo($id_residuo_peligroso);

		redirect('cliente/bitacora/' . $id_persona);
	}

	public function generar_excel()
	{
		if($this->input->post()){
			$this->load->view('usuario/exce');
			$ruta='application/views/usuario/exce.xls';
			$id_persona = $this->input->post('id_persona');
			$nombre_cliente = $this->persona_model->get_nombre_cliente($id_persona);
			$nombre_empresa = $this->persona_model->get_nombre_empresa($id_persona);
			$nombre_empresa = str_replace(" ", "_", $nombre_empresa);
			
			$fecha=date("d-M-Y");
			
			$nombre_excel = $nombre_empresa . "_" . $fecha . ".xls";
			
			header('Content-Description: File Transfer');
			header('Content-Type: application/octet-stream');
			header('Content-Disposition: attachment; filename='. $nombre_excel);
			header('Content-Transfer-Encoding: binary');
			header('Expires: 0');
			header('Cache-Control: must-revalidate');
			header('Pragma: public');
			header('Content-Length: ' . filesize($ruta));
			ob_clean();
			flush();
			readfile($ruta);
			exit;	
		} else{
			redirect('cliente');
		}
	}

	public function manifiesto($id_persona){

		$status = 0;
		$mensajesnuevos = $this->contacto_model->contador_mensajes($status);
		$total			= $this->notificacion_model->obtiene_noticliente($id_persona, $status);
		$data = array(
			'mensajes'=> $mensajesnuevos,
			'numnoti' => $total,
			'id' => $id_persona,

		);

		#	Obtengo a todos mis clientes para seleccionar uno en opcion dar de baja y los mando al modal
		$id_tipo_persona=3;
		$id_status_persona=1;
		// Mandar una variable para selecciar solo a los clientes que ya llenaron su info
		$lleno_datos = 1;
		$cliente_baja=$this->persona_model->obtiene_clientes_baja($id_status_persona,$id_tipo_persona,$lleno_datos);
		$correo_clientes = $this->persona_model->getCorreos($id_tipo_persona);
		$nombre_cliente = $this->persona_model->get_nombre_cliente($id_persona);
		$nombre_empresa = $this->persona_model->get_nombre_empresa($id_persona);
		$email = $this->persona_model->getCorreo($id_persona);
		$datos_popover = $this->notificacion_model->get_new_noti($status, $id_persona);
		$cliente_manifiestos = $this->residuo_peligroso_model->cliente_manifiestos($id_persona);


		$data3 = array(
			'clientes' => $cliente_baja,
			'correo' => $correo_clientes,
			'id_persona' => $id_persona,
			'nombre_cliente' => $nombre_cliente,
			'nombre_empresa' => $nombre_empresa,
			'email' => $email,
			'cliente_manifiestos' => $cliente_manifiestos,
			'new_noti' =>$datos_popover,
		);
		
		$this->load->view("usuario/manifiesto.php", $data3);



	}

	public function generar_manifiesto($id_persona) {

		if ($this->input->post()) {

			$data["id_persona"] = $id_persona;
			$data["manifiesto"] = $this->input->post('manifiesto');
			$data["nombre_cliente"] = $this->persona_model->get_nombre_cliente($id_persona);
			$data["nombre_empresa"] = $this->persona_model->get_nombre_empresa($id_persona);
			$data["residuos_manifiesto"] = $this->residuo_peligroso_model->get_residuos_manifiesto($id_persona, $data["manifiesto"]);
			$data["datos_empresa"] = $this->persona_model->get_datos_empresa($id_persona);

			$this->load->view("usuario/generar_manifiesto.php", $data);
		}

	}

	public function terminar_sesion() {
		$this->session->sess_destroy(); #destruye session
		redirect('home/sesion');		
	}

	public function crizal(){
		$this->setLayout('admin_test');
		$this->load->view("usuario/crizal_forms.php");
	}
}
