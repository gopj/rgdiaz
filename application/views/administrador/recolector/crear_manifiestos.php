<?php $total_reg = count($bitacora_manifiesto); ?>
<main role="main" class="container col-md-10">
	<div class="page-title">
		<h3 class="breadcrumb-header"> Crear Manifiesto </h3>
	</div>
	<div class="col-md-12">
		<div class="card card-white">
			<div class="card-body">
				<form id="form_manifiesto_recolector" action="<?= site_url('admin/recolector_crear_manifiestos/' . $id_cliente . '/' . $folio); ?>" method="post" novalidate>
					<div class="col-md-12">
						<div class="form-row">
							<div class="form-group col-md-9">
								<label class="col-form-label" for="nombre_empresa"> <center> Empresa Destino </center> </label>
								<select class="form-control" style="width: 100%;" name="empresa_destino" id="empresa_destino" onchange="terminar_manifiesto();" required>
									<?php foreach ($empresa_destino as $key) { ?>
											<?php if ($id_emp_destino == $key->id_tipo_emp_destino) { ?>
												<option value="<?= $key->id_tipo_emp_destino; ?>" selected> <?= $key->nombre_destino; ?> </option>
											<?php } else { ?>
												<option value="<?= $key->id_tipo_emp_destino; ?>"> <?= $key->nombre_destino; ?> </option>
											<?php } ?>
									<?php }	?>
								</select>
								<div class="invalid-feedback">
									Selecciona empresa destino.
								</div>
							</div>
							<div class="form-group col-md-3">
								<label class="col-form-label" for="fecha_salida"> <center> Fecha de Embarque </center> </label>
								<input style="text-align: center;" class="form-control" id="fecha_embarque" name="fecha_embarque" value="<?= $fecha_embarque ?>" required>
							</div>
							<div class="invalid-feedback">
								Selecciona la fecha de embarque
							</div>
						</div>

						<div class="form-row">
							<div class="form-group col-md-6">
								<label class="col-form-label" for="responsable_destino"> <center> Nombre del Responable Técnico</center> </label>
								<input type="text" class="form-control" id="responsable_destino" name="responsable_destino" value="<?= $responsable_destino ?>" oninput="terminar_manifiesto();check_resposanble();" placeholder="El nombre del responsable técnico está vacío.">
							</div>

							<div class="form-group col-md-6">
								<label class="col-form-label" for="ruta"> <center> Ruta de la empresa generadora</center> </label>
								<input type="text" class="form-control" id="ruta" name="ruta" value="<?= $ruta ?>" oninput="terminar_manifiesto();check_resposanble();" placeholder="La ruta no está especificada"> 
							</div>		
						</div>

						<div class="form-row">
							<div class="form-group col-md-12">
								<label class="col-form-label" for="observaciones"> <center> Observaciones </center> </label>
								<input type="text" class="form-control" id="observaciones" name="observaciones" value="<?= $observaciones ?>" oninput="terminar_manifiesto();check_resposanble();" placeholder="Observaciones...">  
							</div>		
						</div>


						<!-- Modal agrega residuo -->
						<div class="modal fade" id="agregar_residuo_modal" tabindex="-1" role="dialog" aria-labelledby="residuo_label" aria-hidden="true">
							<div class="modal-dialog modal-lg" role="document">
								<div class="modal-content">

									<!-- Modal Header -->
									<div class="modal-header">
										<h5 class="modal-title" id="residuo_label">Ingresa Residuo</h5>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>
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
															<input class="custom-control-input" type="checkbox" id="caracteristica_check1" value="Corrosivo" name="caracteristica_check[]" onclick="clear_required();" required>
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
												<input type="number" class="form-control" id="cantidad_envase" name="cantidad_envase" min="1" style="text-align:center" value="" required>

												<label class="col-form-label" for="capacidad_envase"> Capacidad de Envase</label>
												<input type="number" class="form-control" id="capacidad_envase" name="capacidad_envase" min="0" style="text-align:center" value="0" required>
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
													<input type="radio" class="custom-control-input" id="tipo_radio5" value="Otro" name="tipoRadio" required>
													<label class="custom-control-label" for="tipo_radio5">Otro</label>
													<div class="invalid-feedback"> &nbsp; Selecciona tipo de contendor</div>
												</div>
											</div>

											<div class="form-group col-md-1">
											</div>

											<div class="form-group col-md-4">
												<label class="col-form-label" for="cantidad"> Cantidad Residuo (KG)</label>
												<input type="number" class="form-control" id="cantidad" name="cantidad" min="1" style="text-align:center" value="" required>

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
								<?php 
									$x=1;
									foreach ($bitacora_manifiesto as $key) { 
								?>
									<tr>
										<th> <?= $x++ ?> </th>
										<td> <?= $key->residuo ?> </td>
										<td> <?= $key->caracteristica ?> </td>
										<td> <?= $key->contenedor_cantidad ?> </td>
										<td> <?= $key->contenedor_tipo ?> </td>
										<td> <?= $key->contenedor_capacidad ?> </td>
										<td> <?= $key->residuo_cantidad ?> </td>
										<td> <?= $key->etiqueta ?> </td>
										<?php if ($total_reg == 1) { ?>
											<td style="text-align: center;">
												<button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modal_delete_last_residuo"> Borrar </button>
											</td>
										<?php } else { ?>
											<td style="text-align: center;"> 
											<a href="<?=site_url('admin/recolector_eliminar_tran_residuo/' . $id_cliente . '/' . $folio . '/' . $key->id_tran_residuo);?>" class="btn btn-danger btn-sm" role="button"> Borrar </a> 
										</td>
										<?php } ?>
									</tr>
								<?php } ?>
							</tbody>
							
						</table>
					</div>
				</div>
			</div>
		</div>	

		<div class="form-row">
			<div class="form-group col-md-12">
			</div>
		</div>


		<div class="form-row">
			<div class="form-group col-md-4">
				<?php if (@$url == 'from_bitacora') { ?>
					<a href="<?= site_url('admin/recolector_bitacora'); ?>"  class="btn btn-warning btn-lg btn-block" id="regresar"> Regresar </a>
				<?php } else { ?>
					<a href="<?= site_url('admin/recolector_ver_manifiestos/' . $id_cliente); ?>"  class="btn btn-warning btn-lg btn-block" id="regresar"> Regresar </a>
				<?php } ?>
			</div>
			<div class="form-group col-md-4">
				<button type="button" class="btn btn-primary btn-lg btn-block" id="agregar_residuos" data-toggle="modal" data-target="#agregar_residuo_modal">Agregar Residuo</button>
			</div>
			<div class="form-group col-md-4">
				<form id="form_terminar_manifiesto" action="<?= site_url('admin/recolector_terminar_manifiesto/' . $id_cliente . '/' . $folio); ?>" method="post">

					<input type="text" name="terminar_responsable" id="terminar_responsable" hidden>
					<input type="text" name="terminar_responsable_tecnico" id="terminar_responsable_tecnico" hidden>
					<input type="text" name="terminar_fecha" id="terminar_fecha" hidden>
					<input type="text" name="terminar_empresa_destino" id="terminar_empresa_destino" hidden>
					<input type="text" name="terminar_ruta" id="terminar_ruta" hidden>
					<input type="text" name="terminar_observaciones" id="terminar_observaciones" hidden>
					<input type="text" name="terminar_persona_residuos" id="terminar_persona_residuos" required hidden>
					<input type="text" name="terminar_cargo_persona" id="terminar_cargo_persona" required hidden>
					<input type="text" name="terminar_asignar_recolector" id="terminar_asignar_recolector"  hidden>


					<button type="button" class="btn btn-success btn-lg btn-block" id="b_terminar_manifiesto" data-toggle="modal" data-target="#terminar_manifiesto_modal" disabled> Terminar Manifiesto </button>

				</form>
			</div>
		</div>

		<!-- Modal Terminar Manifiesto -->
		<div class="modal" id="terminar_manifiesto_modal">
			<div class="modal-dialog modal-md">
				<div class="modal-content">

					<!-- Modal Header -->
					<div class="modal-header">
						<h4 class="modal-title">Terminar manifiesto </h4>
						<button type="button" class="close" data-dismiss="modal">&times;</button>
					</div>

					<!-- Modal body -->
					<div class="modal-body">
						<div class="form-row">
							<div class="form-group col-md-10">
								<label class="col-form-label" for="responsable_tecnico">  Responsable Técnico del Generador </label>
								<input type="text" class="form-control" id="responsable_tecnico" name="responsable_tecnico" onchange="update_terminar_manifiiesto()"> 
								
								<label class="col-form-label" for="persona_residuos">  Persona que recibe los residuos </label>
								<input type="text" class="form-control" id="persona_residuos" name="persona_residuos" onchange="update_terminar_manifiiesto()"> 
								
								<label class="col-form-label" for="cargo_persona">  Cargo </label>
								<input type="text" class="form-control" id="cargo_persona" name="cargo_persona" onchange="update_terminar_manifiiesto()"> 
							
								<label class="col-form-label" for="asignar_recolector"> Selecciona recolector </label>
								<select class="form-control" id="asignar_recolector" name="asignar_recolector" required>
									<option value=""> Selecciona recolector </option>
									<?php foreach($recolectores->result() as $row){ ?>
										<option value="<?php echo $row->id_persona;?>"><?php echo $row->correo; ?></option>
									<?php } ?>
								</select>

							</div>	
						</div>

						<!-- Modal footer -->
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
							<button type="submit" form="form_terminar_manifiesto" class="btn btn-primary" role="button"> Terminar </button>
						</div>

					</div>
				</div>
			</div>
		</div>

		<!-- The Modal -->
		<div class="modal" id="modal_delete_last_residuo">
			<div class="modal-dialog modal-md">
				<div class="modal-content">

					<!-- Modal Header -->
					<div class="modal-header">
						<h4 class="modal-title">Eliminar último residuo del folio - </h4>
						<button type="button" class="close" data-dismiss="modal">&times;</button>
					</div>

					<!-- Modal body -->
					<div class="modal-body">
						<div class="form-row">
							<div class="form-group col-md-8">
								<label class="col-form-label" for="nombre_residuo"> Eliminando último residuo y folio creado ¿Deseas continuar? </label>
							</div>	
						</div>

						<!-- Modal footer -->
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
							<a href="<?=site_url('admin/recolector_eliminar_ultimo_residuo/' . $id_cliente . '/' . $folio . '/' . $key->id_tran_residuo);?>" class="btn btn-danger" role="button"> Eliminar </a>
						</div>

					</div>
				</div>
			</div>
		</div>
	</div>
</main>