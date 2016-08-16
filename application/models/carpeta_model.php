<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Carpeta_model extends CI_Model {

public function __construct() 
     {
           parent::__construct(); 
           $this->load->database();
     }

     public function registrarcarpeta($nombrecarpeta,$id_persona,$ruta_carpeta,$id_status_carpeta,$ruta_anterior)
     {
        return $this->db->set('nombre',$nombrecarpeta)
                        ->set('id_persona',$id_persona)
                        ->set('ruta_carpeta',$ruta_carpeta)
                        ->set('id_status',$id_status_carpeta)
                        ->set('ruta_anterior',$ruta_anterior)
                        ->insert('carpeta');
     }
     
     public function obtiene_carpetasraiz($id_status_persona,$lleno_datos,$ruta){
        return $this->db->select('persona.nombre_empresa as empresa')
                        ->select('persona.nombre as nombre')
                        ->select('carpeta.ruta_carpeta as ruta_carpeta')
                        ->select('persona.id_persona as id_persona')
                        ->where('id_status_persona',$id_status_persona)
                        ->where('lleno_datos',$lleno_datos)
                        ->where('ruta_anterior',$ruta)
                        ->from('carpeta')
                        ->join('persona','carpeta.id_persona = persona.id_persona')
                        ->get();
     }

      public function obtiene_carpetasraiz_administrador($ruta){
        return $this->db->select('persona.nombre_empresa as empresa')
                        ->select('persona.nombre as nombre')
                        ->select('carpeta.ruta_carpeta as ruta_carpeta')
                        ->select('persona.id_persona as id_persona')
                        ->where('ruta_anterior',$ruta)
                        ->from('carpeta')
                        ->join('persona','carpeta.id_persona = persona.id_persona')
                        ->get();
     }

     public function obtienesubcarpeta($ruta_carpeta)
     {
        return $this->db->where('ruta_anterior',$ruta_carpeta)
                        ->get('carpeta');
     }

     public function obtieneunacarpeta($ruta_carpeta)
     {
        $carpeta=$this->db ->where('ruta_carpeta',$ruta_carpeta)
                           ->get('carpeta')
                           ->row();
        $anterior=$carpeta->ruta_anterior;
        return $anterior;
    
     }

      public function eliminar_carpeta($id_carpeta)
     {
        return $this->db->where('id_carpeta',$id_carpeta)
                        ->delete('carpeta');
     }

     public function obt_carpeta_personal($ruta)
     {
        return $this->db->where('ruta_anterior',$ruta)
                        ->get('carpeta');
     }

     public function eliminar_carpetas($ruta){
        return $this->db->where('ruta_anterior',$ruta)
                        ->delete('carpeta');
     }

     public function obtiene_ruta($id_persona,$ruta_anterior){
        return $this->db->select('ruta_carpeta')
                        ->where('id_persona',$id_persona)
                        ->where('ruta_anterior',$ruta_anterior)
                        ->from('carpeta')
                        ->get()
                        ->row();
     }

    public function update_carpeta($nombre, $ruta_carpeta, $nuevo_nombre) {
        return $this->db->where('nombre',$nombre)
                        ->where('ruta_carpeta',$ruta_carpeta)
                        ->set('nombre',$nuevo_nombre)
                        ->update('carpeta');
    }

    public function get_carpetas($ruta_carpeta) {
        return $this->db->like('ruta_carpeta',$ruta_carpeta)
                        ->get('carpeta')
                        ->result();
    }

    public function update_rutas($id_carpeta,$ruta_carpeta_nueva,$ruta_anterior_nueva) {
        return $this->db->where('id_carpeta',$id_carpeta)
                        ->set('ruta_carpeta',$ruta_carpeta_nueva)
                        ->set('ruta_anterior',$ruta_anterior_nueva)
                        ->update('carpeta');
    }

 }


