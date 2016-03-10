<section id="cart_items">
<div class="table-responsive cart_info">
 <table class="table table-condensed total-result" border=0>
			<tr>
				<td style="text-align:right;font-weight: bold;">Nº. Cliente:</td>
				<td style="text-align:left"><?php echo $MisDatosClient->CODIGO_CLIENTE; ?></td>
				<td style="text-align:right;font-weight: bold;">Nombre:</td>
				<td style="text-align:left"><?php echo $MisDatosClient->NOMBRE." ".$MisDatosClient->APELLIDOS; ?> </td>
				<td style="text-align:right;font-weight: bold;">RFC:</td>
				<td style="text-align:left"><?php echo $MisDatosClient->RFC; ?></td>
			</tr>
			<tr class="shipping-cost">
				<td style="text-align:right;font-weight: bold;">CP:</td>
				<td style="text-align:left"><?php echo $MisDatosClient->CP; ?></td>
				<td style="text-align:right;font-weight: bold;">Direcciòn:</td>
				<td style="text-align:left"><?php echo $MisDatosClient->CALLE.", ".$MisDatosClient->COLONIA.", ".$MisDatosClient->MUNICIPIO.", ".$MisDatosClient->ESTADO.", ".$MisDatosClient->PAIS; ?></td>
				<td style="text-align:right;font-weight: bold;">Telefono:</td>
				<td style="text-align:left"><?php echo $MisDatosClient->TELEFONO; ?></td>
			</tr>
			<tr>
			<td colspan="6"></td>
			</tr>
		</table>
</div>
<div class="table-responsive cart_info">

<table  class="table table-condensed">
<thead>
<tr>
  
  <th>Descripcion</th>
  <th>Cantidad</th>
  <th style="text-align:right">Precio</th>
  <th style="text-align:right">Total</th>
</tr>
</thead>
<tbody>
<?php $i = 1; $contador = 0; ?>

<?php foreach ($this->cart->contents() as $items): ?>

	<?php echo form_hidden($i.'[rowid]', $items['rowid']); ?>

	<tr>
	 <td><?php echo $items['name']; ?></td>
	 <td><?php echo $items['qty']; ?></td>
	 <td style="text-align:right"><?php echo $this->cart->format_number($items['price']); ?></td>
	 <td style="text-align:right">$ <?php echo $this->cart->format_number($items['subtotal']); ?></td>
	 
	</tr>
<?php $i++; $contador++; ?> 
<?php endforeach; ?> 
<?php if($contador==0){
	echo "<tr>";
	echo "<td colspan='4'><center>No Hay Productos Agregados al Carrito</center></td>";
	echo "</tr>";
} ?>
<tr>
	<td colspan="2">&nbsp;</td>
	<td colspan="2">
		<table class="table table-condensed total-result" border=0>
			<tr>
				<td style="text-align:right;font-weight: bold;">Sub-Total</td>
				<td style="text-align:right">$ <?php echo $this->cart->format_number($this->cart->total()); if($contador==0){ echo "0.00";} ?></td>
			</tr>
			<tr class="shipping-cost">
				<td style="text-align:right;font-weight: bold;">IVA</td>
				<td style="text-align:right">$ <?php $iva = ($this->cart->total() * 0.16); echo  $this->cart->format_number($iva); if($contador==0){ echo "0.00";} ?></td>
			</tr>
			 
			<tr>
				<td style="text-align:right;font-weight: bold;">Total</td>
				<td style="text-align:right"><span>$ 
				<?php 
				$iva      = ($this->cart->total() * 0.16);
				$total    = $this->cart->total() + $iva;
				echo  $this->cart->format_number($total);
				if($contador==0){ echo "0.00";}
				?></span></td>
			</tr>
		</table>
	</td>
</tr>
</tbody>
</table>
</div> 
</section>
<center>
<script>
function Pedido(){
	window.location = "<?php echo  base_url(); ?>ecomerce/RealizaPedido";
}
</script>
<button type="button" onclick="Pedido()" title="Editar Producto" class="btn btn-success ">
<span class="glyphicon glyphicon-edit"></span>Enviar Pedido
</button>

</center>
 <br/>