<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tran_vehiculo_model extends CI_Model {

	public function __construct() {
		parent::__construct(); 
		$this->load->database();
	}

	public function get_vehiculos(){
		return $this->db->select('*')->get('tran_vehiculos');
	}

}