<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
<script>
var base_url = "<?php echo base_url();?>";
</script>
<script src="<?php echo base_url();?>js/AjaxUpload.js"></script>
 <form method="post" id="formulario" enctype="multipart/form-data">
 <input type="hidden" name="id" value="<?php echo $id; ?>"/>
<h1 class="page-header"><span class="glyphicon glyphicon-th-list"></span> Cargar Imagenes</h1>
<center>
<div id="respuesta"></div>
	<table width="70%">
		<tr>
			<td> 
				<table  class="display table table-bordered table-striped">
					<tr>
						<td>Elige Imagen:</td>
						<td><?php echo form_upload('file') ?></td>
						<td><?php echo form_submit('submit','Subir Imagen',' class="btn btn-success"') ?></td>
					</tr>
				</table> 
			</td>
		</tr>
	</table>
</center>
</form>