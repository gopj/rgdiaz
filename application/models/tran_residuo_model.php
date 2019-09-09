<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tran_residuo_model extends CI_Model {

	public function __construct() {
		parent::__construct(); 
		$this->load->database();
	}

	public function get_bitacora($id_cliente){
		
		$result = $this->db->query("
			SELECT 
				tf.id_tran_folio as folio,
				ed.nombre_destino as empresa_destino,
				tf.id_recolector,
				tf.fecha_embarque,
				tf.responsable_tecnico,
				tf.status,
				tf.ruta,
				tf.observaciones
			FROM
				tran_folios as tf
					LEFT JOIN tipo_emp_destino ed ON (tf.id_tipo_emp_destino = ed.id_tipo_emp_destino)
			WHERE
				tf.id_persona = {$id_cliente};
		")->result();

		return $result;
	}

	public function get_bitacora_count($id_cliente){
		
		$result = $this->db->query("
			SELECT 
				id_tran_folio
			FROM 
				tran_folios 
			WHERE
				id_persona = {$id_cliente}
			ORDER BY
				id_tran_folio desc
			LIMIT 1;
		")->row("folio");

		if ($result == null) {
			$result = 0;
		}

		return $result;
	}

	public function get_bitacora_manifiesto($id_cliente, $folio){
		
		$result = $this->db->query("
			SELECT 
				r.id_tran_residuo,
				tf.id_tran_folio, 
				tf.folio, 
				tr.residuo as residuo,
				r.caracteristica as caracteristica,
				r.contenedor_cantidad,
				r.contenedor_tipo,
				r.residuo_cantidad,
				r.unidad as unidad
			FROM 
				tipo_residuos as tr,
			 	tran_residuos as r,
			 	tran_folios as tf
					LEFT JOIN tipo_emp_destino ed ON (tf.id_tipo_emp_destino = ed.id_tipo_emp_destino)
			WHERE
				r.id_tipo_residuo 	= tr.id_tipo_residuo and
				r.id_folio 			= tf.id_tran_folio and
				tf.id_persona 		= {$id_cliente} and 
				tf.id_tran_folio	= {$folio};
		")->result();  

		return $result;
	}

	public function get_manifiesto($id_cliente, $folio){
		
		$result = $this->db->query("
			SELECT 
				tf.folio,
				tf.fecha_embarque,
				tf.responsable_tecnico,
				ed.nombre_destino as empresa_destino
			FROM 
				tran_residuos as r,
				tipo_residuos as tr,
				tran_folios as tf
					LEFT JOIN tipo_emp_destino ed ON (tf.id_tipo_emp_destino = ed.id_tipo_emp_destino)
			WHERE
				r.id_tipo_residuo = tr.id_tipo_residuo and
				id_persona 	= {$id_cliente} and 
				folio 		= {$folio}
			LIMIT 1;
		")->row();

		return $result;
	}



	public function inserta_tran_folio($data) {	

		$this->db
			->set('id_persona'			, $data['id_cliente'])
			->set('id_tipo_emp_destino'	, $data['id_emp_destino'])
			->set('id_recolector' 		, $data["id_recolector"])
			->set('folio' 				, $data['folio'])
			->set('fecha_embarque' 		, $data['fecha_embarque'])
			->set('responsable_tecnico'	, $data['responsable_tecnico'])
			->set('status' 				, 'W')
			->set('ruta'				, 'ruta... Agregar campo de ruta en UI')
			->set('observaciones'		, 'Falta agregar observaciones - Agregar campo de observaciones en UI')
			->insert('tran_folios');

		return $this->db->insert_id();
	}

	public function inserta_tran_residuo($data) {	

		$this->db
				->set('id_folio'			, $data['folio'])
				->set('id_tipo_residuo'		, $data['residuo'])
				->set('caracteristica'		, $data['caracteristicas'])
				->set('contenedor_cantidad'	, $data['cantidad_contenedor'])
				->set('contenedor_tipo'		, $data['contenedor'])
				->set('residuo_cantidad'	, $data['cantidad'])
				->set('unidad'				, $data['unidad'])
				->set('fecha_insercion'		, 'NOW()', FALSE)
				->set('status'				, "W")
				->set('contenedor_capacidad', 1111111)
				->set('etiqueta' 			, 'falta en ui ETIQUETA ')
				->insert('tran_residuos');

		return $this->db->insert_id();
	}


	public function get_reg_tran_residuos($id_cliente, $folio) {	

		$sql_text = "
			SELECT 
				fecha_embarque,
				responsable_tecnico,
				id_tipo_emp_destino
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
		return $this->db->query(" DELETE FROM tran_folios where id_tran_folio={$id};");	
	}

	public function update_regs($id_cliente, $folio, $data){
		$sql_text = "
			UPDATE 
				tran_residuos 
			SET 
				id_tipo_emp_destino = {$data["id_emp_destino"]}, 
				responsable_tecnico = '{$data["responsable_tecnico"]}',
				fecha_ingreso = '{$data["fecha_embarque"]}'
			WHERE 
				id_persona={$id_cliente} and folio={$folio};
		";

		$this->db->query($sql_text);
	}

	public function terminar_manifiesto($id_cliente, $folio) {	

		$sql_text = "
				UPDATE 
					tran_residuos 
				SET 
					status='R'
				WHERE 
					id_persona={$id_cliente} and folio={$folio};
		";

		return $this->db->query($sql_text);
	}

	public function get_residuos_manifiesto($id_cliente, $folio){
		return $this->db->query("
			SELECT 
				r.id_persona as id_cliente,
				r.id_tran_residuo,
				r.folio,
				r.responsable_tecnico,
				tr.residuo,
				r.caracteristica,
				r.contenedor_cantidad,
				r.contenedor_tipo,
				r.residuo_cantidad,
				r.unidad,
				ed.nombre_destino as dest_final,
				ed.no_autorizacion_destino as no_aut_dest_final
				/*ed.domicilio as domicilio_destino,
				ed.municipio as municipio_destino,
				ed.estado as estado_destino,*/
			FROM 
				tran_residuos as r
					LEFT JOIN tipo_emp_destino ed ON (r.id_tipo_emp_destino = ed.id_tipo_emp_destino),
				tipo_residuos as tr
			WHERE
				r.id_tipo_residuo = tr.id_tipo_residuo and
				id_persona 	= {$id_cliente} and 
				folio 		= {$folio};")->result();
	}

}