 <?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Emp_transportista_model extends CI_Model {

public function __construct() {
	parent::__construct(); 
		$this->load->database();
	}

	public function get_tipo_emp_transportista(){
		return $this->db->query("SELECT * FROM tipo_emp_transportista;")->result();
	}

	public function get_by_id_tipo_emp_transportista($id){
		return $this->db->query("SELECT * FROM tipo_emp_transportista WHERE id_tipo_emp_transportista=" . $id . ";")->row();
	}

	public function get_datos_emp_trans($id){
		$sql = "SELECT et.*, p.*
				FROM rdiaz.tipo_emp_transportista et, rdiaz.persona p
				WHERE 
				p.nombre_empresa =et.nombre_empresa 
				and et.id_tipo_emp_transportista=" . $id . ";";

		return $this->db->query($sql)->result();
	}

	public function _emp_tran($data){

		// Tipo empresa transportista, Insercion de nuevo residui en tabla tipo_emp_transportista
		if ($data['emp_tran'] == "Otro") {
			$this->db->set('nombre_empresa', $data['otro_emp'])
					 ->set('no_autorizacion_transportista', $data['no_auto'])
					 ->insert('tipo_emp_transportista');

			//Obtener id_tipo_emp_transportista
			$sql = "SELECT id_tipo_emp_transportista FROM tipo_emp_transportista order by id_tipo_emp_transportista desc limit 1 ;";
			$result = $this->db->query($sql)->result();
			$id_tipo_emp_transportista = $result[0]->id_tipo_emp_transportista;
		} else {
			$id_tipo_emp_transportista = $data['emp_tran'];
		}

		return $id_tipo_emp_transportista;

	}

	public function actualiza_emp_transportista($data) {

		$this->db
				->set('nombre_empresa'					,$data['nombre_emp_trans'])
				->set('no_autorizacion_transportista'	,$data['no_aut_trans'])
				->set('no_autorizacion_sct'				,$data['no_aut_trans_sct'])
				->set('domicilio'						,$data['domicilio_emp_trans'])
				->set('telefono'						,$data['tel_emp_trans'])
				->where('id_tipo_emp_transportista'		,$data['id_emp_transportista'])
				->update('tipo_emp_transportista');

		return "OK";
		
	}

}