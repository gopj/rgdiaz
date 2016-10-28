<div class="span12">
	<form id="form_bitacora_actualizar_registros" action="<?php echo site_url('cliente/bitacora_actualiza_reg'); ?>" method="post">
	<center><legend>Bitácora Residuos Peligrosos</legend></center>
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
								<td class="center" hidden="true"> <strong> <?php echo $row->id_residuo_peligroso; ?> </strong> </td>
								<td class="center"> <input type="checkbox" id="check" name="residuos_to_update[]" disabled value=""></td>	
						<?php } else { ?>
							<tr bgcolor="#f9f936">
								<td class="center" hidden="true"> <strong> <?php echo $row->id_residuo_peligroso; ?> </strong> </td>
								<td class="center"> <input type="checkbox" id="check" name="residuos_to_update[]" value="<?php echo $row->id_residuo_peligroso; ?>"></td>
						<?php } ?>
								
								<td class="center"><?php echo $row->folio; ?></td>
								<td><?php echo $row->residuo; ?></td>
								<td class="center"><?php echo $row->clave; ?></td>
								<td class="center"><?php echo $row->cantidad; ?></td>
								<td class="center"><?php echo $row->unidad; ?></td>
								<td><?php echo $row->caracteristica; ?></td>
								<td><?php echo $row->area_generacion ?></td>
								<td class="center"><?php echo $row->fecha_ingreso; ?></td>
								<td class="center"><?php echo $row->fecha_salida; ?></td>
								<td><?php echo $row->emp_tran; ?></td>
								<td><?php echo $row->no_aut_transp; ?></td>
								<td><?php echo $row->dest_final; ?></td>
								<td><?php echo $row->no_aut_dest_final; ?></td>
								<td><?php echo $row->sig_manejo; ?></td>
								<td><?php echo $row->resp_tec; ?></td>
								
								<?php if ($row->status == "R") { ?>
									<td class="center center-align">
									<!-- Modificar -->
										<a  class="btn btn-primary btn-mini" disabled> 
											<i class="icon-pencil"></i> Modificar
										</a>
									</td>
								<?php } else { ?>
									<td class="center center-align">
									<!-- Modificar -->
										<a href="<?= site_url('cliente/update_bit') . "/" . $row->id_residuo_peligroso ?>"  class="btn btn-primary btn-mini" > 
											<i class="icon-pencil"></i> Modificar
										</a>
									</td>
								<?php } ?>
							</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
	</div>
	</form>
	<div class="row" style="margin-top:10px;">
		<div class="span5"></div>
		<div class="span1">
			<form action="<?php echo site_url('cliente/bitacora'); ?>" method="POST">
			<input type="hidden" value="<?php echo $id; ?>" name="id_persona">
				<input type="submit" class="btn btn-primary pull-right" value="Nuevo Registro">
			</form>
		</div>
		<div class="span2">
			<input type="submit" class="btn btn-primary pull-left" value="Registrar Salidas">
		</div>
		<div class="span2">
			<form action="<?php echo site_url('cliente/generar_excel'); ?>" method="POST">
				<input type="hidden" value="<?php echo $id; ?>" name="id_persona">
				<input type="submit" class="btn btn-primary pull-left" name="excel" value="Generar Ecxel">
			</form>
		</div>
	</div>
</div>


<div class="modal fade bs-modal-del" tabindex=-1 role=dialog aria-labelledby=mySmallModalLabel> <!-- modal bs-modal-del -->
	<div class="modal-dialog modal-sm"> 
		<div class=modal-content> 
			<div class=modal-header> 
				<button type=button class=close data-dismiss=modal aria-label=Close>
				<span aria-hidden=true>&times;</span>

				</button> <h4 class=modal-title id=mySmallModalLabel>Eliminar</h4> 
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
