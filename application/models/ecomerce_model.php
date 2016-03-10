<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class ecomerce_model extends CI_Model {

	function __construct()

     {
          parent::__construct();
     }
     public function CountProductos(){
     	 return $this->db->count_all_results('productos');
     }
	 public function MisPedidos($cliente){
		 $sql="select * from documentos where CLIENTE='".$cliente."' and TIPO='Pedido' ORDER BY fecha DESC";
		$query=$this->db->query($sql);
		return $query->result();
	 }
     public function ListProductos($limit, $offset){
		 	$this->db->limit($limit, $offset);
	      	$query = $this->db->get('productos');
	      	return $query->result();
     }
     public function ProductosNew(){

		$sql="select * from productos ORDER BY fecha DESC limit 9";
		$query=$this->db->query($sql);
		return $query->result();
	}
	public function TraeImagenes(){
		$sql="select * from img_productos  GROUP BY ID_PRODUCTO ORDER BY RAND() ";
		$query=$this->db->query($sql);
		return $query->result();
	}
	public function TraeCategoriaLimit(){
		$sql="select * from categorias ORDER BY RAND() limit 5";
		$query=$this->db->query($sql);
		return $query->result();
	}
	public function Productos(){
		$sql="select * from productos ORDER BY RAND()";
		$query=$this->db->query($sql);
		return $query->result();
	}
	public function CarruselProductos(){
		$sql="select * from productos ORDER BY RAND() limit 9";
		$query=$this->db->query($sql);
		return $query->result();
	}
	public function BuscaProducto($id){
		//$sql="select * from productos where id='".$id."'";
		$sql = "select p.precio_compra, p.id,p.codigo,p.descripcion,p.precio_venta,p.cantidad,c.descripcion as familia, sc.descripcion as subfamilia  from productos as p inner join categorias as c on p.id_categoria=c.id inner join subcategoria as sc on p.id_subcategoria=sc.id where p.id='".$id."'";
		$query=$this->db->query($sql);
		return $query->result();
	}
	public function TraeImagenDetalle($id){
		$sql="select * from img_productos where ID_PRODUCTO='".$id."' ORDER BY RAND() limit 1 ";
		$query=$this->db->query($sql);
		return $query->result();
	}

}