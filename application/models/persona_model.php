<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Persona_model extends CI_Model {

	public function __construct() 
	{
		   parent::__construct(); 
		   $this->load->database();
	}

	public function login($correo,$password,$id_status_persona)
	{
		return $this->db->where('correo',$correo)
						->where('password',$password)
						->where('id_status_persona',$id_status_persona)
						->get('persona')
						->row();
	}

	public function verifica_correo($nombre_empresa,$correo){
		return $this->db->where('nombre_empresa',$nombre_empresa)
						->where('correo',$correo)
						->get('persona')
						->row();
	}

	public function recupera_corr($correo){
		return $this->db->where('correo',$correo)
						->get('persona')
						->row();
	}

	public function cambia_psw($psw_nva,$correo){
		return $this->db->set('password',$psw_nva)
						->where('correo',$correo)
						->update('persona');
	}

	public function alta_cliente($correo,$psw_nva,$id_tipo_persona,$id_status_persona,$lleno_datos){
		return $this->db->set('correo',$correo)
				 ->set('password',$psw_nva)
				 ->set('id_tipo_persona',$id_tipo_persona)
				 ->set('id_status_persona',$id_status_persona)
				 ->set('lleno_datos',$lleno_datos)
				 ->insert('persona');
	}

	public function baja_cliente($id_status_persona,$id_persona)
	{
	 $this->db->set('id_status_persona',$id_status_persona)
			  ->where('id_persona',$id_persona)
			  ->update('persona');
	}

	public function obtiene_clientes($id_status_persona,$id_tipo_persona)
	{
			$query = $this->db->where('id_tipo_persona',$id_tipo_persona)
				 ->where('id_status_persona',$id_status_persona)
				 ->get('persona');
		return $query;
	}

	public function obtiene_clientes_baja($id_status_persona,$id_tipo_persona,$lleno_datos){
		$query = $this->db->where('id_status_persona',$id_status_persona)
						  ->where('id_tipo_persona',$id_tipo_persona)
						  ->where('lleno_datos',$lleno_datos)
						  ->get('persona');
		return $query;
	}

	public function obtienetodoclientes($id_tipo_persona,$lleno_datos)
	{
		return $this->db->where('id_tipo_persona',$id_tipo_persona)
						->where('lleno_datos',$lleno_datos)
						->order_by('nombre_empresa','asc')
						->get('persona');
	}

	public function obtiene_cliente($id_persona)
	{
		return $this->db->where('id_persona',$id_persona)
						 ->get('persona')
						 ->row();
	}

	public function obtenerid($correo,$psw_nva)
	{
		return $this->db->where('correo',$correo)
						->where('password',$psw_nva)
						->get('persona')
						->row();
	}

	public function alta_recolector($data){
		return $this->db->set('nombre',				$data['nombre'])
						->set('correo',				$data['correo'])
						->set('password',			$data['clave'])
						->set('id_tipo_persona',	2)
						->set('id_status_persona',	1)
						->set('lleno_datos',		1)
						->insert('persona');
	}

	public function update_recolector($data){
		return $this->db->set('nombre',				$data['nombre'])
						->set('correo',				$data['correo'])
						->set('password',			$data['clave'])
						->where('id_persona',		$data['id_persona'])
						->update('persona');
	}

	public function delete_recolector($id){
		 return $this->db->where('id_persona', $id)
		 		->delete('persona');
	}

	public function get_nombre_cliente($id){
		$result = $this->db->query("SELECT nombre FROM persona WHERE  id_persona = {$id} LIMIT 1;")->result();  

		return $result[0]->nombre;
	}

	public function get_nombre_empresa($id){
		$result = $this->db->query("SELECT nombre_empresa FROM persona WHERE  id_persona = {$id} LIMIT 1;")->result();  

		return $result[0]->nombre_empresa;
	}

	public function get_datos_empresa($id){
		$result = $this->db->query("SELECT * FROM persona WHERE  id_persona = {$id} LIMIT 1;")->result();  

		return $result[0];
	}

		public function get_datos_empresas(){
		$result = $this->db->query("SELECT nombre_empresa FROM persona;")->result();  

		return $result;
	}

	public function regisdatos_persona($nombre,
										$telefono_personal,
										$telefono_personal_alt,
										$password,
										$nombre_empresa,
										$calle_empresa,
										$correo_empresa,
										$cp_empresa,
										$colonia_empresa,
										$numero_empresa,
										$numero_registro_ambiental,
										$id_persona,
										$municipio,
										$estado,
										$telefono_empresa,
										$completo)
	{
		$this->db->set('nombre',$nombre)
				 ->set('telefono_personal',$telefono_personal)
				 ->set('telefono_personal_alt',$telefono_personal_alt)
				 ->set('password',$password)
				 ->set('nombre_empresa',$nombre_empresa)
				 ->set('calle_empresa',$calle_empresa)
				 ->set('correo_empresa',$correo_empresa)
				 ->set('cp_empresa',$cp_empresa)
				 ->set('colonia_empresa',$colonia_empresa)
				 ->set('numero_empresa',$numero_empresa)
				 ->set('estado',$estado)
				 ->set('municipio',$municipio)
				 ->set('lleno_datos',$completo)
				 ->set('telefono_empresa',$telefono_empresa)
				 ->set('numero_registro_ambiental',$numero_registro_ambiental)
				 ->where('id_persona',$id_persona)
				 ->update('persona');
	}

	public function actualizadatos_persona($id_persona,$nombre,$correo,$telefono_personal,$telefono_personal_alt,
											$nombre_empresa,$calle_empresa,$correo_empresa,
											$cp_empresa,$colonia_empresa,$numero_empresa,
											$municipio,$estado,$telefono_empresa, $numero_registro_ambiental)
	{
		$this->db->set('nombre',$nombre)
				 ->set('correo',$correo)
				 ->set('telefono_personal',$telefono_personal)
				 ->set('telefono_personal_alt',$telefono_personal_alt)
				 ->set('nombre_empresa',$nombre_empresa)
				 ->set('calle_empresa',$calle_empresa)
				 ->set('correo_empresa',$correo_empresa)
				 ->set('cp_empresa',$cp_empresa)
				 ->set('colonia_empresa',$colonia_empresa)
				 ->set('numero_empresa',$numero_empresa)
				 ->set('municipio',$municipio)
				 ->set('estado',$estado)
				 ->set('telefono_empresa',$telefono_empresa)
				 ->set('numero_registro_ambiental',$numero_registro_ambiental)
				 ->where('id_persona',$id_persona)
				 ->update('persona');
	 }

	public function inserta_cliente_admin($nombre,$correo,$telefono_personal,$telefono_personal_alt,
										   $psw_nva,$nombre_empresa,$id_status_persona,
										   $id_tipo_persona,$calle_empresa,$correo_empresa,
										   $lleno_datos,$cp_empresa,$colonia_empresa,
										   $numero_empresa, $numero_registro_ambiental, $estado,$municipio,$telefono_empresa){
		return $this->db->set('nombre',$nombre)
						->set('correo',$correo)
						->set('telefono_personal',$telefono_personal)
						->set('telefono_personal_alt',$telefono_personal_alt)
						->set('password',$psw_nva)
						->set('nombre_empresa',$nombre_empresa)
						->set('id_status_persona',$id_status_persona)
						->set('id_tipo_persona',$id_tipo_persona)
						->set('calle_empresa',$calle_empresa)
						->set('correo_empresa',$correo_empresa)
						->set('lleno_datos',$lleno_datos)
						->set('cp_empresa',$cp_empresa)
						->set('colonia_empresa',$colonia_empresa)
						->set('numero_empresa',$numero_empresa)
						->set('estado',$estado)
						->set('municipio',$municipio)
						->set('telefono_empresa',$telefono_empresa)
						->set('numero_registro_ambiental',$numero_registro_ambiental)
						->insert('persona');
	}

	public function getCorreos($id_tipo_persona){
		return $this->db->select('correo')
						->where('id_tipo_persona',$id_tipo_persona)
						->get('persona');
	}

	public function getCorreo($id_persona){
	   $query = $this->db->select('correo')
						 ->where('id_persona',$id_persona)
						 ->get('persona')
						 ->row();
		return $query;
	}

	public function actualiza_datos_admin($id_persona,$nombre,$correo,
										   $telefono_personal,$telefono_personal_alt,$password_contacto,$nombre_empresa,
										   $id_status_persona,$calle_empresa,
										   $correo_empresa,$cp_empresa,$colonia_empresa,
										   $numero_empresa,$municipio,$estado,$telefono_empresa, $numero_registro_ambiental, $identificador_folio){

		$status_ident_folio = $this->db->query('select count(*) as count from rdiaz.persona where identificador_folio=\'' . $identificador_folio . '\';')->row();

		$this->db->set('nombre',$nombre)
					->set('correo',$correo)
					->set('telefono_personal',$telefono_personal)
					->set('telefono_personal_alt',$telefono_personal_alt)
					->set('password',$password_contacto)
					->set('nombre_empresa',$nombre_empresa)
					->set('id_status_persona',$id_status_persona)
					->set('calle_empresa',$calle_empresa)
					->set('correo_empresa',$correo_empresa)
					->set('cp_empresa',$cp_empresa)
					->set('colonia_empresa',$colonia_empresa)
					->set('numero_empresa',$numero_empresa)
					->set('municipio',$municipio)
					->set('estado',$estado)
					->set('telefono_empresa',$telefono_empresa)
					->set('numero_registro_ambiental',$numero_registro_ambiental)
					->where('id_persona',$id_persona)
					->update('persona');
		
		if ($status_ident_folio->count == 0) {
			return $this->db->set('identificador_folio',$identificador_folio)
						->where('id_persona',$id_persona)
						->update('persona');
			
		} else {
			return 'Folio duplicado, favor de elejir otro nombre';
		}
		
	}

	public function update_password($id_persona,$password){
		return $this->db->where('id_persona',$id_persona)
						->set('password',$password)
						->update('persona');
	}

	public function get_nombre($id_persona){
		return $this->db->select('nombre_empresa')
						->where('id_persona',$id_persona)
						->get('persona')
						->row();
	}

	public function update_persona($id_persona,$status){
		return $this->db->set('id_status_persona',$status)
						->where('id_persona',$id_persona)
						->update('persona');
	}

	public function get_recolector_vehicle($id_persona){
		return $this->db->where('id_persona', $id_persona)
						 ->get('persona')->row();
	}

	public function update_vehiculo_recolector($data){
		return $this->db->set('cp_empresa',$data['id_vehiculo'])
						->where('id_persona',$data['id_user'])
						->update('persona');
	}

	public function get_recolectores(){
		return $this->db->where('id_tipo_persona', 2)
						 ->get('persona');
	}

	public function get_recolector($id){
		return $this->db->where('id_tipo_persona', 2)
						->where('id_persona', $id)
						->get('persona')->row();
	}

 }



