 <?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Emp_destino_model extends CI_Model {

public function __construct() {
	parent::__construct(); 
		$this->load->database();
	}

	public function get_tipo_emp_destino() {
		return $this->db->query("SELECT * FROM tipo_emp_destino;")->result();
	}
	
	public function get_nombre_dest($id){
		$sql = "SELECT d.nombre_destino
				FROM residuos_peligrosos as r, tipo_emp_destino as d
				WHERE r.id_tipo_emp_destino = d.id_tipo_emp_destino and r.id_residuo_peligroso =" . $id . ";";
		$nombre_emp_destino = $this->db->query($sql)->result();

		return @$nombre_emp_destino[0]->nombre_destino;
	}

	public function _emp_dest($data){
		// Tipo empresa destino, Insersion de nuevo destino en tabla tipo_emp_destino
		if ($data['dest_final'] == "Otro") {
			$this->db->set('nombre_destino', $data['otro_dest'])
					 ->set('no_autorizacion_destino', $data['no_auto_dest'])
					 ->insert('tipo_emp_destino');

			//Obtener id_tipo_emp_destino
			$sql = "SELECT id_tipo_emp_destino FROM tipo_emp_destino order by id_tipo_emp_destino desc limit 1 ;";
			$result = $this->db->query($sql)->result();
			$id_tipo_emp_destino = $result[0]->id_tipo_emp_destino;

		} else {
			$id_tipo_emp_destino = $data['dest_final'];
		}

		return $id_tipo_emp_destino;
	}

}