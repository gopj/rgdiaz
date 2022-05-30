<?php $this->session->set_userdata('url', 'from_bitacora'); ?>

	<div class="page-title">
		<h3 class="breadcrumb-header"> Bitacora </h3>
	</div>
	<div class="card card-white">
		<div id="main-wrapper">
			<div class="card-body">
				<form class="form-inline col-md-12" role="form" autocomplete="off" method='post' id='form_bitacora' action="<?= site_url('admin/recolector_bitacora');?>">
					
					<div class="form-group col-md-4">
						<label class="col-md-2" for="fecha_embarque">Fecha</label>
						<input type="text" class="form-control date-picker col-md-6" id="fecha_embarque" name="fecha_embarque" style="text-align: center;" value="<?= @$fecha_embarque ?>">
					</div>

					<div class="form-group col-md-4">
						<label class="col-md-2" for="fecha">Tipo</label>
						<select class="form-control col-md-6" name="tipo" id="tipo">
							<option value=""> Todos </option>
							<option value="W" <?php if(@$tipo=='W'){echo "selected";}?>> Pendientes </option>
							<option value="R" <?php if(@$tipo=='R'){echo "selected";}?>> Completados </option>
						</select>

					</div>

					<div class="form-group col-md-1">	
						<input class="btn btn-primary btn-sm" type="submit" name="submit_form_bitacora" value="Buscar">
					</div>
					
				</form>
				
				<hr>
				<div class="table-responsive">
					<table id="tabla_manifiestos" class="display table table-striped table-bordered">
						<thead class="thead-dark">
							<tr>
								<th>Folio</th>
								<th>Nombre del Generador</th>
								<!-- <th>Empresa Destino</th> -->
								<th>Recolector</th>
								<th>Placa</th>
								<th>Fecha de Embarque</th>
								<th>Opciones</th>
							</tr>
						</thead>
						<tbody>
							<?php 
								foreach ($bitacora as $bit) { 	
									$fecha =  date_create_from_format("Y-m-d", $bit->fecha_embarque);
							?>	<tr>
									<td style="text-align: center;"> <?= $bit->folio; ?> </td>
									<td style="text-align: center;"> <?= $bit->nombre_generador; ?> </td>
									<!-- <td> <?= $bit->nombre_destino; ?> </td> -->
									<td style="text-align: center;"> <?= $bit->nombre ?> </td>
									<td style="text-align: center;"> <?= $bit->numero_placa ?> </td>
									<td style="text-align: center;"> <?= date_format($fecha, "d/m/Y"); ?> </td>
									<?php if ($bit->status == 'W'){ ?>
										<td style="text-align: center;">  
											<a href="<?=site_url('admin/recolector_crear_manifiestos/' . $bit->id_persona . '/' . $bit->id_tran_folio);?>" class="btn btn-success btn-sm" role="button"> Terminar </a> 
											<button class="btn btn-danger btn-sm" disabled> PDF </a>
										</td>
									<?php } else { ?>
										<td style="text-align: center;"> 
											<a href="<?=site_url('admin/recolector_ver_manifiesto/' . $bit->id_persona . '/' . $bit->id_tran_folio);?>" class="btn btn-primary btn-sm" role="button"> Ver </a> 
											<a href="<?=site_url('admin/recolector_generar_manifiesto/' . $bit->id_persona . '/' . $bit->id_tran_folio);?>" class="btn btn-danger btn-sm" target="_blank" role="button"> PDF </a>
										</td>
									<?php }?>
								</tr>
							<?php } ?>
						</tbody>
						<tfoot>
							<tr>
								<th>Folio</th>
								<th>Nombre del Generador</th>
								<!-- <th>Empresa Destino</th> -->
								<th>Recolector</th>
								<th>Placa</th>
								<th>Fecha de Embarque</th>
								<th>Opciones</th>
							</tr>
						</tfoot>
					</table>
				</div>
			</div>
		</div>
	</div>