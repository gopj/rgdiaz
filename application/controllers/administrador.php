<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Administrador extends CI_Controller {

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
		$this->load->library('session');
		$this->load->library('email');
		$this->load->library('Excel');
		$this->load->library('MY_Output');
		$this->load->helper('file');
	}
	
	#	Metodo index carga la vista principal del administrador
	public function index(){
			if ($this->session->userdata('tipo')==1){
				$status = 0;
				$mensajesnuevos = $this->contacto_model->contador_mensajes($status);
				#$todosmensajes = $this->contacto_model->mensajescontacto();
				$data = array(
					'mensajes'=> $mensajesnuevos,
					#'mensajitos' => $todosmensajes
				);
				$this->load->view('administrador/header_admin',$data);
				$id_tipo_persona=3;
				$id_status_persona=1;
				$cliente=$this->persona_model->obtiene_clientes($id_status_persona,$id_tipo_persona);
				$ruta='administrador/';
				$carpetas=$this->carpeta_model->obtiene_carpetasraiz_administrador($ruta);
				$data2 = array( 
							    'carpetas'=> $carpetas
				              );
				
				$this->load->view('administrador/carpeta_personal',$data2);
				#	---------------------------------------------------------------

			#	Obtengo a todos mis clientes para seleccionar uno en opcion dar de baja y los mando al modal
				$id_tipo_persona=3;
				$id_status_persona=1;
				// Mandar una variable para selecciar solo a los clientes que ya llenaron su info
				$lleno_datos = 1;
				$cliente_baja=$this->persona_model->obtiene_clientes_baja($id_status_persona,$id_tipo_persona,$lleno_datos);
				$correo_clientes = $this->persona_model->getCorreos($id_tipo_persona);
				#exit(var_dump($correo_clientes));
				$data3 = array(
					'clientes' => $cliente_baja,
					'correo' => $correo_clientes
				);
				$this->load->view('administrador/footeru',$data3);
			#	---------------------------------------------------------------
			}else{
				$this->session->sess_destroy(); #destruye session
				redirect('home/index');
			}
		
	}
//	Metodo que obtiene todos los mensajes de contacto
	public function mensajes_contacto()
	{
	#	Validamos el usuario sea el administrador------------------------------
		if ($this->session->userdata('tipo')==1){
		#	Hacemos una consulta para obtener el numero de mensajes no leidos y 
		#	todos los mensajes y sus datos para la data table------------------
			$status = 0;
			$mensajesnuevos = $this->contacto_model->contador_mensajes($status);
			$todosmensajes = $this->contacto_model->mensajescontacto();
			$data = array(
				'mensajes'=> $mensajesnuevos,
				'mensajitos' => $todosmensajes
			);
			$this->load->view('administrador/header_admin',$data);
			$this->load->view('administrador/mensajes_contacto',$data);
		#-------------------------------------------------------------------------
		#	Obtengo a todos mis clientes para seleccionar uno en opcion dar de baja y los mando al modal
				$id_tipo_persona=3;
				$id_status_persona=1;
				// Mandar una variable para selecciar solo a los clientes que ya llenaron su info
				$lleno_datos = 1;
				$cliente_baja=$this->persona_model->obtiene_clientes_baja($id_status_persona,$id_tipo_persona,$lleno_datos);
				$correo_clientes = $this->persona_model->getCorreos($id_tipo_persona);
				#exit(var_dump($correo_clientes));
				#exit(var_dump($cliente_baja));
				$data3 = array(
					'clientes' => $cliente_baja,
					'correo' => $correo_clientes
				);

			$this->load->view('administrador/footeru',$data3);
		#-------------------------------------------------------------------------
		}else{
			redirect('home');
		}
	}
