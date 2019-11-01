<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Test_model extends CI_Model {

public function __construct() {
	parent::__construct(); 
		$this->load->database();
	}

	public function datafix_folio(){

		for ($i=1; $i < 100; $i++) { 
			$result = $this->db->query("SELECT id_residuo_peligroso, id_persona, folio_manifiesto FROM residuos_peligrosos WHERE id_persona={$i} group by folio_manifiesto order by id_persona, id_residuo_peligroso asc;")->result(); 
			$num = 1;
	
			foreach ($result as $row)  {

				$folio = $row->folio_manifiesto;

				if ($folio != "") {

			 		echo "UPDATE residuos_peligrosos SET folio_manifiesto={$num} WHERE id_persona={$i} AND folio_manifiesto='{$folio}'; <br/>";
			 		$num++;
				}

			 } 


		}
		/*echo "<pre>";
		print_r($arr_res);
		echo "</pre>";
		*/

		die();
		return $result;
	}
	
 }