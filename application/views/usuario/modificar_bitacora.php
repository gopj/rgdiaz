 	<div class="page-title">
	<h3 class="breadcrumb-header"> Actualizar Registro </h3>
</div>
	
<div class="card card-white">
	<div id="main-wrapper">
		<div class="card-body">

			<form id="form_bitacora_residuo_peligroso" action="<?php echo site_url('usuario/update_bitacora_cliente'); ?>" method="post">
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
						<label for="lb_clave" class="col-form-label">Clave:</label>
						<label id="lb_clave" type="text" class="form-control" name="lb_clave"> <?= $bitacora->clave; ?> </label>
					</div>

					<div class="form-group col-md-9">
						<label for="otro_residuo" class="col-form-label">Otro:</label>
						<input type="text" class="form-control" name="otro_residuo" id="otro_residuo" disabled>
					</div>	
					<div class="form-group col-md-3">
						<label for="clave" class="col-form-label">Clave:</label>
						<input type="text" class="form-control" id="clave" name="clave" disabled>
					</div>

					<div class="form-group col-md-6">
						<label for="" class="col-form-label">Cantidad:</label>
						<div class="form-inline">
							<input type="number" id="cantidad" class="form-control" style="width:72%;"value="<?php echo $bitacora->cantidad;?>" name="cantidad" >
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

					<div class="form-group col-md-6">
						<label for="" class="col-form-label">Característica de peligrosidad:</label>
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

					<div class="form-group col-md-6">
						<label for="" class="col-form-label">Area de generacion:</label>
						<select id="area_generacion" class="form-control" name="area_generacion" onchange="otra_area_generacion(this.value);" required>
							<?php foreach ($areas as $row) {
								if ($bitacora->area_generacion == $row->area) {
									echo "<option value='{$row->id_area}' selected> ".   mb_strimwidth($row->area, 0, 55, '...', 'UTF-8') . "</option>";
								} else {
									echo "<option value='{$row->id_area}'> ".   mb_strimwidth($row->area, 0, 55, '...', 'UTF-8') . "</option>";
								}
							} ?>
							<option value="Otro">Otro</option>
						</select>
					</div>	
					<div class="form-group col-md-3">								
						<label for="otro_area" class="col-form-label">Otro:</label>
						<input type="text" class="form-control" id="otro_area" name="otro_area" disabled>
					</div>
					<div class="form-group col-md-3">
						<label for="" class="col-form-label">Fecha en el almacen</label>
						<div class="form-inline">
							<label for="fecha_ingreso">Entrada:</label>
							<input class="form-control" style="width: 33%; text-align: center;" name="fecha_ingreso" id="fecha_ingreso" type="text" placeholder="aaaa/mm/dd" data-date-format="yyyy-mm-dd" value="<?= $bitacora->fecha_ingreso ?>">
							&nbsp;&nbsp;&nbsp;
							<label for="">Salida:</label>
							<input class="form-control" style="width: 33%; text-align: center;" name="fecha_salida" id="fecha_salida" type="text" placeholder="aaaa/mm/dd" data-date-format="yyyy-mm-dd" value="<?= $bitacora->fecha_salida ?>">
						</div>
					</div>

					<div class="form-group col-md-9">
						<label for="emp_tran" class="col-form-label">Nombre y Número de Autorización del Transportista:</label>						
						<select class="form-control" name="emp_tran" onchange="otra_empresa_transportista(this.value);" required>
							<?php foreach ($tipo_emp_transportista as $row) {
								if ($bitacora->emp_tran == $row->nombre_empresa) {
									echo "<option value='{$row->id_tipo_emp_transportista}, {$row->no_autorizacion_transportista}' selected> ".   mb_strimwidth($row->nombre_empresa, 0, 55, '...', 'UTF-8') . "</option>";
								} else {
									echo "<option value='{$row->id_tipo_emp_transportista}, {$row->no_autorizacion_transportista}'> ".   mb_strimwidth($row->nombre_empresa, 0, 55, '...', 'UTF-8') . "</option>";
								}
							} ?>
							<option value="Otro"> Otro</option>
						</select>
					</div>
					<div class="form-group col-md-3">	
						<label for="lb_autorizacion" class="col-form-label">No. Aut.:</label>
						<label type="text" class="form-control" for="lb_autorizacion" id="lb_autorizacion"> <?= $bitacora->no_aut_transp ?> </</label>
					</div>

					<div class="form-group col-md-9">
						<label for=""class="col-form-label">Otro:</label>
						<input type="text" class="form-control" id="otro_empresa" name="otro_emp" disabled required>
					</div>
					<div class="form-group col-md-3">
						<label for="" class="col-form-label">No. Aut.:</label>
						<input type="text" class="form-control" id="no_auto" name="no_auto" disabled required>
					</div>

					<div class="form-group col-md-3">
						<label for="folio" class="col-form-label">Folio del Manifiesto:</label>
						<input type="text" name="folio" class="form-control" value="<?= $bitacora->folio ?>" required>
					</div>
					<div class="form-group col-md-6">
						<label for="sig_manejo" class="col-form-label">Modalidad de manejo:</label>
						<select class="form-control" name="sig_manejo" onchange="otro_modalidad_trabajo(this.value);" required>
							<?php foreach ($tipo_modalidad as $row) {
								if ($bitacora->sig_manejo == $row->modalidad) {
									echo "<option value='{$row->id_tipo_modalidad}' selected> ".   mb_strimwidth($row->modalidad, 0, 55, '...', 'UTF-8') . "</option>";
								} else {
									echo "<option value='{$row->id_tipo_modalidad}'> ".   mb_strimwidth($row->modalidad, 0, 55, '...', 'UTF-8') . "</option>";
								}
							} ?>
							<option value="Otro">Otro</option>
						</select>
								
					</div>
					<div class="form-group col-md-3">
						<label for="">Otro:</label>
						<input type="text" class="form-control" id="otro_modalidad" name="otro_modalidad" disabled required>
					</div>

					<div class="form-group col-md-9">
						<label for="" class="col-form-label">Nombre y Número de Autorización de Centro de Acopio o Destino final:</label>
						<select class="form-control" name="dest_final" onchange="otra_destino(this.value);" required>
							<?php foreach ($tipo_emp_destino as $row) {
								if ($bitacora->dest_final == $row->nombre_destino) {
									echo "<option value='{$row->id_tipo_emp_destino}, {$row->no_autorizacion_destino}' selected> ".   mb_strimwidth($row->nombre_destino, 0, 55, '...', 'UTF-8') . "</option>";
								} else {
									echo "<option value='{$row->id_tipo_emp_destino}, {$row->no_autorizacion_destino}'> ".   mb_strimwidth($row->nombre_destino, 0, 55, '...', 'UTF-8') . "</option>";
								}
							} ?>
							<option value="Otro">Otro</option>
						</select>
					</div>	
					<div class="form-group col-md-3">
						<label for="">No. Aut.:</label>
						<label type="text" class="form-control" id="lb_autorizacion_dest"> <?= $bitacora->no_aut_dest_final ?> </label>
					</div>

					<div class="form-group col-md-9">		
						<label for="otro_dest">Otro:</label>
						<input type="text" class="form-control" id="otro_dest" name="otro_dest" disabled required>
					</div>	
					<div class="form-group col-md-3">
						<label for="no_auto_dest">No. Aut.:</label>
						<input type="text" class="form-control" id="no_auto_dest" name="no_auto_dest" disabled required>
					</div>

					<div class="form-group col-md-3">
						<label for="resp_tec" class="col-form-label">Nombre del responsable técnico:</label>
						<input class="form-control" name="resp_tec" type="text" value="<?= $bitacora->resp_tec ?>" required>
					</div>
					<div class="form-group col-md-9">
						<input type="hidden" name="id_persona" value="<?=$id_persona?>">
						<input type="hidden" name="id_bitacora" value="<?=$id_bitacora?>">
					</div>	

					<div class="form-group col-md-6">
						<a href="<?=base_url('usuario/ver_bitacora/' . $id_persona)?>" class="btn btn-lg btn-block btn-warning" type="button" id="regresar_bitacora"> Cancelar </a>
					</div>
					<div class="form-group col-md-6">	
						<input type="submit" onclick="reg_bit_new();" class="btn btn-lg btn-block btn-primary" value="Guardar">
					</div>	
				</div>	
			</form>
		</div>	
	</div>
</div>

<script type="text/javascript">
	$('#fecha_ingreso').datepicker();
	$('#fecha_salida').datepicker();
</script>