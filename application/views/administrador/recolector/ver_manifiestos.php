<?php $this->session->set_userdata('url', 'from_user'); ?>

<div class="page-title">
		<div class="row">
		<div class="col-md-6">
			<h3 class="breadcrumb-header"> Recolectores </h3>
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
				<table id="tabla_manifiestos" class="display table table-striped table-bordered">
					<thead class="thead-dark">
						<tr>
							<th>Folio</th>
							<th>Empresa Destino</th>
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
								<td> <?= $bit->empresa_destino; ?> </td>
								<td style="text-align: center;"> <?= date_format($fecha, "d/m/Y"); ?> </td>
								<?php if ($bit->status == 'R'){ ?>
									<td style="text-align: center;"> 
										<a href="<?=site_url('admin/recolector_ver_manifiesto/' . $id_cliente . '/' . $bit->id_tran_folio);?>" class="btn btn-primary btn-sm" role="button"> <i class="fa fa-eye mx-2"></i>Ver</a>
										<a href="<?=site_url('admin/recolector_generar_manifiesto/' . $id_cliente . '/' . $bit->id_tran_folio);?>" class="btn btn-danger btn-sm" target="_blank" role="button"><i class="fa fa-file-pdf mx-2"></i> PDF </a>
										<a href="<?=base_url('admin/recolector_generar_manifiesto_dummy/' . $id_cliente . '/' . $bit->id_tran_folio . '/' . $nombre_empresa . '_' . $bit->folio . '_' . $bit->fecha_embarque . '.pdf')?>" class="btn btn-secondary btn-sm" target="_blank" role="button" disabled><i class="fa fa-file-pdf mx-2"></i> PDF Mes </a>
									</td>
								<?php } elseif ($bit->status == 'W') {?>
									<td style="text-align: center;"> 
										<a href="<?=site_url('admin/recolector_crear_manifiestos/' . $id_cliente . '/' . $bit->id_tran_folio);?>" class="btn btn-success btn-sm" role="button"> Terminar </a> 
											
										<a href="<?=base_url('admin/recolector_ver_manifiestos/'. $id_cliente . '/' . $bit->id_tran_folio)?>" class="btn btn-danger btn-sm" role="button" disabled> PDF </a>

										<a href="<?=base_url('admin/recolector_generar_manifiesto_dummy/' . $id_cliente . '/' . $bit->id_tran_folio . '/' . $nombre_empresa . '_' . $bit->folio . '_' . $bit->fecha_embarque . '.pdf')?>" class="btn btn-secondary btn-sm" target="_blank" role="button" disabled><i class="fa fa-file-pdf mx-2"></i> PDF Mes </a>
									</td>
								<?php } ?>
							</tr>
						<?php } ?>
					</tbody>
					<tfoot>
						<tr>
							<th>Folio</th>
							<th>Empresa Destino</th>
							<th>Fecha de Entrada</th>
							<th>Opciones</th>
						</tr>
					</tfoot>
				</table>
				<br />
				<div class="form-row float-right">
					<div class="form-group col-md-12">
						<a href="<?=site_url('admin/recolector_crear_manifiesto/' . $id_cliente);?>" class="btn btn-success" role="button"> <i class="fas fa-edit"></i> Crear</a>
					</div>
				</div>	
			</div>
		</div>
	</div>

