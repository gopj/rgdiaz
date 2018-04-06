<div class="span9"> 
<center><legend>Manifiestos</legend></center> 
 
<div class="well"> 

  <form method='post' action="<?php echo site_url('recolector/index');?>"> 
     <div class='input-prepend'>
		<span class='add-on'>
			<img src="<?=base_url();?>/img/glyphicons_003_user.png" class="icon-form">
		</span>
		<select onchange="compruebausuario(this.value)"  id="id_persona" name="id_persona" style="width: 96%;">
			<option value="">Selecciona Cliente</option>

			<?php foreach($tclientes->result() as $row){ ?>
				<option value="<?php echo $row->id_persona;?>"><?php echo $row->nombre_empresa; ?></option>
			<?php } ?>
		</select>
	</div>

	<table id="tabla" class="display">
		<thead>
			<tr>
				<th width="15%">Folio</th>
				<th width="65%">Empresa Destino</th>
				<th width="20%">Fecha de Salida</th>
				<th width="20%">Fecha de Salida</th>
			</tr>
		</thead>
	<tbody>
	<?php 
		foreach ($folios->result() as $folio) {
			echo "<tr>";
	?>
				<td>
					<form method='post' action="<?php echo site_url('administrador/versubcarpeta');?>">
						<input type="hidden" value="<?php echo $carpe->id_persona; ?>" name="id_persona"/>
						<input type="hidden" value="<?php echo $carpe->ruta_carpeta; ?>" name="ruta_carpeta" >
						<input class="nombre-carpeta"  type="submit" value="<?php echo $carpe->nombre?>">
					</form>
				</td>
	<?php                                         
			echo "</tr>";
	}
	?>
	</tbody>
	</table>

  </form> 
</div> 
   
</div>