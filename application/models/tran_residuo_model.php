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
				r.fecha_ingreso as fecha_ingreso
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

	public function get_bitacora_count($id_cliente){
		
		$result = $this->db->query("
			SELECT 
				folio
			FROM 
				tran_residuos 
			WHERE
				id_persona = {$id_cliente}
			ORDER BY
				id_tran_residuo desc
			LIMIT 1;
		")->row("folio");

		return $result;
	}

	public function inserta_tran_residuo($data) {	

		$this->db
			 	->set('id_persona'					,$data['id_cliente'])
			 	->set('id_tipo_residuo'				,$data['residuo'])
				->set('id_tipo_emp_destino'			,$data['id_emp_destino'])
				->set('folio'						,$data['folio'])
				->set('caracteristica'				,$data['caracteristicas'])
				->set('contenedor_cantidad'			,$data['cantidad_contenedor'])
				->set('contenedor_tipo'				,$data['contenedor'])
				->set('residuo_cantidad'			,$data['cantidad'])
				->set('unidad'						,$data['unidad'])
				->set('responsable_tecnico'			,$data['responsable_tecnico'])
				->set('fecha_insercion'				,'NOW()', FALSE)
				->set('fecha_ingreso'				,$data['fecha_emabarque'])
				->set('status'						,"W")
				->insert('tran_residuos');

		return $this->db->insert_id();
	}

}