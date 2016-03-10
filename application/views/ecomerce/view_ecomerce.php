<div class="features_items"><!--features_items-->
<h2 class="title text-center">Nuevos Productos</h2>
 <?php
 	$contador   = 0; 
 	if($productosnew){
 		foreach ($productosnew as $key => $value) {
 			# code...
 			$descr      = strlen($value->descripcion);
			$descripcion=$value->descripcion;
			if($descr>21){
				$descripcion= substr($value->descripcion,0,21)."...";
			}
			//imagenes
			 
			$imgmostra = "NoDisponible.gif";
			foreach ($imgsproducto as $key => $valueimgs) {
				# code...
				if($value->id==$valueimgs->ID_PRODUCTO){
					$imgmostra= $valueimgs->IMG;
				}
			}
			echo '<div class="col-sm-4">';
			echo '<div class="product-image-wrapper">';
			echo '<div class="single-products">';
			echo '<div class="productinfo text-center">';
			echo '<img src="'.base_url().'images/products/'.$imgmostra.'" alt="" />';
			echo '<h2>$'.(float)$value->precio_venta.'</h2>';
			echo '<p>'.strtoupper($descripcion).'</p>';
?>
			<a onclick="AddCarrito('<?php echo $value->id; ?>',1,'<?php echo (float)$value->precio_venta;?>','<?php echo $value->descripcion; ?>','<?php echo $value->codigo; ?>','1');" class="btn btn-default add-to-cart">
<?php
			echo '<i class="fa fa-shopping-cart"></i>Agregar al Carrito</a>';
			echo '</div>';
			echo '<img src="'.base_url().'lib/images/home/new.png" class="new" alt="" />';
			echo '</div>';
			echo '<div class="choose">';
			echo '<ul class="nav nav-pills nav-justified">';
			echo '<li><a href="'.base_url().'ecomerce/Product_Detail/'.base64_encode($value->id).'"><i class="fa fa-plus-square"></i>Ver Detalles</a></li>';
			echo '</ul>';
			echo '</div>';
			echo '</div>';
			echo '</div>';
 		}
 	}
?>
 </div><!--features_items-->

 <div class="category-tab"><!--category-tab-->
	<div class="col-sm-12">
		<ul class="nav nav-tabs">
			<?php
				$i    	  = 0;
				$arrays   = array();
				foreach ($TraeCatLimit as $key => $CategoriaLimit) {
					# code...
					$tab_activo 		 = "";
					$tab_corto  		 = str_replace(" ","",$CategoriaLimit->descripcion);
					$i 					 = $i + 1;
					$arrays[$i]["index"] =  $CategoriaLimit->id;
					$arrays[$i]["tab"]   =  $tab_corto;
					if($i==1){
						$tab_activo 	 = 'class="active"';
					}
					echo '<li '.$tab_activo.'><a href="#'.$tab_corto.'" data-toggle="tab">'.$CategoriaLimit->descripcion.'</a></li>';
				}
			?>
		</ul>
	</div>
	<div class="tab-content">
		<?php 
		$countTab = 0;
		foreach ($arrays as $value){
			$tabsActiv = "tab-pane fade";
			$countTab  = $countTab + 1;
			if($countTab==1){
				$tabsActiv= "tab-pane fade active in";
			}
			
			echo '<div class="'.$tabsActiv.'" id="'.$value["tab"].'">';
			$countCatProd = 0;
			foreach ($ProductoCat as $key => $ProdCat) {
				# code...
				
				
				if($ProdCat->id_categoria==$value["index"]){
					$countCatProd = $countCatProd + 1;
					if($countCatProd  <= 4){
						$descr      = strlen($ProdCat->descripcion);
						$descripcion=$ProdCat->descripcion;
						if($descr>20){
							$descripcion= substr($ProdCat->descripcion,0,20)."...";
						}
						$imgmostra = "NoDisponible.gif";
						foreach ($imgsproducto as $key => $valueimgs) {
							# code...
							if($ProdCat->id==$valueimgs->ID_PRODUCTO){
								$imgmostra= $valueimgs->IMG;
							}
						}
						echo '<div class="col-sm-3">';
						echo '<div class="product-image-wrapper">';
						echo '<div class="single-products">';
						echo '<div class="productinfo text-center">';
						echo '<img src="'.base_url().'images/products/'.$imgmostra.'" alt="" />';
						echo '<h2>$'.(float)$ProdCat->precio_venta.'</h2>';
						echo '<p>'.strtoupper($descripcion).'</p>';
	?>
						<a onclick="AddCarrito('<?php echo $ProdCat->id; ?>',1,'<?php echo (float)$ProdCat->precio_venta;?>','<?php echo $ProdCat->descripcion; ?>','<?php echo $ProdCat->codigo; ?>','1');" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Agregar al Carrito</a>
	<?php
						echo '</div>';
						echo '</div>';
						echo '<div class="choose">';
						echo '<ul class="nav nav-pills nav-justified">';
						echo '<li><a href="'.base_url().'ecomerce/Product_Detail/'.base64_encode($ProdCat->id).'"><i class="fa fa-plus-square"></i>Ver Detalles</a></li>';
						echo '</ul>';
						echo '</div>';
						echo '</div>';
						echo '</div>';
					}
					
					
				}
				
			}
			echo '</div>';
		}
		?>
	</div>
</div><!--/category-tab-->
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
					foreach ($imgsproducto as $key => $valueimgs) {
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