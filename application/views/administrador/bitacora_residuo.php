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
<link rel="stylesheet" type="text/css" href="css/table_bitacora.css">

<div class="span12">
	<form id="form_bitacora_actualizar_registros" action="<?php echo site_url('administrador/bitacora_actualiza_reg'); ?>" method="post">
	<center><legend> Bitácora Residuos Peligrosos - <?= $nombre_empresa; ?> </legend></center>
	<div class="row">
		<div class="span12">
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
								<td hidden="true"> <strong> <?php echo $row->id_residuo_peligroso; ?> </strong> </td>
								<td> <input type="checkbox" id="check" name="residuos_to_update[]" disabled value="" style="width: 12px; height: 12px;"></td>	
						<?php } else { ?>
							<tr bgcolor="#f9f936">
								<td hidden="true"> <strong> <?php echo $row->id_residuo_peligroso; ?> </strong> </td>
								<td> <input type="checkbox" id="check" name="residuos_to_update[]" onclick='activarSalidas();' value="<?php echo $row->id_residuo_peligroso; ?>" style="width: 12px; height: 12px;"></td>
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
									<a href="<?= site_url('administrador/update_bit') . "/" . $id_persona . "/" . $row->id_residuo_peligroso ?>"  class="btn btn-primary btn-mini" > 
										<i class="icon-pencil"></i> Modificar
									</a>

									<!-- ELiminar -->
									<?php $url_delete = site_url('administrador/eliminar_bit'). "/" . $id_persona . "/" . $row->id_residuo_peligroso; ?>
									<button type='button' class='btn btn-danger btn-mini' data-toggle='modal' data-target='.bs-modal-del' id='eliminar' onclick='delete_residuo(<?= $row->id_residuo_peligroso ?>, <?= "\"$row->residuo\"" ?>, <?= "\"$url_delete\""?>, <?= "\"$id_persona\"" ?> , <?= "\"$row->folio\"" ?> )'> <i class="icon-remove"></i>  </button>
								</td>
								
							</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
	</div>

	<input type="hidden" value="<?php echo $id_persona; ?>" name="id_persona" >		

	</form>

	<div style="margin-top:10px;">
		<!-- <div class="span3"></div> -->
		<div class="span2">
			<form action="<?php echo site_url('administrador/nuevo_registro'); ?>" method="POST">
				<input type="hidden" value="<?php echo $id_persona; ?>" name="id_persona">
				<button type="submit" class="btn btn-primary pull-left" ><i class="icon-plus"></i> Nuevo Registro </button>
			</form>
		</div>

		<div class="span2">
			<button id="reg_salidas" type="submit" form="form_bitacora_actualizar_registros" class="btn btn-primary pull-left" disabled="false"><i class="icon-check"></i> Registrar Salidas </button>
		</div>		

		<div class="span2"></div>

		<div class="span5">
			<form action="<?php echo site_url('administrador/generar_excel'); ?>" method="POST">
				<input type="hidden" value="<?php echo $id_persona; ?>" name="id_persona">
				<button type="submit" class="btn btn-primary pull-right" name="excel" ><i class="icon-list-alt"></i> Generar Excel </button>
			</form>
		</div>
	</div>

	
</div>


<div class="modal fade bs-modal-del" tabindex=-1 role=dialog aria-labelledby=mySmallModalLabel> <!-- modal bs-modal-del -->
	<div class="modal-dialog modal-sm"> 
		<div class="modal-content"> 
			<div class="modal-header"> 
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button> <h5 class="modal-title" id="mySmallModalLabel">Eliminar - Folio: <span id="folio_span"></span> </h5>
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

<script type="text/javascript">
    $('table').on('scroll', function () {
    $("table > *").width($("table").width() + $("table").scrollLeft());
});
</script>