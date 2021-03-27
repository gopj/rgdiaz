<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tran_vehiculo_model extends CI_Model {

	public function __construct() {
		parent::__construct(); 
		$this->load->database();
	}

	public function get_vehiculos(){
		return $this->db->select('*')->get('tran_vehiculos');
	}

	public function get_tipo_vehiculos(){
		return $this->db->select('*')->get('tipo_vehiculos');
	}

	public function get_vehiculo($id){
		return $this->db->where('id_vehiculo', $id)
						->get('tran_vehiculos')
						->row();
	}

	public function alta_vehiculo($data){
		return $this->db->set('modelo',				$data['modelo'])
						->set('marca',				$data['marca'])
						->set('id_tipo_vehiculo',	$data['id_vehiculo'])
						->set('numero_placa',		$data['placa'])
						->set('alias',				$data['alias'])
						->insert('tran_vehiculos');
	}

	public function alta_tipo_vehiculo($data){
		return $this->db->set('nombre_tipo',		$data['tipo_vehiculo'])
						->insert('tipo_vehiculos');
	}

	public function update_vehiculo($data){
		return $this->db->set('modelo',				$data['modelo'])
						->set('marca',				$data['marca'])
						->set('tipo_vehiculo',		$data['id_vehiculo'])
						->set('numero_placa',		$data['placa'])
						->set('alias',				$data['alias'])
						->where('id_vehiculo',		$data['id_vehiculo'])
						->update('tran_vehiculos');
	}

	public function delete_vehiculo($id){
		 return $this->db->where('id_vehiculo', $id)
		 		->delete('tran_vehiculos');
	}

}