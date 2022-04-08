<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Contacto_model extends CI_Model {

public function __construct() 
	 {
		   parent::__construct(); 
		   $this->load->database();
	 }

	 public function insertacontacto($nombre,$telefono,$email,$asunto,$mensaje,$status){
		return $this->db->set('nombre',$nombre)
						->set('telefono',$telefono)
						->set('correo',$email)
						->set('asunto',$asunto)
						->set('mensaje',$mensaje)
						->set('status_contacto',$status)
						->insert('contacto');
	 }

	 public function contador_mensajes($status){
		return $this->db->from('contacto')
						->where('status_contacto',$status)
						->count_all_results();
	 }

	 public function mensajescontacto(){
		return  $this->db->select('contacto.id_contacto as numero')
						 ->select('contacto.mensaje')
						 ->select('contacto.nombre as nombre')
						 ->select('contacto.correo as correo')
						 ->select('contacto.asunto as asunto')
						 ->select('contacto.fecha_mensaje as fecha')
						 ->select('estado.nombre as status')
						 ->from('contacto')
						 ->order_by('numero', 'desc')
						 ->join('status_contacto as estado ','contacto.status_contacto = estado.id_status_contacto')
						 ->get()
						 ->result();
	 }

	public function modifica_status($status_contacto,$id_contacto){
		return $this->db->set('status_contacto',$status_contacto)
						->where('id_contacto',$id_contacto)
						->update('contacto');
	 }

	public function obtienemensaje($id_contacto) {
		return $this->db->where('id_contacto',$id_contacto)
						->get('contacto')
						->row();

	 }

	public function delete_residuo($id){
		return $this->db->query(" DELETE FROM contacto where id_contacto={$id};");                
	}
 }


