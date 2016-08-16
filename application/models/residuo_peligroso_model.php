<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Residuo_peligroso_model extends CI_Model {

public function __construct() 
	 {
		   parent::__construct(); 
		   $this->load->database();
	 }

	 public function inserta_residuo($nombre_residuo,
									 $clave_residuo,
									 $cantidad,
									 $unidad,
									 $caracteristicas_residuos,
									 $area_generacion,
									 $fecha_ingreso,
									 $fecha_salida,
									 $sig_manejo,
									 $nombre_empresa,
									 $no_autorizacion_trans,
									 $folio_m,
									 $destino_final,
									 $no_autorizacion_dest,
									 $resp_tec,
									 $tipo_bitacora,
									 $fecha_insercion)                                                        
	 {
		return $this->db->set('folio_manifiesto',$folio_m)
						->set('residuo',$nombre_residuo)
						->set('clave',$clave_residuo)
						->set('cantidad',$cantidad)
						->set('unidad',$unidad)
						->set('caracteristica',$caracteristicas_residuos)
						->set('area_generacion',$area_generacion)
						->set('fecha_ingreso',$fecha_ingreso)
						->set('fecha_salida',$fecha_salida)
						->set('sig_manejo',$sig_manejo)
						->set('emp_tran',$nombre_empresa)
						->set('no_aut_transp',$no_autorizacion_trans)
						->set('dest_final',$destino_final)
						->set('no_aut_dest_final',$no_autorizacion_dest)
						->set('resp_tec',$resp_tec)
						->set('tipo_bitacora',$tipo_bitacora)
						->set('fecha_insercion',$fecha_insercion)
						->insert('residuos_peligrosos');
	 }

	 public function get_id($fecha_insercion){
		return $this->db->select('id_residuo_peligroso')
						->where('fecha_insercion',$fecha_insercion)
						->from('residuos_peligrosos')
						->get()
						->row();
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
				r.sig_manejo as sig_manejo,
				r.emp_tran as emp_tran,
				r.dest_final as dest_final,
				r.resp_tec as resp_tec,
				r.no_aut_transp as no_aut_transp,
				r.no_aut_dest_final as no_aut_dest_final,
				r.folio_manifiesto as folio,
				b.id_persona as id_persona
			FROM
				residuos_peligrosos as r, 
				bitacora as b, 
				tipo_residuos as tr, 
				areas as a, 
				tipo_modalidad as m
			WHERE 
				b.folio = r.id_residuo_peligroso and 
				r.id_tipo_residuo = tr.id_tipo_residuo and
				a.id_area = r.id_area and
				m.id_tipo_modalidad = r.id_tipo_modalidad and
				b.id_persona = {$id_persona}" )->result();
	}

	public function get_bitacora($id_bitacora){
		return $this->db->where('id_residuo_peligroso',$id_bitacora)
						->from('residuos_peligrosos')
						->get()
						->row();
	 }

	public function actualizar_registro($id_residuo_peligroso,
										$nombre_residuo,
										$clave_residuo,
										$cantidad,
										$unidad,
										$caracteristicas_residuos,
										$area_generacion,
										$fecha_ingreso,
										$fecha_salida,
										$sig_manejo,
										$nombre_empresa,
										$no_autorizacion_trans,
										$folio_manifiesto,
										$destino_final,
										$no_autorizacion_dest,
										$resp_tec,
										$tipo_bitacora,
										$fecha_insercion)
	 {
		return $this->db->set('residuo',$nombre_residuo)
						->set('clave',$clave_residuo)
						->set('cantidad',$cantidad)
						->set('unidad',$unidad)
						->set('caracteristica',$caracteristicas_residuos)
						->set('area_generacion',$area_generacion)
						->set('fecha_ingreso',$fecha_ingreso)
						->set('fecha_salida',$fecha_salida)
						->set('sig_manejo',$sig_manejo)
						->set('emp_tran',$nombre_empresa)
						->set('no_aut_transp',$no_autorizacion_trans)
						->set('dest_final',$destino_final)
						->set('no_aut_dest_final',$no_autorizacion_dest)
						->set('resp_tec',$resp_tec)
						->set('tipo_bitacora',$tipo_bitacora)
						->set('fecha_insercion',$fecha_insercion)
						->set('folio_manifiesto',$folio_manifiesto)
						->where('id_residuo_peligroso',$id_residuo_peligroso)
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

 }


