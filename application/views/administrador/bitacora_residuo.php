<?php 
function date_bitacora($s_date){

	if ($s_date == ""){
		$date = "";
	} else {
		$date = date_create($s_date);
		$date = date_format($date, "d-m-Y");
	}

	return $date;
}
?>
<link rel="stylesheet" type="text/css" href="<?=base_url('css/table_bitacora.css')?>">

<div class="page-title">
	<h3 class="breadcrumb-header"> Bitácora Residuos Peligrosos - <?= $nombre_empresa; ?> </h3>
</div>
<input type="hidden" id="prev_selected" name="prev_selected" value="<?=$id_persona;?>">
<div class="card card-white">
	<div id="main-wrapper">
		<div class="card-body">
			<div class="col-md-12">
				<form id="form_bitacora_actualizar_registros" action="<?=base_url('administrador/bitacora_actualiza_reg')?>" method="post">
					<table id="bitacora_administrador" class="display table table-striped table-bordered nowrap" cellspacing="0" width="100%">
						<thead>
							<!-- <th class="table-residuos">#</th> -->
							<tr>
								<th>SELECCIONA</th>
								<th>FOLIO</th>
								<th>RESIDUO PELIGROSO</th>
								<th>CLAVE</th>
								<th>CANTIDAD</th>
								<th>UNIDAD MEDIDA</th>
								<th>CARACTERÍSTICA PELIGROSIDAD</th>
								<th>ÁREA DE GENERACIÓN</th>
								<th>FECHA INGRESO</th>
								<th>FECHA SALIDA</th>
								<th>EMPRESA TRANSPORTISTA</th>
								<th>NO. AUTORIZACIÓN</th>
								<th>DESTINO FINAL</th>
								<th>NO. AUTORIZACIÓN</th>
								<th>MODALIDAD DE MANEJO</th>
								<th>RESPONSABLE TÉCNICO</th>
								<th>OPCIÓN</th>
							</tr>	
						</thead>
						<tbody>
							<?php foreach ($residuos as $row) { ?>
								<?php if ($row->status == "R") { 
									echo "<tr>";
								?>
									<td> <input type="checkbox" id="check" name="residuos_to_update[]" disabled value="" value="<?php echo $row->id_residuo_peligroso; ?>" style="width: 12px; height: 12px;"></td>
								<?php } else { 
									echo "<tr style='background-color:#F9F936; color:#000000;'>";
								?>
									<td style='background-color:#F9F936;'> <input type="checkbox" id="check" name="residuos_to_update[]" onclick='activarSalidas();' value="<?php echo $row->id_residuo_peligroso; ?>" style="width: 12px; height: 12px;" ></td>
								<?php } ?>
								<td><?php echo $row->folio; ?></td>
								<td><?php echo $row->residuo; ?></td>
								<td><?php echo $row->clave; ?></td>
								<td><?php echo $row->cantidad; ?></td>
								<td><?php echo $row->unidad; ?></td>
								<td><?php echo $row->caracteristica; ?></td>
								<td><?php echo $row->area_generacion ?></td>
								<td><?php echo date_bitacora($row->fecha_ingreso); ?></td>
								<td><?php echo date_bitacora($row->fecha_salida); ?></td>
								<td><?php echo $row->emp_tran; ?></td>
								<td><?php echo $row->no_aut_transp; ?></td>
								<td><?php echo $row->dest_final; ?></td>
								<td><?php echo $row->no_aut_dest_final; ?></td>
								<td><?php echo $row->sig_manejo; ?></td>
								<td><?php echo $row->resp_tec; ?></td>
								<td class="center center-align">
									<!-- Modificar -->
									<a href="<?= site_url('administrador/update_bit') . "/" . $id_persona . "/" . $row->id_residuo_peligroso ?>"  class="btn btn-primary btn-mini" title="Modificar"> 
										<i class="icon-pencil"></i>
									</a>
									<input type="hidden" value="<?=$id_persona?>" name="id_persona">
									<!-- ELiminar -->
									<?php $url_delete = site_url('administrador/eliminar_bit'). "/" . $id_persona . "/" . $row->id_residuo_peligroso; ?>
									<button type='button' class='btn btn-danger btn-mini' data-toggle='modal' data-target='.bs-modal-del' id='eliminar' title="Eliminar" onclick='delete_residuo(<?= $row->id_residuo_peligroso ?>, <?= "\"$row->residuo\"" ?>, <?= "\"$url_delete\""?>, <?= "\"$id_persona\"" ?> , <?= "\"$row->folio\"" ?> )'> <i class="fas fa-trash-alt"></i>  </button>
								</td>
							</tr>
							<?php } ?>	
						</tbody>
					</table>
				</form>

				<div class="form-row" style="margin: 15px 0 0px 0;">
					<div class="col">
						<form action="<?=base_url('administrador/admin_clientes/' . $id_persona)?>" method="POST">
							<button type="submit" class="btn btn-secondary btn-rounded" ><i class="icon-arrow-left"></i> Regresar </button>
						</form>
					</div>
					<div class="col">
						<form action="<?=base_url('administrador/nuevo_registro'); ?>" method="POST">
							<input type="hidden" value="<?=$id_persona?>" name="id_persona">
							<button type="submit" class="btn btn-primary btn-rounded" ><i class="icon-plus"></i> Nuevo Registro </button>
						</form>
					</div>
					<div class="col">
						<button id="reg_salidas" type="submit" form="form_bitacora_actualizar_registros" class="btn btn-primary btn-rounded" disabled="false"><i class="fas fa-check"></i> Registrar Salidas </button>
					</div>
					<div class="col">
						<form action="<?=base_url('administrador/generar_excel'); ?>" method="POST">
							<input type="hidden" value="<?=$id_persona?>" name="id_persona">
							<button type="submit" class="btn btn-primary btn-rounded" name="excel" ><i class="fas fa-file-excel"></i> Generar Excel </button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>	

<div class="modal fade bs-modal-del" tabindex=-1 role=dialog aria-labelledby=delete_resiudo_modal> <!-- modal bs-modal-del -->
	<div class="modal-dialog modal-sm"> 
		<div class="modal-content"> 
			<div class="modal-header"> 
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button> <h5 class="modal-title" id="delete_resiudo_modal">Eliminar - Folio: <span id="folio_span"></span> </h5>
			</div> 
			<div class=modal-body>
				¿Deseas eliminar registro de residuo: <strong> <span id="eliminar_span"></span></strong>?
			</div>
			<div class=modal-footer>
				<button type="button" class="btn btn-primary" data-dismiss="modal">Cancelar</button>
				<a href="" id='residuo_delete' class='btn btn-danger' role='button'> Eliminar</a>
			</div>
		</div> 
	</div>
</div><!-- Modal -->
