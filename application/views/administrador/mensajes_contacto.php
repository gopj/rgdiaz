<div class="span9">
	<center><legend>Mensajes de Contacto</legend></center>
	<table id="tabla" class="display">
		<thead>
			<tr>	
				<th>No.</th>
				<th>Nombre</th>
				<th>Asunto</th>
				<th>Fecha</th>
				<th>Estado</th>
				<th>Acciones</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($mensajitos->result() as $men) {
					$fecha_completa = $men->fecha;
					$fecha = explode(" ", $fecha_completa);

					echo "<tr>";
						echo "<td>".$men->numero."</td>";
						echo "<td>".$men->nombre."</td>";
						echo "<td>".$men->asunto."</td>";
						echo "<td>".$fecha[0]."</td>";
						echo "<td>".$men->status."</td>"; ?>
						<td align='center'> 
							<div class="row-fluid" style="margin-top:3px;">
	              				<div class="span6">
									<form method='get' action="<?php echo site_url('administrador/mensaje_completo');?>">
										<input type="hidden" value="<?php echo base64_encode($men->numero); ?>" name="id_contacto"/>
										<button type="submit" class="btn btn-mini btn-primary " name="detalles" title="Ver Detalles"><i class="icon-list-alt"></i> Detalles </button>
									</form> 
								</div>
								<div class="span6">	
									<?php $url_delete = site_url('administrador/eliminar_mensaje') . "/" . $men->numero ; ?>
									<button id="del_mensaje" type="button" class="btn btn-mini btn-danger " name="eliminar" title="Eliminar" data-toggle='modal' data-target='.modal-del-mensaje' onclick='delete_mensaje(<?= $men->numero ?>, <?= "\"$url_delete\"" ?>)'><i class=" icon-remove"></i> Eliminar</button>
								</div>
							</div>
						</td>
			<?php   echo "</tr>"; } ?>
		</tbody>
	</table>
</div>
<div class="modal fade modal-del-mensaje" tabindex=-1 role=dialog aria-labelledby=delete_mensaje_modal> <!-- modal bs-modal-del-mensaje -->
	<div class="modal-dialog modal-sm"> 
		<div class="modal-content"> 
			<div class="modal-header"> 
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button> <h5 class="modal-title" id="delete_mensaje_modal">Eliminar Mensaje </h5>
			</div> 
			<div class=modal-body>
				¿Deseas eliminar el mensaje No. <span id="id_contacto"></span>?
			</div>
			<div class=modal-footer>
				<button type="button" class="btn btn-primary" data-dismiss="modal">Cancelar</button>
				<a href="" id='mensaje_delete' class='btn btn-danger' role='button'> Eliminar</a>
			</div>
		</div> 
	</div>
</div><!-- Modal -->