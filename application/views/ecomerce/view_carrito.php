<script>
function Continuar(){
	window.location="<?php echo base_url();?>";
}
function Pedido(){
	window.location="<?php echo base_url();?>ecomerce/Pedido"; 
}
</script>
<?php echo form_open('path/to/controller/update/function'); ?>
<section id="cart_items">
 
<div class="table-responsive cart_info">
<table  class="table table-condensed">
<thead>
<tr class="cart_menu">
  
  <th>Descripcion</th>
  <th>Cantidad</th>
  <th style="text-align:right">Precio</th>
  <th style="text-align:right">Total</th>
  <th style="text-align:right"></th>
</tr>
</thead>
<tbody>
<?php $i = 1; $contador = 0; ?>

<?php foreach ($this->cart->contents() as $items): ?>

	<?php echo form_hidden($i.'[rowid]', $items['rowid']); ?>

	<tr>
	 <td><?php echo $items['name']; ?></td>
	 <td><?php echo form_input(array('name' => $i.'[qty]', 'value' => $items['qty'], 'maxlength' => '3', 'size' => '4','onblur'=>"AddCarrito('".$items['id']."',this.value,'".$items['price']."','".$items['name']."','".$items['name']."','3');")); ?></td>
	 <td style="text-align:right"><?php echo $this->cart->format_number($items['price']); ?></td>
	 <td style="text-align:right">$ <?php echo $this->cart->format_number($items['subtotal']); ?></td>
	 <td style="text-align:right"><a onclick="AddCarrito('<?php echo $items['id'];?>',1,'<?php echo $items['price'];?>','<?php echo $items['name'];?>','<?php echo $items['name'];?>','2');"><i class="fa fa-plus-square"></i></a> &nbsp; <a onclick="AddCarrito('<?php echo $items['id'];?>',-1,'<?php echo $items['price'];?>','<?php echo $items['name'];?>','<?php echo $items['name'];?>','2');"><i class="fa fa-minus-square"></i></a></td>
	</tr>
<?php $i++; $contador++; ?> 
<?php endforeach; ?> 
<?php if($contador==0){
	echo "<tr>";
	echo "<td colspan='5'><center>No Hay Productos Agregados al Carrito</center></td>";
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
	<td>&nbsp;</td>
</tr>
</tbody>
</table>
</div> 
</section>
<center>
<button type="button" onclick="Continuar()" title="Editar Producto" class="btn btn-default ">
<span class="glyphicon glyphicon-edit"></span>Continuar Comprando
</button>
<button type="button" onclick="Pedido()" title="Editar Producto" class="btn btn-success ">
<span class="glyphicon glyphicon-edit"></span>Realizar Pedido
</button>
<button type="button" onclick="VaciarCarrito();" title="Editar Producto" class="btn btn-danger ">
<span class="glyphicon glyphicon-edit"></span>Vaciar Carrito
</button>
</center>
 <br/>