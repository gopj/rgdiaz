<div class="span12">
	<center><legend>Bitácora Residuos Peligrosos</legend></center>
	<div class="row">
		<div class="span12">
			<div style="overflow:scroll; width:100%; height:450px;">
				<table class="table table-hover" id="header-fixed">
					<thead>
						<th class="table-residuos">FOLIO DEL MANIFIESTO</th>
						<th class="table-residuos">RESIDUO PELIGROSO</th>
						<th class="table-residuos">CLAVE</th>
						<th class="table-residuos">CANTIDAD</th>
						<th class="table-residuos">UNIDAD MEDIDA</th>
						<th class="table-residuos">CARACTERÍSTICA PELIGROSIDAD</th>
						<th class="table-residuos">ÁREA DE GENERACIÓN</th>
						<th class="table-residuos">FECHA INGRESO</th>
						<th class="table-residuos">FECHA SALIDA</th>
						<th class="table-residuos">EMPRESA TRANSPORTISTA</th>
						<th class="table-residuos">NO. AUTORIZACIÓN</th>
						<th class="table-residuos">DESTINO FINAL</th>
						<th class="table-residuos">NO. AUTORIZACIÓN</th>
						<th class="table-residuos">MODALIDAD DE MANEJO</th>
						<th class="table-residuos">RESPONSABLE TÉCNICO</th>
						<th class="table-residuos">ACCIONES</th>
					</thead>
					<tbody>
						<?php
							foreach ($residuos as $row) {
						?>
						<tr bgcolor="#dcf29f">
							<td><?php echo $row->folio; ?></td>
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
							<td class="center center-align">
								<form action="<?php echo site_url('cliente/update_bit');?>" method="post">
									<input type="hidden" name="id_residuo_peligroso" value="<?php echo $row->id_residuo_peligroso;?>" />
									<input type="submit" value="Modificar" class="btn btn-primary btn-mini" <?php if($row->folio!='') ?>>
									<?php $url_delete = site_url('cliente/eliminar_bit/'). "/"; ?>
									<button type='button' class='btn btn-danger btn-mini' data-toggle='modal' data-target='.bs-modal-del' id='eliminar' onclick='delete_residuo(<?= $row->id_residuo_peligroso ?>, <?= "\"$row->residuo\"" ?>, <?= "\"$url_delete\"" ?> )'> Eliminar </button>
								</form>
							</td>
						</tr>
						<?php
							}
						?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<div class="row" style="margin-top:10px;">
		<div class="span5"></div>
		<div class="span1">
			<form action="<?php echo site_url('cliente/bitacora'); ?>" method="POST">
				<input type="submit" class="btn btn-primary pull-right" value="Nuevo Registro">
			</form>
		</div>
		<div class="span2">
			<form action="<?php echo site_url('cliente/generar_excel'); ?>" method="POST">
				<input type="hidden" value="<?php echo $id; ?>" name="id_persona">
				<input type="submit" class="btn btn-primary pull-left" name="excel" value="Generar Ecxel">
			</form>
		</div>
	</div>
	
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
        		<a href="" id='residuo_delete' class='btn btn-danger'role='button'> Eliminar</a>
			</div>
		</div> 
	</div>
</div><!-- Modal -->

<script type="text/javascript">
	$( "tr:odd" ).css( "background-color", "#ffffff" );
</script>>
