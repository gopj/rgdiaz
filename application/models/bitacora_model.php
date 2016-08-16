 <?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Bitacora_model extends CI_Model {

public function __construct() 
     {
           parent::__construct(); 
           $this->load->database();
     }

     public function get_bitacoras(){
        return $this->db->get('tipo_bitacora');
     }

     public function inserta_bitacora($id,$tipo_bitacora,$folio){
        return $this->db->set('id_persona',$id)
                        ->set('tipo_bitacora',$tipo_bitacora)
                        ->set('folio',$folio)
                        ->insert('bitacora');
     }

 }