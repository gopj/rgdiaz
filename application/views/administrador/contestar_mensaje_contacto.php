<div class="span9">
	<legend>Contestar Mensaje</legend>
		<div class="row-fluid well">
			<div class="span6">
				<form id="form_contestar Mensaje" method="post" action="<?php echo site_url('administrador/contestar_mensaje_contacto/'. $completo->id_contacto); ?>">
					
						<br>
						Nombre o Nombre de la Empresa<br>
						<input class="txt-well" type="text" value="<?php echo $completo->nombre;?>" readonly><br>
						Correo<br>
						<input name="correo" class="txt-well" type="text" value="<?php echo $completo->correo;  ?>" readonly><br>
						Fecha Mensaje<br>
						<input class="txt-well" type="text" value="<?php echo $completo->fecha_mensaje; ?>" readonly><br>
					
			</div>
			<div class="span6">
				
				<br>
				Asunto<br>
				<input name="asunto" class="txt-well" type="text" value="<?php echo $completo->asunto; ?>" readonly><br>
				Teléfono<br>
				<input class="txt-well" type="text" value="<?php  echo $completo->telefono;?>" readonly><br>
				
			</div>
			<div class="row-fluid">
				<div class="span12">
					
						Mensaje<br>
						<textarea name="mensaje_contacto" class="txt-well" readonly><?php echo $completo->mensaje; ?></textarea><br>
					

					
						Redactar<br>
						<textarea name="texto_mensaje" class="txt-well" rows="9"></textarea>
					

					<div class="span4">
						<a href="<?php echo site_url('administrador/mensaje_completo?id_contacto=' . base64_encode($completo->id_contacto)); ?>" type="button" class="btn btn pull-right" style="margin-top: 15px;"><i class="icon-arrow-left"></i> Regresar</a>
					</div>

					<div class="span4">
						<button class="btn btn-primary pull-right" style="margin-top: 15px;" type="submit" value="contestar_mensaje_contacto"> <i class="icon-envelope"></i> Contestar Mensaje </button>
					</div>

				</div>
			</div>
			</form>
		</div>
	</div>
</div> 


