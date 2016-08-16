<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Archivo_model extends CI_Model {

public function __construct() 
     {
           parent::__construct(); 
           $this->load->database();
     }

     public function registrar_archivo($nombre,$ruta_archivo,$ruta_carpeta_pertenece)
     {
        return $this->db->set('nombre',$nombre)
                        ->set('ruta_archivo',$ruta_archivo)
                        ->set('ruta_carpeta_pertenece',$ruta_carpeta_pertenece)
                        ->insert('archivo');
     }

     public function obtienearchivos($ruta_carpeta)
     {
        return $this->db->where('ruta_carpeta_pertenece',$ruta_carpeta)
                        ->get('archivo');
     }
     
      public function eliminar_archivo($id_archivo)
     {
        return $this->db->where('id_archivo',$id_archivo)
                        ->delete('archivo');
     }

     public function eliminar_archivos($ruta){
        return $this->db->where('ruta_carpeta_pertenece',$ruta)
                        ->delete('archivo');
     }
    
    public function get_archivos($ruta_carpeta) {
        return $this->db->like('ruta_archivo',$ruta_carpeta)
                        ->get('archivo')
                        ->result();
    }

    public function update_rutas($id_archivo,$ruta_archivo_nueva,$ruta_carpeta_pertenece_nueva) {
        return $this->db->where('id_archivo',$id_archivo)
                        ->set('ruta_archivo',$ruta_archivo_nueva)
                        ->set('ruta_carpeta_pertenece',$ruta_carpeta_pertenece_nueva)
                        ->update('archivo');
    }
 }


