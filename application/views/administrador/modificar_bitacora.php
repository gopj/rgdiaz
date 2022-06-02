<div class="page-title">
	<h3 class="breadcrumb-header"> Actualizar Registro </h3>
</div>
	
<div class="card card-white">
	<div id="main-wrapper">
		<div class="card-body">

			<form id="form_bitacora_residuo_peligroso" action="<?php echo site_url('administrador/update_bitacora_admin'); ?>" method="post">
				<div class="form-row">
					
					<div class="form-group col-md-9">
						<label for="residuo" class="col-form-label">Residuo Peligoso:</label>
						<select id="residuo" class="form-control" name="residuo" type="text" onchange="otro_residuo_peligroso(this.value);" required>
							<?php foreach ($residuos as $row) {
								if ($bitacora->residuo == $row->residuo) {
									echo "<option value='{$row->id_tipo_residuo}, {$row->clave}' selected> " . mb_strimwidth($row->residuo, 0, 55, '...', 'UTF-8') . "</option>";
								} else {
									echo "<option value='{$row->id_tipo_residuo}, {$row->clave}' > " . mb_strimwidth($row->residuo, 0, 55, '...', 'UTF-8') . "</option>";
								}
							} ?>
							<option value="Otro">Otro</option>
						</select>
					</div>
					<div class="form-group col-md-3">	
						<label for="clave" class="col-form-label">Clave:</label>
						<label id="lb_clave" type="text" class="form-control" name="clave"> <?= $bitacora->clave; ?> </label>
					</div>

					<div class="form-group col-md-9">
						<label for="" class="control-label">Otro:</label>
						<input type="text" class="form-control" name="otro_residuo" id="otro_residuo" disabled>
					</div>	
					<div class="form-group col-md-3">
						<label for="">Clave:</label>
						<input type="text" class="form-control" name="clave" id="clave" disabled>
					</div>

					<div class="form-group col-md-3">
						<label for="" class="control-label">Cantidad:</label>
						<div class="controls">
							<div class="form-inline">
								<input type="number" id="cantidad" class="form-control" style="width:58%;"value="<?php echo $bitacora->cantidad;?>" name="cantidad" >
								&nbsp;
								<label for="radio1" class="radio">
									<input type="radio" id="radio1" name="unidad" value="Kg" <?php if($bitacora->unidad == "Kg"){echo "checked";} ?> >Kg
								</label>
								&nbsp;
								<label for="radio2" class="radio">
									<input type="radio" id="radio2" name="unidad" value="Ton" <?php if($bitacora->unidad == "Ton"){echo "checked";} ?> >Ton
								</label>
							</div>
						</div>
					</div>

					<div class="control-group">
						<label for="" class="control-label">Característica de peligrosidad:</label>
						<div class="controls">
							<div class="form-inline">
								<label for="check1" class="checkbox">
									<input type="checkbox" id="check1" name="caracteristica[]" value="Toxico" <?php foreach ($peligrosidad as $row ){if($row == "Toxico"){ echo "checked";}} ?> > Toxico
								</label>
								&nbsp;&nbsp;
								<label for="check2" class="checkbox">
									<input type="checkbox" id="check2" name="caracteristica[]" value="Inflamable" <?php foreach ($peligrosidad as $row ){if($row == "Inflamable"){ echo "checked";}} ?> >Inflamable
								</label>
								&nbsp;&nbsp;
								<label for="check3" class="checkbox">
									<input type="checkbox" id="check3" name="caracteristica[]" value="Corrosivo" <?php foreach ($peligrosidad as $row ){if($row == "Corrosivo"){ echo "checked";}} ?> >Corrosivo
								</label>
								&nbsp;&nbsp;
								<label for="check4" class="checkbox">
									<input type="checkbox" id="check4" name="caracteristica[]" value="Reactivo" <?php foreach ($peligrosidad as $row ){if($row == "Reactivo"){ echo "checked";}} ?> >Reactivo
								</label>
							</div>
						</div>
					</div>

					<div class="control-group">
						<label for="" class="control-label">Area de generacion:</label>
						<div class="controls">
							<div class="form-inline">
								<select id="area_generacion" class="form-control" name="area_generacion" onchange="otra_area_generacion(this.value);" style="width:60%" required>
									<?php foreach ($areas as $row) {
										if ($bitacora->area_generacion == $row->area) {
											echo "<option value='{$row->id_area}' selected> ".   mb_strimwidth($row->area, 0, 55, '...', 'UTF-8') . "</option>";
										} else {
											echo "<option value='{$row->id_area}'> ".   mb_strimwidth($row->area, 0, 55, '...', 'UTF-8') . "</option>";
										}
									} ?>
									<option value="Otro">Otro</option>
								</select>
								&nbsp;
								<label for="">Otro:</label>
								<input type="text" class="form-control" id="otro_area" name="otro_area" style="width:20%" disabled>
							</div>
						</div>
					</div>

					<div class="control-group">
						<label for="" class="control-label">Fecha en el almacen:</label>
						<div class="controls">
							<div class="form-inline">
								<label for="fecha_ingreso">Entrada:</label>
								<input class="form-control" style="width:33%; text-align: center;" name="fecha_ingreso" id="fecha_ingreso" type="text" placeholder="aaaa/mm/dd" data-date-format="yyyy-mm-dd" value="<?= $bitacora->fecha_ingreso ?>">
								&nbsp;
								<label for="">Salida:</label>
								<input class="form-control" style="width:34%; text-align: center;" name="fecha_salida" id="fecha_salida" type="text" placeholder="aaaa/mm/dd" data-date-format="yyyy-mm-dd" value="<?= $bitacora->fecha_salida ?>">
							</div>
						</div>
					</div>

					<div class="control-group">
						<label for="" class="control-label">Nombre y Número de Autorización del Transportista:</label>
						<div class="controls">
							<div class="form-inline" style="margin-bottom:10px;">
								<select class="form-control" name="emp_tran" onchange="otra_empresa_transportista(this.value);" style="width:60%" required>
									<?php foreach ($tipo_emp_transportista as $row) {
										if ($bitacora->emp_tran == $row->nombre_empresa) {
											echo "<option value='{$row->id_tipo_emp_transportista}, {$row->no_autorizacion_transportista}' selected> ".   mb_strimwidth($row->nombre_empresa, 0, 55, '...', 'UTF-8') . "</option>";
										} else {
											echo "<option value='{$row->id_tipo_emp_transportista}, {$row->no_autorizacion_transportista}'> ".   mb_strimwidth($row->nombre_empresa, 0, 55, '...', 'UTF-8') . "</option>";
										}
									} ?>
									<option value="Otro">Otro</option>
								</select>
								&nbsp;
								<label for="">No. Aut.:</label>
								<label for="" id="lb_autorizacion"> <?= $bitacora->no_aut_transp ?> </label>
							</div>
							<div class="form-inline">
								<label for="">Otro:</label>
								<input type="text" class="form-control" id="otro_empresa" name="otro_emp" style="width:52%" disabled required>
								&nbsp;
								<label for="">No. Aut.:</label>
								<input type="text" class="form-control" id="no_auto" name="no_auto" style="width:17%" disabled required>
							</div>
						</div>
					</div>

					<div class="control-group">
						<label for="" class="control-label">Folio del Manifiesto:</label>
						<div class="controls">
							<input type="text" name="folio" class="form-control" value="<?= $bitacora->folio ?>" style="width:58%" required>
						</div>
					</div>

					<div class="control-group">
						<label for="" class="control-label">Nombre y Número de Autorización de Centro de Acopio o Destino final:</label>
						<div class="controls">
							<div class="form-inline" style="margin-bottom:10px;">
								<select class="form-control" name="dest_final" onchange="otra_destino(this.value);" style="width:60%" required>
									<?php foreach ($tipo_emp_destino as $row) {
										if ($bitacora->dest_final == $row->nombre_destino) {
											echo "<option value='{$row->id_tipo_emp_destino}, {$row->no_autorizacion_destino}' selected> ".   mb_strimwidth($row->nombre_destino, 0, 55, '...', 'UTF-8') . "</option>";
										} else {
											echo "<option value='{$row->id_tipo_emp_destino}, {$row->no_autorizacion_destino}'> ".   mb_strimwidth($row->nombre_destino, 0, 55, '...', 'UTF-8') . "</option>";
										}
									} ?>
									<option value="Otro">Otro</option>
								</select>
								&nbsp;
								<label for="">No. Aut.:</label>
								<label for="" id="lb_autorizacion_dest"> <?= $bitacora->no_aut_dest_final ?> </label>
							</div>
							<div class="form-inline">
								<label for="">Otro:</label>
								<input type="text" class="form-control" id="otro_dest" name="otro_dest" style="width:52%" disabled required>
								&nbsp;
								<label for="">No. Aut.:</label>
								<input type="text" class="form-control" id="no_auto_dest" name="no_auto_dest" style="width:17%" disabled required>
							</div>
						</div>
					</div>

					<div class="control-group">
						<label for="" class="control-label">Modalidad de manejo:</label>
						<div class="controls">
							<div class="form-inline">
								<select class="form-control" name="sig_manejo" onchange="otro_modalidad_trabajo(this.value);" style="width:60%" required>
									<?php foreach ($tipo_modalidad as $row) {
										if ($bitacora->sig_manejo == $row->modalidad) {
											echo "<option value='{$row->id_tipo_modalidad}' selected> ".   mb_strimwidth($row->modalidad, 0, 55, '...', 'UTF-8') . "</option>";
										} else {
											echo "<option value='{$row->id_tipo_modalidad}'> ".   mb_strimwidth($row->modalidad, 0, 55, '...', 'UTF-8') . "</option>";
										}
									} ?>
									<option value="Otro">Otro</option>
								</select>
								&nbsp;
								<label for="">Otro:</label>
								<input type="text" class="form-control" id="otro_modalidad" name="otro_modalidad" style="width:20%" disabled required>
							</div>
						</div>
					</div>

					<div class="control-group">
						<label for="" class="control-label">Nombre del responsable técnico:</label>
						<div class="controls">
							<input class="form-control" name="resp_tec" type="text" value="<?= $bitacora->resp_tec ?>" style="width:58%" required>
						</div>
					</div>

					<input type="hidden" name="id_persona" value="<?php echo $id_persona; ?>">
					<input type="hidden" name="id_residuo_peligroso" value="<?php echo $bitacora->id_residuo_peligroso;?>"/>
					<input type="submit" onclick="reg_bit_new();" class="btn btn-primary pull-right" value="Guardar">
				</div>	
			</form>
		</div>	
	</div>
		


	<form id="regresar_bitacora" method='post' action="<?php echo site_url('administrador/bitacora');?>">
		<input type="hidden" name="id_persona" value="<?php echo $id_persona; ?>">
		<input class="btn btn-warning pull-left" id="regresar_bitacora"  type="submit" value="Cancelar">
	</form>
	
</div>
<script type="text/javascript">
	$('#fecha_ingreso').datepicker();
	$('#fecha_salida').datepicker();
</script>