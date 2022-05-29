<div class="page-title">
	<h3 class="breadcrumb-header"> Nuevo Registo </h3>
</div>
	
<div class="card card-white">
	<div id="main-wrapper">
		<div class="card-body">
			<form id="form_actualizar_registros" action="<?=base_url('usuario/guardar_registro_nueva')?>" method="post">
				<div class="form-row">
					<div class="form-group col-md-9">
						<label class="col-form-label" for="nombre_empresa"> Residuo peligoso:</label>
				
						<select class="form-control" id="residuo" name="residuo" type="text" onchange="otro_residuo_peligroso(this.value);" oninvalid="this.setCustomValidity('Selecciona residuo peligoso')" oninput="setCustomValidity('')" required>
								<option value="">Seleccione una opción</option>
								<?php foreach ($residuos as $row) {
									echo "<option value='{$row->id_tipo_residuo}, {$row->clave}'> ". mb_strimwidth($row->residuo, 0, 55, '...', 'UTF-8') . "</option>";
								} ?>
								<option value="Otro">Otro</option>
						</select>			
					</div>
					<div class="form-group col-md-3">
						<label class="col-form-label" >Clave:</label>
						<label class="form-control" id="lb_clave"></label>
					</div>	

					<div class="form-group col-md-9">
						<label class="col-form-label" for="otro_residuo">Otro:</label>
						<input type="text" class="form-control" name="otro_residuo" id="otro_residuo" oninvalid="this.setCustomValidity('Ingresa nombre de residuo peligroso')" required disabled>
					</div>
					<div class="form-group col-md-3">
						<label class="col-form-label" for="">Clave:</label>
						<input type="text" class="form-control" name="clave" id="clave" oninvalid="this.setCustomValidity('Ingresa clave de residuo peligoso')" required disabled>
					</div>

					<div class="form-group col-md-6">
						<label class="col-form-label" for="cantidad">Cantidad:</label>
						
						<input type="number" id="cantidad" class="form-control"  name="cantidad" min="1" oninvalid="this.setCustomValidity('Ingresa cantidad que sea mayor a 0')"
						oninput="setCustomValidity('')" required>
						<label for="unidad" class="radio">
							<input type="radio" id="unidad" name="unidad" value="Kg" oninvalid="this.setCustomValidity('Selecciona Kilogramos o Toneladas')" onclick="clearValidity();" required checked>Kg
						</label>
						&nbsp;
						<label for="unidad2" class="radio">
							<input type="radio" name="unidad" value="Ton" onclick="clearValidity();"> Ton
						</label>
				
					</div>
					<div class="form-group col-md-6">
						<label class="col-form-label">Característica de peligrosidad:</label>
						<div class="controls">
							<div class="form-inline">
								<label for="check1" class="checkbox">
									<input type="checkbox" id="check1" name="caracteristica[]" value="Toxico" oninvalid="this.setCustomValidity('Selecciona característica de peligrosidad')" onclick="clearRequired();" required="required" checked>Tóxico
								</label>
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								<label for="check2" class="checkbox">
									<input type="checkbox" id="check2" name="caracteristica[]" value="Inflamable" onclick="clearRequired();">Inflamable
								</label>
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								<label for="check3" class="checkbox">
									<input type="checkbox" id="check3" name="caracteristica[]" value="Corrosivo" onclick="clearRequired();">Corrosivo
								</label>
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								<label for="check4" class="checkbox">
									<input type="checkbox" id="check4" name="caracteristica[]" value="Reactivo" onclick="clearRequired();">Reactivo
								</label>
							</div>
						</div>
					</div>
					<div class="form-group col-md-9">
						<label class="col-form-label">Area de generacion:</label>
						<select class="form-control" id="area_generacion" name="area_generacion" onchange="otra_area_generacion(this.value);" oninvalid="this.setCustomValidity('Selecciona área de generación')" oninput="setCustomValidity('')" required>
							<option value="">Seleccione una opción</option>
							<?php foreach ($areas as $row) {
								echo "<option value='{$row->id_area}'> ".   mb_strimwidth($row->area, 0, 55, '...', 'UTF-8') . "</option>";
							} ?>
							<option value="Otro">Otro</option>
						</select>
					</div>
					<div class="form-group col-md-3">
						<label class="col-form-label" for="otro_area">Otro:</label>
						<input class="form-control" type="text" id="otro_area" name="otro_area" oninvalid="this.setCustomValidity('Ingresa nueva área de generación')" oninput="setCustomValidity('')" required disabled>
					</div>

					<div class="form-group col-md-6">
						<label class="col-form-label" for="fecha_ingreso">Fecha de entrada en almacen:</label>
						
						<input class="form-control date-picker" type="date" style="text-align: center;" name="fecha_ingreso" id="fecha_ingreso" placeholder="MM/DD/AAAA" data-date-format="yyyy-mm-dd" oninvalid="this.setCustomValidity('Selecciona fecha de entrada');" onchange="clearDateRequired('fecha_ingreso')"  required>	
					</div>
					<div class="form-group col-md-3">
					</div>

					<div class="form-group col-md-6">
						<input type="hidden" name="id_persona" value="<?=$id_persona?>">
						<a href="<?=site_url('usuario/ver_bitacora')?>" class="btn btn-lg btn-block btn-warning" type="button" id="regresar_bitacora"> Cancelar </a>
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
	$('#fecha_ingreso').datepicker();
	//$('#fecha_salida').datepicker();
</script>