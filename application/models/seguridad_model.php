<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class seguridad_model extends CI_Model {
	
     public function SessionActivo($url){
          if($this->session->userdata('is_logged_in')){

          }else{
               redirect(base_url()."login");
          }
     }
}
?>