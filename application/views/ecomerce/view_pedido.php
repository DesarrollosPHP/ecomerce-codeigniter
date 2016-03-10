<?php echo $Pedidos; ?>
<center>
<button type="button" onclick="Pedido()" title="Editar Producto" class="btn btn-success ">
<span class="glyphicon glyphicon-edit"></span>Ver Mis Pedidos
</button>
</center>
<script>
function Pedido(){
	window.location = "<?php echo  base_url(); ?>ecomerce/VerPedidos";
}
</script>
