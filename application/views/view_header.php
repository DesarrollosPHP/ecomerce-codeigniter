<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="POS(Punto de venta)">
    <meta name="author" content="Ing. Manuel Cortes Crisanto">
    <link rel="icon" type="image/<?php echo EXTENSION_IMAGEN_FAVICON; ?>" href="<?php echo base_url()?>img/<?php echo NOMBRE_IMAGEN_FAVICON; ?>" />

    <title><?php echo TITULO_PAGINA; ?></title>
    <!-- Bootstrap core CSS -->
    <link href="<?php echo base_url()?>css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <script type="text/javascript" src="<?php echo base_url()?>js/jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url()?>js/bootstrap.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>js/jquery.dataTables.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>js/JsValidacion.js"></script>
    <script type="text/javascript" src="<?php echo base_url()?>js/treeMenu.js"></script> 
    <link href="<?php echo base_url()?>css/dashboard.css" rel="stylesheet">
	  <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>css/menu.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>css/Tablas.css">
    <link rel="stylesheet" href="<?php echo base_url()?>css/iconos/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo base_url()?>css/jquery-ui.css"> 
  </head>

  <body>

    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Menus</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="<?php echo base_url()?>login"><?php echo NOMBRE_EMPRESA; ?></a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
            <li><a><?php echo 'Bienvenido: <strong>'.$this->session->userdata('NOMBRE').' '.$this->session->userdata('APELLIDOS').'</strong>&nbsp;|&nbsp;';
              echo 'Tipo Usuario: <strong>'.$this->session->userdata('TIPOUSUARIOMS').'</strong>&nbsp;|&nbsp;';
             ?></a></li>
            <li><a href="">Mis Datos</a></li>
             <li><a href="<?php echo base_url().'login/CerrarSesion'; ?>">Salir</a></li>
          </ul>
        </div>
      </div>
    </nav>

    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
          
		  <div id="treeMenu">
			<br/>
  <h2>Menú Principal</h2>
  <hr/>
        <ul>
          <?php
            $contador  = 0;
            $LineaTemp = 0;
            $IdMenu    = 0;
			session_start();
            $ArrayMenu = $_SESSION['Menu'];
            foreach ($ArrayMenu as $key => $value) {
              # code...
                $linea    = $value->Linea;
                $url      = $value->URL;
                $IdMenu   = $value->IdMenu;
                if($linea==1){
                  $LineaTemp = $value->IdMenu;
                  echo '<li>';
                  echo '<a href="#" class="parent">'.$value->Descripcion.'</a><span></span>';
                  echo '<div>';
                  echo '<ul>';
                }
                if($linea == $LineaTemp){ 
                  echo '<li><span></span><a href="'.base_url().$url.'">'.$value->Descripcion.'</a></li>';
                }
                if($url == "usuarios" or $url == "ventas" or $url == "ordencompra" or $url == "reportes"){
                  echo '</ul>';
                  echo '</div>';
                  echo '</li>'; 
                }
            }
           ?>
        </ul>
		<hr/>
		
		<br/>
</div>
		  
		  
        </div>
        <div class="col-md-offset-2 main">
		<br/><br/>
    