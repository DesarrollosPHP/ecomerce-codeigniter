<script>
function Continuar(){
	window.location="<?php echo base_url();?>";
}
function Pedido(){
	window.location="<?php echo base_url();?>ecomerce/Pedido"; 
}
</script>

<section id="cart_items">
 <h1>Mis Pedidos</h2>
<div class="table-responsive cart_info">
<table  class="table table-condensed">
<thead>
<tr class="cart_menu">
  
  <th>Pedido</th>
  <th>Cliente</th>
  <th>Fecha</th>
  <th>Total</th>
</tr>
</thead>
<tbody>

<?php
	if($Pedidos){
		foreach($Pedidos as $key => $value){
			echo '<tr>';
			echo '<td>'.$value->ID.'</td>';
			echo '<td>'.$this->session->userdata('NOMBRE')." ".$this->session->userdata('APELLIDOS').'</td>';
			echo '<td>'.$value->FECHA.'</td>';
			echo '<td>'.$this->cart->format_number($value->TOTAL).'</td>';
			echo '</tr>';
		}
	}else{
		echo "<tr>";
		echo "<td colspan='4'><center>No Hay Pedidos</center></td>";
		echo "</tr>";
	}

 ?>
</tbody>
</table>
</div> 
</section>