//	Metodo que Obtiene todos los datos del mensaje seleccionado
	public function mensaje_completo()
	{
	#	Validamos usuario tipo administrador 1
	if ($this->session->userdata('tipo')==1) {
		if($this->input->get()){
		#	Recibimos id_contacto y cambiamos el status como visto------------
			$id_contacto = base64_decode($this->input->get('id_contacto'));
			$status_contacto= 1;# <-- Ponemos el status de contacto como 1
			$this->contacto_model->modifica_status($status_contacto,$id_contacto);
		#	------------------------------------------------------------------
		#	Hacemos una consulta para obtener el numero de mensajes no leidos
		#	Obtenemos todos los datos del mensaje del contacto seleccionado-------
			$status=0;
			$mensajesnuevos = $this->contacto_model->contador_mensajes($status);
			$completos = $this->contacto_model->obtienemensaje($id_contacto); 
			$data = array(
				'mensajes'=> $mensajesnuevos,
				'completo' =>$completos 
			);
		#	----------------------------------------------------------------------
			$this->load->view('administrador/header_admin',$data);
			$this->load->view('administrador/mensaje',$data);
		#	Obtengo a todos mis clientes para seleccionar uno en opcion dar de baja y los mando al modal
				$id_tipo_persona=3;
				$id_status_persona=1;
				// Mandar una variable para selecciar solo a los clientes que ya llenaron su info
				$lleno_datos = 1;
				$cliente_baja=$this->persona_model->obtiene_clientes_baja($id_status_persona,$id_tipo_persona,$lleno_datos);
				$correo_clientes = $this->persona_model->getCorreos($id_tipo_persona);
				#exit(var_dump($cliente_baja));
				$data3 = array(
					'clientes' => $cliente_baja,
					'correo' => $correo_clientes
				);
		#	---------------------------------------------------------------------
			$this->load->view('administrador/footeru',$data3);

		}else{
			redirect('home');
		}

	}else{
		redirect('home');
	}
	}

	public function subir_archivo(){
		if ($this->session->userdata('tipo')==1){
			$status = 0;
			$mensajesnuevos = $this->contacto_model->contador_mensajes($status);
				#$todosmensajes = $this->contacto_model->mensajescontacto();
				$data = array(
					'mensajes'=> $mensajesnuevos,
					#'mensajitos' => $todosmensajes
				);
				$this->load->view('administrador/header_admin',$data);
				$id_tipo_persona=3;
				$id_status_persona=1;
				// Mandar una variable para selecciar solo a los clientes que ya llenaron su info
				$lleno_datos = 1;
				$cliente=$this->persona_model->obtiene_clientes($id_tipo_persona,$id_status_persona,$lleno_datos);
				$ruta='clientes/';
				$carpetas=$this->carpeta_model->obtiene_carpetasraiz($id_status_persona,$lleno_datos,$ruta);
				$data2 = array(
								'carpetas'=> $carpetas,
								'ruta' => $ruta
				);
				$this->load->view('administrador/subir_archivo',$data2);

				#	Obtengo a todos mis clientes para seleccionar uno en opcion dar de baja y los mando al modal
				$id_tipo_persona=3;
				$id_status_persona=1;
				// Mandar una variable para selecciar solo a los clientes que ya llenaron su info
				$lleno_datos = 1;
				$cliente_baja=$this->persona_model->obtiene_clientes_baja($id_status_persona,$id_tipo_persona,$lleno_datos);
				$correo_clientes = $this->persona_model->getCorreos($id_tipo_persona);
				#exit(var_dump($cliente_baja));
				$data3 = array(
					'clientes' => $cliente_baja,
					'correo' => $correo_clientes
				);
				$this->load->view('administrador/footeru',$data3);
			#	---------------------------------------------------------------
		}
	}

	public function alta_cliente()
	{
	# Revisamos si el usuario es administrador---------------
		if ($this->session->userdata('tipo')==1){

			if($this->input->post()){
			#	Asignamos una contraseña al usuario y lo insertamos como cliente -----------	
				$str = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";
				$psw_nva = ""; #password nueva
					for($i=0;$i<8;$i++) {
					$psw_nva .= substr($str,rand(0,62),1);
				}
				$id_tipo_persona=3;
				$id_status_persona=1;
				$lleno_datos = 0;
				$this->persona_model->alta_cliente($this->input->post('correo'),$psw_nva,$id_tipo_persona,$id_status_persona,$lleno_datos);
			#--------------------------------------------------------------------------------
			#	Mandamos mail con datos de acceso al cliente---------------------------------
			$correo = $this->input->post('correo'); 
			$de = "diaz281@yahoo.com.mx";
			$para = "$correo";
			$asunto = "RDÍAZ Servicios Integrales en Materia Ambiental";
			$mensaje = "DATOS DE ACCESO AL SISTEMA<br/>";
			$mensaje .= "Tu Correo es: $correo<br>";
			$mensaje .= "Tu contraseña es: $psw_nva<br/><br/>";
			$mensaje .= "Accede a tu cuenta de usuario en el siguiente enlace: <br/>";
			$mensaje .= "<a href='http://rgdiaz.com.mx/index.php/home/sesion'>rgdiaz.com.mx/index.php/home/sesion</a>";

			
			$cabeceras = "MIME-Version: 1.0\r\n";
			$cabeceras .= "Content-type: text/html; charset=iso-8859-1\r\n";
			$cabeceras .= "From: $de\r\n";

			mail($para,$asunto,$mensaje,$cabeceras);


			//-------------------------------------------------------------
			$datocliente=$this->persona_model->obtenerid($this->input->post('correo'),$psw_nva);
				$nombrecarpeta=$datocliente->id_persona;
				$id_persona=$nombrecarpeta;
				$ruta_anterior='clientes/';
				$ruta_carpeta= 'clientes/'.$nombrecarpeta;
				$id_status_carpeta=1;
				if($ruta_carpeta =='')
					{
						echo "Ingresa un nombre a la carpeta"."<br>";
					}
				else if(!is_dir($ruta_carpeta))
					{
						mkdir($ruta_carpeta, 0755);
						chmod($ruta_carpeta, 0755);
						$this->carpeta_model->registrarcarpeta($nombrecarpeta,$id_persona,$ruta_carpeta,$id_status_carpeta,$ruta_anterior);
					}
				else
					{
						echo "Ya existe una carpeta con ese nombre"."<br>";
					}

				redirect('administrador');

			}
		}else{

			redirect('home');
		}
	}

	public function baja_cliente()
	{
		if ($this->session->userdata('tipo')==1){
			if($this->input->post())
			{	
				#	Se manda el status al cliente 0 o baja logica y se crea variable razon y correo para mandar mail
				$id_status_persona=0;
				$id_persona = $this->input->post('id_persona');
				$get_correo = $this->persona_model->getCorreo($id_persona);
				$correo = $get_correo->correo;
				$razon = $this->input->post('razon');
				$this->persona_model->baja_cliente($id_status_persona,$this->input->post('id_persona'));

				#	--------------- MANDAMOS MAIL DE AVISO DE DADO DE BAJA -----------------------------
				$de = "diaz281@yahoo.com.mx";
				$para = "$correo";
				$asunto = "RDÍAZ Servicios Integrales en Materia Ambiental";
				$mensaje = "Usted ha sido dado de baja.\n";
				$mensaje .= "Para activar su cuenta pongase en contacto con: $de";

				
				$cabeceras = "MIME-Version: 1.0\r\n";
				$cabeceras .= "Content-type: text/html; charset=iso-8859-1\r\n";
				$cabeceras .= "From: $de\r\n";

				mail($para,$asunto,$mensaje,$cabeceras);

				redirect('administrador');
			}
		}else{

			redirect('home/logout');
		}
	}

	public function admin_clientes()
	{
		if ($this->session->userdata('tipo')==1){
			#	Cargamos los mensajes nuevos y los mandamos a la vista --------
				$status = 0;
				$mensajesnuevos = $this->contacto_model->contador_mensajes($status);
				$data = array(
					'mensajes'=> $mensajesnuevos,
				);
				$this->load->view('administrador/header_admin',$data);
			#	---------------------------------------------------------------

			#	Obtengo todos los datos del cliente y los mando a la vista-----
				#$id_status_persona = 0;
				$id_tipo_persona = 3;
				$lleno_datos = 1;	// <-- Mnadamos 1 para que nos cargue solo a los clientes que ya cargaron sus datos
				$tclientes=$this->persona_model->obtienetodoclientes($id_tipo_persona,$lleno_datos);
				$data3 = array(
					'todosclientes' => $tclientes
				);

				$this->load->view('administrador/admin_clientes',$data3);
			#	---------------------------------------------------------------

			#	Obtengo a todos mis clientes para seleccionar uno en opcion dar de baja y los mando al modal
				$id_tipo_persona=3;
				$id_status_persona=1;
				// Mandar una variable para selecciar solo a los clientes que ya llenaron su info
				$lleno_datos = 1;
				$cliente=$this->persona_model->obtiene_clientes_baja($id_status_persona,$id_tipo_persona,$lleno_datos);
				//exit(var_dump($cliente));
				$correo_clientes = $this->persona_model->getCorreos($id_tipo_persona);
				#exit(var_dump($cliente));
				$data2 = array(
					'clientes' => $cliente,
					'correo' => $correo_clientes
				);
				$this->load->view('administrador/footeru',$data2);
			#	---------------------------------------------------------------
		}else{
			redirect('home/logout');
		}
	}

	public function obtiene_cliente()
	{
		$persona= $this->persona_model->obtiene_cliente($this->input->post('id_persona'));
		$ruta_anterior = "clientes/";
		$ruta = $this->carpeta_model->obtiene_ruta($this->input->post('id_persona'),$ruta_anterior);
		$data = array (
						   'id_persona' =>$persona->id_persona,
        				   'nombre' => $persona->nombre,
        				   'correo' => $persona->correo,
        				   'telefono_personal' => $persona->telefono_personal,
        				   'telefono_personal_alt' => $persona->telefono_personal_alt, 
        				   'nombre_empresa' => $persona->nombre_empresa,
        				   'calle_empresa' => $persona->calle_empresa,
        				   'correo_empresa' => $persona->correo_empresa,
        				   'cp_empresa' => $persona->cp_empresa,
        				   'colonia_empresa' => $persona->colonia_empresa,
        				   'numero_empresa' => $persona->numero_empresa,
        				   'id_status_persona' => $persona->id_status_persona,
        				   'municipio' => $persona->municipio,
        				   'estado' => $persona->estado,
        				   'telefono_empresa' => $persona->telefono_empresa,
        				   'password_contacto' =>$persona->password,
        				   'ruta' => $ruta->ruta_carpeta
						);
		echo json_encode($data);
	}

	public function crearsubcarpeta()
	{
		
		$ruta_anterior= $this->input->post('direccion');
		$nombrecarpeta=$this->input->post('nombrecarpeta');
		$id_persona=$this->input->post('id_persona');
		$id_status_carpeta=1;
		$ruta_carpeta= $ruta_anterior.'/'.$nombrecarpeta;
		if($ruta_carpeta =='')
					{
						echo "Ingresa un nombre a la carpeta"."<br>";
					}
				else if(!is_dir($ruta_carpeta))
					{
						mkdir($ruta_carpeta, 0755);
						chmod($ruta_carpeta, 0755);
						$this->carpeta_model->registrarcarpeta($nombrecarpeta,$id_persona,$ruta_carpeta,$id_status_carpeta,$ruta_anterior);	
					}
				else
					{
						echo "Ya existe una carpeta con ese nombre"."<br>";
					}
		$status = 0;
		$ruta_carpeta=$ruta_anterior;
		$direccion = $ruta_anterior;
		$nombre_empresa = $this->persona_model->get_nombre($id_persona);
		$nombre = $nombre_empresa->nombre_empresa;	//Nombre de la empresa
		$ruta = explode("/", $direccion);
		$ruta[1] = $nombre;
		$direccion_real="";
		foreach ($ruta as $r) {
			$direccion_real .= $r."/";
		}
		$raiz='clientes/';
		$anterior=$this->carpeta_model->obtieneunacarpeta($ruta_carpeta);
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
				$data2 = array( 
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
				$this->load->view('administrador/header_admin',$data);
				$this->load->view('administrador/subcarpeta',$data2);
				$this->load->view('administrador/footeru',$data2);

	}

	public function versubcarpeta()
	{
		if($this->input->post()){
		$status = 0;
		$id_persona=$this->input->post('id_persona');
		$direccion=$this->input->post('ruta_carpeta'); // Direccion de carpeta
		$nombre_empresa = $this->persona_model->get_nombre($id_persona);
		$nombre = $nombre_empresa->nombre_empresa;	//Nombre de la empresa
		$ruta = explode("/", $direccion);

		$ruta[1] = $nombre;
		$direccion_real="";
		foreach ($ruta as $r) {
			$direccion_real .= $r."/";
		}
		$anterior=$this->carpeta_model->obtieneunacarpeta($this->input->post('ruta_carpeta'));
		$raiz='clientes/';
		$subcarpetas=$this->carpeta_model->obtienesubcarpeta($this->input->post('ruta_carpeta'));
		$archivos=$this->archivo_model->obtienearchivos($this->input->post('ruta_carpeta'));
		$id_tipo_persona=3;
		$id_status_persona=1;
		$mensajesnuevos = $this->contacto_model->contador_mensajes($status);
		$cliente=$this->persona_model->obtiene_clientes($id_tipo_persona,$id_status_persona);
				#$todosmensajes = $this->contacto_model->mensajescontacto();
				$data = array(
					'mensajes'=> $mensajesnuevos,
					#'mensajitos' => $todosmensajes
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
								'direccion_real' => $direccion_real
								//'direccion' => $dir_carp,
								//'nombre_empresa' => $nombre
				);
				$this->load->view('administrador/header_admin',$data);
				$this->load->view('administrador/subcarpeta',$data2);

				#	Obtengo a todos mis clientes para seleccionar uno en opcion dar de baja y los mando al modal
				$id_tipo_persona=3;
				$id_status_persona=1;
				// Mandar una variable para selecciar solo a los clientes que ya llenaron su info
				$lleno_datos = 1;
				$cliente_baja=$this->persona_model->obtiene_clientes_baja($id_status_persona,$id_tipo_persona,$lleno_datos);
				$correo_clientes = $this->persona_model->getCorreos($id_tipo_persona);
				#exit(var_dump($cliente_baja));
				$data3 = array(
					'clientes' => $cliente_baja,
					'correo' => $correo_clientes
				);
				$this->load->view('administrador/footeru',$data3);
			}else{
				redirect('administrador');
			}
		
	}

	public function subirarchivo()
	{
		if($this->input->post()){
			$ruta_carpeta_pertenece = $this->input->post('direccion');
			$id_persona = $this->input->post('id_persona');
			$envia=$this->session->userdata('id');
			$id_status_notificacion=0;
			#die(var_dump($_FILES['archivo']));
			// $_FILES['nom_del_archivo']['error'] vale 0 es decir UPLOAD_ERR_OK
			// lo que significa que no ha habido ningún error
				foreach($_FILES['archivo']['tmp_name'] as $key => $tmp_name){
					move_uploaded_file($tmp_name,"$ruta_carpeta_pertenece/{$_FILES['archivo']['name'][$key]}");
					$nombre= "{$_FILES['archivo']['name'][$key]}";
					$ruta_archivo = "$ruta_carpeta_pertenece/{$_FILES['archivo']['name'][$key]}";
					$this->archivo_model->registrar_archivo($nombre,$ruta_archivo,$ruta_carpeta_pertenece);
					$this->notificacion_model->registrar_notificacion($ruta_archivo,$id_status_notificacion,$envia,$id_persona);
				}
				$status = 0;
				$ruta_carpeta=$ruta_carpeta_pertenece;
				$direccion = $ruta_carpeta_pertenece;
				$nombre_empresa = $this->persona_model->get_nombre($id_persona);
				$nombre = $nombre_empresa->nombre_empresa;	//Nombre de la empresa
				$ruta = explode("/", $direccion);
				$ruta[1] = $nombre;
				$direccion_real="";
				foreach ($ruta as $r) {
					$direccion_real .= $r."/";
				}
				$raiz='clientes/';
				$anterior=$this->carpeta_model->obtieneunacarpeta($this->input->post('ruta_carpeta'));
				$subcarpetas=$this->carpeta_model->obtienesubcarpeta($ruta_carpeta);
				$archivos=$this->archivo_model->obtienearchivos($ruta_carpeta);
				$id_tipo_persona=3;
				$id_status_persona=1;
				$lleno_datos = 1;
				$mensajesnuevos = $this->contacto_model->contador_mensajes($status);
				//$cliente=$this->persona_model->obtiene_clientes($id_tipo_persona,$id_status_persona);
				$cliente_baja=$this->persona_model->obtiene_clientes_baja($id_status_persona,$id_tipo_persona,$lleno_datos);
				//exit(var_dump($cliente));
				$correo_clientes = $this->persona_model->getCorreos($id_tipo_persona);
				//$cliente=$this->persona_model->obtiene_clientes($id_tipo_persona,$id_status_persona);
				#$todosmensajes = $this->contacto_model->mensajescontacto();
				$data = array(
					'mensajes'=> $mensajesnuevos,
				);
				$id_tipo_persona=3;
				$id_status_persona=1;
				$data2 = array('clientes' => $cliente_baja,'carpetas'=> $subcarpetas,'direccion'=> $direccion,'id_persona'=> $id_persona,'archivo'=>$archivos,'anterior'=>$anterior,'raiz'=>$raiz,'correo' => $correo_clientes,'direccion_real' => $direccion_real);
				$this->load->view('administrador/header_admin',$data);
				$this->load->view('administrador/subcarpeta',$data2);
				$this->load->view('administrador/footeru',$data2);
		}else{
			echo "No hay post";
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
		header('Content-Length: ' . filesize($ruta));
		ob_clean();
		flush();
		readfile($ruta);
		exit;	
	}

	public function eliminar_archivo()
	{
		
		$this->archivo_model->eliminar_archivo($this->input->post('id_archivo'));
		$ruta= $this->input->post('ruta_archivo');
		unlink($ruta);
		$id_persona = $this->input->post('id_persona');
		$ruta_carpeta_pertenece=$this->input->post('ruta_carpeta_pertenece');
		$status = 0;
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
				$data2 = array( 
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
				$this->load->view('administrador/header_admin',$data);
				$this->load->view('administrador/subcarpeta',$data2);
				$this->load->view('administrador/footeru',$data2);
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
				$data2 = array( 
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
				$this->load->view('administrador/header_admin',$data);
				$this->load->view('administrador/subcarpeta',$data2);
				$this->load->view('administrador/footeru',$data2);
		
	}

	public function bitacora($id = null){
		if(($this->input->post()) || ($id != null) ){

			//redirect
			if ($this->input->post()) {
				$id_persona = $this->input->post('id_persona');
			} elseif ($id) {
				$id_persona = $id;
			}
			
			$status = 0;
				$mensajesnuevos = $this->contacto_model->contador_mensajes($status);
				$data = array(
					'mensajes'=> $mensajesnuevos,
				);
			$this->load->view('administrador/header_admin',$data);

			#	Obtengo a todos mis clientes para seleccionar uno en opcion dar de baja y los mando al modal
				$id_tipo_persona=3;
				$id_status_persona=1;
				// Mandar una variable para selecciar solo a los clientes que ya llenaron su info
				$lleno_datos = 1;
				$cliente_baja=$this->persona_model->obtiene_clientes_baja($id_status_persona,$id_tipo_persona,$lleno_datos);
				$correo_clientes = $this->persona_model->getCorreos($id_tipo_persona);
				$nombre_cliente = $this->persona_model->get_nombre_cliente($id_persona);
			#	Obtengo todos los registros de residuos peligrosos
				$residuos_peligrosos = $this->residuo_peligroso_model->get_residuos($id_persona);
				$data3 = array(
					'clientes' => $cliente_baja,
					'correo' => $correo_clientes,
					'residuos' => $residuos_peligrosos,
					'id_persona' => $id_persona,
					'nombre_cliente' => $nombre_cliente
				);
				$this->load->view('administrador/bitacora_residuo',$data3);
				$this->load->view('administrador/footeru',$data3);
			#	---------------------------------------------------------------
		}
		else
		{
			redirect('administrador/admin_clientes');
		}
	}

	public function alta_cliente_admin(){
		$status = 0;
				$mensajesnuevos = $this->contacto_model->contador_mensajes($status);
				#$todosmensajes = $this->contacto_model->mensajescontacto();
				$data = array(
					'mensajes'=> $mensajesnuevos,
					#'mensajitos' => $todosmensajes
				);
		$this->load->view('administrador/header_admin',$data);
		$this->load->view('administrador/alta_cliente_admin');

		#	Obtenemos a todos los clientes activos de RDIAZ-----------------------
			$id_tipo_persona=3;
			$id_status_persona=1;
			// Mandar una variable para selecciar solo a los clientes que ya llenaron su info
			$lleno_datos = 1;
			$cliente_baja=$this->persona_model->obtiene_clientes_baja($id_status_persona,$id_tipo_persona,$lleno_datos);
			//$cliente=$this->persona_model->obtiene_clientes($id_tipo_persona,$id_status_persona,$lleno_datos);
			$correo_clientes = $this->persona_model->getCorreos($id_tipo_persona);
			$data2 = array(
				'clientes' => $cliente_baja,
				'correo' => $correo_clientes
			);

			$this->load->view('administrador/footeru',$data2);
		#-------------------------------------------------------------------------
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
				$id_tipo_persona=3;
				$id_status_persona=1;
				$lleno_datos = 1;
				#	Insertamos en la base de datos 
				$inserta = $this->persona_model->inserta_cliente_admin($this->input->post('nombre'),
															           $this->input->post('correo'),
															           $this->input->post('telefono_personal'),
															           $this->input->post('telefono_personal_alt'),
															           $psw_nva,
															           $this->input->post('nombre_empresa'),
															           $id_status_persona,
															           $id_tipo_persona,
															           $this->input->post('calle_empresa'),
															           $this->input->post('correo_empresa'),
															           $lleno_datos,
																	   $this->input->post('cp_empresa'),
																	   $this->input->post('colonia_empresa'),
																	   $this->input->post('numero_empresa'),
																	   $this->input->post('estado'),
																	   $this->input->post('municipio'),
																	   $this->input->post('telefono_empresa'));
				#	Mandamos Correo con datos de acceso al nuevo cliente
				#	Mandamos mail con datos de acceso al cliente---------------------------------
			$correo = $this->input->post('correo'); 
			$de = "diaz281@yahoo.com.mx";
			$para = "$correo";
			$asunto = "RDÍAZ Servicios Integrales en Materia Ambiental";
			$mensaje = "DATOS DE ACCESO AL SISTEMA<br/>";
			$mensaje .= "Tu Correo es: $correo<br>";
			$mensaje .= "Tu contraseña es: $psw_nva<br/><br/>";
			$mensaje .= "Accede a tu cuenta de usuario en el siguiente enlace: <br/>";
			$mensaje .= "<a href='http://rgdiaz.com.mx/index.php/home/sesion'>rgdiaz.com.mx/index.php/home/sesion</a>";

			
			$cabeceras = "MIME-Version: 1.0\r\n";
			$cabeceras .= "Content-type: text/html; charset=iso-8859-1\r\n";
			$cabeceras .= "From: $de\r\n";

			mail($para,$asunto,$mensaje,$cabeceras);

			//-------------------------------------------------------------
			$datocliente=$this->persona_model->obtenerid($this->input->post('correo'),$psw_nva);
				$nombrecarpeta=$datocliente->id_persona;
				$id_persona=$nombrecarpeta;
				$ruta_anterior='clientes/';
				$ruta_carpeta= 'clientes/'.$nombrecarpeta;
				$id_status_carpeta=1;
				if($ruta_carpeta =='')
					{
						echo "Ingresa un nombre a la carpeta"."<br>";
					}
				else if(!is_dir($ruta_carpeta))
					{
						mkdir($ruta_carpeta, 0755);
						chmod($ruta_carpeta, 0755);
						$this->carpeta_model->registrarcarpeta($nombrecarpeta,$id_persona,$ruta_carpeta,$id_status_carpeta,$ruta_anterior);
					}
				else
					{
						echo "Ya existe una carpeta con ese nombre"."<br>";
					}
				redirect('administrador');
			}
		}
	}

	public function envia_correo_admin(){
		if ($this->input->post()) {
			$id_persona = $this->input->post('id_persona');
			$get_correo = $this->persona_model->getCorreo($id_persona);
			$correo = $get_correo->correo;
			$para = "$correo";
			$de = "diaz281@yahoo.com.mx";
			$asunto = $this->input->post('asunto');
			$mensaje = $this->input->post('mensaje');

			$cabeceras = "MIME-Version: 1.0\r\n";
			$cabeceras .= "Content-type: text/html; charset=iso-8859-1\r\n";
			$cabeceras .= "From: $de\r\n";

			if(mail($para,$asunto,$mensaje,$cabeceras)){
				$bandera = true;
				echo json_encode($bandera);
			}else{
				$bandera = false;
				echo json_encode($bandera);
			}

		}
	}

	public function generar_ecxel()
	{
		if($this->input->post()){
	    	$this->load->view('administrador/exce');
	    	
			$ruta='application/views/administrador/exce.xls';
			$id_persona = $this->input->post('id_persona');
			$nombre_cliente = $this->persona_model->get_nombre_cliente($id_persona);
			$nombre_empresa = $this->persona_model->get_nombre_empresa($id_persona);

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
		} else{
			redirect('administrador');
		}
	}

	public function actualiza_datos_admin(){
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
			
			$id_persona = $this->input->post('id_persona');
			
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
														$telefono_empresa);
			redirect('administrador/admin_clientes');
		}
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
			$data = array(
				'mensajes'=> $mensajesnuevos,
			);
			$this->load->view('administrador/header_admin',$data);
			$data2 = array(
				'id_persona'	=>$id_persona,
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
			$this->load->view('administrador/nuevo_registro',$data2);
			$this->load->view('administrador/footeru',$data3);
		}
		else
		{
			redirect('administrador/bitacora_residuo');
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
			

			redirect('administrador/bitacora/' . $data["id_persona"]);

		} else {
			redirect('administrador/bitacora');
		} 
	}

	public function eliminar_bit($id, $id_persona){
		$this->residuo_peligroso_model->delete_residuo($id);

		redirect('administrador/bitacora/' . $id_persona);
	}

	public function actualizar_registros() {
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
			} 

			// Empresa de destino
			if($data["dest_final"] != "Otro")	{
				$id_emp_final = explode(",", $data["emp_tran"]);
				$data["dest_final"] = $id_emp_final[0];
			}

			$this->residuo_peligroso_model->actualizar_registros($data);
			
			redirect('administrador/bitacora/' . $data["id_persona"] );
		} else {
			redirect('administrador/bitacora/' . $data["id_persona"] );
		} 
	}


	public function bitacora_actualiza_reg(){

		if ($this->input->post()) {
			if ($this->input->post('residuos_to_update') != NULL ) {

				$id_tipo_persona=3; // para la función de correo en el header
				$id_status_persona=1; // para la función de correo en el footer

				$id_bitacora 			= $this->input->post('id_residuo_peligroso');
				$id_persona				= $this->input->post('id_persona');
				$id						= $this->session->userdata('id');
				$status 				= 0;
				$total					= $this->notificacion_model->obtiene_noticliente($id,$status);
				$ruta 					= "clientes/".$id;
				$ruta_carpeta 			= $ruta;
				$carpetas 				= $this->carpeta_model->obt_carpeta_personal($ruta);
				$archivos 				= $this->archivo_model->obtienearchivos($ruta_carpeta);
				$mensajesnuevos 		= $this->contacto_model->contador_mensajes($status);
				$correo_clientes 		= $this->persona_model->getCorreos($id_tipo_persona);

				$tipo_emp_transportista = $this->emp_transportista_model->get_tipo_emp_transportista();
				$tipo_emp_destino 		= $this->emp_destino_model->get_tipo_emp_destino();
				$tipo_modalidad 		= $this->modalidad_model->get_tipo_modalidad();
				$actualizar_registros	= $this->input->post("residuos_to_update");
				
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
					'actualizar_registros' 	=> $actualizar_registros
				);

				$this->load->view('administrador/header_admin',$data);
				$this->load->view('administrador/actualizar_registros',$data);
				$datos_popover = $this->notificacion_model->get_new_noti($status,$id);
				$bitacoras 			= $this->bitacora_model->get_bitacoras();

				$cliente 			= $this->persona_model->obtiene_clientes($id_tipo_persona, $id_status_persona);
				$correo_clientes 	= $this->persona_model->getCorreos($id_tipo_persona);


				$data2 = array(
					'new_noti' =>$datos_popover,
					'bitacoras' =>$bitacoras,
					'clientes' => $cliente,
					'correo' => $correo_clientes
				);

				$this->load->view('administrador/footeru',$data2);
			} else {
				redirect("administrador/ver_bitacora");
			}
		}

	}

	public function update_bit($id_bit = null){
		
		if(($this->input->post()) || ($id_bit != null) ){
		
			$id_tipo_persona=3; // para la función de correo en el header
			$id_status_persona=1; // para la función de correo en el footer

			$residuo_ident 			= $this->residuo_peligroso_model->get_ident_residuo($id_bit);

			print_r($residuo_ident);
			
			$id_bitacora 			= $id_bit;
			$id 					= $this->session->userdata('id');
			$status 				= 0;
			$total					= $this->notificacion_model->obtiene_noticliente($id,$status);
			$bitacora 				= $this->residuo_peligroso_model->get_bitacora($id_bitacora);
			$peligrosidad 			= $bitacora->caracteristica;
			$peligrosidad2 			= explode(" ", $peligrosidad);

			$residuos 				= $this->residuo_peligroso_model->get_tipo_residuos();
			$areas 					= $this->area_model->get_areas();
			$tipo_emp_transportista = $this->emp_transportista_model->get_tipo_emp_transportista();
			$tipo_emp_destino 		= $this->emp_destino_model->get_tipo_emp_destino();
			$tipo_modalidad 		= $this->modalidad_model->get_tipo_modalidad();

			$nombre_residuo 		= $this->residuo_peligroso_model->get_nombre_residuo($id_bitacora);
			$nombre_area 			= $this->area_model->get_nombre_area($id_bitacora);
			$nombre_emp_trans		= $this->emp_transportista_model->get_nombre_trans($id_bitacora);
			$nombre_emp_dest		= $this->emp_destino_model->get_nombre_dest($id_bitacora);
			$nombre_modalidad		= $this->modalidad_model->get_nombre_modalidad($id_bitacora);

			$status = 0;
			$mensajesnuevos = $this->contacto_model->contador_mensajes($status);

			$data = array(
				'numnoti'=>$total,
				'id'=>$id,
				'bitacora' => $bitacora,
				'mensajes' => $mensajesnuevos,
				'peligrosidad' => $peligrosidad2,
				'residuos' => $residuos,
				'areas' => $areas,
				'tipo_emp_transportista' => $tipo_emp_transportista,
				'tipo_emp_destino' => $tipo_emp_destino,
				'tipo_modalidad' => $tipo_modalidad,
				'nombre_residuo' => $nombre_residuo,
				'nombre_area' => $nombre_area,
				'nombre_emp_trans' => $nombre_emp_trans,
				'nombre_emp_dest' => $nombre_emp_dest,
				'nombre_modalidad' => $nombre_modalidad
			);

			$this->load->view('administrador/header_admin',$data);
			$this->load->view('administrador/modificar_bitacora',$data);
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

			$this->load->view('administrador/footeru',$data2);
		}else{
			redirect('administrador/');
		}	
			
	}


	public function renombrar_carpeta(){
		#die('Estamos Trabajando');
		#die(var_dump($this->input->post()));
		if($this->input->post()) {
			$id_persona = $this->input->post('id_persona');
			$nombre_carpeta = $this->input->post('nombre_carpeta');
			$nombre_nuevo = $this->input->post('nombre_nuevo');
			$ruta_carpeta = $this->input->post('ruta_carpeta');
			$ruta_anterior = $this->input->post('ruta_anterior');
			$nombre_nuevo = trim($nombre_nuevo);
			rename($ruta_carpeta, $ruta_anterior."/".$nombre_nuevo);
			$renombrar_carpeta_padre = $this->carpeta_model->update_carpeta($nombre_carpeta, $ruta_carpeta, $nombre_nuevo);
			$carpetas_hijas = $this->carpeta_model->get_carpetas($ruta_carpeta);
			
			foreach ($carpetas_hijas as $reg) {
				$id_carpeta = $reg->id_carpeta;
				$array_ruta_carpeta = explode("/", $reg->ruta_carpeta);
				$ruta_carpeta_nueva = "";
				$cont1 = 0;
				foreach ($array_ruta_carpeta as $row) {
					if ($row == $nombre_carpeta) {
						$array_ruta_carpeta[$cont1] = $nombre_nuevo;
					}
					$ruta_carpeta_nueva .= $array_ruta_carpeta[$cont1]."/";
					$cont1++;
				}
				$array_ruta_anterior = explode("/", $reg->ruta_anterior);
				$ruta_anterior_nueva = "";
				$cont2 = 0;
				foreach ($array_ruta_anterior as $row) {
					if ($row == $nombre_carpeta) {
						$array_ruta_anterior[$cont2] = $nombre_nuevo;
					}
					$ruta_anterior_nueva .= $array_ruta_anterior[$cont2]."/";
					$cont2++;
				}
				$ruta_carpeta_nueva = substr($ruta_carpeta_nueva, 0, -1);
				$ruta_anterior_nueva = substr($ruta_anterior_nueva, 0, -1);
				#echo $id_carpeta."<br>";
				#echo $ruta_carpeta_nueva."<br>";
				#echo $ruta_anterior_nueva."<br>";
				$actualizacion_ruta_carpetas = $this->carpeta_model->update_rutas($id_carpeta,$ruta_carpeta_nueva,$ruta_anterior_nueva);
			}
			$archivos_en_carpetas = $this->archivo_model->get_archivos($ruta_carpeta);
			
			foreach ($archivos_en_carpetas as $reg) {
				$id_archivo = $reg->id_archivo;
				$array_ruta_archivo = explode("/", $reg->ruta_archivo);
				$ruta_archivo_nueva = "";
				$cont1 = 0;
				foreach ($array_ruta_archivo as $row) {
					if ($row == $nombre_carpeta) {
						$array_ruta_archivo[$cont1] = $nombre_nuevo;
					}
					$ruta_archivo_nueva .= $array_ruta_archivo[$cont1]."/";
					$cont1++;
				}
				$array_ruta_carpeta_pertenece = explode("/", $reg->ruta_carpeta_pertenece);
				$ruta_carpeta_pertenece_nueva = "";
				$cont2 = 0;
				foreach ($array_ruta_carpeta_pertenece as $row) {
					if ($row == $nombre_carpeta) {
						$array_ruta_carpeta_pertenece[$cont2] = $nombre_nuevo;
					}
					$ruta_carpeta_pertenece_nueva .= $array_ruta_carpeta_pertenece[$cont2]."/";
					$cont2++;
				}
				$ruta_archivo_nueva = substr($ruta_archivo_nueva, 0, -1);
				$ruta_carpeta_pertenece_nueva = substr($ruta_carpeta_pertenece_nueva, 0, -1);
				#echo $id_archivo."<br>";
				#echo $ruta_archivo_nueva."<br>";
				#echo $ruta_carpeta_pertenece_nueva."<br>";
				$actualizar_ruta_archivos = $this->archivo_model->update_rutas($id_archivo,$ruta_archivo_nueva,$ruta_carpeta_pertenece_nueva);

			}
			#echo print_r($archivos_en_carpetas);
			$status = 0;
			#$id_persona=$this->input->post('id_persona');
			#$direccion=$this->input->post('ruta_carpeta'); // Direccion de carpeta
			$nombre_empresa = $this->persona_model->get_nombre($id_persona);
			$nombre = $nombre_empresa->nombre_empresa;	//Nombre de la empresa
			$ruta = explode("/", $ruta_anterior);

			$ruta[1] = $nombre;
			$direccion_real="";
			foreach ($ruta as $r) {
				$direccion_real .= $r."/";
			}
			$anterior=$this->carpeta_model->obtieneunacarpeta($ruta_anterior);
			$raiz='clientes/';
			$subcarpetas=$this->carpeta_model->obtienesubcarpeta($ruta_anterior);
			$archivos=$this->archivo_model->obtienearchivos($ruta_anterior);
			$id_tipo_persona=3;
			$id_status_persona=1;
			$mensajesnuevos = $this->contacto_model->contador_mensajes($status);
			$cliente=$this->persona_model->obtiene_clientes($id_tipo_persona,$id_status_persona);
					#$todosmensajes = $this->contacto_model->mensajescontacto();
			$data = array(
				'mensajes'=> $mensajesnuevos,
						#'mensajitos' => $todosmensajes
			);
					#$id_tipo_persona=3;
					#$id_status_persona=1;
			$data2 = array( 
				'clientes' => $cliente,
				'carpetas'=> $subcarpetas,
				'direccion'=> $ruta_anterior,
				'id_persona'=> $id_persona,
				'archivo'=>$archivos,
				'anterior'=>$anterior,
				'raiz'=>$raiz,
				'direccion_real' => $direccion_real
								//'direccion' => $dir_carp,
									//'nombre_empresa' => $nombre
			);
			$this->load->view('administrador/header_admin',$data);
			$this->load->view('administrador/subcarpeta',$data2);

					#	Obtengo a todos mis clientes para seleccionar uno en opcion dar de baja y los mando al modal
					#$id_tipo_persona=3;
					#$id_status_persona=1;
					// Mandar una variable para selecciar solo a los clientes que ya llenaron su info
			$lleno_datos = 1;
			$cliente_baja=$this->persona_model->obtiene_clientes_baja($id_status_persona,$id_tipo_persona,$lleno_datos);
			$correo_clientes = $this->persona_model->getCorreos($id_tipo_persona);
					#exit(var_dump($cliente_baja));
			$data3 = array(
				'clientes' => $cliente_baja,
				'correo' => $correo_clientes
			);
			$this->load->view('administrador/footeru',$data3);
		} else {
			redirect('administrador');
		} 
	}

	public function verifica_correo(){
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
}