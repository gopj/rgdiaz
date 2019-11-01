 <?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Area_model extends CI_Model {

public function __construct() {
	parent::__construct(); 
		$this->load->database();
	}

	public function get_areas(){
		return $this->db->query("SELECT * FROM areas;")->result();
	}

	public function get_nombre_area($id){
		$sql = "SELECT a.area
				FROM residuos_peligrosos as r, areas as a
				WHERE r.id_area = a.id_area and r.id_residuo_peligroso =" . $id . ";";
		$nombre_area = $this->db->query($sql)->result();

		return $nombre_area[0]->area;
	}

	public function _area($data){

		// Tipo de area, Insersion de nueva area en tabla areas
		if ($data['area_generacion'] == "Otro") {
			$this->db->set('area', $data['otro_area'])
					 ->insert('areas');

			//Obtener id_area
			$sql = "SELECT id_area FROM areas order by id_area desc limit 1 ;";
			$result = $this->db->query($sql)->result();
			$id_area = $result[0]->id_area;

		} else {
			$id_area = $data['area_generacion'];
		}

		return $id_area;

	}

	

 }