<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Manifest extends MY_Controller {

	public function __construct(){
		parent::__construct();
		$this->setLayout('empty');
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
		$this->load->helper('file');
		$this->load->library('session');
		$this->load->library('MY_PDF');
		$this->load->library('MY_Output');
		$this->load->library('MY_Input');
		$this->load->helper('file');
		$this->load->helper('url');
	}

	public function manifiesto($folio) {
		$this->unlink_pdf();

		$recolector 					= $this->tran_residuo_model->get_vehiculo($folio)->id_persona;
		$vehiculo 						= $this->tran_residuo_model->get_vehiculo($folio)->id_vehiculo;
		$id_cliente						= $this->tran_residuo_model->get_folio_identificador($folio)->id_persona;

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

		$this->load->view("administrador/recolector/generar_manifiesto", $data);

	}

	public function manifiestos($folio) {
		$this->unlink_pdf();
		
		$recolector 					= $this->tran_residuo_model->get_vehiculo($folio)->id_persona;
		$vehiculo 						= $this->tran_residuo_model->get_vehiculo($folio)->id_vehiculo;
		$id_cliente						= $this->tran_residuo_model->get_folio_identificador($folio)->id_persona;

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

		$this->load->view("administrador/recolector/generar_manifiesto_dummy", $data);
	}

	private function unlink_pdf() {
		$pdfpath = $_SERVER['DOCUMENT_ROOT'] . 'rgdiaz/img/pdf/*.pdf';
		if (file_exists($pdfpath)) {
			unlink($pdfpath);
		}
	}
	
}

?>