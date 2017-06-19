				<div class="span9">
					<center><legend>Alta de Cliente</legend></center>
					<form method="post" id="altaCAdmin" action="<?php echo site_url('administrador/registra_cliente_admin')?>">
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
										<input class="txt-well" id="nomEmp" type='text' name="nombre_empresa">
									</div>
									Calle 
									<div class='input-prepend'>
										<span class='add-on'>
											<img src="img/glyphicons_242_google_maps.png" class="icon-form">
										</span>
										<input class="txt-well" id="calleEmp" type='text' name="calle_empresa">
									</div>
									Número
									<div class='input-prepend'>
										<span class='add-on'>
											<img src="img/glyphicons_242_google_maps.png" class="icon-form">
										</span>
										<input class="txt-well" id="numEmp" type='text' placeholder='Ejemplo: 45'  name="numero_empresa">
									</div>
									Número de Registro Ambiental
									<div class='input-prepend'>
										<span class='add-on'>
											<img src="img/glyphicons_242_google_maps.png" class="icon-form">
										</span>
										<input class="txt-well" id="numRegAmb" type='text' placeholder='Ejemplo: 45'  name="numero_registro_ambiental">
									</div>
									Colonia
									<div class='input-prepend'>
										<span class='add-on'>
											<img src="img/glyphicons_242_google_maps.png" class="icon-form">
										</span>
										<input class="txt-well" id="colEmp" type='text' name="colonia_empresa">
									</div>
									Municipio
									<div class='input-prepend'>
										<span class='add-on'>
											<img src="img/glyphicons_242_google_maps.png" class="icon-form">
										</span>
										<input class="txt-well" id="munEmp" type='text' name="municipio">
									</div>
									Código Postal
									<div class='input-prepend'>
										<span class='add-on'>
											<img src="img/glyphicons_242_google_maps.png" class="icon-form">
										</span>
										<input class="txt-well" id="cpEmp" type='text' name="cp_empresa">
									</div>
									Estado
									<div class='input-prepend'>
										<span class='add-on'>
											<img src="img/glyphicons_242_google_maps.png" class="icon-form">
										</span>
										<input class="txt-well" id="esEmp" type='text' name="estado">
									</div>
									Teléfono
									<div class='input-prepend'>
										<span class='add-on'>
											<img src="img/glyphicons_442_earphone.png" class="icon-form">
										</span>
										<input class="txt-well" id="telEmp" type='text' name="telefono_empresa">
									</div>
									Dirección de Email
									<div class='input-prepend'>
										<span class='add-on'>
											<img src="img/glyphicons_010_envelope.png" class="icon-form">
										</span>
										<input class="txt-well" id="correo_empresa" type="email"  type='text' name="correo_empresa">
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
										<input class="txt-well" id="nomCont" type='text' name="nombre">
									</div>
									Teléfono
									<div class='input-prepend'>
										<span class='add-on'>
											<img src="img/glyphicons_442_earphone.png" class="icon-form">
										</span>
										<input class="txt-well" id="telCont" type='text' name="telefono_personal">
									</div>
									Teléfono Alternativo
									<div class='input-prepend'>
										<span class='add-on'>
											<img src="img/glyphicons_442_earphone.png" class="icon-form">
										</span>
										<input class="txt-well" id="telCont_alt" type='text' name="telefono_personal_alt">
									</div>
									Direcion de Email
									<div class='input-prepend'>
										<span class='add-on'>
											<img src="img/glyphicons_010_envelope.png" class="icon-form">
										</span>
										<input class="txt-well" id="emailCont" name="correo" type='text'>
									</div>
								</center>
								<br>
							</div>
						</div>
					</div>
					<input type="button" value="Dar de Alta" id="enviar" onclick="alta_cliente_admin();" class="btn btn-primary pull-right">
					</form>
				</div>
			</div>
		</div>