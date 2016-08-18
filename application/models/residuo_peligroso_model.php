<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Residuo_peligroso_model extends CI_Model {

public function __construct() 
	 {
		parent::__construct(); 
		$this->load->database();
	 }

	public function get_id(){
		$result = $this->db->query("SELECT id_residuo_peligroso FROM residuos_peligrosos order by id_residuo_peligroso desc limit 1 ;")->result();	

		return $result[0]->id_residuo_peligroso;
	}

	public function get_tipo_residuos(){
		return $this->db->query("SELECT * FROM tipo_residuos;")->result();
	}

	public function get_areas(){
		return $this->db->query("SELECT * FROM areas;")->result();
	}

	public function get_tipo_emp_transportista(){
		return $this->db->query("SELECT * FROM tipo_emp_transportista;")->result();
	}

	public function get_tipo_emp_destino() {
		return $this->db->query("SELECT * FROM tipo_emp_destino;")->result();
	}

	public function get_tipo_modalidad() {
		return $this->db->query("SELECT * FROM tipo_modalidad;")->result();
	}

	public function get_nombre_residuo($id){
		$sql = "SELECT tr.residuo
				FROM residuos_peligrosos as r, tipo_residuos as tr
				WHERE r.id_tipo_residuo = tr.id_tipo_residuo and r.id_residuo_peligroso =" . $id . ";";
		$nombre_resiudo = $this->db->query($sql)->result();

		return $nombre_resiudo[0]->residuo;
	}

	public function get_nombre_area($id){
		$sql = "SELECT a.area
				FROM residuos_peligrosos as r, areas as a
				WHERE r.id_area = a.id_area and r.id_residuo_peligroso =" . $id . ";";
		$nombre_area = $this->db->query($sql)->result();

		return $nombre_area[0]->residuo;
	}

	public function get_nombre_trans($id){
		$sql = "SELECT tr.residuo
				FROM residuos_peligrosos as r, tipo_residuos as tr
				WHERE r.id_tipo_residuo = tr.id_tipo_residuo and r.id_residuo_peligroso =" . $id . ";";
		$nombre_resiudo = $this->db->query($sql)->result();

		return $nombre_resiudo[0]->residuo;
	}

	public function get_nombre_dest($id){
		$sql = "SELECT tr.residuo
				FROM residuos_peligrosos as r, tipo_residuos as tr
				WHERE r.id_tipo_residuo = tr.id_tipo_residuo and r.id_residuo_peligroso =" . $id . ";";
		$nombre_resiudo = $this->db->query($sql)->result();

		return $nombre_resiudo[0]->residuo;
	}

	public function get_nombre_modalidad($id){
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
				m.modalidad as sig_manejo,
				et.nombre_empresa as emp_tran,
				r.dest_final as dest_final,
				r.resp_tec as resp_tec,
				et.no_autorizacion_transportista as no_aut_transp,
				r.no_aut_dest_final as no_aut_dest_final,
				r.folio_manifiesto as folio,
				b.id_persona as id_persona

			FROM 
				residuos_peligrosos as r
					LEFT JOIN areas a ON (r.id_area = a.id_area)
					LEFT JOIN tipo_modalidad m ON (r.id_tipo_modalidad = m.id_tipo_modalidad)
					LEFT JOIN tipo_emp_transportista et ON (r.id_tipo_emp_transportista = et.id_tipo_emp_transportista)
					LEFT JOIN tipo_emp_destino ed ON (r.id_tipo_emp_destino = ed.id_tipo_emp_destino),
				bitacora as b, 
				tipo_residuos as tr

			WHERE
				r.id_residuo_peligroso = b.id_bitacora  and 
				r.id_tipo_residuo = tr.id_tipo_residuo and
				b.id_persona = {$id_persona}" )->result();
	}

	public function get_bitacora($id_bitacora){
		return $this->db->where('id_residuo_peligroso',$id_bitacora)
						->from('residuos_peligrosos')
						->get()
						->row();
	 }

	public function inserta_residuo($data) {	
		//Bloquear tabla para no tomar otros valores
		$sql = "LOCK TABLES `residuos_peligrosos` WRITE;";
		$this->db->query($sql);

		$data['residuo'] = $this->_tipo_residuo($data['residuo']);
	 	$data['area_generacion'] = $this->_area($data['area_generacion']);
	 	$data['emp_tran'] = $this->_emp_tran($data['emp_tran']);
	 	$data['dest_final'] = $this->_emp_dest($data['dest_final']);
	 	$data['sig_manejo'] = $this->_modalidad($data['sig_manejo']);

		$sql = "UNLOCK TABLES;";
		$this->db->query($sql);

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
						->set('tipo_bitacora'				,$data['tipo_bitacora'])
						->set('fecha_insercion'				,$data['fecha_insercion'])
						->set('folio_manifiesto'			,$data['folio_manifiesto'])
						->set('fecha_insercion'				,$data['folio_manifiesto'])
						->insert('residuos_peligrosos');
	}

	public function actualizar_registro($data) {

		$sql = "LOCK TABLES `residuos_peligrosos` WRITE;";
		$this->db->query($sql);

		$data['residuo'] = $this->_tipo_residuo($data['residuo']);
	 	$data['area_generacion'] = $this->_area($data['area_generacion']);
	 	$data['emp_tran'] = $this->_emp_tran($data['emp_tran']);
	 	$data['dest_final'] = $this->_emp_dest($data['dest_final']);
	 	$data['sig_manejo'] = $this->_modalidad($data['sig_manejo']);

		$sql = "UNLOCK TABLES;";
		$this->db->query($sql);		
						
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
						->set('tipo_bitacora'				,$data['tipo_bitacora'])
						->set('fecha_insercion'				,$data['fecha_insercion'])
						->set('folio_manifiesto'			,$data['folio_manifiesto'])
						->set('fecha_insercion'				,$data['folio_manifiesto'])
						->where('id_residuo_peligroso'		,$data["id_residuo_peligroso"])
						->update('residuos_peligrosos');
	}		

	

	 public function update_residuos($id_residuo_peligroso,
									 $fecha_salida,
									 $sig_manejo,
									 $nombre_empresa,
									 $no_autorizacion_trans,
									 $folio_manifiesto,
									 $destino_final,
									 $no_autorizacion_dest,
									 $resp_tec){
		return $this->db->set('fecha_salida',$fecha_salida)
						->set('sig_manejo',$sig_manejo)
						->set('emp_tran',$nombre_empresa)
						->set('no_aut_transp',$no_autorizacion_trans)
						->set('folio_manifiesto',$folio_manifiesto)
						->set('dest_final',$destino_final)
						->set('no_aut_dest_final',$no_autorizacion_dest)
						->set('resp_tec',$resp_tec)
						->where('id_residuo_peligroso',$id_residuo_peligroso)
						->update('residuos_peligrosos');
	 }
	
	public function delete_residuo($id_residuo_peligroso){
		$this->db->query(" DELETE FROM bitacora where id_bitacora={$id_residuo_peligroso};");
		return $this->db->query(" DELETE FROM residuos_peligrosos where id_residuo_peligroso={$id_residuo_peligroso};");				
	}

	public function _tipo_residuo($otro){

		// Tipo residuo, Insersion de nuevo residuo en tabla tipo.residuos
		if ($otro == "Otro") {
			$this->db->set('clave', $data['clave'])
					 ->set('residuo', $data['otro_residuo'])
					 ->insert('tipo_residuos');

			//Bloquear tabla para no tomar otros valores
			$sql = "LOCK TABLES `tipo_residuos` WRITE;";
			$this->db->query($sql);

			//Obtener id_tipo_residuo
			$sql = "SELECT id_tipo_residuo FROM tipo_residuos order by id_tipo_residuo desc limit 1 ;";
			$result = $this->db->query($sql)->result();

			$id_tipo_residuo = $result[0]->id_tipo_residuo;

			$sql = "UNLOCK TABLES;";
			$this->db->query($sql);

		} else {
			$id_tipo_residuo = $otro;
		}

		return $id_tipo_residuo;

	}

	public function _area($otro){

		// Tipo de area, Insersion de nueva area en tabla areas
		if ($otro == "Otro") {
			$this->db->set('area', $data['otro_area'])
					 ->insert('areas');

			//Bloquear tabla para no tomar otros valores
			$sql = "LOCK TABLES `areas` WRITE;";
			$this->db->query($sql);

			//Obtener id_area
			$sql = "SELECT id_area FROM areas order by id_area desc limit 1 ;";
			$result = $this->db->query($sql)->result();
			$id_area = $result[0]->id_area;

			$sql = "UNLOCK TABLES;";
			$this->db->query($sql);

		} else {
			$id_area = $otro;
		}

		return $id_area;

	}

	public function _emp_tran($otro){

		// Tipo empresa transportista, Insersion de nuevo residui en tabla tipo_emp_transportista
		if ($otro == "Otro") {
			$this->db->set('nombre_empresa', $data['otro_emp'])
					 ->set('no_autorizacion_transportista', $data['no_auto'])
					 ->insert('tipo_emp_transportista');

			//Bloquear tabla para no tomar otros valores
			$sql = "LOCK TABLES `tipo_emp_transportista` WRITE;";
			$this->db->query($sql);

			//Obtener id_tipo_emp_transportista
			$sql = "SELECT id_tipo_emp_transportista FROM tipo_emp_transportista order by id_tipo_emp_transportista desc limit 1 ;";
			$result = $this->db->query($sql)->result();
			$id_tipo_emp_transportista = $result[0]->id_tipo_emp_transportista;
		
			//Desbloquear tabla
			$sql = "UNLOCK TABLES;";
			$this->db->query($sql);

		} else {
			$id_tipo_emp_transportista = $otro;
		}

		return $id_tipo_emp_transportista;

	}

	public function _emp_dest($otro){
		// Tipo empresa destino, Insersion de nuevo destino en tabla tipo_emp_destino
		if ($otro == "Otro") {
			$this->db->set('nombre_destino', $data['otro_dest'])
					 ->set('no_autorizacion_destino', $data['no_auto_dest'])
					 ->insert('tipo_emp_transportista');

			//Bloquear tabla para no tomar otros valores
			$sql = "LOCK TABLES `tipo_emp_destino` WRITE;";
			$this->db->query($sql);

			//Obtener id_tipo_emp_destino
			$sql = "SELECT id_tipo_emp_destino FROM tipo_emp_destino order by id_tipo_emp_destino desc limit 1 ;";
			$result = $this->db->query($sql)->result();
			$id_tipo_emp_destino = $result[0]->id_tipo_emp_destino;

			$sql = "UNLOCK TABLES;";
			$this->db->query($sql);

		} else {
			$id_tipo_emp_destino = $otro;
		}

		return $id_tipo_emp_destino;
	}

	public function _modalidad($otro){

		// Tipo modalidad, Insersion de nuevo destino en tabla tipo_modalidad
		if ($otro == "Otro") {
			$this->db->set('modalidad', $data['otro_modalidad'])
					 ->insert('tipo_modalidad');

			//Bloquear tabla para no tomar otros valores
			$sql = "LOCK TABLES `tipo_modalidad` WRITE;";
			$this->db->query($sql);

			//Obtener id_tipo_emp_destino
			$sql = "SELECT id_tipo_modalidad FROM tipo_modalidad order by id_tipo_modalidad desc limit 1 ;";
			$result = $this->db->query($sql)->result();
			$id_tipo_modalidad = $result[0]->id_tipo_modalidad;
		
			$sql = "UNLOCK TABLES;";
			$this->db->query($sql);
		} else {
			$id_tipo_modalidad = $otro;
		}

		return $id_tipo_modalidad;
	}



 }


