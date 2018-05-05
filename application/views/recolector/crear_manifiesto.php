<main role="main" class="container" style="padding-top:-10px;">
	<center><h2 class="bd-title" id="content">Crear Manifiesto</h1></center>
	<hr>
	<div class="col-md-12">

		<div class="form-row">
			<div class="form-group col-md-9">
				<label class="col-form-label" for="nombre_empresa"> <center> Empresa Destino </center> </label>
				<select class="form-control" style="width: 100%;">
					<option value="">Selecciona empresa destino</option>
					<?php foreach ($empresa_destino as $key) { ?>
						<option value="<?= $key->id_tipo_emp_destino; ?>"> <?= $key->nombre_destino; ?> </option>
					<?php } ?>
				</select>
			</div>
			<div class="form-group col-md-3">
				<label class="col-form-label" for="numero"> <center> Fecha de Embarque </center> </label>
				<input type="date" class="form-control" id="fecha_salida">
			</div>		
		</div>

		<div class="form-row">
			<div class="form-group col-md-9">
				<label class="col-form-label" for="responsable_tecnico"> <center> Nombre del Responable Técnico</center> </label>
				<input type="text" class="form-control" id="responsable_tecnico">
			</div>		
		</div>


		<div class="form-row">
			<div class="form-group col-md-12">

				<center><h2 class="bd-title" id="content">Recolección de Residuos</h1></center>
				<hr>
				<table id="tabla_residuos" class="table table-striped table-bordered" style="width:100%">
					<thead>
						<tr>
							<th style="width: 390px;">Folio</th>
							<th>Nombre residuo</th>
							<th>CRETI</th>
							<th>Contenedor Cantidad</th>
							<th>Contenedor Tipo</th>
							<th>Cantidad Total</th>
							<th>Unidad Vol/Peso</th>
							<th>Area de Generación</th>
							<th>Modalidad</th>
							<th>Opciones</th>
						</tr>
					</thead>
					<tbody>
							<tr>
								<td> 1 </td>
								<td> sadddddddddddddddddddddddddddd asd asda sd asd sad sad asd asd asd sad asd asd</td>
								<td> T </td>
								<td> </td>
								<td> </td>
								<td> </td>
								<td> </td>
								<td> </td>
								<td> </td>
								<td> </td>
							</tr>
					</tbody>
					
				</table>

			</div>
		</div>
		<div class="form-row">
			<div class="form-group col-md-12">
			</div>
		</div>


		<div class="form-row">
			<div class="form-group col-md-4">
				<button type="submit" class="btn btn-warning btn-lg btn-block" id="agregar_residuos">Cancelar</button>
			</div>
			<div class="form-group col-md-4">
				<button type="submit" class="btn btn-primary btn-lg btn-block" id="agregar_residuos" data-toggle="modal" data-target="#myModal">Agregar Residuo</button>
			</div>
			<div class="form-group col-md-4">
				<button type="submit" class="btn btn-success btn-lg btn-block" id="agregar_residuos">Terminar Manifiesto</button>
			</div>
		</div>


		<!-- The Modal -->
		<div class="modal" id="myModal">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">

				<!-- Modal Header -->
				<div class="modal-header">
					<h4 class="modal-title">Ingresa Resiudo</h4>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>

				<!-- Modal body -->
				<div class="modal-body">
					<div class="form-row">
						<div class="form-group col-md-8">
							<label class="col-form-label" for="nombre_residuo"> Residuo Peligroso </label>
							<select class="form-control">
								<option value="">Selecciona Residuo</option>
							</select>
						</div>	

						<div class="form-group col-md-3">
							<label class="col-form-label" for="nombre_residuo"> Clave </label>
							<input type="text" class="form-control" name="" value="Clave" disabled> 
						</div>	
						<div class="form-group col-md-1">
							<label class="col-form-label" for="otro_resdiuo"> Otro </label>
							<br>
							<label class="switch">
								<input type="checkbox">
								<span class="slider round"></span>
							</label>
						</div>	
					</div>

					<div class="form-row">
						<div class="form-group col-md-4">
							<label class="col-form-label" for="nombre_residuo"> Cantidad Residuo </label>
							<input type="number" class="form-control" id="cantidad" name="cantidad" min="1" oninvalid="this.setCustomValidity('Ingresa cantidad que sea mayor a 0')" oninput="setCustomValidity('')" required>
						</div>	

						<div class="form-group col-md-2">
							<label class="col-form-label" for="nombre_residuo"> Unidad </label>
							<br>
							<div class="form-check form-check-inline">
								<input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1">
								<label class="form-check-label" for="inlineRadio1">Kg</label>
							</div>
							<div class="form-check form-check-inline">
								<input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2">
								<label class="form-check-label" for="inlineRadio2">Ton</label>
							</div>
						</div>	
					</div>

					<div class="form-row">
						<div class="form-group col-md-4">
							<label class="col-form-label" for="nombre_residuo"> Cantidad Tipo </label>
							<input type="number" class="form-control" id="cantidad" name="cantidad" min="1" oninvalid="this.setCustomValidity('Ingresa cantidad que sea mayor a 0')" oninput="setCustomValidity('')" required>
						</div>	

						<div class="form-group col-md-4">
							<label class="col-form-label" for="nombre_residuo"> Tipo </label>
							<br>
							<div class="form-check form-check-inline">
								<input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1">
								<label class="form-check-label" for="inlineRadio1">Bolsa</label>
							</div>
							<div class="form-check form-check-inline">
								<input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2">
								<label class="form-check-label" for="inlineRadio2">Cubeta</label>
							</div>
							<div class="form-check form-check-inline">
								<input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2">
								<label class="form-check-label" for="inlineRadio2">Tambo</label>
							</div>
						</div>	
					</div>

					<div class="form-row">
						<div class="form-group col-md-12">
							<label class="col-form-label" for="nombre_residuo">Caracteristica de Peligrosidad </label>
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<div class="form-check form-check-inline">
								<input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">
								<label class="form-check-label" for="inlineCheckbox1">Tóxico</label>
							</div>
							<div class="form-check form-check-inline">
								<input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="option2">
								<label class="form-check-label" for="inlineCheckbox2">Inflamable</label>
							</div>
							<div class="form-check form-check-inline">
								<input class="form-check-input" type="checkbox" id="inlineCheckbox3" value="option3">
								<label class="form-check-label" for="inlineCheckbox3"> Corrosivo</label>
							</div>
							<div class="form-check form-check-inline">
								<input class="form-check-input" type="checkbox" id="inlineCheckbox3" value="option3">
								<label class="form-check-label" for="inlineCheckbox3"> Reactivo</label>
							</div>
						</div>	
					</div>

					<div class="form-row">
						<div class="form-group col-md-8">
							<label class="col-form-label" for="nombre_residuo"> Area de Generación </label>
							<select class="form-control">
								<option value="">Selecciona Area de Generaión</option>
							</select>
						</div>	

						<div class="form-group col-md-4">
							<label class="col-form-label" for="nombre_residuo"> Otro </label>
							<br>
							<label class="switch">
								<input type="checkbox">
								<span class="slider round"></span>
							</label>
							
						</div>	
					</div>

					<div class="form-row">
						<div class="form-group col-md-8">
							<label class="col-form-label" for="nombre_residuo"> Modalidad de Manejo </label>
							<select class="form-control">
								<option value="">Selecciona Modalidad de Manejo</option>
							</select>
						</div>	

						<div class="form-group col-md-4">
							<label class="col-form-label" for="nombre_residuo"> Otro </label>
							<br>
							<label class="switch">
								<input type="checkbox">
								<span class="slider round"></span>
							</label>
							
						</div>	
					</div>

				</div>


				<!-- Modal footer -->
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
				</div>

				</div>
			</div>
		</div>

	</div>
</main>
