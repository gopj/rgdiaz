<div class="span9">
	<legend><center>Nuevo Registro</center></legend>
	<form id="form_bitacora_residuo_peligroso" action="<?php echo site_url('administrador/guardar_registro_nueva'); ?>" method="post">
	<div class="well">
		<br>
		<div class="form-horizontal">
			<div class="control-group">
				<label for="" class="control-label">Residuo peligoso:</label>
				<div class="controls">
					<div class="form-inline">
						<select id="residuo" class="txt"  style="width:60%;" name="residuo" type="text" onchange="otro_residuo_peligroso(this.value);" 
						 oninvalid="this.setCustomValidity('Selecciona residuo peligoso')"
						oninput="setCustomValidity('')"  required>
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
				</div>
			</div>
			<div class="control-group">
				<label for="" class="control-label">Otro:</label>
				<div class="controls">
					<div class="form-inline"  style="margin-bottom:10px;">
						<input type="text" class="txt" style="width:58%" name="otro_residuo" id="otro_residuo" disabled  oninvalid="this.setCustomValidity('Ingresa nombre de residuo peligroso')" required	>
						&nbsp;
						<label for="">Clave:</label>
						<input type="text" class="txt" style="width:19%" name="clave" id="clave" disabled  oninvalid="this.setCustomValidity('Ingresa clave de residuo peligoso')" required>
					</div>
				</div>
			</div>
			<div class="control-group">
				<label for="" class="control-label">Cantidad:</label>
				<div class="controls">
					<div class="form-inline">
						<input type="number" id="cantidad" class="txt" style="width:58%;" name="cantidad" min="1" oninvalid="this.setCustomValidity('Ingresa cantidad que sea mayor a 0')"
						oninput="setCustomValidity('')" required>
						&nbsp;
						<label for="unidad1" class="radio">
							<input type="radio" id="unidad1" name="unidad" value="Kg"  oninvalid="this.setCustomValidity('Selecciona Kilogramos o Toneladas')" onclick="clearValidity('unidad1')" required>Kg
						</label>
						&nbsp;
						<label for="unidad2" class="radio">
							<input type="radio" name="unidad" value="Ton" onclick="clearValidity('unidad1')"> Ton
						</label>
					</div>
				</div>
			</div>
			<div class="control-group">
				<label for="" class="control-label">Característica de peligrosidad:</label>
				<div class="controls">
					<div class="form-inline">
<<<<<<< HEAD
						<label for="check1" class="checkbox">
							<input type="checkbox" id="check1" name="caracteristica[]" value="Toxico" oninvalid="this.setCustomValidity('Selecciona característica de peligrosidad')" onclick="clearRequired();" required="required">Toxico
						</label>
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<label for="check2" class="checkbox">
							<input type="checkbox" name="caracteristica[]" value="Inflamable" onclick="clearRequired();">Inflamable
						</label>
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<label for="check3" class="checkbox">
							<input type="checkbox" name="caracteristica[]" value="Corrosivo" onclick="clearRequired();">Corrosivo
						</label>
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<label for="check4" class="checkbox">
							<input type="checkbox" name="caracteristica[]" value="Reactivo" onclick="clearRequired();">Reactivo
=======
						<label for="caracteristica1" class="checkbox">
							<input type="checkbox" name="caracteristica[]" value="Toxico" oninvalid="this.setCustomValidity('Selecciona característica de peligrosisdad')" onclick="setCustomValidity('')" required>Tóxico
						</label>
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<label for="caracteristica2" class="checkbox">
							<input type="checkbox" name="caracteristica[]" value="Inflamable" onclick="setCustomValidity('')">Inflamable
						</label>
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<label for="caracteristica3" class="checkbox">
							<input type="checkbox" name="caracteristica[]" value="Corrosivo" onclick="setCustomValidity('')">Corrosivo
						</label>
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<label for="caracteristica4"class="checkbox">
							<input type="checkbox" name="caracteristica[]" value="Reactivo" onclick="setCustomValidity('')">Reactivo
>>>>>>> master
						</label>
					</div>
				</div>
			</div>
			<div class="control-group">
				<label for="" class="control-label">Area de generacion:</label>
				<div class="controls">
					<div class="form-inline">
<<<<<<< HEAD
						<select id="area_generacion" class="txt" name="area_generacion" onchange="otra_area_generacion(this.value);" style="width:60%" required oninvalid="this.setCustomValidity('Selecciona área de generación')"
						oninput="setCustomValidity('')">
=======
						<select id="area_generacion" class="txt" name="area_generacion" onchange="otra_area_generacion(this.value);" style="width:60%"  oninvalid="this.setCustomValidity('Selecciona área de generación')" oninput="setCustomValidity('')" required>
>>>>>>> master
							<option value="">Seleccione una opción</option>
							<?php foreach ($areas as $row) {
								echo "<option value='{$row->id_area}'> ".   mb_strimwidth($row->area, 0, 55, '...') . "</option>";
							} ?>
							<option value="Otro">Otro</option>
						</select>
						&nbsp;
						<label for="">Otro:</label>
<<<<<<< HEAD
						<input type="text" class="txt" id="otro_area" name="otro_area" style="width:20%" disabled  oninvalid="this.setCustomValidity('Ingresa nueva área de generación')" oninput="setCustomValidity('')" required>
=======
						<input type="text" class="txt" id="otro_area" name="otro_area" style="width:20%" oninvalid="this.setCustomValidity('Ingresa nueva área de generación')" oninput="setCustomValidity('')" required disabled>
>>>>>>> master
					</div>
				</div>
			</div>
			<div class="control-group">
				<label for="fecha_ingreso" class="control-label">Fecha de entrada en almacen:</label>
				<div class="controls">
<<<<<<< HEAD
					<input class="txt" style="width:58%; text-align: center;" name="fecha_ingreso" id="fecha_ingreso" type="text" placeholder="aaaa/mm/dd" data-date-format="yyyy-mm-dd"  oninvalid="this.setCustomValidity('Selecciona fecha de ingreso')" oninput="setCustomValidity('')" required>
=======
					<input class="txt" style="width:58%; text-align: center;" name="fecha_ingreso" id="fecha_ingreso" type="text" placeholder="aaaa/mm/dd" data-date-format="yyyy-mm-dd"  oninvalid="this.setCustomValidity('Selecciona fecha de entrada')" oninput="setCustomValidity('')" required>
>>>>>>> master
				</div>
			</div>
		</div>
	</div>
	<input type="hidden" name="id_persona" value="<?php echo $id_persona; ?>">
	<input type="submit" class="btn btn-primary pull-right" value="Guardar">
	</form>

	<form id="regresar_bitacora" method='post' action="<?php echo site_url('administrador/bitacora');?>">
		<input type="hidden" name="id_persona" value="<?php echo $id_persona; ?>">
		<input class="btn btn-warning pull-left" id="regresar_bitacora"  type="submit" value="Cancelar">
	</form>
</div>

<script type="text/javascript">
	$('#fecha_ingreso').datepicker();
	$('#fecha_salida').datepicker();
</script>