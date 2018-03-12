<div class="span9">
	<center><legend>Alta Recolector</legend></center>

	<form method='post' action="<?php echo site_url('administrador/recolector_alta');?>">
		<div class="well">
			</br>
			<div class="form-horizontal">
				<div class="control-group">
					<label for="nombre_recolector" class="control-label">Nombre:</label>
					<div class="controls">
						<div class="form-inline">
							<input type="text" class="txt" style="width:70%; text-align: center;" name="nombre_recolector" id="nombre_recolector"  oninvalid="this.setCustomValidity('Ingresa nombre del recolector')" oninput="setCustomValidity('')"  required>
						</div>
					</div>
				</div>
				<div class="control-group">
					<label for="correo" class="control-label">Correo electrónico:</label>
					<div class="controls">
						<div class="form-inline">
							<input type="email" class="txt" style="width:70%; text-align: center;" name="correo" id="correo"  oninvalid="this.setCustomValidity('Ingresa correo')" oninput="setCustomValidity('')" required>
						</div>
					</div>
				</div>
				<div class="control-group">
					<label for="clave" class="control-label">Generar clave automática:</label>
					<div class="controls">
						<div class="form-inline">
							<input type="checkbox" id="clave_automatica" name="clave_automatica" onclick="automatic_pass()" checked>

							&nbsp;&nbsp;&nbsp;&nbsp;
							<label for="">Clave:</label>
							<input type="text" class="txt" style="width:58%; text-align: center;" name="clave" id="clave"  oninvalid="this.setCustomValidity('Ingresa una clave')" oninput="setCustomValidity('')" disabled required>
							<input type="hidden" class="txt" style="width:58%; text-align: center;" name="clave2" id="clave2">
						</div>
					</div>
				</div>

			<input type="submit" class="btn btn-primary" value="Guardar">

			</div>  
			
		</div>      
	</form>
</div>

<script type="text/javascript">
$(document).ready(function ($) {
	var randomstring = gen_pass();

	document.getElementById('clave').value = randomstring;
	document.getElementById('clave2').value = randomstring;
});
</script>