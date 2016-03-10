<?php
	$imgmostra = "NoDisponible.gif";
	$descripci = "";
	$codigo    = "";
	$precio    = "";
	$existencia= "";
	$familia   = "";
	$subfamilia= "";
	$id        = "";
	foreach ($DetalleProd as $key => $value) {
		# code...
		$descripci = $value->descripcion;
		$codigo    = $value->codigo;
		$precio    = $value->precio_venta;
		$existencia= $value->cantidad;
		$familia   = $value->familia;
		$subfamilia= $value->subfamilia;
		$id        = $value->id;
	}
	foreach ($imgsproducto as $key => $valueimgs) {
		# code...
		if($id==$valueimgs->ID_PRODUCTO){
			$imgmostra= $valueimgs->IMG;
		}
	} 
 ?>
<div class="product-details"><!--product-details-->
	<div class="col-sm-5">
		<div class="view-product"> 
			<img src="<?php  echo base_url();?>images/products/<?php echo $imgmostra;?>" alt="" />
		</div>
	</div>
	<div class="col-sm-7">
		<div class="product-information"><!--/product-information-->
			<h2><?php echo $descripci; ?></h2>
			<p>SKU: <?php echo $codigo; ?></p> 
			<span>
				<span><small>Mx $<?php echo (float)$precio; ?></small></span>
				<label>Cantidad:</label>
				<input type="number" value="1" id="txtCantidad" name="txtCantidad" />
				<button onclick="AddCarrito('<?php echo $id; ?>',999999,'<?php echo (float)$precio;?>','<?php echo $descripci; ?>','<?php echo $codigo; ?>','1');" type="button" class="btn btn-fefault cart">
					<i class="fa fa-shopping-cart"></i>
					Comprar
				</button>
			</span>
			<p><b>Existencias:</b> <?php echo $existencia; ?> Pzas</p>
			<p><b>Familia:</b> <?php echo $familia; ?></p>
			<p><b>Sub Familia:</b> <?php echo $subfamilia; ?></p>
			 
		</div><!--/product-information-->
	</div>
</div><!--/product-details-->


<div class="recommended_items"><!--recommended_items-->
	<h2 class="title text-center">Productos Recomendados</h2>
	
	<div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
		<div class="carousel-inner">
			<?php
				$contador = 0;
				$cuantos  = 0;
				foreach ($CarruselProd as $key => $carrusel) {
					# code...
					$contador       = $contador + 1;
					$classActive    = "";
					$descr          = strlen($carrusel->descripcion);
					$descripcion    = $carrusel->descripcion;
					if($descr>20){
						$descripcion= substr($carrusel->descripcion,0,20)."..";
					}
					if($contador==1){$classActive=" active";}
					if($cuantos==0){
						echo '<div class="item'.$classActive.'">';
					}
					$cuantos ++; 
					$imgmostra = "NoDisponible.gif";
					foreach ($imgsproducto2 as $key => $valueimgs) {
						# code...
						if($carrusel->id==$valueimgs->ID_PRODUCTO){
							$imgmostra= $valueimgs->IMG;
						}
					}
					echo '<div class="col-sm-4">';
					echo '<div class="product-image-wrapper">';
					echo '<div class="single-products">';
					echo '<div class="productinfo text-center">';
					echo '<img src="'.base_url().'images/products/'.$imgmostra.'" alt="" />';
					echo '<h2>$'.(float)$carrusel->precio_venta.'</h2>';
					echo '<p>'.$descripcion.'</p>';
	?>
					<a onclick="AddCarrito('<?php echo $carrusel->id; ?>',1,'<?php echo (float)$carrusel->precio_venta;?>','<?php echo $carrusel->descripcion; ?>','<?php echo $carrusel->codigo; ?>','1');" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Agregar al Carrito</a>
	<?php
					echo '</div>';
					echo '</div>';
					echo '<div class="choose">';
					echo '<ul class="nav nav-pills nav-justified">';
					echo '<li><a href="'.base_url().'ecomerce/Product_Detail/'.base64_encode($carrusel->id).'"><i class="fa fa-plus-square"></i>Ver Detalles</a></li>';
					echo '</ul>';
					echo '</div>';
					echo '</div>';
					echo '</div>';
					if($cuantos==3){
						$cuantos=0;
						echo '</div>';
					}
				}
			?>
		</div>
		 <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
			<i class="fa fa-angle-left"></i>
		  </a>
		  <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
			<i class="fa fa-angle-right"></i>
		  </a>			
	</div>
</div><!--/recommended_items-->