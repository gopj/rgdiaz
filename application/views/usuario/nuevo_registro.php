<?php 
//print_r($tipo_emp_transportista);

?>
<div class="span9">
	<legend><center>Nuevo Registro</center></legend>
	<form id="form_bitacora_residuo_peligroso" action="<?php echo site_url('cliente/guardar_registro_nueva'); ?>" method="post">
	<div class="well">
		<br>
		<div class="form-horizontal">
			<div class="control-group">
				<label for="" class="control-label">Residuo peligoso:</label>
				<div class="controls">
					<div class="form-inline" style="margin-bottom:10px;">
						<select id="residuo" class="txt"  style="width:60%;" name="residuo" type="text" onchange="otro_residuo_peligroso(this.value);" required>
							<option value="">Seleccione una opción</option>
							<?php foreach ($residuos as $row) {
								echo "<option value='{$row->id_tipo_residuo}, {$row->clave}'> ". mb_strimwidth($row->residuo, 0, 55, '...') . "</option>";
							} ?>
							<option value="Otro">Otro</option>
						</select>
						&nbsp;
						<label for="">Clave:</label>
						<label style="width:15%;" id="lb_clave"></label>
					</div>
					<div class="form-inline">
						<label for="">Otro:</label>
						<input type="text" class="txt" style="width:52%" name="otro_residuo" id="otro_residuo" disabled>
						&nbsp;
						<label for="">Clave:</label>
						<input type="text" class="txt" style="width:10%" name="clave" id="clave" disabled>
					</div>
				</div>
			</div>
			<div class="control-group">
				<label for="" class="control-label">Cantidad:</label>
				<div class="controls">
					<div class="form-inline">
						<input type="number" id="cantidad" class="txt" style="width:20%;" name="cantidad">
						&nbsp;
						<label for="radio1" class="radio">
							<input type="radio" id="radio1" name="unidad" value="Kg">Kg
						</label>
						&nbsp;
						<label for="radio2" class="radio">
							<input type="radio" id="radio2" name="unidad" value="Ton">Ton
						</label>
					</div>
				</div>
			</div>
			<div class="control-group">
				<label for="" class="control-label">Característica de peligrosidad:</label>
				<div class="controls">
					<div class="form-inline">
						<label for="check1" class="checkbox">
							<input type="checkbox" id="check1" name="caracteristica[]" value="Toxico">Toxico
						</label>
						&nbsp;&nbsp;
						<label for="check2" class="checkbox">
							<input type="checkbox" id="check2" name="caracteristica[]" value="Inflamable">Inflamable
						</label>
						&nbsp;&nbsp;
						<label for="check3" class="checkbox">
							<input type="checkbox" id="check3" name="caracteristica[]" value="Corrosivo">Corrosivo
						</label>
						&nbsp;&nbsp;
						<label for="check4" class="checkbox">
							<input type="checkbox" id="check4" name="caracteristica[]" value="Reactivo">Reactivo
						</label>
					</div>
				</div>
			</div>
			<div class="control-group">
				<label for="" class="control-label">Area de generacion:</label>
				<div class="controls">
					<div class="form-inline">
						<select id="area_generacion" class="txt" name="area_generacion" onchange="otra_area_generacion(this.value);" style="width:40%" required>
							<option value="">Seleccione una opción</option>
							<?php foreach ($areas as $row) {
								echo "<option value='{$row->id_area}'> ".   mb_strimwidth($row->area, 0, 55, '...') . "</option>";
							} ?>
							<option value="Otro">Otro</option>
						</select>
						&nbsp;
						<label for="">Otro:</label>
						<input type="text" class="txt" id="otro_area" name="otro_area" style="width:40%" disabled>
					</div>
				</div>
			</div>
			<div class="control-group">
				<label for="" class="control-label">Fecha en el almacen:</label>
				<div class="controls">
					<div class="form-inline">
						<label for="fecha_ingreso">Entrada:</label>
						<input class="txt" style="width:15%" name="fecha_ingreso" id="fecha_ingreso" type="text" placeholder="aaaa/mm/dd" data-date-format="yyyy-mm-dd">
						&nbsp;
						<label for="">Salida:</label>
						<input class="txt" style="width:15%" name="fecha_salida" id="fecha_salida" type="text" placeholder="aaaa/mm/dd" data-date-format="yyyy-mm-dd">
					</div>
				</div>
			</div>
			<div class="control-group">
				<label for="" class="control-label">Nombre y Número de Autorización del Transportista:</label>
				<div class="controls">
					<div class="form-inline" style="margin-bottom:10px;">
						<select class="txt" name="emp_tran" onchange="otra_empresa_transportista(this.value);" style="width:30%">
							<option value="">Seleccione una opción</option>
							<?php foreach ($tipo_emp_transportista as $row) {
								echo "<option value='{$row->id_tipo_emp_transportista}, {$row->no_autorizacion_transportista}'> ".   mb_strimwidth($row->nombre_empresa, 0, 55, '...') . "</option>";
							} ?>
							<option value="Otro">Otro</option>
						</select>
						&nbsp;
						<label for="">No. de Aut.:</label>
						<label for="" id="lb_autorizacion"></label>
					</div>
					<div class="form-inline">
						<label for="">Otro:</label>
						<input type="text" class="txt" id="otro_empresa" name="otro_emp" style="width:30%" disabled>
						&nbsp;
						<label for="">No. Aut.:</label>
						<input type="text" class="txt" id="no_auto" name="no_auto" style="width:25%" disabled>
					</div>
				</div>
			</div>
			<div class="control-group">
				<label for="" class="control-label">Folio del Manifiesto:</label>
				<div class="controls">
					<input type="text" name="folio" class="txt">
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
						<input type="text" class="txt" id="otro_dest" name="otro_dest" style="width:30%" disabled>
						&nbsp;
						<label for="">No. Aut.:</label>
						<input type="text" class="txt" id="no_auto_dest" name="no_auto_dest" style="width:25%" disabled>
					</div>
				</div>
			</div>
			<div class="control-group">
				<label for="" class="control-label">Modalidad de manejo:</label>
				<div class="controls">
					<div class="form-inline"> 
						<select class="txt" name="sig_manejo" onchange="otro_modalidad_trabajo(this.value);" style="width:40%">
							<option value="">Seleccione una opción</option>
							<?php foreach ($tipo_modalidad as $row) {
								echo "<option value='{$row->id_tipo_modalidad}'> ".   mb_strimwidth($row->modalidad, 0, 55, '...') . "</option>";
							} ?>
							<option value="Otro">Otro</option>
						</select>
						&nbsp;
						<label for="">Otro:</label>
						<input type="text" class="txt" id="otro_modalidad" name="otro_modalidad" style="width:40%" disabled>
					</div>
					
				</div>
			</div>
			<div class="control-group">
				<label for="" class="control-label">Nombre del responsable técnico:</label>
				<div class="controls">
					<input class="txt" name="resp_tec" type="text">
				</div>
			</div>
		</div>
	</div>
	<input type="hidden" name="id_persona" value="<?php echo $id; ?>">
	<input type="button" onclick="reg_bit_new();" class="btn btn-primary pull-right" value="Guardar">
	</form>
</div>

<script type="text/javascript">
	$('#fecha_ingreso').datepicker();
	$('#fecha_salida').datepicker();
</script>