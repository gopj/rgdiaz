<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Administrador extends MY_Controller {

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
		$this->load->library('MY_QR_PDF');
		$this->load->library('MY_Output');
		$this->load->library('MY_Input');
		$this->load->helper('file');
		$this->load->helper('url');
	}
	
	# Metodo index carga la vista principal del administrador
	public function index(){
		if ($this->session->userdata('tipo') == 1){
			$data['mensajes'] = $this->contacto_model->contador_mensajes($status = 0);			
			$data['carpetas'] = $this->carpeta_model->obtiene_carpetasraiz_administrador($ruta='administrador/');
			$data['clientes'] = $this->persona_model->obtiene_clientes_baja($id_status_persona=1,$id_tipo_persona=3,$lleno_datos=1);
			$data['correo'] = $this->persona_model->getCorreos($id_tipo_persona);
			
			$this->load->view('administrador/carpeta_personal',$data);
		}else{
			$this->session->sess_destroy(); #destruye session
			redirect('home/sesion');
		}
	}

	//	Metodo que obtiene todos los mensajes de contacto
	public function mensajes_contacto() {
		if ($this->session->userdata('tipo')==1){
			$data['mensajes'] = $this->contacto_model->contador_mensajes($status = 0);
			$data['todosmensajes'] = $this->contacto_model->mensajescontacto();
			$data['clientes'] = $this->persona_model->obtiene_clientes_baja($id_status_persona=1,$id_tipo_persona=3,$lleno_datos=1);
			$data['correo'] = $this->persona_model->getCorreos($id_tipo_persona=3);			

			$this->load->view('administrador/mensajes_contacto',$data);
		}else{
			$this->session->sess_destroy();
			redirect('home');
		}
	}

	public function eliminar_mensaje($id) {		
		if ($this->session->userdata('tipo')==1) {
			
			$this->contacto_model->delete_residuo($id);
			redirect('administrador/mensajes_contacto');

		}else{
			redirect('home');
		}
	}

	public function alta_cliente() {
		if ($this->session->userdata('tipo')==1){
			if ($this->input->post()) {
			
				$str = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";
				$psw_nva = "";
					for($i=0;$i<8;$i++) {
					$psw_nva .= substr($str,rand(0,62),1);
				}

				$this->persona_model->alta_cliente($this->input->post('correo'),$psw_nva,$id_tipo_persona=3,$id_status_persona=1,$lleno_datos=1);

				$correo = $this->input->post('correo'); 
			
				$para 	= $correo . ", " . "diaz281@yahoo.com.mx, rigediaz@hotmail.com";
				$asunto = "RDíaz - Favor de completar alta";

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
						Utilizar el siguiente link para completar el registro: <strong> http://rdiaz.mx/index.php/home/sesion </strong> <br>

						Usuario: {$correo} <br>
						Contraseña: {$psw_nva} <br>
						
						<br> <br>
						<img href='http://rdiaz.mx/' src='{$image}' alt='Logo' />
					</body>
				</html>
				";

				$this->email->subject($asunto);
				$this->email->message($mensaje);
				$this->email->set_mailtype('html');

				$this->email->send();

				$datocliente = $this->persona_model->obtenerid($this->input->post('correo'),$psw_nva);
				$nombrecarpeta = $datocliente->id_persona;
				$id_persona = $nombrecarpeta;
				$ruta_anterior ='clientes/';
				$ruta_carpeta = 'clientes/'.$nombrecarpeta;
				$id_status_carpeta=1;
				
				if($ruta_carpeta =='') {
					echo "Ingresa un nombre a la carpeta"."<br>";
				} else if(!is_dir($ruta_carpeta)) {
					mkdir($ruta_carpeta, 0755);
					chmod($ruta_carpeta, 0755);
					$this->carpeta_model->registrarcarpeta($nombrecarpeta,$id_persona,$ruta_carpeta,$id_status_carpeta,$ruta_anterior);
				} else {
					echo "Ya existe una carpeta con ese nombre"."<br>";
				}

				redirect('administrador/index');
			}

		} else {
			redirect('home');
		}
	}

	public function baja_cliente() {
		if ($this->session->userdata('tipo')==1){
			if ($this->input->post()) {	
				$id_persona = $this->input->post('id_persona');
				$get_correo = $this->persona_model->getCorreo($id_persona);
				$correo = $get_correo->correo;
				$razon = $this->input->post('razon');
				$this->persona_model->baja_cliente($id_status_persona=0,$id_persona);

				$para 	= $correo . ", " . "diaz281@yahoo.com.mx, rigediaz@hotmail.com";
				$asunto = "RDíaz - Baja de cliente {$correo} ";

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
						Usted ha sido dado de baja. <br>
						Si desea volver a activar su cuenta pongase en contacto con: diaz281@yahoo.com.mx <br>

						<br> <br>
						<img href='http://rdiaz.mx/' src='{$image}' alt='Logo' />
					</body>
				</html>
				";

				$this->email->subject($asunto);
				$this->email->message($mensaje);
				$this->email->set_mailtype('html');

				$this->email->send();

				redirect('administrador/admin_clientes');
			}
		}else{
			redirect('home/logout');
		}
	}

	public function admin_clientes($id = null) {
		if ($this->session->userdata('tipo')==1){
			$data['id_persona'] = $id;
			$data['mensajes'] = $this->contacto_model->contador_mensajes($status=0);
			$data['todosclientes'] = $this->persona_model->obtienetodoclientes($id_tipo_persona=3,$lleno_datos=1);
			$data['clientes'] = $this->persona_model->obtiene_clientes_baja($id_status_persona=1,$id_tipo_persona=3,$lleno_datos=1);
			$data['correo'] = $this->persona_model->getCorreos($id_tipo_persona=3);

			$this->load->view('administrador/admin_clientes',$data);
		}else{
			redirect('home/logout');
		}
	}

	public function obtiene_cliente() {
		$this->setLayout('empty');
		$persona = $this->persona_model->obtiene_cliente($this->input->post('id_persona'));
		
		$data['id_persona'] = $persona->id_persona;
		$data['nombre'] = $persona->nombre;
		$data['correo'] = $persona->correo;
		$data['telefono_personal'] = $persona->telefono_personal;
		$data['telefono_personal_alt'] = $persona->telefono_personal_alt; 
		$data['nombre_empresa'] = $persona->nombre_empresa;
		$data['calle_empresa'] = $persona->calle_empresa;
		$data['correo_empresa'] = $persona->correo_empresa;
		$data['cp_empresa'] = $persona->cp_empresa;
		$data['colonia_empresa'] = $persona->colonia_empresa;
		$data['numero_empresa'] = $persona->numero_empresa;
		$data['id_status_persona'] = $persona->id_status_persona;
		$data['municipio'] = $persona->municipio;
		$data['estado'] = $persona->estado;
		$data['telefono_empresa'] = $persona->telefono_empresa;
		$data['numero_registro_ambiental'] = $persona->numero_registro_ambiental;
		$data['identificador_folio'] = $persona->identificador_folio;
		$data['password_contacto'] = $persona->password;
		$data['ruta'] = $this->carpeta_model->obtiene_ruta($this->input->post('id_persona'),$ruta_anterior="clientes/")->ruta_carpeta;

		echo json_encode($data);
	}

	public function crearsubcarpeta(){
		$data['mensajes']		= $this->contacto_model->contador_mensajes($status=0);
		$data['clientes'] 		= $this->persona_model->obtiene_clientes_baja($id_status_persona=1,$id_tipo_persona=3,$lleno_datos=1);
		$data['correo'] 		= $this->persona_model->getCorreos($id_tipo_persona);

		$data['nombre'] 		= $this->input->post('nombrecarpeta');
		$data['id_persona'] 	= $this->input->post('id_persona');
		$data['parent_id'] 		= $this->input->post('file_id');
		$data['old_parent_id']	= $this->carpeta_model->get_old_parent($data['parent_id']);
		$data['path']			= $this->carpeta_model->get_path($data);
		
		$data['folder_path']	= $_SERVER['DOCUMENT_ROOT'] . 'rgdiaz/clientes/' . $data['path'] . $data['nombre'];
		#$data['folder_path'] 	= $_SERVER['DOCUMENT_ROOT'] . '/clientes/' . $data['path'];
		
		if ($data['folder_path'] == '') {
			echo "Ingresa un nombre a la carpeta"."<br>";
		} else if (!is_dir($data['folder_path'])) {
			mkdir($data['folder_path'], 0755);
			chmod($data['folder_path'], 0755);
			$this->carpeta_model->create_folder($data);
		} else {
			echo "Ya existe una carpeta con ese nombre"."<br>";
		}

		$data['subfolder'] 		= $this->carpeta_model->get_subfolder($data['parent_id']);

		$this->load->view('administrador/subcarpeta',$data);
	}

	public function versubcarpeta($id = null){
		$data['mensajes']	= $this->contacto_model->contador_mensajes($status=0);
		$data['clientes'] 	= $this->persona_model->obtiene_clientes_baja($id_status_persona=1,$id_tipo_persona=3,$lleno_datos=1);
		$data['correo'] 	= $this->persona_model->getCorreos($id_tipo_persona);
		
		if($this->input->post()){
			$data['id_persona'] = $this->input->post('id_persona_expediente');

			if ($this->input->post('file_id') == -1) {
				redirect('administrador/admin_clientes/' . $data['id_persona']);
			} elseif ($this->input->post('file_id') != 0) {
				$data['parent_id'] 	= $this->input->post('file_id');
			} else {
				$data['folder_data']= $this->carpeta_model->get_folder($data['id_persona']);
				$data['folder'] 	= $data['folder_data']->name;
				$data['parent_id'] 	= $data['folder_data']->file_id;
			}
			$data['old_parent_id']	= $this->carpeta_model->get_old_parent($data['parent_id']);
			$data['path']			= $this->carpeta_model->get_path($data);
			$data['subfolder'] 		= $this->carpeta_model->get_subfolder($data['parent_id']);

			// echo '<pre>';
			// print_r($data);
			// echo '</pre>';

			$this->load->view('administrador/subcarpeta',$data);
		}else{
			redirect('administrador/index');
		}

	}

	public function renombrar_carpeta(){
		if($this->input->post('id_persona')) {
			$data['mensajes']	= $this->contacto_model->contador_mensajes($status=0);
			$data['clientes'] 	= $this->persona_model->obtiene_clientes_baja($id_status_persona=1,$id_tipo_persona=3,$lleno_datos=1);
			$data['correo'] 	= $this->persona_model->getCorreos($id_tipo_persona);
			
			$data['id_persona']	= $this->input->post('id_persona');
			$data['parent_id'] 	= $this->input->post('file_id');

			$data['new_folder']		= $this->input->post('rename_folder_input');
			$data['old_parent_id']	= $this->carpeta_model->get_old_parent($data['parent_id']);
			$data['path']			= $this->carpeta_model->get_path($data);
			
			$data['folder_path']	= $_SERVER['DOCUMENT_ROOT'] . 'rgdiaz/clientes/' . $data['path']; #DEV
			#$data['folder_path'] 	= $_SERVER['DOCUMENT_ROOT'] . 'clientes/' . $data['path']; #PROD
			$data['new_folder_path']= $_SERVER['DOCUMENT_ROOT'] . 'rgdiaz/clientes/' . $data['id_persona'] . '/' . $data['new_folder']; #DEV
			#$data['new_folder_path']= $_SERVER['DOCUMENT_ROOT'] . 'clientes/' . $data['id_persona'] . '/' . $data['new_folder']; #PROD

			
			if ($data['folder_path'] == '') {
				echo "Ingresa un nombre a la carpeta"."<br>";
			} else if (!is_dir($data['new_folder_path'])) {
				rename($data['folder_path'], $data['new_folder_path']);
				$this->carpeta_model->update_folder($data);
			} else {
				echo "Ya existe una carpeta con ese nombre"."<br>";
			}
			
			$data['subfolder'] 		= $this->carpeta_model->get_subfolder($data['old_parent_id']);
			

			$this->load->view('administrador/subcarpeta', $data);
		} else {
			redirect('administrador/index');
		} 
	}


	public function subir_archivo() {
		if ($this->session->userdata('tipo')==1) {

			if($this->input->post()) {
				$data['mensajes']		= $this->contacto_model->contador_mensajes($status=0);
				$data['clientes'] 		= $this->persona_model->obtiene_clientes_baja($id_status_persona=1,$id_tipo_persona=3,$lleno_datos=1);
				$data['correo'] 		= $this->persona_model->getCorreos($id_tipo_persona);
				
				$data['id_persona']		= $this->input->post('id_persona');
				$data['parent_id'] 		= $this->input->post('file_id');
				$data['old_parent_id']	= $this->carpeta_model->get_old_parent($data['parent_id']);
				$data['path']			= $this->carpeta_model->get_path($data);

				$data['subfolder'] 		= $this->carpeta_model->get_subfolder($data['old_parent_id']);
				echo '<pre>';
				print_r($data);
				echo '</pre>';
				die();

				$this->load->view('administrador/subcarpeta',$data);
			}
		} else {
			redirect('home/logout');
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

	public function eliminar_archivo()
	{	
		$this->archivo_model->eliminar_archivo($this->input->post('id_archivo'));
		$ruta = $this->input->post('ruta_archivo');
		unlink(@$ruta);
		$id_persona = $this->input->post('id_persona');
		$ruta_carpeta_pertenece = $this->input->post('ruta_carpeta_pertenece');
		
		$ruta_carpeta=$ruta_carpeta_pertenece;
		$direccion = $ruta_carpeta_pertenece;
		$anterior=$this->carpeta_model->obtieneunacarpeta($ruta_carpeta);
		$nombre_empresa = $this->persona_model->get_nombre($id_persona);
		$nombre = $nombre_empresa->nombre_empresa;	//Nombre de la empresa
		$ruta = explode("/", $direccion);
		$ruta[1] = $nombre;
		$direccion_real="";

		foreach ($ruta as $r) {
			$direccion_real .= $r."/";
		}

		$raiz='clientes/';
		$subcarpetas=$this->carpeta_model->obtienesubcarpeta($ruta_carpeta);
		$archivos=$this->archivo_model->obtienearchivos($ruta_carpeta);
		$id_tipo_persona=3;
		$id_status_persona=1;
		$mensajesnuevos = $this->contacto_model->contador_mensajes($status=0);
		$cliente=$this->persona_model->obtiene_clientes($id_tipo_persona,$id_status_persona);
		$correo_clientes = $this->persona_model->getCorreos($id_tipo_persona);

		#$todosmensajes = $this->contacto_model->mensajescontacto();
		$data = array(
			'mensajes'=> $mensajesnuevos,
			#'mensajitos' => $todosmensajes
		);
		$id_tipo_persona=3;
		$id_status_persona=1;
		$data = array( 
			'clientes' => $cliente,
			'carpetas'=> $subcarpetas,
			'direccion'=> $direccion,
			'id_persona'=> $id_persona,
			'archivo'=>$archivos,
			'anterior'=>$anterior,
			'raiz'=>$raiz,
			'correo' => $correo_clientes,
			'direccion_real' => $direccion_real

		);

		$this->load->view('administrador/subcarpeta',$data);
				
	}

	public function eliminar_carpeta()
	{	
		$ruta=$this->input->post('ruta_carpeta');
		$this->carpeta_model->eliminar_carpeta($this->input->post('id_carpeta'));
		delete_files($ruta, TRUE);
		rmdir($ruta);
		#	borramos archivos de la base de datos
		$this->archivo_model->eliminar_archivos($ruta);
		#	borramos carpetas de la base de datos
		$this->carpeta_model->eliminar_carpetas($ruta);
		$id_persona = $this->input->post('id_persona');
		$ruta_carpeta_pertenece=$this->input->post('ruta_anterior');
		$status = 0;
		$ruta_carpeta=$ruta_carpeta_pertenece;
		$anterior=$this->carpeta_model->obtieneunacarpeta($ruta_carpeta);
		$nombre_empresa = $this->persona_model->get_nombre($id_persona);
		$nombre = $nombre_empresa->nombre_empresa;	//Nombre de la empresa
		$ruta = explode("/", $ruta_carpeta);
		$ruta[1] = $nombre;
		$direccion_real="";
		foreach ($ruta as $r) {
			$direccion_real .= $r."/";
		}
		$raiz='clientes/';
		$direccion = $ruta_carpeta_pertenece;
		$subcarpetas=$this->carpeta_model->obtienesubcarpeta($ruta_carpeta);
		$archivos=$this->archivo_model->obtienearchivos($ruta_carpeta);
		$id_tipo_persona=3;
		$id_status_persona=1;
		$mensajesnuevos = $this->contacto_model->contador_mensajes($status);
		$cliente=$this->persona_model->obtiene_clientes($id_tipo_persona,$id_status_persona);
		$correo_clientes = $this->persona_model->getCorreos($id_tipo_persona);
		#$todosmensajes = $this->contacto_model->mensajescontacto();
		$data = array(
			'mensajes'=> $mensajesnuevos,
			#'mensajitos' => $todosmensajes
		);
		$id_tipo_persona=3;
		$id_status_persona=1;
		$data = array( 
				'clientes' => $cliente,
				'carpetas'=> $subcarpetas,
				'direccion'=> $direccion,
				'id_persona'=> $id_persona,
				'archivo'=>$archivos,
				'anterior'=>$anterior,
				'raiz'=>$raiz,
				'correo' => $correo_clientes,
				'direccion_real' => $direccion_real

		);

		$this->load->view('administrador/subcarpeta',$data);
	}

	public function bitacora($id_persona=null){
		if ($this->session->userdata('tipo')==1){
			
			if ($id_persona) {
				$data['id_persona'] = $id_persona;
			} else {
				$data['id_persona'] = $this->input->post('id_persona');
			}
					
			//PDF
			$pdfpath = $_SERVER['DOCUMENT_ROOT'] . "rgdiaz/img/pdf/rdiaztmp" . $data['id_persona'] . ".pdf";
			#$pdfpath = $_SERVER['DOCUMENT_ROOT'] . "img/pdf/rdiaztmp" . $data['id_persona'] . ".pdf";
			if (file_exists($pdfpath)) {
				unlink($pdfpath);
			}

			$data['mensajes'] = $this->contacto_model->contador_mensajes($status=0);
			$data['clientes'] = $this->persona_model->obtiene_clientes_baja($id_status_persona=1,$id_tipo_persona=3,$lleno_datos=1);
			$data['correo'] = $this->persona_model->getCorreos($id_tipo_persona=3);
			$data['nombre_cliente'] = $this->persona_model->get_nombre_cliente($data['id_persona']);
			$data['nombre_empresa'] = $this->persona_model->get_nombre_empresa($data['id_persona']);
			$data['residuos'] = $this->residuo_peligroso_model->get_residuos($data['id_persona']);

			$this->load->view('administrador/bitacora_residuo',$data);
		} else {
			$this->session->sess_destroy(); #destruye session
			redirect('home/sesion');
		}
	}

	public function alta_cliente_admin(){	
	
		if ($this->input->post()){
			$data['correo'] = $this->input->post('alta_correo_hidd');
		}

		$this->load->view('administrador/alta_cliente_admin', $data);
	}

	public function registra_cliente_admin(){	
		if ($this->session->userdata('tipo')==1){
			if($this->input->post()){
				
				#	Asignamos una contraseña al usuario y lo insertamos como cliente -----------	
				$str = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";
				$psw_nva = ""; #password nueva
					for($i=0;$i<8;$i++) {
					$psw_nva .= substr($str,rand(0,62),1);
				}

				$data['id_tipo_persona'] = 3;
				$data['psw_nva'] = $psw_nva;
				$data['lleno_datos'] = 1;
				$data['id_status_persona'] = 1;
				$data['nombre_empresa'] = $this->input->post('nombre_empresa');
				$data['numero_registro_ambiental'] = $this->input->post('numero_registro_ambiental');
				$data['email_empresa'] = $this->input->post('email_empresa');
				$data['telefono_empresa'] = $this->input->post('telefono_empresa');
				$data['identificador_folio'] = $this->input->post('identificador_folio');
				$data['calle_empresa'] = $this->input->post('calle_empresa');
				$data['numero_empresa'] = $this->input->post('numero_empresa');
				$data['cp_empresa'] = $this->input->post('cp_empresa');
				$data['colonia_empresa'] = $this->input->post('colonia_empresa');
				$data['estado_empresa'] = $this->input->post('estado_empresa');
				$data['municipio_empresa'] = $this->input->post('municipio_empresa');
				$data['nombre_contacto'] = $this->input->post('nombre_contacto');
				$data['email_contacto'] = $this->input->post('email_contacto');
				$data['telefono_contacto'] = $this->input->post('telefono_contacto');
				$data['telefono_contacto_alt'] = $this->input->post('telefono_contacto_alt');			

				$inserta = $this->persona_model->inserta_cliente_admin($data);

				#	Mandamos Correo con datos de acceso al nuevo cliente
				#	Mandamos mail con datos de acceso al cliente---------------------------------

				$correo = $this->input->post('correo'); 
			
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

				//-------------------------------------------------------------

				$datocliente=$this->persona_model->obtenerid($this->input->post('correo'),$psw_nva);
				$nombrecarpeta=$datocliente->id_persona;
				$id_persona=$nombrecarpeta;
				$ruta_anterior='clientes/';
				$ruta_carpeta= 'clientes/'.$nombrecarpeta;
				$id_status_carpeta=1;

				if($ruta_carpeta =='') {
					echo "Ingresa un nombre a la carpeta"."<br>";
				} else if(!is_dir($ruta_carpeta)) {
					mkdir($ruta_carpeta, 0755);
					chmod($ruta_carpeta, 0755);
					$this->carpeta_model->registrarcarpeta($nombrecarpeta,$id_persona,$ruta_carpeta,$id_status_carpeta,$ruta_anterior);
				} else {
					echo "Ya existe una carpeta con ese nombre"."<br>";
				}

				redirect('administrador/index');
			}
		}
	}

	public function envia_correo_admin(){
		$this->setLayout('empty');
		if ($this->session->userdata('tipo')==1){

			if($this->input->post()){
				$id_persona = $this->input->post('id_persona');
				$get_correo = $this->persona_model->getCorreo($id_persona);
				$correo = $get_correo->correo;

				$para 	= $correo . ", " . "diaz281@yahoo.com.mx, rigediaz@hotmail.com";
				$asunto = $this->input->post('asunto');
				$mensaje = $this->input->post('mensaje');

				$this->email->from('admin@rdiaz.mx', 'Admin RDíaz');
				$this->email->to($para); 
				$this->email->cc(''); 
				$this->email->bcc('');

				$image = "http://rdiaz.mx/img/logo_mini.png"; // image path

				$mensaje = "
				<html>
					<head> </head>
					<body>
						" . $mensaje ." <br>
						<br> <br>
						<img href='http://rdiaz.mx/' src='{$image}' alt='Logo' />
					</body>
				</html>
				";

				$this->email->subject($asunto);
				$this->email->message($mensaje);
				$this->email->set_mailtype('html');

				if($this->email->send()){
					$bandera = true;	
				}else{
					$bandera = false;
				}

				echo json_encode($bandera);
			}
		}
	}

	public function contestar_mensaje_contacto($id_contacto){
		if ($this->session->userdata('tipo')==1){

			$mensaje_contacto = $this->contacto_model->obtienemensaje($id_contacto); 

			$correo = $mensaje_contacto->correo;
			$asunto = $mensaje_contacto->asunto;
			$mensaje_contacto = $mensaje_contacto->mensaje_contacto;
			$mensaje = $this->input->post('text_message');

			$para 	= $correo . ", " . "diaz281@yahoo.com.mx, rigediaz@hotmail.com";
			$this->email->from('admin@rdiaz.mx', 'Admin RDíaz');
			$this->email->to($para); 
			$this->email->cc(''); 
			$this->email->bcc('');

			$image = "http://rdiaz.mx/img/logo_mini.png"; // image path

			$mensaje = "
			<html>
				<head> </head>
				<body>
					" . $mensaje ." <br>
					======================================================================= <br>
					<b> De: </b> {$correo} <br>
					<b> Asunto: </b> {$asunto} <br>
					<b> Mensaje: </b> <br> {$mensaje_contacto} <br>

					<br> <br>
					<img href='http://rdiaz.mx/' src='{$image}' alt='Logo' />
				</body>
			</html>
			";

			$this->email->subject($asunto);
			$this->email->message($mensaje);
			$this->email->set_mailtype('html');

			$this->email->send();

			/*echo $this->email->print_debugger();
			die();*/
			redirect('administrador/mensajes_contacto');

		} else {
			$this->session->sess_destroy(); #destruye session
			redirect('home/sesion');
		}
	}

	public function generar_excel() {
		$this->setLayout('empty');	
		if ($this->session->userdata('tipo')==1){
			if($this->input->post()){
				$this->load->view('administrador/exce');
				$ruta='application/views/administrador/exce.xls';
				$id_persona = $this->input->post('id_persona');
				$nombre_cliente = $this->persona_model->get_nombre_cliente($id_persona);
				$nombre_empresa = $this->persona_model->get_nombre_empresa($id_persona);
				$nombre_empresa = str_replace(" ", "_", $nombre_empresa);
				$nombre_empresa = str_replace(",", "", $nombre_empresa);
				
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
			} else {
				redirect('home');
			}
		}
	}

	public function actualiza_datos_admin(){
		$this->setLayout('empty');	
		if ($this->session->userdata('tipo')==1){
			if($this->input->post()){
	
				//insertamos datos en la base de datos
				$nombre = $this->input->post('nombre_contacto');//1
				$correo = $this->input->post('email_contacto');//2
				$telefono_personal = $this->input->post('telefono_contacto');//3
				$telefono_personal_alt = $this->input->post('telefono_contacto_alt');
				$password_contacto = $this->input->post('password_contacto');
				$nombre_empresa = $this->input->post('nombre_empresa');//4
				$status_persona = $this->input->post('estado_cuenta');//5
				if($status_persona == "Activo"){
					$id_status_persona = 1;
				}else{
					$id_status_persona = 0;	
				}
				$calle_empresa = $this->input->post('calle_empresa');//6
				$correo_empresa = $this->input->post('email_empresa');//7
				$cp_empresa = $this->input->post('cp_empresa');//8
				$colonia_empresa =$this->input->post('colonia_empresa');//9
				$numero_empresa = $this->input->post('numero_empresa');//10
				$municipio = $this->input->post('municipio');
				$estado = $this->input->post('estado');
				$telefono_empresa = $this->input->post('telefono_empresa'); 
				$numero_registro_ambiental = $this->input->post('numero_registro_ambiental'); 
				$identificador_folio = $this->input->post('identificador_folio'); 
				
				$id_persona = $this->input->post('id_cliente');
				
				$this->persona_model->actualiza_datos_admin($id_persona,
															$nombre,
															$correo,
															$telefono_personal,
															$telefono_personal_alt,
															$password_contacto,
															$nombre_empresa,
															$id_status_persona,
															$calle_empresa,
															$correo_empresa,
															$cp_empresa,
															$colonia_empresa,
															$numero_empresa,
															$municipio,
															$estado,
															$telefono_empresa,
															$numero_registro_ambiental,
															$identificador_folio);
				redirect('administrador/admin_clientes');
			}
		} else {
			redirect('home');
		}
	}

	public function nuevo_registro() {
		if ($this->session->userdata('tipo')==1){

			if($this->input->post()){
				$data['id_persona'] = $this->input->post('id_persona');
				$data['mensajes'] = $this->contacto_model->contador_mensajes($status=0);
				$data['residuos'] = $this->residuo_peligroso_model->get_tipo_residuos();
				$data['areas'] = $this->area_model->get_areas();	
				$data['clientes'] = $this->persona_model->obtiene_clientes_baja($id_status_persona=1,$id_tipo_persona=3,$lleno_datos=1);
				$data['correo'] = $this->persona_model->getCorreos($id_tipo_persona=3);

				$this->load->view('administrador/nuevo_registro',$data);
				
			} else {
				redirect('administrador/bitacora_residuo', 'refresh');
			}
		} else { 
			redirect('home'); 
		}
	}

	public function guardar_registro_nueva() {

		if ($this->session->userdata('tipo') == 1){
			
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

				redirect('administrador/bitacora/' . $data["id_persona"]);

			} else {
				redirect('administrador/bitacora' .  $data["id_persona"]);
			}

		} else { 
			redirect('home'); 
		}
	}

	public function eliminar_bit($id_persona, $id_residuo_peligroso){
		$this->setLayout('empty');	
		if ($this->session->userdata('tipo')==1) {
			
			$this->residuo_peligroso_model->delete_residuo($id_residuo_peligroso);
			redirect('administrador/bitacora/' . $id_persona);

		} else {
			redirect('home');
		}
		
	}

	public function actualizar_registros() {
		if ($this->session->userdata('tipo')==1) {
			if ( $this->input->post() ) {

				$data["id_persona"] 		= $this->input->post('id_persona'); // refiere al id de administrador
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
					$no_aut_em_tr = $id_emp_tran[1];
				} 

				// Empresa de destino
				if($data["dest_final"] != "Otro")	{
					$id_emp_final = explode(",", $data["dest_final"]);
					$data["dest_final"] = $id_emp_final[0];
					$no_aut_de_fi = $id_emp_final[1];
				}

				//Actualiza los registros al finalizar el manifiesto
				$this->residuo_peligroso_model->actualizar_registros($data);


				//Enviar Mail de notificación [NO BORRAR]
				/*$nombre_empresa_transportista 	= $this->emp_transportista_model->get_datos_emp_trans($data['emp_tran'])[0]->nombre_empresa;
				$nombre_empresa_destino 		= $this->emp_destino_model->get_nombre_dest($data['dest_final']);
				$correo 						= $this->persona_model->get_datos_empresa($this->input->post('id_persona'))->correo_empresa;

				$asunto = "RDíaz - Folio {$data['folio_manifiesto']} Generado";
				$mensaje_contacto = $this->input->post('mensaje_contacto');
				$completo = $data["completo"];

				$para 	= $correo . ", " . "diaz281@yahoo.com.mx, rigediaz@hotmail.com";
	
				$this->email->from('admin@rdiaz.mx', 'Admin RDíaz');
				$this->email->to($para); 
				$this->email->cc(''); 
				$this->email->bcc('');

				$image = "http://rdiaz.mx/img/logo_mini.png"; // image path

				$mensaje = "
				<html>
					<head> </head>
					<body>

						<br> <br>

						<strong> Se ha actuliazido el folio: </strong> {$data['folio_manifiesto']} <br>
						<strong> Empresa transportista: </strong> {$nombre_empresa_transportista} <br>
						<strong> No de autorización: </strong> {$no_aut_em_tr} <br>
						<strong> Empresa destino: </strong> {$nombre_empresa_destino} <br>
						<strong> No de autorización: </strong> {$no_aut_de_fi} <br>

						<br> <br>
						<img href='http://rdiaz.mx/' src='{$image}' alt='Logo' />
					</body>
				</html>
				";

				$this->email->subject($asunto);
				$this->email->message($mensaje);
				$this->email->set_mailtype('html');

				$this->email->send(); */
				
				redirect('administrador/bitacora/' . $data["id_persona"] );
			} else {
				redirect('administrador/bitacora/' . $data["id_persona"] );
			}

		} else {
			redirect('home');
		}
	}

	public function update_bitacora_admin(){
		$this->setLayout('empty');	

		if ($this->session->userdata('tipo')==1) {

			if($this->input->post()){
				$data["id_residuo_peligroso"]= $this->input->post('id_bitacora');
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

				$data['residuo'] = $this->residuo_peligroso_model->tipo_residuo($data);
				$data['area_generacion'] = $this->area_model->_area($data);
				$data['emp_tran'] = $this->emp_transportista_model->_emp_tran($data);
				$data['dest_final'] = $this->emp_destino_model->_emp_dest($data);
				$data['sig_manejo'] = $this->modalidad_model->_modalidad($data);


				$this->residuo_peligroso_model->actualizar_registro($data);
																
				redirect('administrador/bitacora/' . $data["id_persona"] );
			}else{
				redirect('administrador/bitacora/' . $data["id_persona"] );
			}

		} else {
			$this->session->sess_destroy(); #destruye session
			redirect('home');
		}
	}

	public function bitacora_actualiza_reg(){	
		if ($this->session->userdata('tipo')==1) {

			if ($this->input->post()) {
				if ($this->input->post('residuos_to_update') != NULL ) {
					$id_tipo_persona=3; // para la función de correo en el header
					$id_status_persona=1; // para la función de correo en el footer

					$id_bitacora 			= $this->input->post('id_residuo_peligroso');
					$id_persona				= $this->input->post('id_persona');
					$id						= $this->session->userdata('id');
					$status 				= 0;
					$total					= $this->notificacion_model->obtiene_noticliente($id,$status);
					$ruta 					= "administrador/".$id;
					$ruta_carpeta 			= $ruta;
					$carpetas 				= $this->carpeta_model->obt_carpeta_personal($ruta);
					$archivos 				= $this->archivo_model->obtienearchivos($ruta_carpeta);
					$mensajesnuevos 		= $this->contacto_model->contador_mensajes($status);
					$correo_clientes 		= $this->persona_model->getCorreos($id_tipo_persona);

					$tipo_emp_transportista = $this->emp_transportista_model->get_tipo_emp_transportista();
					$tipo_emp_destino 		= $this->emp_destino_model->get_tipo_emp_destino();
					$tipo_modalidad 		= $this->modalidad_model->get_tipo_modalidad();
					$actualizar_registros	= $this->input->post("residuos_to_update");
					$siguiente_folio 		= $this->residuo_peligroso_model->get_siguiente_folio($id_persona);
					
					$data = array(
						'carpetas' 				=> $carpetas,
						'archivo' 				=> $archivos,
						'numnoti' 				=> $total,
						'id' 					=> $id,
						'id_persona' 			=> $id_persona,
						'mensajes' 				=> $mensajesnuevos,
						'correo' 				=> $correo_clientes,
						'tipo_emp_transportista'=> $tipo_emp_transportista,
						'tipo_emp_destino' 		=> $tipo_emp_destino,
						'tipo_modalidad' 		=> $tipo_modalidad,
						'actualizar_registros' 	=> $actualizar_registros,
						'siguiente_folio'		=> $siguiente_folio
					);

	
					$this->load->view('administrador/actualizar_registros',$data);
					$datos_popover = $this->notificacion_model->get_new_noti($status,$id);
				

					$cliente 			= $this->persona_model->obtiene_clientes($id_tipo_persona, $id_status_persona);
					$correo_clientes 	= $this->persona_model->getCorreos($id_tipo_persona);


					$data2 = array(
						'new_noti' =>$datos_popover,
						'clientes' => $cliente,
						'correo' => $correo_clientes
					);

					
				} else {
					redirect('administrador/bitacora/' . $data["id_persona"] );
				}
			}

		} else {
			redirect('home');
		}
	}

	public function update_bit($id_persona = null, $id_bit = null){
		if ($this->session->userdata('tipo')==1) {
		
			if(($this->input->post()) || ($id_bit != null) ){
			
				$id_tipo_persona=3; // para la función de correo en el header
				$id_status_persona=1; // para la función de correo en el footer

				$bitacora 				= $this->residuo_peligroso_model->get_ident_residuo($id_bit);
				
				$id_bitacora 			= $id_bit;
				$id_persona 			= $id_persona;
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

				$this->load->view('administrador/modificar_bitacora',$data);
				$datos_popover = $this->notificacion_model->get_new_noti($status,$id_persona);
				
				// Obtenemos las bitacoras que hay
				
				$cliente 			= $this->persona_model->obtiene_clientes($id_tipo_persona, $id_status_persona);
				$correo_clientes 	= $this->persona_model->getCorreos($id_tipo_persona);

			}else{
				redirect('administrador/bitacora/' . $id_persona );
			}	
		} else {
			
			redirect('home');
		}
	}

	public function verifica_correo(){
		$this->setLayout('empty');
		if ($this->input->post()) {
			$correo = $this->input->post('correo');
			$nombre_empresa = $this->input->post('nombre_empresa');
			// Hacemos consulta a la base de datos para verificar si el cliente ya existe
			$confirma = $this->persona_model->verifica_correo($nombre_empresa,$correo);

			if(is_object($confirma)){
					$respuesta = true;
					echo json_encode($respuesta);
			}else{
				$respuesta = false;
				echo json_encode($respuesta);
			}
		}
	}

	public function update_status_cliente(){
		$this->setLayout('empty');
		if($this->input->post()){
			$id_persona = $this->input->post('id_persona');
			$status = 1;
			$update = $this->persona_model->update_persona($id_persona,$status);
			echo json_encode($update);
		}else{
			$resp = false;
			echo json_encode($resp);
		}
	}

	public function manifiesto($id_persona){	
		$status = 0;
		$mensajesnuevos = $this->contacto_model->contador_mensajes($status);
		$data = array(
			'mensajes'=> $mensajesnuevos
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

		$cliente_manifiestos = $this->residuo_peligroso_model->cliente_manifiestos($id_persona);


		$data = array(
			'clientes' => $cliente_baja,
			'correo' => $correo_clientes,
			'id_persona' => $id_persona,
			'nombre_cliente' => $nombre_cliente,
			'nombre_empresa' => $nombre_empresa,
			'email' => $email,
			'cliente_manifiestos' => $cliente_manifiestos
		);
		
		$this->load->view("administrador/manifiesto", $data);
	}


	public function generar_manifiesto($id_persona) {
		if ($this->input->post()) {

			$data["id_persona"] = $id_persona;
			$data["manifiesto"] = $this->input->post('manifiesto');
			$data["nombre_cliente"] = $this->persona_model->get_nombre_cliente($id_persona);
			$data["nombre_empresa"] = $this->persona_model->get_nombre_empresa($id_persona);
			$data["residuos_manifiesto"] = $this->residuo_peligroso_model->get_residuos_manifiesto($id_persona, $data["manifiesto"]);
			$data["datos_empresa"] = $this->persona_model->get_datos_empresa($id_persona);

			$this->load->view("administrador/generar_manifiesto", $data);
		}

	}

	public function generar_qr_cliente($id_persona) {
		$this->setLayout('empty');

		$data["id_cliente"] = $id_persona;
		
		$this->load->view("administrador/generar_qr", $data);
	}

	public function transportistas_destinos(){
		$status = 0;
		$mensajesnuevos = $this->contacto_model->contador_mensajes($status);

		// Obtengo a todos mis clientes para seleccionar uno en opcion dar de baja y los mando al modal
		$id_tipo_persona=3;
		$id_status_persona=1;

		// Mandar una variable para selecciar solo a los clientes que ya llenaron su info
		$lleno_datos = 1;
		$cliente_baja 		= $this->persona_model->obtiene_clientes_baja($id_status_persona, $id_tipo_persona, $lleno_datos);
		$correo_clientes 	= $this->persona_model->getCorreos($id_tipo_persona);
		$emp_transportista 	= $this->emp_transportista_model->get_tipo_emp_transportista();
		$emp_destino 		= $this->emp_destino_model->get_tipo_emp_destino();

		$data = array(
			'mensajes'=> $mensajesnuevos,
			'clientes' => $cliente_baja,
			'correo' => $correo_clientes,
			'emp_transportista' => $emp_transportista,
			'emp_destino' => $emp_destino,
		);

		$this->load->view("administrador/transportistas_destinos", $data);
	}

	public function obtiene_emp_trans(){
		$this->setLayout('empty');
		$emp_transportista = $this->emp_transportista_model->get_by_id_tipo_emp_transportista($this->input->post('id_tipo_emp_trans'));
		//$emp_transportista = $this->emp_transportista_model->get_by_id_tipo_emp_transportista(1);

		$data = array (
				'nombre_emp_trans' => $emp_transportista->nombre_empresa,
				'no_autorizacion_transportista' => $emp_transportista->no_autorizacion_transportista,
				'no_autorizacion_sct' => $emp_transportista->no_autorizacion_sct,
				'domicilio' => $emp_transportista->domicilio,
				'telefono' => $emp_transportista->telefono,
		);

		echo json_encode($data);
	}

	public function obtiene_emp_dest(){
		$this->setLayout('empty');
		$emp_destino = $this->emp_destino_model->get_by_id_tipo_emp_destino($this->input->post('id_tipo_emp_dest'));
		//$emp_destino = $this->emp_destino_model->get_by_id_tipo_emp_destino(1);

		$data = array (
				'nombre_emp_dest' => $emp_destino->nombre_destino,
				'no_autorizacion_destino' => $emp_destino->no_autorizacion_destino,
				'domicilio' => $emp_destino->domicilio,
				'municipio' => $emp_destino->municipio,
				'estado' => $emp_destino->estado,
		);

		echo json_encode($data);
	}

	public function actualizar_transportistas() {
		$this->setLayout('empty');	
		if ( $this->input->post() ) {

			$data["id_emp_transportista"]	= $this->input->post('id_tipo_emp_transportista');
			$data["nombre_emp_trans"] 		= $this->input->post('nombre_emp_trans');
			$data["no_aut_trans"] 			= $this->input->post('no_aut_trans');
			$data["no_aut_trans_sct"] 		= $this->input->post('no_aut_trans_sct');
			$data["domicilio_emp_trans"] 	= $this->input->post('domicilio_emp_trans');
			$data["tel_emp_trans"] 			= $this->input->post('tel_emp_trans');

			$this->emp_transportista_model->actualiza_emp_transportista($data);

		} 

		redirect('administrador/transportistas_destinos');
	}

	public function actualizar_destinos() {
		$this->setLayout('empty');	
		if ( $this->input->post() ) {

			$data["id_emp_destino"]		= $this->input->post('id_tipo_emp_destino');
			$data["nombre_emp_dest"]	= $this->input->post('nombre_emp_dest');
			$data["no_aut_dest"]		= $this->input->post('no_aut_dest');
			$data["domicilio_emp_dest"]	= $this->input->post('domicilio_emp_dest');
			$data["municipio_emp_dest"]	= $this->input->post('municipio_emp_dest');
			$data["estado_emp_dest"]	= $this->input->post('estado_emp_dest');

			$this->emp_destino_model->actualiza_emp_destino($data);

		} 

		redirect('administrador/transportistas_destinos');
	}

	public function get_message(){
		$this->setLayout('empty');
		
		$email_id = $this->input->post('email_id');			
		$mensaje = $this->contacto_model->obtienemensaje($email_id); 

		$data = array (
			'email_subject' => $mensaje->asunto,
			'email' => $mensaje->correo,
			'email_date' => $mensaje->fecha_mensaje,
			'email_message' => $mensaje->mensaje,
			'email_phone' => $mensaje->telefono,
			'status' => $mensaje->status_contacto
		);

		echo json_encode($data);
	}

	public function get_clientes(){
		$this->setLayout('empty');
		if ($this->session->userdata('tipo') == 1){
			$data['clientes'] = $this->persona_model->obtiene_clientes_baja_ajax($id_status_persona=1,$id_tipo_persona=3,$lleno_datos=1);

			echo json_encode($data['clientes']);
		} else {
			$this->session->sess_destroy(); #destruye session
			redirect('home/sesion');
		}	
	}

	public function get_unread(){
		$this->setLayout('empty');
		if ($this->session->userdata('tipo') == 1){
			$unread = $this->contacto_model->contador_mensajes($status = 0);

			echo json_encode($unread);
		} else {
			$this->session->sess_destroy(); #destruye session
			redirect('home/sesion');
		}	
	}

	public function mark_read($id){
		$this->setLayout('empty');
		if ($this->session->userdata('tipo') == 1){
			$this->contacto_model->modifica_status('1', $id);
			$unread = $this->contacto_model->contador_mensajes($status = 0);

			echo json_encode($unread);
		} else {
			$this->session->sess_destroy(); #destruye session
			redirect('home/sesion');
		}	
	}

	public function mail_test() { 

		$data["mensajes"] = $this->contacto_model->contador_mensajes(0);
		$data["clientes"] = $this->persona_model->obtiene_clientes_baja(3,1,1);
		$data["correo"] = $this->persona_model->getCorreos(3);
		$data["email"] = $this->persona_model->getCorreo(2);
		$data["email"] = $data["email"]->correo;

		$data["email"] = $data["email"] . ", " . "diaz281@yahoo.com.mx, jesus.igp92@gmail.com, gopixc@gmail.com, gopi_xc@hotmail.com";

		$this->load->view("administrador/header_admin", $data);
		$this->load->view("administrador/admin_test", $data);
		$this->load->view("administrador/footeru" ,$data);

		if (isset($_REQUEST['email']))  {

			$this->email->from('admin@rdiaz.mx', 'Admin RDíaz');
			$this->email->to('gopixc@gmail.com'); 
			$this->email->cc(''); 
			$this->email->bcc(''); 

			$this->email->subject($_REQUEST['subject']);
			$this->email->message($_REQUEST['comment']);	

			$this->email->send();

			echo $this->email->print_debugger();
		}
	}

	public function end_session() { 
		$this->session->sess_destroy(); #destruye session
		redirect('home/sesion');
	}

}

?>