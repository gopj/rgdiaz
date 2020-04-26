		<div class="row">
			<div class="span12">
				<div class="texttitle well barrabackground">Contáctanos</div>
			</div>
		</div>
		<div class="row">
				<div class="span5">				
						<form name="form_contacto" id="form_contacto" method="post" action="<?php echo site_url('home/contacto_mensaje')?>">
							
							<div class="well">
							<center>
							<br>
							Nombre del Contacto o de la Empresa
							<div class='input-prepend'>
								<span class='add-on'>
									<img src="img/glyphicons_003_user.png" class="icon-form">
								</span>
								<input class="txt-well" name="nombre" id="nombre" type='text'>
							</div>
							Teléfono
							<div class='input-prepend'>
								<span class='add-on'>
									<img src="img/glyphicons_442_earphone.png" class="icon-form">
								</span>
								<input class="txt-well" name="telefono" id="telefono" type='text'>
							</div>
							Dirección de Email
							<div class='input-prepend'>
								<span class='add-on'>
									<img src="img/glyphicons_010_envelope.png" class="icon-form">
								</span>
								<input class="txt-well" name="email" id="email" type='text'>
							</div>
							Asunto
							<div class='input-prepend'>
								<span class='add-on'>
									<img src="img/glyphicons_065_tag.png" class="icon-form">
								</span>
								<input class="txt-well" name="asunto" id="asunto" type='text'>
							</div>
							Mensaje
							<div class='input-prepend'>
								<span class='add-on'>
									<img src="img/glyphicons_245_chat.png" class="icon-form">
								</span>
								<textarea class="txt-well" name="mensaje" id="mensaje" rows='4' cols="20"></textarea>
							</div>
							</center>
							</div>
							<input type="button" value="Enviar" id="enviar" onclick="validarForm()" class="btn btn-primary pull-right"/>
						</form>
					</div>
				<div class="span7">
					<p style="font-weight:normal; font-size:16px;">
						Ante cualquier petición de información o solicitud de alguno de nuestros servicios, envíenos un mensaje llenando los campos adjuntos y pulse <b>“Enviar”</b>. En breve nos pondremos en contacto con usted; de antemano agradecemos su interés por contactarnos.
					</p>
					<br>
					<label style="font-size:20px;">Telefonos</label>
					<label style="font-weight:normal; padding-left:15px; font-size:16px;">Nextel: 312-157-8255</label>
					<label style="font-weight:normal; padding-left:15px; font-size:16px;">Id: 92*12*42073</label>
					<br>
					<label style="font-weight:normal; padding-left:15px; font-size:16px;">Celular: 312-120-9233</label>
					<label style="font-weight:normal; padding-left:15px; font-size:16px;">Nextel: 312-163-9599</label>
					<label style="font-weight:normal; padding-left:15px; font-size:16px;">Id: 92*12*62399</label>
					<br>
					<label style="font-size: 20px;">E-mail</label>
					<label style="font-weight:normal; padding-left:15px; font-size:16px;">diaz281@yahoo.com.mx</label>
				</div>
			</div>
		</div>
			