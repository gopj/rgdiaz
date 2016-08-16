					<div class="span9">
						<center><legend>Bitacora Residuos Peligrosos</legend></center>
						<div class="row">
							<div class="span9">
								<div style="overflow:scroll; width:100%; height:300px;">
									<table class="table table-hover">
										<thead>
											<th class="table-residuos">FOLIO DEL MANIFIESTO</th>
											<th class="table-residuos">RESIDUO PELIGROSO</th>
											<th class="table-residuos">CLAVE</th>
											<th class="table-residuos">CANTIDAD</th>
											<th class="table-residuos">UNIDAD MEDIDA</th>
											<th class="table-residuos">CARACTERISTICA PELIGROSIDAD</th>
											<th class="table-residuos">AREA DE GENERACION</th>
											<th class="table-residuos">FECHA INGRESO</th>
											<th class="table-residuos">FECHA SALIDA</th>
											<th class="table-residuos">EMPRESA TRANSPORTISTA</th>
											<th class="table-residuos">NO. AUTORIZACIÓN</th>
											<th class="table-residuos">DESTINO FINAL</th>
											<th class="table-residuos">NO. AUTORIZACIÓN</th>
											<th class="table-residuos">MODALIDAD DE MANEJO</th>
											<th class="table-residuos">RESPONSABLE TECNICO</th>
											<th class="table-residuos">ACCIONES</th>
										</thead>
										<tbody>
											<?php
												foreach ($residuos as $row) {
											?>
											<tr>
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
													<form action="<?php echo site_url('administrador/modificar_bitacora'); ?>" method="POST">
														<input type="hidden" name="id_bitacora" value="<?php echo $row->id_residuo_peligroso; ?>">
														<input type="hidden" name="id_persona" value="<?php echo $id_persona ?>">
														<input type="submit" value="Modificar" name="enviar" class="btn btn-primary btn-mini">
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
							<div class="span2">
								<form method="post" action="<?php echo site_url('administrador/subir_archivo');?>">
                    				<input type="submit" class="btn btn-primary" value="Regresar">
                  				</form>
							</div>
							<div class="span3"></div>
							<div class="span2">
								<form action="<?php echo site_url('administrador/nuevo_registro'); ?>" method="POST">
									<input type="hidden" value="<?php echo $id_persona; ?>" name="id_persona">
									<input type="submit" class="btn btn-primary pull-right" value="Nuevo Registro">
								</form>
							</div>
							<div class="span2">
								<form action="<?php echo site_url('administrador/generar_ecxel'); ?>" method="POST">
									<input type="hidden" value="<?php echo $id_persona; ?>" name="id_persona">
									<input type="submit" class="btn btn-primary pull-left" name="excel" value="Generar Ecxel">
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>