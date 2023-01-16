	<div class="page-title">
	<div class="row">
			<div class="col-md-6">
				<h3 class="breadcrumb-header"> Manifiestos </h3>
			</div>
			<div class="col-md-6 flex-row  ">
				<div class="row">
					<button class="btn "><a href="<?=base_url('admin/recolector_consulta')?>" > Consultas</a></button>		
					<button class="btn "><a href="<?=base_url('admin')?>"> Manifiestos</a></button>
					<button class="btn "> <a href="<?=base_url('admin/recolector_bitacora')?>"> Bítacora</a></button>
				</div>
			</div>
	</div>
	</div>
	<div class="card card-white">
		<div id="main-wrapper">
			<div class="card-body">
				<div class="form-row">
					<div class="form-group col-md-9">
						<label class="col-form-label" for="nombre_empresa">  Empresa Destino </label>
						<input type="text" class="form-control" id="nombre_empresa" name="fecha_embarque" value="<?= $empresa_destino; ?> " disabled>
					</div>
					<div class="form-group col-md-3">
						<label class="col-form-label" for="fecha_embarque_terminada">  Fecha de Embarque </label>
						<input type="text" class="form-control" id="fecha_embarque_terminada" name="fecha_embarque_terminada" style="text-align:center;" value="<?= $fecha_embarque ?>" disabled>
					</div>		
				</div>

				<div class="form-row">
					<div class="form-group col-md-6">
						<label class="col-form-label" for="responsable_destino">  Nombre del Responable Técnico</label>
						<input type="text" class="form-control" id="responsable_destino" name="responsable_destino" value="<?= $responsable_destino ?>" readonly>
					</div>

					<div class="form-group col-md-6">
						<label class="col-form-label" for="ruta">  Ruta de la empresa generadora</label>
						<input type="text" class="form-control" id="ruta" name="ruta" value="<?= $ruta ?>" readonly>
					</div>	
				</div>

				<div class="form-row">
					<div class="form-group col-md-12">
						<label class="col-form-label" for="observaciones">  Observaciones </label>
						<input type="text" class="form-control" id="observaciones" name="observaciones" value="<?= $observaciones ?>" readonly>  
					</div>		
				</div>


				<div class="form-row">
					<div class="form-group col-md-12">
						<h3 class="bd-title" id="content">Recolección de Residuos</h3>
						<hr>
						<table id="tabla_residuos" class="table table-striped table-bordered table-sm" >
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
									<th>Opcion</th>
								</tr>
							</thead>
							<tbody>
								<?php 
									$x = 1;
									foreach ($bitacora_manifiesto as $key) { 
								?>
									<tr>
										<td> <?= $x++ ?></td>
										<td> <?= $key->residuo ?> </td>
										<td> <?= $key->caracteristica ?> </td>
										<td> <?= $key->contenedor_cantidad ?> </td>
										<td> <?= $key->contenedor_tipo ?> </td>
										<td> <?= $key->contenedor_capacidad ?> </td>
										<td> <?= $key->residuo_cantidad ?> </td>
										<td> <?= $key->etiqueta ?> </td>
										<td> <button class="btn btn-danger btn-sm" disabled> <i class="fa fa-trash"></i> Borrar </button> </td>
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
						<?php if ($url_back == 'recolector_bitacora'){ ?>
						<a href="<?= site_url('admin/' . $url_back); ?>"  class="btn btn-warning btn-lg btn-block" id="regresar"> Regresar </a>
					<?php } else { ?>
						<a href="<?= site_url('admin/recolector_ver_manifiestos/' . $id_cliente); ?>"  class="btn btn-warning btn-lg btn-block" id="regresar"> Regresar </a>
					<?php } ?>
					</div>
					<div class="form-group col-md-4">
						<button type="button" class="btn btn-primary btn-lg btn-block" id="agregar_residuos" data-toggle="modal" data-target="#myModal" disabled>Agregar Residuo</button>
					</div>
					<div class="form-group col-md-4">
						<button type="button" class="btn btn-success btn-lg btn-block" id="termminar" disabled>Terminar Manifiesto</button>
					</div>
				</div>
			</div>
		</div>
	</div>