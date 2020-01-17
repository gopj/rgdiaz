 <div class="row">
    <div class="col-md-12">}
    	<div class="col-md-6 offset-md-3">
			<!-- form user info -->
	        <div class="card card-outline-secondary">
	            <div class="card-header">
	                <h3 class="mb-0">Alta Recolector</h3>
	            </div>
	            <div class="card-body">
	                <form class="form" role="form" autocomplete="off" method='post' action="<?php echo site_url('administrador/recolector_alta');?>">
	                    <div class="form-group row">
	                        <label class="col-lg-3 col-form-label form-control-label" for="nombre_recolector">Nombre</label>
	                        <div class="col-lg-9">
	                            <input class="form-control" type="text" class="txt " style="width:85%; text-align: center;" name="nombre_recolector" id="nombre_recolector"  oninvalid="this.setCustomValidity('Ingresa nombre del recolector')" oninput="setCustomValidity('')"  required>
	                        </div>
	                    </div>
	                
	                    <div class="form-group row">
	                        <label class="col-lg-3 col-form-label form-control-label" for="correo">Correo Electronico</label>
	                        <div class="col-lg-9">
	                        	<input class="form-control" type="email" class="txt" style="width:85%; text-align: center;" name="correo" id="correo"  oninvalid="this.setCustomValidity('Ingresa correo')" oninput="setCustomValidity('')" required>
	                        </div>
	                    </div>

	                    <div class="form-inline row">
	                        <label class="col-lg-3 col-form-label form-control-label" for="clave">Contraseña</label>
	                        <div class="col-lg-9">
	                            <input class="form-control" type="text" class="txt" style="width:54%; text-align: center;" name="clave" id="clave"  oninvalid="this.setCustomValidity('Ingresa una clave')" oninput="setCustomValidity('')" onchange="input_pass()" disabled required>

								<input type="hidden" class="txt" name="clave2" id="clave2">

								&nbsp; &nbsp; &nbsp;

								<div class="custom-control custom-checkbox custom-control-inline">
									<input type="checkbox" class="custom-control-input" id="clave_automatica" value="Toxico" name="clave_automatica" onclick="automatic_pass();" checked>
									<label class="custom-control-label" for="clave_automatica">Aleatoria</label>
								</div>
	                        </div>
	                    </div>

	                    <br>
	                    <div class="form-group row">
	                        <label class="col-lg-3 col-form-label form-control-label"></label>
	                        <div class="col-lg-9">
	                            <input type="submit" class="btn btn-primary" value="Guardar">
	                        </div>
	                    </div>

	                </form>
	            </div>
	        </div>
       		<!-- /form user info -->
       	</div>	
    </div>
</div>

<br><br>


<script type="text/javascript">
window.onload = function() {
	var randomstring = gen_pass();

	document.getElementById('clave').value = randomstring;
	document.getElementById('clave2').value = randomstring;
};

$(document).ready(function ($) {
	var randomstring = gen_pass();

	document.getElementById('clave').value = randomstring;
	document.getElementById('clave2').value = randomstring;
});
</script>