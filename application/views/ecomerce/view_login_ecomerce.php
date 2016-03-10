<script type="text/javascript" src="<?php echo base_url();?>js/JsValidacion.js"></script>
<script src="<?php echo base_url();?>js/JsonClientes.js"></script>
<script> 
var baseurl = "<?php echo base_url(); ?>";

  var codigopostal  = 0;

  var ids           = document.getElementById("id").value;

  ids               = parseInt(ids.length);

  var col           = document.getElementById("col").value;

  if(ids==0){

    codigopostal = 0;

  }else{

    codigopostal = document.getElementById("cps").value;;

  }
</script>
<input type="hidden" value="" id="id" name="id"> 

<input type="hidden" value="0" id="cps" name="cps"> 

<input type="hidden" value="0" id="col" name="col">
<div id="mensaje2"></div>
<section id="form"><!--form-->
		<div class="container">
			<div class="row">
				<div class="col-sm-4 col-sm-offset-1">
					<div class="login-form"><!--login form-->
						<h2>Accede a tu Cuenta</h2>
						<form name="formulario2" id="formulario2" >
							<input type="email" id="txtEmail" required name="txtEmail" placeholder="Email" />
							<input type="password" id="txtPasswordE" required name="txtPasswordE" placeholder="Password" />
							
							<button type="submit" class="btn btn-default">Login</button>
						</form>
					</div><!--/login form-->
				</div>
				<div class="col-sm-1">
					<h2 class="or">OR</h2>
				</div>
				<div class="col-sm-4">
					<div class="signup-form"><!--sign up form-->
						<h2>Registrate!</h2>
						<form name="formulario" id="formulario">
							Usuario:<input type="text" id="Nombre" name="Nombre" placeholder="Nombre" required/>
							Apellidos:<input type="text" id="apellidos" name="apellidos" placeholder="Apellidos" required/>
							Codigo Postal:<input type="text" id="cp" name="cp" placeholder="Codigo Postal" required/>
							Pais:<input type="text" id="pais" name="pais" placeholder="Pais" required/>
							Estado:<input type="text" id="estado" name="estado" placeholder="Estado" required/>
							Municipio:<input type="text" id="municipio" name="municipio" placeholder="Municipio" required/>
							Ciudad:<input type="text" id="ciudad" name="ciudad" placeholder="Ciudad" required/> 
							<input type="hidden" value="0" id="validamail" name="validamail">
							<input type="hidden" value="0" id="validarfc" name="validarfc"> 
							Colonia:
							<select name="colonia" id="colonia">
							<option value='0'>Elige Colonia...</option>
							</select>
							<br/> <br/>
							
							Calle:<input type="text" id="Calle" name="Calle" placeholder="Calle" required/>
							Email:<input type="email" id="email" onblur="validarEmail(this.value);" name="email" placeholder="Email" required/>
							RFC:<input type="text" id="rfc" name="rfc" onblur="validarRFC(this.value);'" placeholder="RFC" required/>
							Telefono:<input type="text" id="telefono" name="telefono" onkeypress="return  validarNumeros(event)" placeholder="Telefono" required/>
							Password:<input type="password" id="password" name="password" placeholder="Password" required/>
							<button type="submit" class="btn btn-default">Registrarme!</button>
						</form>
					</div><!--/sign up form-->
				</div>
			</div>
		</div>
	</section><!--/form-->