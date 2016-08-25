 <?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Modalidad_model extends CI_Model {

	public function __construct() {
		parent::__construct(); 
		$this->load->database();
	}

	public function get_tipo_modalidad() {
		return $this->db->query("SELECT * FROM tipo_modalidad;")->result();
	}

	public function get_nombre_modalidad($id){
		$sql = "SELECT m.modalidad
				FROM residuos_peligrosos as r, tipo_modalidad as m
				WHERE r.id_tipo_modalidad = m.id_tipo_modalidad and r.id_residuo_peligroso =" . $id . ";";
		$nombre_modalidad = $this->db->query($sql)->result();

		return $nombre_modalidad[0]->modalidad;
	}

	public function _modalidad($data){

		// Tipo modalidad, Insersion de nuevo destino en tabla tipo_modalidad
		if ($data['sig_manejo'] == "Otro") {
			$this->db->set('modalidad', $data['otro_modalidad'])
					 ->insert('tipo_modalidad');

			//Obtener id_tipo_emp_destino
			$sql = "SELECT id_tipo_modalidad FROM tipo_modalidad order by id_tipo_modalidad desc limit 1 ;";
			$result = $this->db->query($sql)->result();
			$id_tipo_modalidad = $result[0]->id_tipo_modalidad;
		
		} else {
			$id_tipo_modalidad = $data['sig_manejo'];
		}

		return $id_tipo_modalidad;
	}

}