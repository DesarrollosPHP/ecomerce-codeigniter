<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
date_default_timezone_set('America/Mexico_City');
class ecomerce extends CI_Controller {

	function __construct(){
		parent::__construct(); 
		$this->load->model('categorias_model');
		$this->load->model('ecomerce_model');
		$this->load->model('ecomerce_login');
		$this->load->model('ordencompra_model');
		$this->load->library('pagination');
	}
	public function index(){ 
          $this->load->view('constant');
          $data['categorias'] = $this->categorias_model->ListarCategorias();
          $data['subcategoria'] = $this->categorias_model->ListarSubCategorias();
          //Productos
          $data['productosnew']= $this->ecomerce_model->ProductosNew();
          $data['imgsproducto']= $this->ecomerce_model->TraeImagenes();
          $data['TraeCatLimit']= $this->ecomerce_model->TraeCategoriaLimit();
          $data['ProductoCat'] = $this->ecomerce_model->Productos();
          $data['CarruselProd']= $this->ecomerce_model->CarruselProductos();
          $this->load->view('ecomerce/view_header',$data);
          $this->load->view('ecomerce/view_ecomerce',$data);
          $this->load->view('ecomerce/view_footer'); 
	}
	public function Productos($offset=''){
		  $this->load->view('constant');
          $data['categorias'] = $this->categorias_model->ListarCategorias();
          $data['subcategoria'] = $this->categorias_model->ListarSubCategorias();
          //
          $this->load->view('ecomerce/view_header',$data);
          $this->load->view('ecomerce/view_list_productos');
          $this->load->view('ecomerce/view_footer'); 
	}
	public function Pagina_Productos($offset=''){
		   //
		  $limit                = 9; 
	      $data['Productos']    = $this->ecomerce_model->ListProductos($limit, $offset);
	      $config['base_url']   = base_url().'ecomerce/Pagina_Productos/';
	      $config['total_rows'] = $this->ecomerce_model->CountProductos();
	      $config['per_page']   = $limit;
	      $config['uri_segment']= '3';
	      $this->pagination->initialize($config);
	      $data['pag_links']    = $this->pagination->create_links(); 
	      $data['imgsproducto'] = $this->ecomerce_model->TraeImagenes();
          $this->load->view('ecomerce/view_productos',$data);
	}
	public function Product_Detail($id){
		  $id = base64_decode($id);
		  $this->load->view('constant');
          $data['categorias'] = $this->categorias_model->ListarCategorias();
          $data['subcategoria'] = $this->categorias_model->ListarSubCategorias();
          //
          $data['DetalleProd'] = $this->ecomerce_model->BuscaProducto($id);
           $data['imgsproducto']= $this->ecomerce_model->TraeImagenDetalle($id);
           $data['CarruselProd']= $this->ecomerce_model->CarruselProductos();
           $data['imgsproducto2']= $this->ecomerce_model->TraeImagenes();
          $this->load->view('ecomerce/view_header',$data);
          $this->load->view('ecomerce/view_detail',$data);
          $this->load->view('ecomerce/view_footer'); 
	}
	public function DeleteCarrito(){
		$this->cart->destroy();
		$add = array("Msg"=>"Se Elimino al Carrito Correctamente");
		echo json_encode($add);
	}
	public function AddToCarrito(){ 
		$Carrito = json_decode($this->input->post('MiCarrito'));
		$Cantidad= $Carrito->Cantidad;
		$idProduc= $Carrito->Id;
		$Precio  = $Carrito->Precio;
		$Descrip = $Carrito->Descripc;
		$Control = $Carrito->Control;
		
		$row     = array();
		if($cart = $this->cart->contents()){
			foreach($cart as $item){
				if($item['id'] === $idProduc){
					$cant   = ($item['qty']+$Cantidad);
					if($Control==3){
						$cant = $Cantidad;
					} 
					$row    = array('rowid' => $item['rowid'],
					'price' => $item['price'],
					'qty'   =>$cant
					);
					break;
				}
			}
		}
		if($row){
			$this->cart->update($row);
		}else{
			$insert = array(
			'id' => $idProduc,
			'qty' => $Cantidad,
			'price' => $Precio,
		    'name'=>convert_accented_characters($Descrip) // para quitar los acentos	    
			);
			$this->cart->insert($insert); 
		}
		$add = array();
		if($Cantidad=="-1"){
			$add = array("Msg"=>"Se Elimino al Carrito Correctamente");
		}else{
			$add = array("Msg"=>"Agregado al Carrito Correctamente");
		}
		
		echo json_encode($add);
		
	}
	public function Carrito(){
		$this->load->view('constant');
        $data['categorias'] = $this->categorias_model->ListarCategorias();
        $data['subcategoria'] = $this->categorias_model->ListarSubCategorias();
		$this->load->view('ecomerce/view_header',$data);
        $this->load->view('ecomerce/view_carrito');
        $this->load->view('ecomerce/view_footer'); 
	}
	public function RealizaPedido(){
		if($this->cart->total_items()>0){
				//Creamos Pedido
				$impuesto      = 16;
				$iva 		   = ($this->cart->total() * 0.16);
				$total    	   = $this->cart->total() + $iva;
				$arrayDocumento= array(
				"TIPO"				=>"Pedido", 
				"FECHA"				=>date('Y-m-j H:i:s'),
				"CLIENTE"			=>$this->session->userdata('ID'),
				"BASEIMPUESTO"		=>$impuesto,
				"TOTAL_IMPUESTO"	=>$iva,
				"BRUTO"				=>$this->cart->total(),
				"TOTAL"				=>$total,
				"USUARIO"			=>$this->session->userdata('ID')
				);
				$saveOrderDocument = $this->ordencompra_model->saveOrderDocumento($arrayDocumento);
				if($saveOrderDocument!=0){
					foreach ($this->cart->contents() as $items):
						$Id            = $items['rowid'];
						$Clave         = "";
						$Descripcion   = "";
						$Costo         = "";
						$DetalleProd   = $this->ecomerce_model->BuscaProducto($Id);
						foreach ($DetalleProd as $key => $value){
							# code...
							$Descripcion = $value->descripcion;
							$Clave       = $value->codigo;
							$Costo      = $value->precio_compra;
						}
						
						$arrayPartidas = array(
						"ID_LINK"			=> $saveOrderDocument,
						"TIPO"				=> "Pedido",
						"FECHA"				=> date('Y-m-j H:i:s'),
						"CLIENTE"			=> $this->session->userdata('ID'),
						"CLAVE"				=> $Clave,
						"COSTO"				=> $Costo,
						"PRECIO"			=> $items['price'],
						"DESCRIPCION"		=> $Descripcion,
						"SALIDAS"			=> $items['qty']
						);
						$this->ordencompra_model->saveOrderPartidas($arrayPartidas);
					endforeach;
				}
				$this->cart->destroy();
				$this->load->view('constant');
				$data['categorias'] = $this->categorias_model->ListarCategorias();
				$data['subcategoria'] = $this->categorias_model->ListarSubCategorias();
				$data['Pedidos']       = "<div class='alert alert-success'>El Pedido <strong>".$saveOrderDocument."</strong>, se Creo Correctamente, Revisa Tu Correo</div>";
				$this->load->view('ecomerce/view_header',$data);
				$this->load->view('ecomerce/view_pedido',$data);
				$this->load->view('ecomerce/view_footer'); 
				

				$configGmail = array(
					'protocol'  => 'smtp',
					'smtp_host' => 'ssl://smtp.gmail.com',
					'smtp_port' => 465,
					'smtp_user' => 'mimail@gmail.com',
					'smtp_pass' => 'mipassword',
					'mailtype'  => 'html',
					'charset'   => 'utf-8',
					'newline'   => "\r\n"
				);    
				$this->email->initialize($configGmail);
				$this->email->from('desarrollosphp8@gmail.com','Sistema Ecomerce');
				$this->email->to($this->session->userdata('EMAIL'));
				$this->email->subject('Pedido Nº:'.$saveOrderDocument);
				$this->email->message('Se Creo el Pedido:<strong>'.$saveOrderDocument.'</strong>');
				$this->email->send();
		}else{
				$this->load->view('constant');
				$data['categorias'] = $this->categorias_model->ListarCategorias();
				$data['subcategoria'] = $this->categorias_model->ListarSubCategorias();
				$data['Pedidos']       = "<div class='alert alert-danger'>No has Comprado Nada para enviar Pedido</div>";
				$this->load->view('ecomerce/view_header',$data);
				$this->load->view('ecomerce/view_pedido',$data);
				$this->load->view('ecomerce/view_footer'); 
		}
	}
	public function VerPedidos(){
		if($this->session->userdata('is_logged_in')){
			
			$this->load->view('constant');
			$data['categorias'] 	= 	$this->categorias_model->ListarCategorias();
			$data['subcategoria']   = $this->categorias_model->ListarSubCategorias();
			$data['Pedidos']       = $this->ecomerce_model->MisPedidos($this->session->userdata('ID'));
			$this->load->view('ecomerce/view_header',$data);
			$this->load->view('ecomerce/view_list_pedidos',$data);
			$this->load->view('ecomerce/view_footer'); 
		}else{
			redirect(base_url());
		}
	}
	public function Pedido(){
		if($this->session->userdata('is_logged_in')){
			$TipoUsuario = $this->session->userdata('TIPOUSUARIOMS');
			$IdCliente   = $this->session->userdata('ID');
			if($TipoUsuario=="Cliente"){
				$this->load->view('constant');
				$data['categorias'] = $this->categorias_model->ListarCategorias();
				$data['subcategoria'] = $this->categorias_model->ListarSubCategorias();
				$data['MisDatosClient'] = $this->ecomerce_login->DatosCliente($IdCliente);
				$this->load->view('ecomerce/view_header',$data);
				$this->load->view('ecomerce/view_detailt_pedido',$data);
				$this->load->view('ecomerce/view_footer'); 
			}else{
				$this->load->view('constant');
				$data['categorias'] = $this->categorias_model->ListarCategorias();
				$data['subcategoria'] = $this->categorias_model->ListarSubCategorias();
				$this->load->view('ecomerce/view_header',$data);
				$this->load->view('ecomerce/view_login_ecomerce');
				$this->load->view('ecomerce/view_footer'); 
			}
          }else{
                $this->load->view('constant');
				$data['categorias'] = $this->categorias_model->ListarCategorias();
				$data['subcategoria'] = $this->categorias_model->ListarSubCategorias();
				$this->load->view('ecomerce/view_header',$data);
				$this->load->view('ecomerce/view_login_ecomerce');
				$this->load->view('ecomerce/view_footer'); 
          }
	}
	public function Logout(){
		$this->session->sess_destroy();
		redirect(base_url());
	}
	public function LoginOut(){
		if($this->session->userdata('is_logged_in')){
			redirect(base_url());
		}else{
			$this->load->view('constant');
			$data['categorias'] = $this->categorias_model->ListarCategorias();
			$data['subcategoria'] = $this->categorias_model->ListarSubCategorias();
			$this->load->view('ecomerce/view_header',$data);
			$this->load->view('ecomerce/view_login_ecomerce');
			$this->load->view('ecomerce/view_footer');
		}
		 
	}
	public function Login(){
		//$Login 		= json_decode($this->input->post('LoginPost'));
		$Login      = json_decode('{"Email":"crisant_89@hotmail.com","Password":"1234"}');
		$response = array (
				"login"     => false,
				"campo"     => "",
	            "error_msg" => ""
	    );
		$user = $this->ecomerce_login->LoginBD($Login->Email);
		if(count($user) == 1){
			$crypt     = crypt($Login->Password, $user->PASSWORD); 
			if($user->PASSWORD==$crypt){
				$session = array(
                'ID'           => $user->ID,
				'NOMBRE'       => $user->NOMBRE,
				'APELLIDOS'    => $user->APELLIDOS,
				'EMAIL'        => $Login->Email,
				'TIPOUSUARIO'  => 3,
				'TIPOUSUARIOMS'=> "Cliente",
				'RFC'          => $user->RFC,
				'is_logged_in' => TRUE,                 
				);
				
				$this->session->set_userdata($session);
				//$this->Pedido;
				
				$response["login"] = true;
				$response["error_msg"] = "<div class='alert alert-danger text-center' alert-dismissable><button type='button' class='close' data-dismiss='alert'>&times;</button>Login</div>";
			}else{
				$response["error_msg"]   = "<div class='alert alert-danger text-center' alert-dismissable><button type='button' class='close' data-dismiss='alert'>&times;</button>La Contraseña Contraseña es Invalida  </div>";
			}
		}else{
			$response["error_msg"]   = "<div class='alert alert-danger text-center' alert-dismissable><button type='button' class='close' data-dismiss='alert'>&times;</button>El Email es Invalida </div>";
		}
		echo json_encode($response);
	}

}