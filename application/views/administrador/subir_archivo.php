					<div class="span9">
						<center><legend>Administrar Carpetas</legend>
            Ubicación: <strong style="font-family:Californian FB; color:#4249D6;font-size:20px;"><?php echo $ruta;?></strong><br/>
            </center>
						<table id="tabla" class="display">
							<thead>
        						<tr>
                      <th width="5%"></th>
          					  <th width="35%">Nombre Empresa</th>
          						<th width="35%">Nombre del Contacto</th>
          						<th width="25%">Acciones</th>
        						</tr>
        					</thead>
        					<tbody>
        							<?php 
										    foreach ($carpetas->result() as $carpe) {
                  				echo "<tr>";
                          echo "<td><center><img src='img/iconos/folder.png'></center></td>";
                      ?>
                      <td>
                        <form method='post' action="<?php echo site_url('administrador/versubcarpeta');?>">
                          <input type="hidden" value="<?php echo $carpe->id_persona; ?>" name="id_persona"/>
                          <input type="hidden" value="<?php echo $carpe->ruta_carpeta; ?>" name="ruta_carpeta" >
                          <input class="nombre-carpeta"  type="submit" value="<?php echo $carpe->empresa?>">
                        </form>
                      </td>
                      <td>
                        <form method='post' action="<?php echo site_url('administrador/versubcarpeta');?>">
                          <input type="hidden" value="<?php echo $carpe->id_persona; ?>" name="id_persona"/>
                          <input type="hidden" value="<?php echo $carpe->ruta_carpeta; ?>" name="ruta_carpeta" >
                          <input class="nombre-carpeta"  type="submit" value="<?php echo $carpe->nombre?>">
                        </form>
                      </td>

                      <td align="center">
                        <div class="row-fluid" style="margin-top:10px;">
                          <div class="span6">
                            <form method='post' action="<?php echo site_url('administrador/versubcarpeta');?>">
                              <input type="hidden" value="<?php echo $carpe->id_persona; ?>" name="id_persona"/>
                              <input type="hidden" value="<?php echo $carpe->ruta_carpeta; ?>" name="ruta_carpeta" >
                              <input class="btn btn-mini btn-primary" type="submit" value="Ver Expediente">
                            </form>
                          </div>
                          <div class="span6">
                          <form id="ver_bitacora" method='post' action="<?php echo site_url('administrador/bitacora');?>">
                            <input type="hidden" value="<?php echo $carpe->id_persona; ?>" name="id_persona">
                            <input class="btn btn-mini btn-primary"  type="submit"  value="Ver Bitacora">
                          </form>
                          </div>
                        </div>
                      </td>
							        
								  <?php                                         
                      echo "</tr>";
                		}
                  ?>  						
							</tbody>
						</table>
					</div>
				</div>
			</div>