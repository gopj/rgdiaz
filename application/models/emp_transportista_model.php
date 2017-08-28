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
		return $this->db->query("SELECT * FROM tipo_emp_transportista WHERE id_tipo_emp_transportista=" . $id . ";")->result();
	}

	public function get_nombre_trans($id){
		$sql = "SELECT e.nombre_empresa
				FROM residuos_peligrosos as r, tipo_emp_transportista as e
				WHERE r.id_tipo_emp_transportista = e.id_tipo_emp_transportista and r.id_residuo_peligroso =" . $id . ";";
		$nombre_emp_trans = $this->db->query($sql)->result();

		return @$nombre_emp_trans[0]->nombre_empresa;
	}

	public function _emp_tran($data){

		// Tipo empresa transportista, Insersion de nuevo residui en tabla tipo_emp_transportista
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

}