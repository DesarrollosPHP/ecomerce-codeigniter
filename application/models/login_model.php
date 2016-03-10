<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class login_model extends CI_Model {
	function __construct()
     {
          parent::__construct();
     }
     public function CreaMenu($idUser){
     	$sql ="select U.ID, U.NOMBRE, U.APELLIDOS, AU.Usuario, AU.Proteccion, AU.Estatus, M.Id as IdMenu, M.Linea, ";
     	$sql = $sql." M.Descripcion, M.URL From usuarios as U inner join accesosusuarios as AU on U.ID=AU.Usuario ";
		$sql = $sql." inner join menu as M on AU.Proteccion = M.Id WHERE AU.Usuario='".$idUser."' AND AU.Estatus=1 ORDER BY M.Id ASC";
		$query=$this->db->query($sql);
		return $query->result();
     }
      function LoginBD($username)
     {
          $this->db->where('EMAIL', $username);
          //$this->db->where('PASSWORD', $password);
          return $this->db->get('usuarios')->row();
     }
}