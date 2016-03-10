<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class ecomerce_login extends CI_Model {

	function __construct()

     {
          parent::__construct();
     }
	 function LoginBD($username)
     {
          $this->db->where('EMAIL', $username);
          return $this->db->get('clientes')->row();
     }
	 public function DatosCliente($id){
		 $this->db->where('ID', $id);
          return $this->db->get('clientes')->row();
	 }
	 
}