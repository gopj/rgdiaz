<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tran_residuo_model extends CI_Model {

	public function __construct() {
		parent::__construct(); 
		$this->load->database();
	}

	public function get_bitacora($id_cliente){
		
		$result = $this->db->query("
			SELECT 
				tf.id_tran_folio,
				ed.nombre_destino as empresa_destino,
				tf.id_recolector,
				tf.fecha_embarque,
				tf.responsable_tecnico,
				tf.status,
				tf.ruta,
				tf.observaciones,
				tf.folio
			FROM
				tran_folios as tf
					LEFT JOIN tipo_emp_destino ed ON (tf.id_tipo_emp_destino = ed.id_tipo_emp_destino)
			WHERE
				tf.id_persona = {$id_cliente} and 
				tf.status in ('R', 'W');
		")->result();

		return $result;
	}

	public function get_folios_count($id_cliente){
		
		$result = $this->db->query("
			SELECT AUTO_INCREMENT FROM information_schema.tables WHERE table_schema='rdiaz' AND table_name='tran_folios';
		")->row();

		$result = $result->AUTO_INCREMENT;

		if ($result == 0) {
			$result = 1;
		}

		return $result;
	}

	public function get_bitacora_count($id_cliente){

		$result = $this->db->query("
			select count(*) as total from tran_folios where id_persona = {$id_cliente};
		")->row();

		$result = $result->total;
		$result = $result + 1;

		return $result;
	}

	public function get_bitacora_manifiesto($id_cliente, $folio){
		
		$result = $this->db->query("
			SELECT 
				r.id_tran_residuo,
				tf.id_tran_folio, 
				tf.folio, 
				tf.id_tipo_emp_destino,
				tf.id_vehiculo,
				tr.residuo as residuo,
				r.caracteristica as caracteristica,
				r.contenedor_cantidad,
				r.contenedor_tipo,
				r.contenedor_capacidad,
				r.residuo_cantidad,
				r.etiqueta
			FROM 
				tipo_residuos as tr,
			 	tran_residuos as r,
			 	tran_folios as tf
					LEFT JOIN tipo_emp_destino ed ON (tf.id_tipo_emp_destino = ed.id_tipo_emp_destino)
			WHERE
				r.id_tipo_residuo 	= tr.id_tipo_residuo and
				r.id_tran_folio 	= tf.id_tran_folio and
				tf.id_persona 		= {$id_cliente} and 
				tf.id_tran_folio	= {$folio};
		")->result();  

		return $result;
	}

	public function get_manifiesto($id_cliente, $folio){
		
		$result = $this->db->query("
			SELECT 
				*
			FROM 
				tran_folios
					
			WHERE
				id_persona 	 = {$id_cliente} and 
				id_tran_folio= {$folio};
		")->row();

		// $result = $this->db->query("
		// 	SELECT 
		// 		tf.folio,
		// 		tf.fecha_embarque,
		// 		tf.responsable_tecnico,
		// 		tf.responsable_destino,
		// 		ed.nombre_destino as empresa_destino
		// 	FROM 
		// 		tran_residuos as r,
		// 		tipo_residuos as tr,
		// 		tran_folios as tf
		// 			LEFT JOIN tipo_emp_destino ed ON (tf.id_tipo_emp_destino = ed.id_tipo_emp_destino)
		// 	WHERE
		// 		r.id_tipo_residuo = tr.id_tipo_residuo and
		// 		id_persona 	 = {$id_cliente} and 
		// 		r.id_tran_folio= {$folio}
		// 	LIMIT 1;
		// ")->row();

		return $result;
	}

	public function inserta_tran_folio($data) {	

		$this->db
			->set('id_persona'			, $data['id_cliente'])
			->set('id_tipo_emp_destino'	, $data['id_emp_destino'])
			->set('id_recolector' 		, $data["id_recolector"])
			->set('folio' 				, $data["folio_identificador"])
			->set('fecha_embarque' 		, $data['fecha_embarque'])
			->set('responsable_destino'	, $data['responsable_destino'])
			->set('status' 				, 'W')
			->set('ruta'				, $data['ruta'])
			->set('observaciones'		, $data['observaciones'])
			->set('id_vehiculo'			, $data['id_vehiculo'])
			->insert('tran_folios');

		return $this->db->insert_id();
	}

	public function inserta_tran_residuo($data) {	

		if ($data['etiqueta']=="0") {
			$data['etiqueta'] = 'N';
		}

		$this->db
				->set('id_tran_folio'		, $data['folio']) // id_folio, proviene de la inserción hecha en la funcion de inserta_tran_folio (no mover)
				->set('id_tipo_residuo'		, $data['residuo'])
				->set('caracteristica'		, $data['caracteristicas'])
				->set('contenedor_cantidad'	, $data['cont_cantidad'])
				->set('contenedor_capacidad', $data['cont_capacidad'])
				->set('contenedor_tipo'		, $data['contenedor_tipo'])
				->set('residuo_cantidad'	, $data['residuo_cantidad'])
				->set('etiqueta'			, $data['etiqueta'])
				->set('fecha_insercion'		, 'NOW()', FALSE)
				->insert('tran_residuos');

		return $this->db->insert_id();
	}


	public function get_reg_tran_residuos($id_cliente, $folio) {	

		$sql_text = "
			SELECT 
				*
			FROM 
				tran_folios
			WHERE
				id_persona 	= {$id_cliente} and 
				id_tran_folio	= {$folio}
			LIMIT 1;
		";

		$result = $this->db->query($sql_text)->row();

		return $result;
	}

	public function delete_tran_residuos($id) {	
		return $this->db->query(" DELETE FROM tran_residuos where id_tran_residuo={$id};");	
	}

	public function delete_tran_folio($id) {	
		//return $this->db->query(" DELETE FROM tran_folios where id_tran_folio={$id};");	
		
		return $this->db->set('status', 'D')
						->where('id_tran_folio', $id)
						->update('tran_folios');
	}

	public function update_recolector($data){
		return $this->db->set('nombre',				$data['nombre'])
						->set('correo',				$data['correo'])
						->set('password',			$data['clave'])
						->where('id_persona',		$data['id_persona'])
						->update('persona');
	}

	public function terminar_manifiesto($id_cliente, $folio, $data) {
		return $this->db->set('status',				'R')
						->set('responsable_tecnico',$data["responsable_tecnico"])
						->where('id_persona',		$id_cliente)
						->where('id_tran_folio',	$folio)
						->update('tran_folios');
	}

	// public function update_folio($data){
	// 	return $this->db->
	// }

	public function get_residuos_manifiesto($id_cliente, $folio){
		return $this->db->query("
			SELECT 
				r.id_tran_residuo,
				tf.id_persona as id_cliente,
				tf.id_tran_folio as folio, 
				tf.responsable_tecnico,
				tf.observaciones, 
				tr.residuo as residuo,
				r.caracteristica as caracteristica,
				r.contenedor_cantidad,
				r.contenedor_tipo,
				r.contenedor_capacidad,
				r.residuo_cantidad,
				r.fecha_insercion,
				r.etiqueta
			FROM 
				tipo_residuos as tr,
			 	tran_residuos as r,
			 	tran_folios as tf
					LEFT JOIN tipo_emp_destino ed ON (tf.id_tipo_emp_destino = ed.id_tipo_emp_destino)
			WHERE
				r.id_tipo_residuo 	= tr.id_tipo_residuo and
				r.id_tran_folio		= tf.id_tran_folio and
				tf.id_persona 		= {$id_cliente} and 
				tf.id_tran_folio	= {$folio};")->result();

	}

	public function get_vehiculo($folio){
		return $this->db->query("select * from tran_folios where id_tran_folio=" . $folio . ";")->row();
	}


}