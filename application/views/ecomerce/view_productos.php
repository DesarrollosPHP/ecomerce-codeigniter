<div class="features_items"><!--features_items-->
<h2 class="title text-center">Lista de Productos</h2>
 <?php
 	$contador   = 0; 
 	if($Productos){
 		foreach ($Productos as $key => $value) {
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
			<a  onclick="AddCarrito('<?php echo $value->id; ?>',1,'<?php echo (float)$value->precio_venta;?>','<?php echo $value->descripcion; ?>','<?php echo $value->codigo; ?>','1');" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Agregar al Carrito</a>
	<?php
			echo '</div>';
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
 <ul id="pagination-digg">
 	 
	 <?=$pag_links;?>
</ul>
<br/><br/>