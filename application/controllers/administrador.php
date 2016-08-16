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

	public function bitacora(){
		if($this->input->post()){
			$id_persona = $this->input->post('id_persona');
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
			#	Obtengo todos los registros de residuos peligrosos
				$residuos_peligrosos = $this->residuo_peligroso_model->get_residuos($id_persona);
				$data3 = array(
					'clientes' => $cliente_baja,
					'correo' => $correo_clientes,
					'residuos' => $residuos_peligrosos,
					'id_persona' => $id_persona
				);
				$this->load->view('administrador/bitacora_residuo',$data3);
				$this->load->view('administrador/footeru',$data3);
			#	---------------------------------------------------------------
		}
		else
		{
			redirect('administrador/subir_archivo');
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
		else{
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

	public function nuevo_registro()
	{
		if($this->input->post()){
			$id_persona = $this->input->post('id_persona');
			$id_bitacora = $this->input->post('id_bitacora');
			$status = 0;
			$mensajesnuevos = $this->contacto_model->contador_mensajes($status);
			$data = array(
				'mensajes'=> $mensajesnuevos,
			);
			$this->load->view('administrador/header_admin',$data);
			$data2 = array(
				'id_persona'=>$id_persona);

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
			redirect('administrador/bitacora');
		}
	}

	public function modificar_bitacora()
	{
		if($this->input->post()){
			$id_persona = $this->input->post('id_persona');
			$id_bitacora = $this->input->post('id_bitacora');
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
			#	Obtengo todos los registros de residuos peligrosos
			$otro_residuo = "";
			$residuos_peligrosos = $this->residuo_peligroso_model->get_bitacora($id_bitacora);
			if( $residuos_peligrosos->residuo != "Aceite dieléctricos gastados" && 
				$residuos_peligrosos->residuo != "Aceites hidráulicos gastados" && 
				$residuos_peligrosos->residuo != "Aceites lubricantes usados" && 
				$residuos_peligrosos->residuo != "Acumuladores de vehículos automotrices conteniendo plomo " && 
				$residuos_peligrosos->residuo != "Aditamentos que contengan mercurio, cadmio plomo" && 
				$residuos_peligrosos->residuo != "Baterías eléctricas a base de mercurio o de níquel-cadmio" && 
				$residuos_peligrosos->residuo != "Combustóleo contaminado" && 
				$residuos_peligrosos->residuo != "Diesel contaminado" && 
				$residuos_peligrosos->residuo != "Disolventes orgánicos usados" && 
				$residuos_peligrosos->residuo != "Fármacos" && 
				$residuos_peligrosos->residuo != "Lámparas fluorescentes y de vapor de mercurio" && 
				$residuos_peligrosos->residuo != "Lodos aceitosos" && 
				$residuos_peligrosos->residuo != "Plaguicidas y sus envases que contengan remanentes de los mismos" && 
				$residuos_peligrosos->residuo != "Sólidos con metales pesados" && 
				$residuos_peligrosos->residuo != "Sólidos de mantenimiento automotriz" && 
				$residuos_peligrosos->residuo != "Sólidos impregnados con pintura" && 
				$residuos_peligrosos->residuo != "Sólidos impregnados con sustancias químicas"&&
				$residuos_peligrosos->residuo != "Solventes orgánicos" && 
				$residuos_peligrosos->residuo != "Sustancias corrosivas  ácidos" && 
				$residuos_peligrosos->residuo != "Sustancias corrosivas  álcalis" && 
				$residuos_peligrosos->residuo != "Telas o pieles impregnadas de residuos peligrosos") 
			{
				$otro_residuo = $residuos_peligrosos->residuo;
				$residuos_peligrosos->residuo = "Otro";
			}

			$otro_area = "";
			if ($residuos_peligrosos->area_generacion != "Mantenimiento" && 
				$residuos_peligrosos->area_generacion != "Laboratorio" ) 
			{
				$otro_area = $residuos_peligrosos->area_generacion;
				$residuos_peligrosos->area_generacion = "Otro";
			}

			$otro_empresa = "";
			if ($residuos_peligrosos->emp_tran != "Ricardo Díaz Virgen" && 
				$residuos_peligrosos->emp_tran != "Alicia Huerta Rodríguez" && 
				$residuos_peligrosos->emp_tran != "Ecoltec S.A. de C.V." &&
				$residuos_peligrosos->emp_tran != "EK Ambiental S.A. de C.V." ) 
			{
				$otro_empresa = $residuos_peligrosos->emp_tran;
				$residuos_peligrosos->emp_tran = "Otro";
			}

			$otro_destino = "";
			if ($residuos_peligrosos->dest_final != "Ecoltec S.A de C.V." && 
				$residuos_peligrosos->dest_final != "Francisco Serrano Lomeli" && 
				$residuos_peligrosos->dest_final != "Alicia Huerta Rodriguez" &&
				$residuos_peligrosos->dest_final != "EK Ambiental S.A. de C.V." &&
				$residuos_peligrosos->dest_final != "Sistema de Tratamiento Ambiental S.A. de C.V." &&
				$residuos_peligrosos->dest_final != "Enertec Exports S. de R.L. de C.V." ) 
			{
				$otro_destino = $residuos_peligrosos->dest_final;
				$residuos_peligrosos->dest_final = "Otro";
			}

			$otro_manejo = "";
			if ($residuos_peligrosos->sig_manejo != "Coprocesamiento" && 
				$residuos_peligrosos->sig_manejo != "Confinamiento controlado" && 
				$residuos_peligrosos->sig_manejo != "Formulación de combustibles alternos" ) 
			{
				$otro_manejo = $residuos_peligrosos->sig_manejo;
				$residuos_peligrosos->sig_manejo = "Otro";
			}
			$caracteristicas = "";
			$caracteristicas = explode(" ", $residuos_peligrosos->caracteristica);
			#die(print_r($caracteristicas));
			$data3 = array(
				'clientes' => $cliente_baja,
				'correo' => $correo_clientes,
				'residuos' => $residuos_peligrosos,
				'id_persona' => $id_persona,
				'residuo' => $residuos_peligrosos,
				'otro_residuo' => $otro_residuo,
				'otro_area' => $otro_area,
				'otro_empresa' => $otro_empresa,
				'otro_destino' => $otro_destino,
				'otro_manejo' => $otro_manejo,
				'caracteristicas' => $caracteristicas
			);
			$this->load->view('administrador/modificar_bitacora',$data3);
			$this->load->view('administrador/footeru',$data3);
		}
		else
		{
			redirect('administrador/bitacora');
		}
	}

	public function guardar_registro_nueva()
	{
		if($this->input->post()){
			$id_persona = $this->input->post('id_persona');
			$residuo = $this->input->post('residuo');
			$otro_residuo = $this->input->post('otro_residuo');
			$clave = $this->input->post('clave');
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
			$folio_m = $this->input->post('folio');
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
				$nombre_residuo = "Acumuladores de vehículos automotrices conteniendo plomo ";
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
			#die($nombre_residuo);
			$caracteristicas_residuos = "";
			foreach ($caracteristica as $row) {
				$caracteristicas_residuos .= $row." ";
			}

			if($area_generacion == "Otro") {
				$area_generacion = $otro_area;
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

			$fecha_insercion = date("Y-m-d H:i:s");
			$tipo_bitacora = 1;

			$this->residuo_peligroso_model->inserta_residuo($nombre_residuo,
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
															$folio_m,
															$destino_final,
															$no_autorizacion_dest,
															$resp_tec,
															$tipo_bitacora,
															$fecha_insercion);

			$folio_prueba = $this->residuo_peligroso_model->get_id($fecha_insercion);
			$folio = $folio_prueba->id_residuo_peligroso;
			$this->bitacora_model->inserta_bitacora($id_persona,$tipo_bitacora,$folio);
			
			$status = 0;
				$mensajesnuevos = $this->contacto_model->contador_mensajes($status);
				$data = array(
					'mensajes'=> $mensajesnuevos,
				);
			$this->load->view('administrador/header_admin',$data);
			$id_tipo_persona=3;
			$id_status_persona=1;
			$lleno_datos = 1;
			$cliente_baja=$this->persona_model->obtiene_clientes_baja($id_status_persona,$id_tipo_persona,$lleno_datos);
			$correo_clientes = $this->persona_model->getCorreos($id_tipo_persona);
			$residuos_peligrosos = $this->residuo_peligroso_model->get_residuos($id_persona);
			$data3 = array(
				'clientes' => $cliente_baja,
				'correo' => $correo_clientes,
				'residuos' => $residuos_peligrosos,
				'id_persona' => $id_persona
			);
			$this->load->view('administrador/bitacora_residuo',$data3);
			$this->load->view('administrador/footeru',$data3);
		}
		else
		{
			redirect('administrador/bitacora');
		}
	}

	public function actualizar_registro()
	{
		if($this->input->post()){
			$id_bitacora = $this->input->post('id_bitacora');
			$id_persona = $this->input->post('id_persona');
			$residuo = $this->input->post('residuo');
			$otro_residuo = $this->input->post('otro_residuo');
			$clave = $this->input->post('clave');
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
			$folio_m = $this->input->post('folio');
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
			if($residuo == "02") {
				$nombre_residuo = "Aceites hidráulicos gastados";
				$clave_residuo = $residuo;
			} 
			if($residuo == "RPM/01") {
				$nombre_residuo = "Aceites lubricantes usados";
				$clave_residuo = $residuo;
			} 
			if($residuo == "RPM/04") {
				$nombre_residuo = "Acumuladores de vehículos automotrices conteniendo plomo ";
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
			#die($nombre_residuo);
			$caracteristicas_residuos = "";
			foreach ($caracteristica as $row) {
				$caracteristicas_residuos .= $row." ";
			}

			if($area_generacion == "Otro") {
				$area_generacion = $otro_area;
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

			$fecha_insercion = date("Y-m-d H:i:s");
			$tipo_bitacora = 1;

			$this->residuo_peligroso_model->actualizar_registro(
															$id_bitacora,
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
															$folio_m,
															$destino_final,
															$no_autorizacion_dest,
															$resp_tec,
															$tipo_bitacora,
															$fecha_insercion);

			$status = 0;
				$mensajesnuevos = $this->contacto_model->contador_mensajes($status);
				$data = array(
					'mensajes'=> $mensajesnuevos,
				);
			$this->load->view('administrador/header_admin',$data);
			$id_tipo_persona=3;
			$id_status_persona=1;
			$lleno_datos = 1;
			$cliente_baja=$this->persona_model->obtiene_clientes_baja($id_status_persona,$id_tipo_persona,$lleno_datos);
			$correo_clientes = $this->persona_model->getCorreos($id_tipo_persona);
			$residuos_peligrosos = $this->residuo_peligroso_model->get_residuos($id_persona);
			$data3 = array(
				'clientes' => $cliente_baja,
				'correo' => $correo_clientes,
				'residuos' => $residuos_peligrosos,
				'id_persona' => $id_persona
			);
			$this->load->view('administrador/bitacora_residuo',$data3);
			$this->load->view('administrador/footeru',$data3);
		}
		else
		{
			redirect('administrador/bitacora');
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