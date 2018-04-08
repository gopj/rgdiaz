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
				ed.nombre_destino as empre_destino,
				tr.clave as clave,
				r.unidad as unidad,
				r.caracteristica as caracteristica,
				r.fecha_ingreso as fecha_ingreso,
				r.fecha_salida as fecha_salida,
			FROM 
			 	tran_residuos as r
				tipo_residuos as tr
				LEFT JOIN areas a ON (r.id_area = a.id_area)
				LEFT JOIN tipo_modalidad m ON (r.id_tipo_modalidad = m.id_tipo_modalidad)
				LEFT JOIN tipo_emp_destino ed ON (r.id_tipo_emp_destino = ed.id_tipo_emp_destino),
			WHERE
				r.id_tipo_residuo = tr.id_tipo_residuo and
				r.id_persona = {$id_cliente}
			GROUP BY
				r.folio asc;
		")->result();

		return $result;
	}

}