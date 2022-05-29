<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Notificacion_model extends CI_Model {

public function __construct() 
     {
           parent::__construct(); 
           $this->load->database();
     }

     public function registrar_notificacion($ruta_archivo,$id_status_notificacion,$envia,$id_persona)
     {
        return $this->db->set('ruta_archivo',$ruta_archivo)
                        ->set('id_status_notificacion',$id_status_notificacion)
                        ->set('envia',$envia)
                        ->set('recibe',$id_persona)
                        ->insert('notificacion');
     }

     public function obtiene_noticliente($id,$status)
     {
            return $this->db->from('notificacion')
                        ->where('recibe',$id)
                        ->where('id_status_notificacion',$status)
                        ->count_all_results();     
    }

    public function get_new_noti($status,$id){
        return $this->db->from('notificacion')
                        ->where('id_status_notificacion',$status)
                        ->where('recibe',$id)
                        ->get()
                        ->result();
    }

        /*Obtiene todos las rutas de los archivos cuyo status sea 0
        select notificacion.ruta_archivo
        from notificacion
        where id_status_notificacion = 0;*/   
    public function cambia_status_notificacion($status,$id){
        return $this->db->set('id_status_notificacion',$status)
                        ->where('recibe',$id)
                        ->update('notificacion');
    } 
 }


