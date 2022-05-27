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
		<h3 class="breadcrumb-header"> Bitácora Residuos Peligrosos - <?=$nombre_empresa?> </h3>
	</div>
	<input type="hidden" id="prev_selected" name="prev_selected" value="<?=$id_persona;?>">
	<div class="card card-white">
		<div id="main-wrapper">
			<div class="card-body">

				<form id="form_bitacora_actualizar_registros" action="<?=base_url('usuario/bitacora_actualiza_reg')?>" method="post">
					<div class="row">
						<table>
							<thead>
								<!-- <th class="table-residuos">#</th> -->
								<th>SELECCIONA</th>
								<th>FOLIO DEL MANIFIESTO</th>
								<th style="width: 100px;">RESIDUO PELIGROSO</th>
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
							</thead>
							<tbody>
							
								<?php foreach ($residuos as $row) { ?>
									<?php if ($row->status == "R") { ?>
										<tr bgcolor="#dcf29f">
											<td hidden="true"> <strong> <?=$row->id_residuo_peligroso?> </strong> </td>
											<td> <input type="checkbox" id="check" name="residuos_to_update[]" disabled value="" style="width: 12px; height: 12px;"></td>
									<?php } else { ?>
										<tr bgcolor="#f9f936">
											<td hidden="true"> <strong> <?=$row->id_residuo_peligroso?> </strong> </td>
											<td> <input type="checkbox" id="check" name="residuos_to_update[]" onclick='activarSalidas();' value="<?php echo $row->id_residuo_peligroso; ?>" style="width: 12px; height: 12px;"></td>
									<?php } ?>
											<td><?=$row->folio?></td>
											<td><?=$row->residuo?></td>
											<td><?=$row->clave?></td>
											<td><?=$row->cantidad?></td>
											<td><?=$row->unidad?></td>
											<td><?=$row->caracteristica?></td>
											<td><?=$row->area_generacion ?></td>
											<td><?=date_bitacora($row->fecha_ingreso)?></td>
											<td><?=date_bitacora($row->fecha_salida)?></td>
											<td><?=$row->emp_tran?></td>
											<td><?=$row->no_aut_transp?></td>
											<td><?=$row->dest_final?></td>
											<td><?=$row->no_aut_dest_final?></td>
											<td><?=$row->sig_manejo?></td>
											<td><?=$row->resp_tec?></td>
											
											<td class="center center-align">
												<!-- Modificar -->
												<a href="<?=site_url('usuario/update_bit') . "/" . $id_persona . "/" . $row->id_residuo_peligroso?>"  class="btn btn-primary btn-mini" > 
													<i class="icon-pencil"></i> Modificar
												</a>
											</td>
			
										</tr>
								<?php } ?>
							</tbody>
						</table>
					</div>

					<input type="hidden" value="<?=$id_persona?>" name="id_persona" >		

				</form>
		


				<div class="form-row" style="margin: 15px 0 0px 0;">
					<div class="col">
						<form action="<?=base_url('usuario')?>" method="POST">
							<button type="submit" class="btn btn-secondary btn-rounded" ><i class="icon-arrow-left"></i> Regresar </button>
						</form>
					</div>
					<div class="col">
						<form action="<?=base_url('usuario/nuevo_registro')?>" method="POST">
							<input type="hidden" value="<?=$id_persona?>" name="id_persona">
							<button type="submit" class="btn btn-primary btn-rounded" ><i class="icon-plus"></i> Nuevo Registro </button>
						</form>
					</div>
					<div class="col">
						<button id="reg_salidas" type="submit" form="form_bitacora_actualizar_registros" class="btn btn-primary btn-rounded" disabled="false"><i class="icon-check"></i> Registrar Salidas </button>
					</div>
					<div class="col">
						<form action="<?=base_url('usuario/generar_excel')?>" method="POST">
							<input type="hidden" value="<?=$id_persona?>" name="id_persona">
							<button type="submit" class="btn btn-primary btn-rounded" name="excel" ><i class="icon-list-alt"></i> Generar Excel </button>
						</form>
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
				¿Deseas eliminar registro de residuo: <strong><span id="eliminar_span"></span></strong>?
			</div>
			<div class=modal-footer>
				<button type="button" class="btn btn-primary" data-dismiss="modal">Cancelar</button>
				<a href="" id='residuo_delete' class='btn btn-danger' role='button'> Eliminar</a>
			</div>
		</div> 
	</div>
</div><!-- Modal -->
