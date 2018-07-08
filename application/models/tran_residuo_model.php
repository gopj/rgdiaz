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
				status
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

		if ($result == null) {
			$result = 0;
		}

		return $result;
	}

	public function get_bitacora_manifiesto($id_cliente, $folio){
		
		$result = $this->db->query("
			SELECT 
				r.id_tran_residuo,
				r.folio,
				tr.residuo,
				r.caracteristica,
				r.contenedor_cantidad,
				r.contenedor_tipo,
				r.residuo_cantidad,
				r.unidad
			FROM 
				tran_residuos as r
					LEFT JOIN tipo_emp_destino ed ON (r.id_tipo_emp_destino = ed.id_tipo_emp_destino),
				tipo_residuos as tr
			WHERE
				r.id_tipo_residuo = tr.id_tipo_residuo and
				id_persona 	= {$id_cliente} and 
				folio 		= {$folio};
		")->result();  

		return $result;
	}

	public function get_manifiesto($id_cliente, $folio){
		
		$result = $this->db->query("
			SELECT 
				r.folio,
				r.fecha_ingreso,
				r.responsable_tecnico,
				ed.nombre_destino as empresa_destino
			FROM 
				tran_residuos as r
					LEFT JOIN tipo_emp_destino ed ON (r.id_tipo_emp_destino = ed.id_tipo_emp_destino),
				tipo_residuos as tr
			WHERE
				r.id_tipo_residuo = tr.id_tipo_residuo and
				id_persona 	= {$id_cliente} and 
				folio 		= {$folio}
			LIMIT 1;
		")->row();

		return $result;
	}

	public function inserta_tran_residuo($data) {	

		$this->db
				->set('id_persona'			,$data['id_cliente'])
				->set('id_tipo_residuo'		,$data['residuo'])
				->set('id_tipo_emp_destino'	,$data['id_emp_destino'])
				->set('folio'				,$data['folio'])
				->set('caracteristica'		,$data['caracteristicas'])
				->set('contenedor_cantidad'	,$data['cantidad_contenedor'])
				->set('contenedor_tipo'		,$data['contenedor'])
				->set('residuo_cantidad'	,$data['cantidad'])
				->set('unidad'				,$data['unidad'])
				->set('responsable_tecnico'	,$data['responsable_tecnico'])
				->set('fecha_insercion'		,'NOW()', FALSE)
				->set('fecha_ingreso'		,$data['fecha_embarque'])
				->set('status'				,"W")
				->insert('tran_residuos');

		return $this->db->insert_id();
	}

	public function update_prev_reg($id_cliente, $folio, $data) {	

		$sql_text = "
			SELECT 
				fecha_ingreso,
				responsable_tecnico,
				id_tipo_emp_destino
			FROM 
				tran_residuos
			WHERE
				id_persona 	= {$id_cliente} and 
				folio 		= {$folio}
			LIMIT 1;
		";

		$result = $this->db->query($sql_text)->row();

		if ( ($result->fecha_ingreso != $data["fecha_embarque"]) || ($result->responsable_tecnico != $data["responsable_tecnico"]) || ($result->id_tipo_emp_destino != $data["id_emp_destino"])) {
			
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

		return $sql_text;
	}

	public function get_reg_tran_residuos($id_cliente, $folio) {	

		$sql_text = "
			SELECT 
				fecha_ingreso,
				responsable_tecnico,
				id_tipo_emp_destino
			FROM 
				tran_residuos
			WHERE
				id_persona 	= {$id_cliente} and 
				folio 		= {$folio}
			LIMIT 1;
		";

		$result = $this->db->query($sql_text)->row();

		return $result;
	}

	public function delete_tran_residuos($id) {	
		return $this->db->query(" DELETE FROM tran_residuos where id_tran_residuo={$id};");	
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

	public function get_residuos_manifiesto($id_persona, $manifiesto){
		return $this->db->query("
			SELECT 
				r.id_residuo_peligroso,
				tr.residuo as residuo,
				tr.clave as clave,
				tr.abreviacion,
				r.cantidad as cantidad,
				r.unidad as unidad,
				r.caracteristica as caracteristica,
				a.area as area_generacion,
				r.fecha_ingreso as fecha_ingreso,
				r.fecha_salida as fecha_salida,
				m.modalidad as sig_manejo,
				et.nombre_empresa as emp_tran,
				et.no_autorizacion_sct as no_autorizacion_sct,
				et.domicilio as domicilio_transportista,
				et.telefono as telefono,
				ed.nombre_destino as dest_final,
				ed.domicilio as domicilio_destino,
				ed.municipio as municipio_destino,
                ed.estado as estado_destino,
				r.resp_tec as resp_tec,
				et.no_autorizacion_transportista as no_aut_transp,
				ed.no_autorizacion_destino as no_aut_dest_final,
				r.folio_manifiesto as folio,
				r.id_persona as id_persona,
				r.status
			FROM 
				residuos_peligrosos as r
					LEFT JOIN areas a ON (r.id_area = a.id_area)
					LEFT JOIN tipo_modalidad m ON (r.id_tipo_modalidad = m.id_tipo_modalidad)
					LEFT JOIN tipo_emp_transportista et ON (r.id_tipo_emp_transportista = et.id_tipo_emp_transportista)
					LEFT JOIN tipo_emp_destino ed ON (r.id_tipo_emp_destino = ed.id_tipo_emp_destino),
				tipo_residuos as tr
			WHERE
				r.id_tipo_residuo = tr.id_tipo_residuo and
				r.id_persona = {$id_persona} and
				r.folio_manifiesto = {$manifiesto}
			ORDER BY
				r.fecha_ingreso asc;")->result();
	}

}