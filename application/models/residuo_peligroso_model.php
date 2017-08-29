<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Residuo_peligroso_model extends CI_Model {

	public function __construct() {
		parent::__construct(); 
		$this->load->database();
		$this->load->model('area_model');
		$this->load->model('emp_transportista_model');
		$this->load->model('emp_destino_model');
		$this->load->model('modalidad_model');
	}

	public function get_id(){
		$result = $this->db->query("SELECT id_residuo_peligroso FROM residuos_peligrosos order by id_residuo_peligroso desc limit 1 ;")->result();	

		return $result[0]->id_residuo_peligroso;
	}

	public function get_tipo_residuos(){
		return $this->db->query("SELECT * FROM tipo_residuos;")->result();
	}

	public function get_nombre_residuo($id){
		$sql = "SELECT tr.residuo
				FROM residuos_peligrosos as r, tipo_residuos as tr
				WHERE r.id_tipo_residuo = tr.id_tipo_residuo and r.id_residuo_peligroso =" . $id . ";";
		$nombre_resiudo = $this->db->query($sql)->result();

		return $nombre_resiudo[0]->residuo;
	}

	public function get_residuos($id_persona){
		return $this->db->query("
			SELECT 
				r.id_residuo_peligroso,
				tr.residuo as residuo,
				tr.clave as clave,
				r.cantidad as cantidad,
				r.unidad as unidad,
				r.caracteristica as caracteristica,
				a.area as area_generacion,
				r.fecha_ingreso as fecha_ingreso,
				r.fecha_salida as fecha_salida,
				r.cantidad_contenedor as cantidad_contenedor,
				r.tipo_contenedor as tipo_contenedor,
				m.modalidad as sig_manejo,
				et.nombre_empresa as emp_tran,
				ed.nombre_destino as dest_final,
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
				r.id_persona = {$id_persona}
			ORDER BY
				r.folio_manifiesto asc;")->result();
	}

	public function get_bitacora($id_bitacora){
		return $this->db->where('id_residuo_peligroso',$id_bitacora)
						->from('residuos_peligrosos')
						->get()
						->row();
	}

	public function get_ident_residuo($id_bitacora){
		/*return $this->db->select('t.residuo, t.clave, et.no_autorizacion_transportista, ed.no_autorizacion_destino, r.*')
						->from('residuos_peligrosos r')
						->join('tipo_residuos t', 't.id_tipo_residuo = r.id_tipo_residuo', 'left')
						->join('tipo_emp_transportista et', 'et.id_tipo_emp_transportista = r.id_tipo_emp_transportista', 'left')
						->join('tipo_emp_destino ed', 'ed.id_tipo_emp_destino = r.id_tipo_emp_destino', 'left')
						->where('r.id_residuo_peligroso', $id_bitacora)
						->get()
						->row();*/

		return $this->db->query("
			SELECT 
				r.id_residuo_peligroso,
				tr.residuo as residuo,
				tr.clave as clave,
				r.cantidad as cantidad,
				r.unidad as unidad,
				r.caracteristica as caracteristica,
				a.area as area_generacion,
				r.fecha_ingreso as fecha_ingreso,
				r.fecha_salida as fecha_salida,
				m.modalidad as sig_manejo,
				et.nombre_empresa as emp_tran,
				ed.nombre_destino as dest_final,
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
				r.id_residuo_peligroso = {$id_bitacora}
		;")->row();
	}

	public function inserta_residuo($data) {	

		$data['residuo'] = $this->_tipo_residuo($data);
		$data['area_generacion'] = $this->area_model->_area($data);

		$this->db
				->set('id_persona'					,$data['id_persona'])
				->set('id_tipo_residuo'				,$data['residuo'])
				->set('id_area'						,$data['area_generacion'])
				->set('cantidad'					,$data['cantidad'])
				->set('unidad'						,$data['unidad'])
				->set('caracteristica'				,$data['caracteristicas_residuos'])
				->set('fecha_ingreso'				,$data['fecha_ingreso'])
				->set('fecha_insercion'				,$data['fecha_insercion'])
				->set('cantidad_contenedor'			,$data['cantidad_contenedor'])
				->set('tipo_contenedor'				,$data['tipo_contenedor'])
				->set('status'						,"W")
				->insert('residuos_peligrosos');

		return $this->db->insert_id();
	}

	public function actualizar_registros($data) {

		$data['emp_tran'] = $this->emp_transportista_model->_emp_tran($data);
		$data['dest_final'] = $this->emp_destino_model->_emp_dest($data);
		$data['sig_manejo'] = $this->modalidad_model->_modalidad($data);

		foreach ($data['registros'] as $row) {
			$this->db->set('id_tipo_modalidad'		    ,$data['sig_manejo'])
					->set('id_tipo_emp_transportista'	,$data['emp_tran'])
					->set('id_tipo_emp_destino'			,$data['dest_final'])
					->set('fecha_salida'				,$data['fecha_salida'])
					->set('resp_tec'					,$data['resp_tec'])
					->set('folio_manifiesto'			,$data['folio_manifiesto'])
					->set('status'						,"R")
					->where('id_residuo_peligroso'		,$row)
					->update('residuos_peligrosos');
		}

		return "OK";
	}

	public function actualizar_registro($data) {
		
		$data['residuo'] = $this->_tipo_residuo($data);
		$data['area_generacion'] = $this->area_model->_area($data);
		$data['emp_tran'] = $this->emp_transportista_model->_emp_tran($data);
		$data['dest_final'] = $this->emp_destino_model->_emp_dest($data);
		$data['sig_manejo'] = $this->modalidad_model->_modalidad($data);

							
		return $this->db->set('id_tipo_residuo'				,$data['residuo'])
						->set('id_area'						,$data['area_generacion'])
						->set('id_tipo_modalidad'			,$data['sig_manejo'])
						->set('id_tipo_emp_transportista'	,$data['emp_tran'])
						->set('id_tipo_emp_destino'			,$data['dest_final'])
						->set('cantidad'					,$data['cantidad'])
						->set('unidad'						,$data['unidad'])
						->set('caracteristica'				,$data['caracteristicas_residuos'])
						->set('fecha_ingreso'				,$data['fecha_ingreso'])
						->set('fecha_salida'				,$data['fecha_salida'])
						->set('resp_tec'					,$data['resp_tec'])
						->set('folio_manifiesto'			,$data['folio_manifiesto'])
						->set('status'						,"R")
						->where('id_residuo_peligroso'		,$data['id_residuo_peligroso'])
						->update('residuos_peligrosos');
	}
	
	public function delete_residuo($id_residuo_peligroso){

		//$this->db->query(" DELETE FROM bitacora where id_bitacora={$id_residuo_peligroso};");
		return $this->db->query(" DELETE FROM residuos_peligrosos where id_residuo_peligroso={$id_residuo_peligroso};");				
	}

	public function _tipo_residuo($data){

		// Tipo residuo, Insersion de nuevo residuo en tabla tipo.residuos
		if ($data['residuo'] == "Otro") {
			$this->db->set('clave', $data['clave'])
					 ->set('residuo', $data['otro_residuo'])
					 ->insert('tipo_residuos');

			//Obtener id_tipo_residuo
			$sql = "SELECT id_tipo_residuo FROM tipo_residuos order by id_tipo_residuo desc limit 1 ;";
			$result = $this->db->query($sql)->result();

			$id_tipo_residuo = $result[0]->id_tipo_residuo;
		} else {
			$id_tipo_residuo = $data['residuo'];
		}

		return $id_tipo_residuo;

	}

	public function cliente_manifiestos($id_persona){

		return $this->db->query("SELECT folio_manifiesto FROM residuos_peligrosos where id_persona={$id_persona} and fecha_ingreso and folio_manifiesto is not null group by folio_manifiesto order by id_residuo_peligroso desc;")->result();

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
				r.cantidad_contenedor as cantidad_contenedor,
				r.tipo_contenedor as tipo_contenedor,
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

	function get_siguiente_folio($id_persona){

		@$result = @$this->db->query("
			SELECT 
				folio_manifiesto
			FROM 
				residuos_peligrosos
			WHERE
				id_persona = {$id_persona} and folio_manifiesto is not null
			GROUP BY
				folio_manifiesto
			ORDER BY
				folio_manifiesto desc limit 1;")->result()[0]->folio_manifiesto;

		if ($result == ""){
			$result = 0;
		}

		$result = $result + 1;

		return $result;

	}



}
