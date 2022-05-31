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
<div class="page-title">
	<h3 class="breadcrumb-header"> Actualizar Registros - <?=$str_act_reg?> </h3>
</div>
	
<div class="card card-white">
	<div id="main-wrapper">
		<div class="card-body">
			<form id="form_actualizar_registros" action="<?=base_url('administrador/actualizar_registros')?>" method="post">
				<div class="form-row">
					<div class="form-group col-md-6">
						<label for="folio" class="col-form-label">Folio del Manifiesto:</label>
						<div class="controls">
							<input type="text" id="folio" name="folio" class="form-control" value="<?=$siguiente_folio?>" >
						</div>
					</div>
					<div class="form-group col-md-6">
						<label for="fecha_salida" class="col-form-label" for="fecha_salida">Fecha de salida en almacen:</label>
						<div class="controls">
							<input class="form-control date-picker" style="text-align: center;" name="fecha_salida" id="fecha_salida" type="date" placeholder="AAAA/MM/DD" data-date-format="yyyy-mm-dd">
						</div>
					</div>
					<div class="form-group col-md-9">
						<label class="col-form-label" for="emp_tran">Nombre y Número de Autorización del Transportista:</label>
						<select class="form-control" name="emp_tran" onchange="otra_empresa_transportista(this.value);">
							<option value="">Seleccione una opción</option>
							<?php foreach ($tipo_emp_transportista as $row) {
								echo "<option value='{$row->id_tipo_emp_transportista}, {$row->no_autorizacion_transportista}'> ".   mb_strimwidth($row->nombre_empresa, 0, 55, '...', 'UTF-8') . "</option>";
							} ?>
							<option value="Otro">Otro</option>
						</select>
					</div>
					<div class="form-group col-md-3">		
						<label class="col-form-label" for="lb_autorizacion">No. Aut.:</label>
						<label for="" id="lb_autorizacion" type="text" class="form-control"></label>
					</div>
					<div class="form-group col-md-9">
						<label for="">Otro:</label>
						<input type="text" class="form-control" id="otro_empresa" name="otro_emp" disabled>
					</div>
					<div class="form-group col-md-3">
						<label for="no_auto">No. Aut. Otro:</label>
						<input type="text" class="form-control" id="no_auto" name="no_auto"  disabled>
					</div>

					<div class="form-group col-md-9">
						<label class="col-form-label" for="dest_final">Nombre y Número de Autorización de Centro de Acopio o Destino final:</label>

						<select class="form-control" name="dest_final" id="dest_final" onchange="otra_destino(this.value);">
							<option value="">Seleccione una opción</option>
							<?php foreach ($tipo_emp_destino as $row) {
								echo "<option value='{$row->id_tipo_emp_destino}, {$row->no_autorizacion_destino}'> ".   mb_strimwidth($row->nombre_destino, 0, 55, '...', 'UTF-8') . "</option>";
							} ?>
							<option value="Otro">Otro</option>
						</select>
					</div>
					<div class="form-group col-md-3">		
						<label class="col-form-label" for="lb_autorizacion_dest">No. Aut.:</label>
						<label for="" id="lb_autorizacion_dest" type="text" class="form-control"></label>
					</div>
					<div class="form-group col-md-9">
						<label for="otro_dest">Otro:</label>
						<input type="text" class="form-control" id="otro_dest" name="otro_dest" disabled>
					</div>
					<div class="form-group col-md-3">	
						<label for="no_auto_dest">No. Aut.:</label>
						<input type="text" class="form-control" id="no_auto_dest" name="no_auto_dest" disabled>
					</div>
						
					<div class="form-group col-md-6">
						<label for="sig_manejo" class="control-label">Modalidad de manejo:</label>

						<select class="form-control" name="sig_manejo" id="sig_manejo" onchange="otro_modalidad_trabajo(this.value)">
							<option value="">Seleccione una opción</option>
							<?php foreach ($tipo_modalidad as $row) {
								echo "<option value='{$row->id_tipo_modalidad}'> ".   mb_strimwidth($row->modalidad, 0, 55, '...', 'UTF-8') . "</option>";
							} ?>
							<option value="Otro">Otro</option>
						</select>
					</div>
					<div class="form-group col-md-3">
						<label for="">Otro:</label>
						<input type="text" class="form-control" id="otro_modalidad" name="otro_modalidad" disabled>
					</div>
							
				
					<div class="form-group col-md-3">
						<label for="resp_tec" class="control-label">Nombre del responsable técnico:</label>
		
						<input class="form-control" name="resp_tec" id="resp_tec" type="text">
					</div>
				
					<input type="hidden" name="id_persona" value="<?php echo $id_persona ?>">
					<input type="hidden" name="registros" value="<?php echo $str_act_reg ?>">
		
					<!-- <input type="button" onclick="reg_bit_update();" class="btn btn-primary pull-right" value="Guardar"> -->
					<div class="form-group col-md-6">
						<a href="<?=base_url('administrador/bitacora/'.$id_persona)?>" class="btn btn-lg btn-block btn-warning" type="button" id="regresar_bitacora"> Cancelar </a>
					</div>
					<div class="form-group col-md-6">
						<input type="submit" class="btn btn-lg btn-block btn-primary" value="Guardar">
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

<script type="text/javascript">
	//$('#fecha_ingreso').datepicker();
	$('#fecha_salida').datepicker();
</script>