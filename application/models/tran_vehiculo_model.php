<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tran_vehiculo_model extends CI_Model {

	public function __construct() {
		parent::__construct(); 
		$this->load->database();
	}

	public function get_vehiculos(){
		return $this->db->select('*')->where('status', 'A')->get('tran_vehiculos');
	}

	public function get_tipo_vehiculos(){
		return $this->db->select('*')->where('status', 'A')->get('tipo_vehiculos');
	}

	public function get_vehiculo($id){
		return $this->db->where('id_vehiculo', $id)
						->where('status', 'A')
						->get('tran_vehiculos')
						->row();
	}

	public function get_folio_vehiculo($id){
		return $this->db->query("
			SELECT 
				trv.id_vehiculo,
				trv.id_tipo_vehiculo,
				tv.nombre_tipo,
				trv.alias,
				trv.numero_placa,
				trv.marca,
				trv.modelo,
				trv.status
			from 
				tran_vehiculos trv,
				tipo_vehiculos tv 
			where 
				tv.id_tipo_vehiculo = trv.id_tipo_vehiculo and
				trv.id_vehiculo={$id};
			")->row();
	}

	public function alta_vehiculo($data){

		if ($data["new_id_tipo"]) {
			$statement = $this->db->set('modelo',	$data['modelo'])
						->set('marca',				$data['marca'])
						->set('id_tipo_vehiculo',	$data['new_id_tipo'])
						->set('numero_placa',		$data['placa'])
						->set('alias',				$data['alias'])
						->insert('tran_vehiculos');
		} else {
			$statement = $this->db->set('modelo',	$data['modelo'])
						->set('marca',				$data['marca'])
						->set('id_tipo_vehiculo',	$data['id_tipo_vehiculo'])
						->set('numero_placa',		$data['placa'])
						->set('alias',				$data['alias'])
						->insert('tran_vehiculos');
		}

		return $statement;
	}

	public function alta_tipo_vehiculo($data){
		$this->db->set('nombre_tipo',	$data['tipo_vehiculo'])
		->insert('tipo_vehiculos');

		return $this->db->insert_id();
	}

	public function update_vehiculo($data){

		if ($data["new_id_tipo"]) {
			$statement = $this->db->set('modelo',			$data['modelo'])
									->set('marca',				$data['marca'])
									->set('id_tipo_vehiculo',	$data['new_id_tipo'])
									->set('numero_placa',		$data['placa'])
									->set('alias',				$data['alias'])
									->where('id_vehiculo',		$data['id_vehiculo'])
									->update('tran_vehiculos');
		} else {
			$statement = $this->db->set('modelo',			$data['modelo'])
									->set('marca',				$data['marca'])
									->set('id_tipo_vehiculo',	$data['id_tipo_vehiculo'])
									->set('numero_placa',		$data['placa'])
									->set('alias',				$data['alias'])
									->where('id_vehiculo',		$data['id_vehiculo'])
									->update('tran_vehiculos');
		}

		return $statement;
	}

	public function delete_vehiculo($id){
		 return $this->db->set('status', 'I')
		 		->where('id_vehiculo', $id)
		 		->update('tran_vehiculos');
	}

}