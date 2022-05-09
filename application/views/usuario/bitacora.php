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

<?php if ($this->session->userdata('completo') == 1) { ?>

<div class="span12">
	<form id="form_bitacora_actualizar_registros" action="<?=base_url('usuario/bitacora_actualiza_reg'); ?>" method="post">
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
								<td hidden="true"> <strong> <?php echo $row->id_residuo_peligroso; ?> </strong> </td>
								<td> <input type="checkbox" id="check" name="residuos_to_update[]" disabled value="" style="width: 12px; height: 12px;"></td>	
						<?php } else { ?>
							<tr bgcolor="#f9f936">
								<td hidden="true"> <strong> <?php echo $row->id_residuo_peligroso; ?> </strong> </td>
								<td> <input type="checkbox" id="check" name="residuos_to_update[]" onclick='activarSalidas();' value="<?php echo $row->id_residuo_peligroso; ?>" style="width: 12px; height: 12px;"></td>
						<?php } ?>
								
								<td><?php echo $row->id_persona . "-" . $row->folio; ?></td>
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
										<a href="<?= site_url('usuario/update_bit') . "/" . $row->id_residuo_peligroso ?>"  class="btn btn-primary btn-mini" > 
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


	<div style="margin-top:10px;">
		<!-- <div class="span3"></div> -->
		<div class="span2">
			<form action="<?=base_url('usuario/nuevo_registro'); ?>" method="POST">
				<input type="hidden" value="<?php echo $id; ?>" name="id_persona">
				<button type="submit" class="btn btn-primary pull-left" ><i class="icon-plus"></i> Nuevo Registro </button>
			</form>
		</div>

		<div class="span2">
			<button id="reg_salidas" type="submit" form="form_bitacora_actualizar_registros" class="btn btn-primary pull-left" disabled="false"><i class="icon-check"></i> Registrar Salidas </button>
		</div>		

		<div class="span3"></div>

		<div class="span2">
			<form action="<?=base_url('usuario/generar_excel'); ?>" method="POST">
				<input type="hidden" value="<?php echo $id; ?>" name="id_persona">
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
        		<a href="" id='residuo_delete' class='btn btn-danger'role='button'> Eliminar</a>
			</div>
		</div> 
	</div>
</div><!-- Modal -->

<script type="text/javascript">
    $('table').on('scroll', function () {
    $("table > *").width($("table").width() + $("table").scrollLeft());
});
</script>

<?php } else { ?>
				<div class="span9">
					<form method="post" action="<?=base_url('usuario/regisdatos_persona'); ?>">
					<div class="row-fluid">
						<div class="span5">
							<legend>Datos de la Empresa</legend>
							<div class="well">
								<br>
								<center>
									Nombre o Razón Social
									<div class='input-prepend'>
										<span class='add-on'>
											<img src="img/glyphicons_450_factory.png" class="icon-form">
										</span>
										<input class="txt-well" id="nombre" type='text' name="nombre_empresa" required>
									</div>
									Calle
									<div class='input-prepend'>
										<span class='add-on'>
											<img src="img/glyphicons_242_google_maps.png" class="icon-form">
										</span>
										<input class="txt-well" id="calle_empresa" name="calle_empresa" type='text' required>
									</div>
									Número
									<div class='input-prepend'>
										<span class='add-on'>
											<img src="img/glyphicons_242_google_maps.png" class="icon-form">
										</span>
										<input class="txt-well" id="numero_empresa" name="numero_empresa" type='text' required>
									</div>
									Número de Registro Ambiental
									<div class='input-prepend'>
										<span class='add-on'>
											<img src="img/glyphicons_242_google_maps.png" class="icon-form">
										</span>
										<input class="txt-well" id="numRegAmb" type='text' placeholder=''  name="numero_registro_ambiental">
									</div>
									Colonia
									<div class='input-prepend'>
										<span class='add-on'>
											<img src="img/glyphicons_242_google_maps.png" class="icon-form">
										</span>
										<input class="txt-well" id="colonia_empresa" name="colonia_empresa" type='text' required>
									</div>
									Municipio
									<div class='input-prepend'>
										<span class='add-on'>
											<img src="img/glyphicons_242_google_maps.png" class="icon-form">
										</span>
										<input class="txt-well" id="municipio" name="municipio" type='text' required>
									</div>
									Código Postal
									<div class='input-prepend'>
										<span class='add-on'>
											<img src="img/glyphicons_242_google_maps.png" class="icon-form">
										</span>
										<input class="txt-well" id="cp_empresa" name="cp_empresa" type='text' required>
									</div>
									Estado
									<div class='input-prepend'>
										<span class='add-on'>
											<img src="img/glyphicons_242_google_maps.png" class="icon-form">
										</span>
										<input class="txt-well" id="estado" name="estado" type='text' required>
									</div>
									Teléfono
									<div class='input-prepend'>
										<span class='add-on'>
											<img src="img/glyphicons_442_earphone.png" class="icon-form">
										</span>
										<input class="txt-well" id="telefono_empresa" name="telefono_empresa" type='text' required>
									</div>
									Direcion de Email
									<div class='input-prepend'>
										<span class='add-on'>
											<img src="img/glyphicons_010_envelope.png" class="icon-form">
										</span>
										<input class="txt-well" id="email" type='text' name="correo_empresa">
									</div>
								</center>
								<br>
							</div>
						</div>
						<div class="span2"></div>
						<div class="span5">
							<legend>Datos del Contacto</legend>
							<div class="well">
								<br>
								<center>
									Nombre
									<div class='input-prepend'>
										<span class='add-on'>
											<img src="img/glyphicons_003_user.png" class="icon-form">
										</span>
										<input class="txt-well" id="nombre" type='text' name="nombre" required>
									</div>
									Telefono
									<div class='input-prepend'>
										<span class='add-on'>
											<img src="img/glyphicons_442_earphone.png" class="icon-form">
										</span>
										<input class="txt-well" id="email" type='text' name="telefono_personal" required>
									</div>
									Telefono Alternativo
									<div class='input-prepend'>
										<span class='add-on'>
											<img src="img/glyphicons_442_earphone.png" class="icon-form">
										</span>
										<input class="txt-well" id="email" type='text' name="telefono_personal_alt">
									</div>
									Direcion de Email
									<div class='input-prepend'>
										<span class='add-on'>
											<img src="img/glyphicons_010_envelope.png" class="icon-form">
										</span>
										<input class="txt-well" type='text' name="correo" value="<?php echo $datos->correo; ?>" readonly>
									</div>
									Contraseña
									<div class='input-prepend'>
										<span class='add-on'>
											<img src="img/glyphicons_203_lock.png" class="icon-form">
										</span>
										<input class="txt-well" type='password' name="password" value="<?php echo $datos->password?>" readonly>
									</div>
								</center>
								<br>
							</div>
						</div>
					</div>
					<input type="hidden" value="<?php echo $this->session->userdata('id'); ?>" name="id_persona" >
					<input type="submit" value="Guardar" id="enviar" class="btn btn-primary pull-right">
					</form>
				</div>
			</div>
		</div>
<?php } ?>
