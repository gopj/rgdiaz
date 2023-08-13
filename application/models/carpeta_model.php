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

    public function get_folder($id_persona) {
        return $this->db->where('name', $id_persona)
                        ->get('files')
                        ->row();
    }

   public function get_subfolder($parent_id) {
      return $this->db->where('parent_id', $parent_id)
                        ->get('files')
                        ->result();
   }

   public function get_old_parent($parent_id) {
      if ($parent_id) {
         return $this->db->where('file_id', $parent_id)
                        ->get('files')
                        ->row()->parent_id;
      } else {
         return -1;
      }      
   }

   public function get_folder_id($file_id){
      return $this->db->where('parent_id', $file_id)
                      ->get('files')
                      ->row()->parent_id;;
   }

   public function get_path($data) {
      $array_path = array();
      $full_path = '';

      if ($data['parent_id'] == 0){
         $path = $this->db->where('name', $data['id_persona'])
                        ->get('files')
                        ->row();
         $array_path[] = $path->name;               
      } else {
         while ($data['parent_id'] > 0) {
            $path = $this->db->where('file_id', $data['parent_id'])
                        ->get('files')
                        ->row(); 
            $data['parent_id'] = $path->parent_id;
            $array_path[] = $path->name;
         }
      }
      
      foreach (array_reverse($array_path) as $value) {
         $full_path .= $value . '/';
      }
      
      return $full_path;
   }

   public function create_folder($data){
      return $this->db->set('name', $data["nombre"])
            ->set('type','folder')
            ->set('parent_id', $data["parent_id"])
            ->set('size', '4096')
            ->insert('files');
   }

   public function update_folder($data) {
      return $this->db->where('file_id',$data['parent_id'])
                      ->set('name',$data['new_folder'])
                      ->update('files');
  }

  public function upload_files($data) {
   
   $count_files = count($data['files']);

      for ($i=0; $i < $count_files; $i++) { 

         return $this->db->set('name', $data['files']['name'][$i])
                        ->set('type','file')
                        ->set('parent_id', $data["parent_id"])
                        ->set('size', $data['files']['size'][$i])
                        ->insert('files');
      }
  }
}
