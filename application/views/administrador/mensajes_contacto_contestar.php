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
				</div>
			</div>
		</div>
	</div>
</div> 

 <form method="post">

Email: <input name="email" type="text" />

Subject: <input name="subject" type="text" />

Message:

<textarea name="comment" rows="15" cols="40"></textarea>

<input type="submit" value="Submit" />
</form>

  <?php echo CI_VERSION;

  echo $email;
   ?>