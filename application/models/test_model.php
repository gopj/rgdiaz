<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Test_model extends CI_Model {

public function __construct() {
	parent::__construct(); 
		$this->load->database();
	}

	public function datafix_folio(){

		for ($i=1; $i < 100; $i++) { 
			$result = $this->db->query("SELECT id_residuo_peligroso, id_persona, folio_manifiesto FROM residuos_peligrosos WHERE id_persona={$i};")->result(); 
	
			foreach ($result as $row)  {

				if ($row->folio_manifiesto != "") {

			 		$arr_res[$i][] = $row->folio_manifiesto;
				}
			 } 

		}

		//sort($arr_res);

		for ($i=1; $i < (count($arr_res)); $i++) { 
			$num = 1;	
			for ($j=0; $j < (count($arr_res[$i])); $j++) {
				
				if (@$arr_res[$i][$j] != "") {
				
					if (@$arr_res[$i][$j] != (@$arr_res[$i][$j-1])) {
						echo "UPDATE residuos_peligrosos SET folio_manifiesto={$num} WHERE id_persona={$i} AND folio_manifiesto={$arr_res[$i][$j]}; <br/>";
						$num++;
					} 
				}
			}
			echo "<br/>";
		}

		echo "<pre>";
		print_r($arr_res);
		echo "</pre>";
		

		die();
		return $result;
	}
	
 }