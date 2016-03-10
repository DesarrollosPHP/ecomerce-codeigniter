<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="E-Comerce Desarrollado con framework Codeigniter">
    <meta name="author" content="Ing. Manuel Cortes Crisanto">
    <title><?php echo TITULO_ECOMERCE; ?></title>
    <link href="<?php echo base_url()?>lib/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url()?>lib/css/font-awesome.min.css" rel="stylesheet"> 
    <link href="<?php echo base_url()?>lib/css/animate.css" rel="stylesheet">
	<link href="<?php echo base_url()?>lib/css/main.css" rel="stylesheet">
	<link href="<?php echo base_url()?>lib/css/responsive.css" rel="stylesheet">
	<script src="<?php echo base_url()?>lib/js/jquery.js"></script>
	<script>
	function AddCarrito(a,b,c,d,e,f){ 
		var url          = "<?php echo base_url();?>";
		if(b==999999){
			var valor   = document.getElementById("txtCantidad").value;
			b = valor;
		}
		var totalCarrito = "<?php echo $this->cart->total_items() + 1; ?>";
		
		var Carrito 	 = new Object();
		Carrito.Id  	 = a;
		Carrito.Cantidad = b;
		Carrito.Precio   = c;
		Carrito.Descripc = d;
		Carrito.Control  = f;
		var Json = JSON.stringify(Carrito); 
		$.post(url + 'ecomerce/AddToCarrito',
		{ 
			MiCarrito: Json
		},
		function(data, textStatus) {
			 
			$("#Mensaje").html("<div class='alert alert-success'>Producto: <strong>" + e +"</strong>: "+data.Msg+"</div>");
			$('#lblCarrito').text("(" + totalCarrito + ")");
		}, 
		"json"		
		); 
		if(f=="2"){
			window.setInterval("temporizador()",1000);
		}
		if(f=="3"){
			window.setInterval("temporizador()",1000);
		}

		return false;
	}
	function temporizador() { 
		location.reload(true);

	}
	function VaciarCarrito(){
		if(confirm("Estas Seguro de Vaciar el Carrito?")){
			var url          = "<?php echo base_url();?>";
			var Carrito 	 = new Object();
			Carrito.Id  	 = "1";
			var Json = JSON.stringify(Carrito); 
			$.post(url + 'ecomerce/DeleteCarrito',
			{ 
				MiCarrito: Json
			},
			function(data, textStatus) {
				 
				$("#Mensaje").html("<div class='alert alert-danger'>"+data.Msg+"</div>");
				$('#lblCarrito').text("");
			}, 
			"json"		
			); 
			window.setInterval("temporizador()",1000);
			return false;
			
		}
		
	}
	</script>   
    <link rel="icon" type="image/<?php echo EXTENSION_IMAGEN_FAVICON; ?>" href="<?php echo base_url()?>img/<?php echo NOMBRE_IMAGEN_FAVICON; ?>" />
</head><!--/head-->

<body>
	<header id="header"><!--header-->
		
		
		<div class="header-middle"><!--header-middle-->
			<div class="container">
				<div class="row">
					<div class="col-sm-4">
						<div class="logo pull-left"> 
							<a href=""><img src="<?php echo base_url()?>img/logo.png" width="140px" height="39px" alt="" /></a>
						</div>
						
					</div>
					<div class="col-sm-8">
						<div class="shop-menu pull-right">
							<ul class="nav navbar-nav">
								<?php if($this->session->userdata('is_logged_in')){ ?>
								<li><a><strong>Logeado:</strong> <small><?php echo $this->session->userdata('NOMBRE')." ".$this->session->userdata('APELLIDOS');?></small>&nbsp;&nbsp;&nbsp;&nbsp;|</a></li>
								<?php }?>
								<li><a href="<?php echo base_url()?>ecomerce/Carrito"><i class="fa fa-shopping-cart"></i>Mi Carrito <label id="lblCarrito"><?php if($this->cart->total_items()>0){echo "(".$this->cart->total_items().")";}  ?></label></a></li>
								<?php if($this->session->userdata('is_logged_in')){ ?>
								<li><a href="<?php echo base_url()?>ecomerce/VerPedidos"><i class="fa fa-user"></i> Mis Pedidos</a></li>
								<li><a href="<?php echo base_url()?>ecomerce/Logout"><i class="fa fa-user"></i> Cerrar Sesión</a></li>
								<?php }else{ ?>
								<li><a href="<?php echo base_url()?>ecomerce/LoginOut"><i class="fa fa-lock"></i> Login</a></li>
								<?php } ?>
								<li><a href="<?php echo base_url()?>login"><i class="fa fa-lock"></i> Administrar</a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header-middle-->
	
		<div class="header-bottom"><!--header-bottom-->
			<div class="container">
				<div class="row">
					<div class="col-sm-9">
						<div class="navbar-header">
							<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
								<span class="sr-only">Toggle navigation</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
						</div>
						<div class="mainmenu pull-left">
							<ul class="nav navbar-nav collapse navbar-collapse">
								<li><a href="<?php echo base_url()?>" class="active">Inicio</a></li>
								<li class="dropdown"><a href="#">Ecomerce<i class="fa fa-angle-down"></i></a>
                                    <ul role="menu" class="sub-menu">
                                        <li><a href="<?php echo base_url()?>ecomerce/Productos">Productos</a></li> 
										<li><a href="<?php echo base_url()?>ecomerce/Carrito">Mi Carrito</a></li> 
										
                                    </ul>
                                </li> 
								
							</ul>
						</div>
					</div>
					
				</div>
			</div>
		</div><!--/header-bottom-->
	</header><!--/header-->
	
	 
	<section>
		<div class="container">
			<div class="row">
				<div class="col-sm-3">
					<div class="left-sidebar">
						<h2>Categorias</h2>
						<div class="panel-group category-products" id="accordian"><!--category-productsr-->
							<div class="panel panel-default">
							<?php
								if($categorias){
									foreach ($categorias as $key => $value) {
										# code... 
										echo '<div class="panel-heading">';
										echo '<h4 class="panel-title">';
										echo '<a data-toggle="collapse" data-parent="#accordian" href="#'.$value->id.'">';
										echo '<span class="badge pull-right"><i class="fa fa-plus"></i></span>';
										echo $value->descripcion;
										echo '</a>';
										echo '</h4>';
										echo '</div>';
										echo '<div id="'.$value->id.'" class="panel-collapse collapse">';
										echo '<div class="panel-body">'; 
										//
										if($subcategoria){
											foreach ($subcategoria as $key => $value2) {
												# code...
												if($value->id==$value2->id_categoria){
													echo '<ul>';
													echo '<li><a href="#">'.$value2->descripcion.'</a></li>';
													echo '</ul>';
												}
											}
										}
										echo '</div>';
										echo '</div>';
									}
								} 
							?>
								
							</div>
							 
							
						</div><!--/category-products-->
					 
					</div>
				</div>
				
				<div class="col-sm-9 padding-right">
				<div id="Mensaje" ></div>