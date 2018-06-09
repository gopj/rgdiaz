<?php $total_reg = count($bitacora_manifiesto); ?>

<main role="main" class="container" style="padding-top:-10px;">
	<center><h2 class="bd-title" id="content"><h2>Crear Manifiesto</h2></center>
	<hr>
	<form id="form_manifiesto_recolector" action="<?= site_url('recolector/crear_manifiestos/' . $id_cliente . '/' . $folio); ?>" method="post">
		<div class="col-md-12">
			<div class="form-row">
				<div class="form-group col-md-9">
					<label class="col-form-label" for="nombre_empresa"> <center> Empresa Destino </center> </label>
					<select class="form-control" style="width: 100%;" name="empresa_destino" id="empresa_destino">
						<?php foreach ($empresa_destino as $key) { ?>
								<? if ($id_emp_destino == $key->id_tipo_emp_destino) { ?>
									<option value="<?= $key->id_tipo_emp_destino; ?>" selected> <?= $key->nombre_destino; ?> </option>
								<?php } else { ?>
									<option value="<?= $key->id_tipo_emp_destino; ?>"> <?= $key->nombre_destino; ?> </option>
								<?php } ?>
						<?php }	?>
					</select>
				</div>
				<div class="form-group col-md-3">
					<label class="col-form-label" for="fecha_salida"> <center> Fecha de Embarque </center> </label>
					<input type="date" class="form-control" id="fecha_embarque" name="fecha_embarque" value="<?= $fecha_embarque ?>">
				</div>		
			</div>

			<div class="form-row">
				<div class="form-group col-md-9">
					<label class="col-form-label" for="responsable_tecnico"> <center> Nombre del Responable Técnico</center> </label>
					<input type="text" class="form-control" id="responsable_tecnico" name="responsable_tecnico" value="<?= $responsable_tecnico ?>">
				</div>		
			</div>


			<div class="form-row">
				<div class="form-group col-md-12">

					<center><h3 class="bd-title" id="content">Recolección de Residuos</h3></center>
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
								<th>Opciones</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($bitacora_manifiesto as $key) { ?>
								<tr>
									<td> <?= $key->folio ?> </td>
									<td> <?= $key->residuo ?> </td>
									<td> <?= $key->caracteristica ?> </td>
									<td> <?= $key->contenedor_cantidad ?> </td>
									<td> <?= $key->contenedor_tipo ?> </td>
									<td> <?= $key->residuo_cantidad ?> </td>
									<td> <?= $key->unidad ?> </td>
									<?php if ($total_reg == 1) { ?>
										<td style="text-align: center;">
											<button class="btn btn-danger btn-sm btn-block" disabled> Eliminar </button>
										</td>
									<?php } else { ?>
										<td style="text-align: center;"> 
										<a href="<?=site_url('recolector/eliminar_tran_residuo/' . $id_cliente . '/' . $key->folio . '/' . $key->id_tran_residuo);?>" class="btn btn-danger btn-sm btn-block" role="button"> Eliminar </a> 
									</td>
									<?php } ?>
								</tr>
							<?php } ?>
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
					<a href="<?=site_url('recolector/terminar_manifiesto/' . $id_cliente . '/' . $key->folio);?>" class="btn btn-success btn-lg btn-block" role="button"> Terminar Manifiesto </a> 
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
								<select class="form-control" onchange="update_clave(this.value);" name="residuo_peligroso">
									<option value="">Selecciona Residuo</option>
									<?php foreach ($residuos as $key) { ?>
										<option value="<?= $key->id_tipo_residuo; ?>"> <?= mb_strimwidth($key->residuo, 0, 55, '...'); ?></option>
									<?php } ?>
								</select>
							</div>	

							<div class="form-group col-md-3">
								<label class="col-form-label" for="clave"> Clave </label>
								<input type="text" class="form-control" id="clave" name="clave" value="Clave" disabled> 
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
								<input readonly type="number" class="form-control" id="cantidad" name="cantidad" min="1" oninvalid="this.setCustomValidity('Ingresa cantidad que sea mayor a 0')" oninput="setCustomValidity('')" style="text-align:center" value="1" required>
							</div>	

							<div class="form-group col-md-4">
								<label class="col-form-label" for="nombre_residuo"> Unidad </label>
								<br>
								<div class="form-check form-check-inline">
									<input class="magic-radio" type="radio" name="unidadRadio" id="unidad_radio1" value="Kg">
									<label class="form-check-label" for="unidad_radio1">Kg</label>
								</div>
								<div class="form-check form-check-inline">
									<input class="magic-radio" type="radio" name="unidadRadio" id="unidad_radio2" value="Ton">
									<label class="form-check-label" for="unidad_radio2">Ton</label>
								</div>
							</div>	
						</div>

						<div class="form-row">
							<div class="form-group col-md-4">
								<label class="col-form-label" for="nombre_residuo"> Cantidad Tipo </label>
								<input readonly type="number" class="form-control" id="cantidad_tipo" name="cantidad_tipo" min="1" oninvalid="this.setCustomValidity('Ingresa cantidad que sea mayor a 0')" oninput="setCustomValidity('')" style="text-align:center" value="1" required >
							</div>	

							<div class="form-group col-md-6">
								<label class="col-form-label" for="nombre_residuo"> Tipo </label>
								<br>
								<div class="form-check form-check-inline">
									<input class="magic-radio" type="radio" name="tipoRadio" id="tipo_radio1" value="Bolsa">
									<label class="form-check-label" for="tipo_radio1">Bolsa</label>
								</div>
								<div class="form-check form-check-inline">
									<input class="magic-radio" type="radio" name="tipoRadio" id="tipo_radio2" value="Cubeta">
									<label class="form-check-label" for="tipo_radio2">Cubeta</label>
								</div>
								<div class="form-check form-check-inline">
									<input class="magic-radio" type="radio" name="tipoRadio" id="tipo_radio3" value="Tambo">
									<label class="form-check-label" for="tipo_radio3">Tambo</label>
								</div>
							</div>	
						</div>

						<div class="form-row">
							<div class="form-group col-md-12">
								<label class="col-form-label" for="nombre_residuo">Caracteristica de Peligrosidad </label>
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								<div class="form-check form-check-inline">
									<input class="magic-checkbox" type="checkbox" id="caracteristica_check1" value="Toxico" name="caracteristica_check[]">
									<label class="form-check-label" for="caracteristica_check1">Tóxico</label>
								</div>
								<div class="form-check form-check-inline">
									<input class="magic-checkbox" type="checkbox" id="caracteristica_check2" value="Inflamable" name="caracteristica_check[]">
									<label class="form-check-label" for="caracteristica_check2">Inflamable</label>
								</div>
								<div class="form-check form-check-inline">
									<input class="magic-checkbox" type="checkbox" id="caracteristica_check3" value="Corrosivo" name="caracteristica_check[]">
									<label class="form-check-label" for="caracteristica_check3"> Corrosivo</label>
								</div>
								<div class="form-check form-check-inline">
									<input class="magic-checkbox" type="checkbox" id="caracteristica_check4" value="Reactivo" name="caracteristica_check[]">
									<label class="form-check-label" for="caracteristica_check4"> Reactivo</label>
								</div>
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
		</form>
	</div>
</main>