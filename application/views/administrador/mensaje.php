<div class="span9">
	<center><legend>Detalles de Mensaje</legend></center>
		<div class="row-fluid well">
			<div class="span6">
				<form id="form_alta_cliente" method="post" action="<?php echo site_url('administrador/alta_cliente'); ?>">
					<center>
						<br>
						Nombre o Nombre de la Empresa<br>
						<input class="txt-well" type="text" value="<?php echo $completo->nombre;?>" readonly><br>
						Correo<br>
						<input name="correo" class="txt-well" type="text" value="<?php echo $completo->correo;  ?>" readonly><br>
						Fecha Mensaje<br>
						<input class="txt-well" type="text" value="<?php echo $completo->fecha_mensaje; ?>" readonly><br>
					</center>
			</div>
			<div class="span6">
				<center>
				<br>
				Asunto<br>
				<input class="txt-well" type="text" value="<?php echo $completo->asunto; ?>" readonly><br>
				Teléfono<br>
				<input class="txt-well" type="text" value="<?php  echo $completo->telefono;?>" readonly><br>
				</center>
			</div>
			<div class="row-fluid">
				<div class="span12">
					<center>
						Mensaje<br>
						<textarea class="txt-well" readonly><?php echo $completo->mensaje; ?></textarea><br>
					</center>

					<div class="span3">
						<a href="<?php echo site_url('administrador/mensajes_contacto'); ?>" type="button" class="btn btn pull-right" style="margin-top: 15px;"><i class="icon-arrow-left"></i> Regresar</a>
					</div>

					<div class="span3">
						<input class="btn btn-primary pull-right" style="margin-top: 15px;" onclick="swith();" type="button" value="Dar de Alta">
					</div>

				</form>
					<div class="span3">
						<form action="<?php echo site_url('administrador/contestar_mensaje_contacto');?>">
								<button class="btn btn-primary pull-right" style="margin-top: 15px;" type="submit" value="contestar_mensaje_contacto"> <i class="icon-envelope"></i> Contestar Mensaje </button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<!--Modales-->
<div id="download" class="modal hide fade">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal">&times;</button>
		Descargar archivo
	</div>
	<div class="modal-body">
		<center>
			<img src="img/download.png" height="100" width="100">
			<br/>
			Quiere descargar este archivo
		</center>
	</div>
	<div class="modal-footer">
		<button type="button" class="btn btn-primary" data-dismiss="modal">Descargar</button>
	</div>
</div>

<div id="modal" class="modal hide fade">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal">&times;</button>
		Nuevo mensaje
	</div>
	<div class="modal-body">
		Asunto:
		<div class='input-prepend'>
			<span class='add-on'>
				<img src="img/glyphicons_065_tag.png" height="18" width="18">
			</span>
			<input class="txt-modal" type='text'>
		</div>
		Mensaje:
		<div class='input-prepend'>
			<span class='add-on'>
				<img src="img/glyphicons_245_chat.png" height="18" width="18">
			</span>
			<textarea class="area-modal" id="mensaje" rows='4' cols="20"></textarea>
		</div>
	</div>
	<div class="modal-footer">
		<button type="button" class="btn btn-primary" data-dismiss="modal">Enviar</button>
	</div>
</div>

<div id="entrada" class="modal hide fade">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal">&times;</button>
		Mensaje resivido
	</div>
	<div class="modal-body">
		De:
		<div class='input-prepend'>
			<span class='add-on'>
				<img src="img/glyphicons_003_user.png" height="18" width="18">
			</span>
			<input class="txt-modal" id="nombre" type='text' readonly>
		</div>
		Asunto:
		<div class='input-prepend'>
			<span class='add-on'>
				<img src="img/glyphicons_065_tag.png" height="18" width="18">
			</span>
			<input class="txt-modal" type='text' readonly>
		</div>
		Fecha:
		<div class='input-prepend'>
			<span class='add-on'>
				<img src="img/glyphicons_045_calendar.png" height="18" width="18">
			</span>
			<input class="txt-fecha" id="nombre" type='text' readonly>
		</div>
		Mensaje:
		<div class='input-prepend'>
			<span class='add-on'>
				<img src="img/glyphicons_245_chat.png" height="18" width="18">
			</span>
			<textarea class="area-modal" id="mensaje" rows='4' cols="20" readonly></textarea>
		</div>
	</div>
	<div class="modal-footer">
		<button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
	</div>
</div>
<!---->
