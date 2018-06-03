<main role="main" class="container" style="padding-top:-10px;">
	<center><h2 class="bd-title" id="content"><h2>Ver Manifiesto</h2></center>
	<hr>
		<div class="col-md-12">
			<div class="form-row">
				<div class="form-group col-md-9">
					<label class="col-form-label" for="nombre_empresa"> <center> Empresa Destino </center> </label>
					<select class="form-control" style="width: 100%;" name="empresa_destino" id="empresa_destino" readonly>
						<option> <?= $empresa_destino; ?> </option>
					</select>
				</div>
				<div class="form-group col-md-3">
					<label class="col-form-label" for="fecha_salida"> <center> Fecha de Embarque </center> </label>
					<input type="date" class="form-control" id="fecha_embarque" name="fecha_embarque" value="<?= $fecha_embarque ?>" readonly>
				</div>		
			</div>

			<div class="form-row">
				<div class="form-group col-md-9">
					<label class="col-form-label" for="responsable_tecnico"> <center> Nombre del Responable Técnico</center> </label>
					<input type="text" class="form-control" id="responsable_tecnico" name="responsable_tecnico" value="<?= $responsable_tecnico ?>" readonly>
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
									<td> <button class="btn btn-danger btn-sm btn-block" disabled> Eliminar </button> </td>
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
					<button type="button" class="btn btn-success btn-lg btn-block" id="termminar">Terminar Manifiesto</button>
				</div>
			</div>
		</div>
</main>