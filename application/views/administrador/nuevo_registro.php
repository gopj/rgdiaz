<main role="main" class="container col-md-10">
	<div class="page-title">
		<h3 class="breadcrumb-header"> Nuevo Registro </h3>
	</div>
	<input type="hidden" id="prev_selected" name="prev_selected" value="<?=$id_persona;?>">
	<div class="card card-white">

		<form id="form_bitacora_residuo_peligroso" action="<?=base_url('administrador/guardar_registro_nueva')?>" method="post">
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
										echo "<option value='{$row->id_tipo_residuo}, {$row->clave}'> ". mb_strimwidth($row->residuo, 0, 55, '...', 'UTF-8') . "</option>";
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
								<input type="text" class="txt" style="width:58%" name="otro_residuo" id="otro_residuo"  oninvalid="this.setCustomValidity('Ingresa nombre de residuo peligroso')" required disabled>
								&nbsp;
								<label for="">Clave:</label>
								<input type="text" class="txt" style="width:19%" name="clave" id="clave" oninvalid="this.setCustomValidity('Ingresa clave de residuo peligoso')" required disabled>
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
								<label for="unidad" class="radio">
									<input id="unidad" type="radio" id="unidad" name="unidad" value="Kg"  oninvalid="this.setCustomValidity('Selecciona Kilogramos o Toneladas')" onclick="clearValidity();" required checked>Kg
								</label>
								&nbsp;
								<label for="unidad2" class="radio">
									<input id="unidad2" type="radio" name="unidad" value="Ton" onclick="clearValidity();"> Ton
								</label>
							</div>
						</div>
					</div>
					<div class="control-group">
						<label for="" class="control-label">Característica de peligrosidad:</label>
						<div class="controls">
							<div class="form-inline">
								<label for="check1" class="checkbox">
									<input type="checkbox" id="check1" name="caracteristica[]" value="Toxico" oninvalid="this.setCustomValidity('Selecciona característica de peligrosidad')" onclick="clearRequired();" required="required" checked>Tóxico
								</label>
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								<label for="check2" class="checkbox">
									<input id="check2" type="checkbox" name="caracteristica[]" value="Inflamable" onclick="clearRequired();">Inflamable
								</label>
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								<label for="check3" class="checkbox">
									<input id="check3" type="checkbox" name="caracteristica[]" value="Corrosivo" onclick="clearRequired();">Corrosivo
								</label>
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								<label for="check4"  class="checkbox">
									<input id="check4" type="checkbox" name="caracteristica[]" value="Reactivo" onclick="clearRequired();">Reactivo
								</label>
							</div>
						</div>
					</div>
					<div class="control-group">
						<label for="" class="control-label">Area de generacion:</label>
						<div class="controls">
							<div class="form-inline">
								<select id="area_generacion" class="txt" name="area_generacion" onchange="otra_area_generacion(this.value);" style="width:60%"  oninvalid="this.setCustomValidity('Selecciona área de generación')" oninput="setCustomValidity('')" required>
									<option value="">Seleccione una opción</option>
									<?php foreach ($areas as $row) {
										echo "<option value='{$row->id_area}'> ".   mb_strimwidth($row->area, 0, 55, '...', 'UTF-8') . "</option>";
									} ?>
									<option value="Otro">Otro</option>
								</select>
								&nbsp;
								<label for="">Otro:</label>
								<input type="text" class="txt" id="otro_area" name="otro_area" style="width:20%" oninvalid="this.setCustomValidity('Ingresa nueva área de generación')" oninput="setCustomValidity('')" required disabled>
							</div>
						</div>
					</div>
					<div class="control-group">
						<label for="fecha_ingreso" class="control-label">Fecha de entrada en almacen:</label>
						<div class="controls">
							<input type="date" class="txt" style="width:58%; text-align: center;" name="fecha_ingreso" id="fecha_ingreso"  placeholder="MM/DD/AAAA" data-date-format="yyyy-mm-dd" oninvalid="this.setCustomValidity('Selecciona fecha de entrada');" onchange="clearDateRequired('fecha_ingreso')" lang="es" required>
						</div>
					</div>
				</div>
			</div>

			<div class="form-row" style="margin: 15px 0 0px 0;">
				<input type="hidden" name="id_persona" value="<?=$id_persona?>">

				<a href="<?=base_url('administrador/bitacora/'.$id_persona)?>" class="btn btn-warning btn-rounded" type="button">Cancelar</a>
				<input class="btn btn-primary btn-rounded" type="submit" value="Guardar">
			</div>
		</form>

		
	</div>
</main>

