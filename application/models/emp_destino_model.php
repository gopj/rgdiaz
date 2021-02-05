 <?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Emp_destino_model extends CI_Model {

public function __construct() {
	parent::__construct(); 
		$this->load->database();
	}

	public function get_tipo_emp_destino() {
		return $this->db->query("SELECT * FROM tipo_emp_destino;")->result();
	}

	public function get_by_id_tipo_emp_destino($id){
		return $this->db->query("SELECT * FROM tipo_emp_destino WHERE id_tipo_emp_destino=" . $id . ";")->row();
	}
	
	public function get_nombre_dest($id){
		$sql = "SELECT nombre_destino
				FROM tipo_emp_destino
				WHERE id_tipo_emp_destino =" . $id . ";";
				
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

	public function get_destinos() {
		return $this->db->select('*')->get('tipo_emp_destino');
	}

	public function get_destino($id) {
		return $this->db->where('id_tipo_emp_destino', $id)->get('tipo_emp_destino')->row();
	}

	public function actualiza_emp_destino($data) {
		return $this->db
				->set('nombre_destino'			,$data['nombre_emp_dest'])
				->set('no_autorizacion_destino'	,$data['no_aut_dest'])
				->set('domicilio'				,$data['domicilio_emp_dest'])
				->set('municipio'				,$data['municipio_emp_dest'])
				->set('estado'					,$data['estado_emp_dest'])
				->where('id_tipo_emp_destino'	,$data['id_emp_destino'])
				->update('tipo_emp_destino');
		
	}

	public function alta_destino($data) {
		return $this->db
				->set('nombre_destino',		 	$data['nombre_destino'])
				->set('no_autorizacion_destino',$data['numero_autorizacion'])
				->set('calle', 					$data['calle'])
				->set('num_ext', 				$data['num_ext'])
				->set('num_int', 				$data['num_int'])
				->set('cp',		 				$data['cp'])
				->set('colonia', 				$data['colonia'])
				->set('municipio', 				$data['municipio'])
				->set('estado', 				$data['estado'])
				->set('telefono', 				$data['telefono'])
				->insert('tipo_emp_destino');
	}

	public function update_destino($data) {
		return $this->db
				->set('nombre_destino',		 	$data['nombre_destino'])
				->set('no_autorizacion_destino',$data['numero_autorizacion'])
				->set('calle', 					$data['calle'])
				->set('num_ext', 				$data['num_ext'])
				->set('num_int', 				$data['num_int'])
				->set('cp',		 				$data['cp'])
				->set('colonia', 				$data['colonia'])
				->set('municipio', 				$data['municipio'])
				->set('estado', 				$data['estado'])
				->set('telefono', 				$data['telefono'])
				->where('id_tipo_emp_destino',	$data['id_emp_dest'])
				->update('tipo_emp_destino');
	}

	public function delete_destino($id){
		 return $this->db->where('id_tipo_emp_destino', $id)
		 		->delete('tipo_emp_destino');
	}

}