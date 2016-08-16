			<div class="span9">
				<div class="row-fluid">
					<div class="span5">
						<legend>Datos de la empresa</legend>
						<form id="form_actualiza" method="post" action="<?php echo site_url('cliente/actualizadatos_persona');?>">
						<input type="hidden" id="recibe" name="id_persona" value="<?php echo $id;?>" />
							<div class="well">
								<br>
								<center>
								Nombre o Razón Social
								<div class='input-prepend'>
									<span class='add-on'>
										<img src="img/glyphicons_450_factory.png" class="icon-form">
									</span>
									<input class="txt-well" id="nombre" type='text' value="<?php echo $cliente->nombre_empresa; ?>" name="nombre_empresa" readonly>
								</div>
								Calle 
								<div class='input-prepend'>
									<span class='add-on'>
										<img src="img/glyphicons_242_google_maps.png" class="icon-form">
									</span>
									<input class="txt-well" id="email" type='text'value="<?php echo $cliente->calle_empresa; ?>" name="calle_empresa">
								</div>
								Número
								<div class='input-prepend'>
									<span class='add-on'>
										<img src="img/glyphicons_242_google_maps.png" class="icon-form">
									</span>
									<input class="txt-well" id="email" type='text'value="<?php echo $cliente->numero_empresa; ?>" name="numero_empresa">
								</div>
								Colonia
								<div class='input-prepend'>
									<span class='add-on'>
										<img src="img/glyphicons_242_google_maps.png" class="icon-form">
									</span>
									<input class="txt-well" id="email" type='text'value="<?php echo $cliente->colonia_empresa; ?>" name="colonia_empresa">
								</div>
								Municipio
									<div class='input-prepend'>
										<span class='add-on'>
											<img src="img/glyphicons_242_google_maps.png" class="icon-form">
										</span>
										<input class="txt-well" id="municipio" name="municipio" type='text' value="<?php echo $cliente->municipio; ?>">
									</div>
								Código Postal
								<div class='input-prepend'>
									<span class='add-on'>
										<img src="img/glyphicons_242_google_maps.png" class="icon-form">
									</span>
									<input class="txt-well" id="email" type='text'value="<?php echo $cliente->cp_empresa; ?>" name="cp_empresa">
								</div>
								Estado
									<div class='input-prepend'>
										<span class='add-on'>
											<img src="img/glyphicons_242_google_maps.png" class="icon-form">
										</span>
										<input class="txt-well" id="estado" name="estado" type='text' value="<?php echo $cliente->estado; ?>">
									</div>
								Teléfono
									<div class='input-prepend'>
										<span class='add-on'>
											<img src="img/glyphicons_442_earphone.png" class="icon-form">
										</span>
										<input class="txt-well" id="telefono_empresa" name="telefono_empresa" type='text' value="<?php echo $cliente->telefono_empresa; ?>">
									</div>
								Dirección de Email
								<div class='input-prepend'>
									<span class='add-on'>
										<img src="img/glyphicons_010_envelope.png" class="icon-form">
									</span>
									<input class="txt-well" id="email" type='text'value="<?php echo $cliente->correo_empresa; ?>" name="correo_empresa">
								</div>
								</center>
								<br>
							</div>		
						</div>
						<div class="span2"></div>
						<div class="span5">
							<legend>Datos del contacto</legend>
							<div class="well">
								<br>
								<center>
								Nombre
								<div class='input-prepend'>
									<span class='add-on'>
										<img src="img/glyphicons_003_user.png" class="icon-form">
									</span>
									<input class="txt-well" id="nombre" type='text' value="<?php echo $cliente->nombre; ?>" name="nombre">
								</div>
								
								Teléfono
								<div class='input-prepend'>
									<span class='add-on'>
										<img src="img/glyphicons_442_earphone.png" class="icon-form">
									</span>
									<input class="txt-well" id="email" type='text' value="<?php echo $cliente->telefono_personal; ?>" name="telefono_personal">
									<input type="hidden" value="<?php echo $this->session->userdata('id') ?>" name="id_persona" >	
								</div>
								Telefono Alternativo
								<div class='input-prepend'>
									<span class='add-on'>
										<img src="img/glyphicons_442_earphone.png" class="icon-form">
									</span>
									<input class="txt-well" id="email" type='text' value="<?php echo $cliente->telefono_personal_alt;?>" name="telefono_personal_alt">
								</div>
								Direcion de Email
								<div class='input-prepend'>
									<span class='add-on'>
										<img src="img/glyphicons_010_envelope.png" class="icon-form">
									</span>
									<input class="txt-well" id="nombreemp" type='text' name="correo" value="<?php echo $cliente->correo; ?>" readonly>
								</div>
								<br/>
								<a class="btn btn-primary" href="<?php echo site_url('cliente/act_password');?>">Cambiar Contraseña</a>
								</center>
								<br>
							</div>
							<input type="button"  onclick="actualiza_datos();" value="Guardar Cambios" id="enviar" class="btn btn-primary pull-right"/>
						</form>
					</div>				
				</div>
			</div>