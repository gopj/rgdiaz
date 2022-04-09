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
		<h3 class="breadcrumb-header"> Actualizar Registros - <?php echo $str_act_reg; ?> </h3>
	</div>
	<input type="hidden" id="prev_selected" name="prev_selected" value="<?=$id_persona;?>">
	<div class="card card-white">
		<div id="main-wrapper">
			<div class="card-body">
				<form id="form_actualizar_registros" action="<?=base_url('administrador/actualizar_registros')?>" method="post">
					<div class="well">
						<br>
						<div class="form-horizontal">
							<div class="control-group">
								<label for="fecha_salida" class="control-label">Fecha de salida en almacen:</label>
								<div class="controls">
									<input class="txt" style="width:48%; text-align: center;" name="fecha_salida" id="fecha_salida" type="date" placeholder="MM/DD/AAAA" data-date-format="yyyy-mm-dd" oninvalid="this.setCustomValidity('Selecciona fecha de salida');" onchange="clearDateRequired('fecha_salida')"  required>
								</div>
							</div>
							<div class="control-group">
								<label for="" class="control-label">Nombre y Número de Autorización del Transportista:</label>
								<div class="controls">
									<div class="form-inline" style="margin-bottom:10px;">
										<select class="txt" name="emp_tran" onchange="otra_empresa_transportista(this.value);" style="width:50%" onchange="otro_residuo_peligroso(this.value);" 
										 oninvalid="this.setCustomValidity('Selecciona nombre y número de autorización del Transportista')"
										 oninput="setCustomValidity('')" required>
											<option value="">Seleccione una opción</option>
											<?php foreach ($tipo_emp_transportista as $row) {
												echo "<option value='{$row->id_tipo_emp_transportista}, {$row->no_autorizacion_transportista}'> ".   mb_strimwidth($row->nombre_empresa, 0, 55, '...', 'UTF-8') . "</option>";
											} ?>
											<option value="Otro">Otro</option>
										</select>
										&nbsp;
										<label for="">No. Aut.:</label>
										<label for="" id="lb_autorizacion"></label>
									</div>
									<div class="form-inline">
										<label for="">Otro:</label>
										<input type="text" class="txt" id="otro_empresa" name="otro_emp" style="width:42%" oninvalid="this.setCustomValidity('Ingresa nombre y número de autorización del Transportista')" required oninput="setCustomValidity('')" disabled>
										&nbsp;
										<label for="no_auto">No. Aut.:</label>
										<input type="text" class="txt" id="no_auto" name="no_auto" style="width:27%" oninvalid="this.setCustomValidity('Ingresa número de autorización')" oninput="setCustomValidity('')" required disabled>
									</div>
								</div>
							</div>
							<div class="control-group">
								<label for="folio" class="control-label">Folio del Manifiesto:</label>
								<div class="controls">
									<input type="text" id="folio" name="folio" class="txt" style="width:48%" value="<?= $siguiente_folio ?>" oninvalid="this.setCustomValidity('Ingresa folio del manifiesto')" oninput="setCustomValidity('')" required>
								</div>
							</div>
							<div class="control-group">
								<label for="dest_final" class="control-label">Nombre y Número de Autorización de Centro de Acopio o Destino final:</label>
								<div class="controls">
									<div class="form-inline" style="margin-bottom:10px;">
										<select class="txt" name="dest_final" id="dest_final" onchange="otra_destino(this.value);" style="width:50%" onchange="otro_residuo_peligroso(this.value);" 
										 oninvalid="this.setCustomValidity('Selecciona nombre y número de autorización de centro de acopio o destino final')"
										 oninput="setCustomValidity('')" required>
											<option value="">Seleccione una opción</option>
											<?php foreach ($tipo_emp_destino as $row) {
												echo "<option value='{$row->id_tipo_emp_destino}, {$row->no_autorizacion_destino}'> ".   mb_strimwidth($row->nombre_destino, 0, 55, '...', 'UTF-8') . "</option>";
											} ?>
											<option value="Otro">Otro</option>
										</select>
										&nbsp;
										<label for="">No. Aut.:</label>
										<label for="" id="lb_autorizacion_dest"></label>
									</div>
									<div class="form-inline">
										<label for="otro_dest">Otro:</label>
										<input type="text" class="txt" id="otro_dest" name="otro_dest" style="width:42%" oninvalid="this.setCustomValidity('Ingresa nombre y número de autorización de centro de acopio o destino final')" oninput="setCustomValidity('')" required disabled>
										&nbsp;
										<label for="no_auto_dest">No. Aut.:</label>
										<input type="text" class="txt" id="no_auto_dest" name="no_auto_dest" style="width:27%" oninvalid="this.setCustomValidity('Ingresa número de autorización')" oninput="setCustomValidity('')" required disabled>
									</div>
								</div>
							</div>
							<div class="control-group">
								<label for="sig_manejo" class="control-label">Modalidad de manejo:</label>
								<div class="controls">
									<div class="form-inline"> 
										<select class="txt" name="sig_manejo" id="sig_manejo" onchange="otro_modalidad_trabajo(this.value);" style="width:50%" onchange="otro_residuo_peligroso(this.value);" oninvalid="this.setCustomValidity('Selecciona modalidad de manejo')" oninput="setCustomValidity('')" required>
											<option value="">Seleccione una opción</option>
											<?php foreach ($tipo_modalidad as $row) {
												echo "<option value='{$row->id_tipo_modalidad}'> ".   mb_strimwidth($row->modalidad, 0, 55, '...', 'UTF-8') . "</option>";
											} ?>
											<option value="Otro">Otro</option>
										</select>
										&nbsp;
										<label for="">Otro:</label>
										<input type="text" class="txt" id="otro_modalidad" name="otro_modalidad" style="width:30%" oninvalid="this.setCustomValidity('Ingresa nombre de modalidad de manejo')" oninput="setCustomValidity('')"  required disabled>
									</div>
									
								</div>
							</div>
							<div class="control-group">
								<label for="resp_tec" class="control-label">Nombre del responsable técnico:</label>
								<div class="controls">
									<input class="txt" name="resp_tec" id="resp_tec" type="text" style="width:48%" oninvalid="this.setCustomValidity('Ingresa nombre de responsable técnico')" oninput="setCustomValidity('')" required>
								</div>
							</div>
						</div>
					</div>
					<input type="hidden" name="id_persona" value="<?=$id_persona?>">
					<input type="hidden" name="registros" value="<?=$str_act_reg?>">
					<div class="form-row" style="margin: 15px 0 0px 0;">
						<a href="<?=base_url('administrador/bitacora/'.$id_persona)?>" class="btn btn-warning btn-rounded" type="button">Cancelar</a>
						<input class="btn btn-primary btn-rounded" type="submit" value="Guardar">
					</div>
				</form>
			</div>
		</div>	
	</div>
