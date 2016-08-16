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
        							<?php 
										foreach ($mensajitos->result() as $men) {
                  						$fecha_completa = $men->fecha;
                  						$fecha = explode(" ", $fecha_completa);
                  						echo "<tr>";
                      					echo "<td>".$men->numero."</td>";
                      					echo "<td>".$men->nombre."</td>";
                      					echo "<td>".$men->asunto."</td>";
                                        echo "<td>".$fecha[0]."</td>";
                                        echo "<td>".$men->status."</td>";
                                        ?>

						<form method='get' action="<?php echo site_url('administrador/mensaje_completo');?>">
                       		<input type="hidden" value="<?php echo base64_encode($men->numero); ?>" name="id_contacto"/>
                        	<td><center><input class="btn btn-small btn-primary" type="submit" value="Ver Detalles"></center></td>
                    	</form> 			 
									 <?php                                         
                                        echo "</tr>";
                      					}
                      				?>
							</tbody>
						</table>
					</div>
				</div>
			</div>