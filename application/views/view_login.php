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
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>css/Tablas.css">
    <script type="text/javascript" src="<?php echo base_url()?>js/jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url()?>js/bootstrap.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url()?>js/JsonLogin.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>js/JsValidacion.js"></script>
    <script type="text/javascript">
    	var baseurl = "<?php echo base_url(); ?>";
    </script>
    </head>
  	<body>
    <div class="container">    
        <div id="loginbox" style="margin-top:50px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">                    
        	<div id="mensaje"></div>
            <div class="panel panel-info" >
                    <div class="panel-heading">
                        <div class="panel-title">Iniciar Sesión</div>
                    </div>     

                    <div style="padding-top:30px" class="panel-body" >
                        <form id="loginform" name="loginform" class="form-horizontal" role="form">
                            <input type="hidden" value="0" id="validamail" name="validamail">
                            <div style="margin-bottom: 25px" class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                <input id="email" type="text" onblur='validarEmail(this.value);' class="form-control" name="email" value="info@desarrollosphp.com">                                        
                            </div>
                                
                            <div style="margin-bottom: 25px" class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                <input id="password" type="password" class="form-control" name="password" value="1234">
                            </div>
                                
                             <div style="margin-top:10px" class="form-group">
                                <div class="col-sm-12 controls">
                                <center>
                                <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-log-in"></span> Iniciar Sesión</button>
                                </center>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12 control">
                                    <div style="border-top: 1px solid#888; padding-top:15px; font-size:85%" ></div>
                                </div>
                            </div>    
                        </form>
                    </div>                     
            </div>  
        </div>
    </div> 
    </body>
	</html>