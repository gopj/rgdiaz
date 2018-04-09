<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tran_residuo_model extends CI_Model {

	public function __construct() {
		parent::__construct(); 
		$this->load->database();
	}

	public function get_bitacora($id_cliente){
		
		$result = $this->db->query("
			SELECT 
				r.id_tran_residuo,
				r.folio, 
				ed.nombre_destino as empresa_destino,
				tr.residuo as residuo,
				tr.clave as clave,
				r.unidad as unidad,
				r.caracteristica as caracteristica,
				r.fecha_ingreso as fecha_ingreso,
				r.fecha_salida as fecha_salida
			FROM 
				tipo_residuos as tr,
			 	tran_residuos as r
					LEFT JOIN tipo_emp_destino ed ON (r.id_tipo_emp_destino = ed.id_tipo_emp_destino)
			WHERE
				r.id_tipo_residuo = tr.id_tipo_residuo and
				r.id_persona = {$id_cliente}
			GROUP BY
				r.folio asc;
		")->result();

		return $result;
	}

}