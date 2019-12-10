<div class="span9">
	<center><legend>Alta Recolector</legend></center>

	<form method='post' action="<?php echo site_url('administrador/recolector_alta');?>">
		<div class="well">
			</br>
			<div class="form-horizontal">
				<div class="control-group">
					<label for="nombre_recolector" class="control-label">Nombre:</label>
					<div class="controls">
							<input type="text" class="txt " style="width:85%; text-align: center;" name="nombre_recolector" id="nombre_recolector"  oninvalid="this.setCustomValidity('Ingresa nombre del recolector')" oninput="setCustomValidity('')"  required>
					</div>
				</div>
				<div class="control-group">
					<label for="correo" class="control-label">Correo electrónico:</label>
					<div class="controls">
						<input type="email" class="txt" style="width:85%; text-align: center;" name="correo" id="correo"  oninvalid="this.setCustomValidity('Ingresa correo')" oninput="setCustomValidity('')" required>
					</div>
				</div>
				<div class="control-group">
					<label for="clave" class="control-label">Clave:</label>
					<div class="controls">
						<div class="form-inline">
							<div class="form-inline">
								<input type="text" class="txt" style="width:68%; text-align: center;" name="clave" id="clave"  oninvalid="this.setCustomValidity('Ingresa una clave')" oninput="setCustomValidity('')" onchange="input_pass()" disabled required>
								<input type="hidden" class="txt" name="clave2" id="clave2">
								&nbsp;&nbsp;&nbsp;
								<label for="clave_automatica" class="checkbox">
									<input class="controls" type="checkbox" id="clave_automatica" name="clave_automatica" onclick="automatic_pass()" checked> Aleatoria
								</label>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="row-fluid">
				<div class="span4 offset4">
					<input type="submit" class="btn btn-large btn-block btn-primary" value="Guardar">
				</div>
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