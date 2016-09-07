<?php
	//Numero de Registros seleccionados
	$nvals = count($actualizar_registros);
	$str_act_reg = "";
	for ($i = 0; $i < $nvals; $i++) {
		if ($i == ($nvals-1)) {
			$str_act_reg .= $actualizar_registros[$i];
		} else {
			$str_act_reg .= $actualizar_registros[$i] . " ";
		}
	}
?>

<div class="span9">
	<legend><center>Actualizar Registros - <?= $str_act_reg; ?> </center></legend>
	<form action="<?php echo site_url('cliente/actualizar_registros'); ?>" method="post">
	<div class="well">
		<br>
		<div class="form-horizontal">
			<div class="control-group">
				<label for="" class="control-label">Fecha de salida en almacen:</label>
				<div class="controls">
					<input class="txt" style="width:48%; text-align: center;" name="fecha_salida" id="fecha_salida" type="text" placeholder="AAAA/MM/DD" data-date-format="yyyy-mm-dd">
				</div>
			</div>
			<div class="control-group">
				<label for="" class="control-label">Nombre y Número de Autorización del Transportista:</label>
				<div class="controls">
					<div class="form-inline" style="margin-bottom:10px;">
						<select class="txt" name="emp_tran" onchange="otra_empresa_transportista(this.value);" style="width:50%">
							<option value="">Seleccione una opción</option>
							<?php foreach ($tipo_emp_transportista as $row) {
								echo "<option value='{$row->id_tipo_emp_transportista}, {$row->no_autorizacion_transportista}'> ".   mb_strimwidth($row->nombre_empresa, 0, 55, '...') . "</option>";
							} ?>
							<option value="Otro">Otro</option>
						</select>
						&nbsp;
						<label for="">No. Aut.:</label>
						<label for="" id="lb_autorizacion"></label>
					</div>
					<div class="form-inline">
						<label for="">Otro:</label>
						<input type="text" class="txt" id="otro_empresa" name="otro_emp" style="width:42%" disabled>
						&nbsp;
						<label for="">No. Aut.:</label>
						<input type="text" class="txt" id="no_auto" name="no_auto" style="width:27%" disabled>
					</div>
				</div>
			</div>
			<div class="control-group">
				<label for="" class="control-label">Folio del Manifiesto:</label>
				<div class="controls">
					<input type="text" name="folio" class="txt" style="width:48%">
				</div>
			</div>
			<div class="control-group">
				<label for="" class="control-label">Nombre y Número de Autorización de Centro de Acopio o Destino final:</label>
				<div class="controls">
					<div class="form-inline" style="margin-bottom:10px;">
						<select class="txt" name="dest_final" onchange="otra_destino(this.value);">
							<option value="">Seleccione una opción</option>
							<?php foreach ($tipo_emp_destino as $row) {
								echo "<option value='{$row->id_tipo_destino}, {$row->no_autorizacion_destino}'> ".   mb_strimwidth($row->nombre_destino, 0, 55, '...') . "</option>";
							} ?>
							<option value="Otro">Otro</option>
						</select>
						&nbsp;
						<label for="">No. Aut.:</label>
						<label for="" id="lb_autorizacion_dest"></label>
					</div>
					<div class="form-inline">
						<label for="">Otro:</label>
						<input type="text" class="txt" id="otro_dest" name="otro_dest" style="width:42%" disabled>
						&nbsp;
						<label for="">No. Aut.:</label>
						<input type="text" class="txt" id="no_auto_dest" name="no_auto_dest" style="width:27%" disabled>
					</div>
				</div>
			</div>
			<div class="control-group">
				<label for="" class="control-label">Modalidad de manejo:</label>
				<div class="controls">
					<div class="form-inline"> 
						<select class="txt" name="sig_manejo" onchange="otro_modalidad_trabajo(this.value);" style="width:50%">
							<option value="">Seleccione una opción</option>
							<?php foreach ($tipo_modalidad as $row) {
								echo "<option value='{$row->id_tipo_modalidad}'> ".   mb_strimwidth($row->modalidad, 0, 55, '...') . "</option>";
							} ?>
							<option value="Otro">Otro</option>
						</select>
						&nbsp;
						<label for="">Otro:</label>
						<input type="text" class="txt" id="otro_modalidad" name="otro_modalidad" style="width:30%" disabled>
					</div>
					
				</div>
			</div>
			<div class="control-group">
				<label for="" class="control-label">Nombre del responsable técnico:</label>
				<div class="controls">
					<input class="txt" name="resp_tec" type="text" style="width:48%">
				</div>
			</div>
		</div>
	</div>
	<input type="hidden" name="id_persona" value="<?php echo $id; ?>">
	<input type="hidden" name="registros" value="<?php echo $str_act_reg ?>">
	<input type="submit" class="btn btn-primary pull-right" value="Guardar">
	<!-- <input type="button" onclick="reg_bit_update();" class="btn btn-primary pull-right" value="Guardar"> -->
	</form>
</div>

<script type="text/javascript">
	$('#fecha_ingreso').datepicker();
	$('#fecha_salida').datepicker();
</script>