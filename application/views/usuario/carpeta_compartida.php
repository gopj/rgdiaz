				<?php 
					if ($this->session->userdata('completo') == 1) {
				?>
				<div class="span9">
					<center><legend>Documentos de RDíaz</legend></center>
					<table id="tabla" class="display">
						<thead>
							<tr>
								<th style="width:5%;"></th>
								<th style="width:75%;">Nombre</th>
								<th style="width:20%;">Acciones</th>
							</tr>
						</thead>
						<tbody>
							<?php
								foreach ($carpetas->result() as $carpe) {
							?>
							<tr>
								<td><center><img src='img/iconos/folder.png'></center></td>
								<td>
									<form method='post' action="<?php echo site_url('cliente/versubcarpeta'); ?>">
										<input type="hidden" value="<?php echo $carpe->id_persona; ?>" name="id_persona">
                      					<input type="hidden" value="<?php echo $carpe->ruta_carpeta; ?>" name="ruta_carpeta">
                      					<input class="nombre-carpeta"  type="submit" value="<?php echo $carpe->nombre; ?>">
									</form>
								</td>
								<td align="center">
									<form method='post' action="<?php echo site_url('cliente/versubcarpeta'); ?>">
										<input type="hidden" value="<?php echo $carpe->id_persona; ?>" name="id_persona">
                      					<input type="hidden" value="<?php echo $carpe->ruta_carpeta; ?>" name="ruta_carpeta">
                      					<input class="btn btn-mini btn-primary"  type="submit" value="Ver Carpeta">
									</form>
								</td>
							</tr>
							<?php
								}
								foreach ($archivo->result() as $arch) {
									echo "<tr>";
			                          $ext = explode('.', $arch->nombre);
			                          $extencion = array_pop($ext);
			                          if($extencion=='pdf'){
			                            echo "<td><center><img src='img/iconos/pdf.png'></center></td>";
			                          }elseif($extencion=='xls' || $extencion=='xlsx'){
			                            echo "<td><center><img src='img/iconos/xls.png'></center></td>";
			                          }elseif($extencion=='doc'|| $extencion=='docx'){
			                            echo "<td><center><img src='img/iconos/doc.png'></center></td>";
			                          }elseif($extencion=='jpg' || $extencion=='JPG'){
			                            echo "<td><center><img src='img/iconos/jpg.png'></center></td>";
			                          }elseif($extencion=='jpeg' || $extencion=='JPEG'){
			                            echo "<td><center><img src='img/iconos/jpeg.png'></center></td>";
			                          }elseif($extencion=='png' || $extencion=='PNG'){
			                            echo "<td><center><img src='img/iconos/png.png'></center></td>";
			                          }elseif($extencion=='gif'){
			                            echo "<td><center><img src='img/iconos/gif.png'></center></td>";
			                          }elseif($extencion=='txt'){
			                            echo "<td><center><img src='img/iconos/txt.png'></center></td>";
			                          } else {
			                            echo "<td><center><img src='img/iconos/unk.png'></center></td>";
			                          }
							?>
								<td><?php echo $arch->nombre; ?></td>
								<td align="center">
									<form method='post' action="<?php echo site_url('administrador/descargar'); ?>">
										<input type="hidden" value="<?php echo $arch->nombre; ?>" name="nombre">
										<input type="hidden" value="<?php echo $arch->ruta_archivo; ?>" name="ruta_archivo">
										<input class="btn btn-mini btn-primary"  type="submit" value="Descargar">
									</form>
								</td>
							</tr>
							<?php } ?>
						</tbody>
					</table>
					 
					
				</div>
			</div>
		</div>
		<?php 
			} else {
		?>
				<div class="span9">
					<form method="post" action="<?php echo site_url('cliente/regisdatos_persona'); ?>">
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
						</div>zz
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
										<input class="txt-well" type='text' name="correo" value="<?php echo $datos->correo;?>" readonly>
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