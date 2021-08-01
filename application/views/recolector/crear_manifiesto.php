<main role="main" class="container" style="padding-top:-10px;">
	<center><h2 class="bd-title" id="content"><h2>Crear Manifiesto</h2></center>
	<hr>
	<form id="form_manifiesto_recolector" action="<?= site_url('recolector/crear_manifiesto/' . $id_cliente); ?>" method="post" novalidate>
		<div class="col-md-12">
			<div class="form-row">
				<div class="form-group col-md-9">
					<label class="col-form-label" for="nombre_empresa"> <center> Empresa Destino </center> </label>
					<select class="form-control" style="width: 100%;" name="empresa_destino" id="empresa_destino" required>
						<option value="">Selecciona empresa destino</option>
						<?php foreach ($empresa_destino as $key) { ?>
							<?php if ($key->id_tipo_emp_destino == 24) {  ?> // Empresa por default RDIAZ
								<option value="<?= $key->id_tipo_emp_destino; ?>" selected> <?= $key->nombre_destino; ?> </option>
							<?php } else { ?>
								<option value="<?= $key->id_tipo_emp_destino; ?>"> <?= $key->nombre_destino; ?> </option>
							<?php } ?>
						<?php } ?>
					</select>
					<div class="invalid-feedback">
						Selecciona empresa destino.
					</div>

				</div>
				<div class="form-group col-md-3">
					<label class="col-form-label" for="fecha_salida" style="text-align: center;"> Fecha de Embarque </label>
					<input style="text-align: center;" class="form-control" id="fecha_embarque" name="fecha_embarque" required>
					<div class="invalid-feedback">
						Selecciona la fecha de embarque
					</div>

					<input type="text" name="id_vehiculo" value="<?= $recolector->cp_empresa ?>" hidden>
				</div>		
			</div>

			<div class="form-row">
				<div class="form-group col-md-6">
					<label class="col-form-label" for="responsable_destino"> <center> Nombre del Responable Técnico</center> </label>
					<input type="text" class="form-control" id="responsable_destino" name="responsable_destino">
				</div>		

				<div class="form-group col-md-6">
					<label class="col-form-label" for="ruta"> <center> Ruta de la empresa generadora</center> </label>
					<input type="text" class="form-control" id="ruta" name="ruta">
				</div>		
			</div>

			<div class="form-row">
				<div class="form-group col-md-12">
					<label class="col-form-label" for="observaciones"> <center> Observaciones </center> </label>
					<input type="text" class="form-control" id="observaciones" name="observaciones">
				</div>		
			</div>

			<div class="form-row">
				<div class="form-group col-md-12">

					<center><h3 class="bd-title" id="content">Recolección de Residuos</h3></center>
					<hr>
					<table id="tabla_residuos" class="table table-striped table-bordered" style="width:100%">
						<thead>
							<tr>
								<th>#</th>
								<th>Nombre residuo</th>
								<th>CRETI</th>
								<th>Contenedor Cantidad</th>
								<th>Contenedor Tipo</th>
								<th>Contenedor Capacidad</th>
								<th>Cantidad (KG)</th>
								<th>Etiqueta</th>
								<th>Opciones</th>
							</tr>
						</thead>
						<tbody>
								<tr>
									<td> </td>
									<td> </td>
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
					<a href="<?= site_url('recolector/ver_manifiestos/' . $id_cliente); ?>"  class="btn btn-warning btn-lg btn-block" id="regresar"> Regresar </a>
				</div>
				<div class="form-group col-md-4">
					<button type="button" class="btn btn-primary btn-lg btn-block" id="agregar_residuos" data-toggle="modal" data-target="#myModal">Agregar Residuo</button>
				</div>
				<div class="form-group col-md-4">
					<button type="button" class="btn btn-success btn-lg btn-block" id="termminar" disabled>Terminar Manifiesto</button>
				</div>
			</div>


			<!-- The Modal -->
			<div class="modal" id="myModal">
				<div class="modal-dialog modal-lg">
					<div class="modal-content">

						<!-- Modal Header -->
						<div class="modal-header">
							<h4 class="modal-title">Ingresa Residuo</h4>
							<button type="button" class="close" data-dismiss="modal">&times;</button>
						</div>

						<!-- Modal body -->
						<div class="modal-body">
							<div class="form-row">
								<div class="form-group col-md-9">
									<label class="col-form-label" for="nombre_residuo"> Residuo Peligroso </label>
									<select class="form-control" onchange="update_clave(this.value);" name="residuo_peligroso" required>
										<option value=""> <strong> Selecciona Residuo </strong> </option>
										<?php foreach ($residuos as $key) { ?>
											<option value="<?= $key->id_tipo_residuo; ?>"> <?= mb_strimwidth($key->residuo, 0, 75, '...', 'UTF-8'); ?></option>
										<?php } ?>
									</select>
									<div class="invalid-feedback">
										Selecciona residuo peligroso.
									</div>
								</div>	

								<div class="form-group col-md-3">
									<label class="col-form-label" for="clave"> Clave </label>
									<input type="text" class="form-control" id="clave" name="clave" value="Clave" disabled> 
								</div>	
								
							</div>


							<div class="form-row">
								<div class="form-group col-md-10">
									<label>Clasificación</label>

									&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									<br />

									<div class="row">
										<div class="form-check col-sm">
											<div class="custom-control custom-checkbox">
												<input type="checkbox" class="custom-control-input" id="caracteristica_check1" value="Corrosivo" name="caracteristica_check[]" onclick="clear_required();" required>
												<label class="custom-control-label" for="caracteristica_check1">Corrosivo</label>
											</div>
											<div class="custom-control custom-checkbox">
												<input type="checkbox" class="custom-control-input" id="caracteristica_check2" value="Reactivo" name="caracteristica_check[]" onclick="clear_required();" required>
												<label class="custom-control-label" for="caracteristica_check2">Reactivo</label>
											</div>
																	
										</div>

										<div class="form-check col-sm">
											<div class="custom-control custom-checkbox">
												<input type="checkbox" class="custom-control-input" id="caracteristica_check3" value="Explosivo" name="caracteristica_check[]" onclick="clear_required();" required>
												<label class="custom-control-label" for="caracteristica_check3">Explosivo</label>
											</div>			
											<div class="custom-control custom-checkbox">
												<input type="checkbox" class="custom-control-input" id="caracteristica_check4" value="Toxico" name="caracteristica_check[]" onclick="clear_required();" required>
												<label class="custom-control-label" for="caracteristica_check4">Tóxico</label>
												<div class="invalid-feedback">
													<div class="alert alert-danger" role="alert">
														Selecciona al menos una caracteristica de peligrosidad.
													</div>
												</div>
											</div>
										</div>

										<div class="form-check col-sm">
											<div class="custom-control custom-checkbox">
												<input type="checkbox" class="custom-control-input" id="caracteristica_check5" value="Inflamable" name="caracteristica_check[]" onclick="clear_required();" required>
												<label class="custom-control-label" for="caracteristica_check5">Inflamable</label>
											</div>
											<div class="custom-control custom-checkbox">
												<input type="checkbox" class="custom-control-input" id="caracteristica_check6" value="Biologico" name="caracteristica_check[]" onclick="clear_required();" required>
												<label class="custom-control-label" for="caracteristica_check6">Biológico</label>
											</div>
										</div>

										<div class="form-check col-sm">
											<div class="custom-control custom-checkbox">
												<input type="checkbox" class="custom-control-input" id="caracteristica_check7" value="Mutageno" name="caracteristica_check[]" onclick="clear_required();" required>
												<label class="custom-control-label" for="caracteristica_check7">Mutágeno</label>
											</div>
										</div>

									</div>
								</div>

						<!--  -->
							</div>

							<div class="form-row">
								<div class="form-group col-md-4">
									<label class="col-form-label" for="cantidad_envase"> Envase Cantidad </label>
									<input readonly type="number" class="form-control" id="cantidad_envase" name="cantidad_envase" min="1" style="text-align:center" value="" required>

									<label class="col-form-label" for="capacidad_envase"> Capacidad de Envase</label>
									<input readonly type="number" class="form-control" id="capacidad_envase" name="capacidad_envase" min="0" style="text-align:center" value="0" required>
								</div>	

								<div class="form-group col-md-1">
								</div>

								<div class="form-group col-md-2">
									<label class="col-form-label" for="nombre_residuo"> Tipo </label>
									<br>
									<div class="custom-control custom-radio">
										<input type="radio" class="custom-control-input" id="tipo_radio1" value="Bolsa" name="tipoRadio" required>
										<label class="custom-control-label" for="tipo_radio1">Bolsa</label>
									</div>
									<div class="custom-control custom-radio">
										<input type="radio" class="custom-control-input" id="tipo_radio2" value="Cubeta" name="tipoRadio" required>
										<label class="custom-control-label" for="tipo_radio2">Tambo</label>
									</div>
									<div class="custom-control custom-radio">
										<input type="radio" class="custom-control-input" id="tipo_radio3" value="Tambo" name="tipoRadio" required>
										<label class="custom-control-label" for="tipo_radio3">Tote</label>
									</div>
									<div class="custom-control custom-radio">
										<input type="radio" class="custom-control-input" id="tipo_radio4" value="Porron" name="tipoRadio" required>
										<label class="custom-control-label" for="tipo_radio4">Porrón</label>
									</div>
									<div class="custom-control custom-radio">
										<input type="radio" class="custom-control-input" id="tipo_radio5" value="OLtro" name="tipoRadio" required>
										<label class="custom-control-label" for="tipo_radio5">Otro</label>
										<div class="invalid-feedback"> &nbsp; Selecciona tipo de contendor</div>
									</div>
								</div>

								<div class="form-group col-md-1">
								</div>

								<div class="form-group col-md-4">
									<label class="col-form-label" for="cantidad"> Cantidad Residuo (KG)</label>
									<input readonly type="number" class="form-control" id="cantidad" name="cantidad" min="1" style="text-align:center" value="" required>

									<label class="col-form-label " for="etiqueta_check"> Etiqueta </label> <br>
									<label class="switch">
										<input type="checkbox" name="etiqueta_check" id="etiqueta_check" value="S">
										<span class="slider round"></span>
									</label>
								</div>	

							</div>

							<!-- Modal footer -->
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
								<button type="submit" class="btn btn-primary">Guardar</button>
							</div>
						</div>
					</div>
				</div>
			</div> <!-- Modal footer -->
		</div>
	</form>
</main>