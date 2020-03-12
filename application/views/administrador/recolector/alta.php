
    	<div class="col-md-8" style="padding-top:15px;" >
			<!-- form user info -->
			<div class="accordion" id="accordionAltaRecolector">
				<div class="card">
					<div class="card-header" id="headingOne">
						<h2 class="mb-0">
							<button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
								Alta Recolector
							</button>
						</h2>
					</div>

					<div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionAltaRecolector">
						<div class="card-body">
							<form class="form" role="form" autocomplete="off" method='post' action="<?php echo site_url('administrador/recolector_alta');?>">
								<div class="form-group row">
									<label class="col-lg-3 col-form-label form-control-label" for="nombre_recolector">Nombre</label>
									<div class="col-lg-9">
										<input class="form-control" type="text" class="txt " style="width:81%; text-align: center;" name="nombre_recolector" id="nombre_recolector"  oninvalid="this.setCustomValidity('Ingresa nombre del recolector')" oninput="setCustomValidity('')"  required>
									</div>
								</div>

								<div class="form-group row">
									<label class="col-lg-3 col-form-label form-control-label" for="correo">Correo Electronico</label>
									<div class="col-lg-9">
										<input class="form-control" type="email" class="txt" style="width:81%; text-align: center;" name="correo" id="correo"  oninvalid="this.setCustomValidity('Ingresa correo')" oninput="setCustomValidity('')" required>
									</div>
								</div>

								<div class="form-inline row">
									<label class="col-lg-3 col-form-label form-control-label" for="clave" style="justify-content: left;">Contraseña</label>
									<div class="col-lg-9">
										<input class="form-control" type="text" class="txt" style="width:54%; text-align: center;" name="clave" id="clave"  oninvalid="this.setCustomValidity('Ingresa una clave')" oninput="setCustomValidity('')" onchange="input_pass()" disabled required> &nbsp; &nbsp; &nbsp;

										<input type="hidden" class="txt" name="clave2" id="clave2">

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
				</div>
				<div class="card">
					<div class="card-header" id="headingTwo">
						<h2 class="mb-0">
							<button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
								Alta Vehículo
							</button>
						</h2>
					</div>
					<div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionAltaVehiculo">
						<div class="card-body">
							<form class="form" role="form" autocomplete="off" method='post' action="<?php echo site_url('administrador/recolector_alta_vehiculo');?>">
								<div class="form-group row">
									<label class="col-lg-3 col-form-label form-control-label" for="modelo">Modelo</label>
									<div class="col-lg-9">
										<input class="form-control" type="text" class="txt " style="width:81%; text-align: center;" name="modelo" id="modelo"  oninvalid="this.setCustomValidity('Ingresa moodelo del vehiculo')" oninput="setCustomValidity('')"  required>
									</div>
								</div>

								<div class="form-group row">
									<label class="col-lg-3 col-form-label form-control-label" for="marca">Marca</label>
									<div class="col-lg-9">
										<input class="form-control" type="text" class="txt" style="width:81%; text-align: center;" name="marca" id="marca"  oninvalid="this.setCustomValidity('Ingresa marca')" oninput="setCustomValidity('')" required>
									</div>
								</div>

								<div class="form-group row">
									<label class="col-lg-3 col-form-label form-control-label" for="tipo">Tipo</label>
									<div class="col-lg-9">
										<input class="form-control" type="text" class="txt" style="width:81%; text-align: center;" name="tipo" id="tipo"  oninvalid="this.setCustomValidity('Ingresa correo')" oninput="setCustomValidity('')" required>
									</div>
								</div>

								<div class="form-group row">
									<label class="col-lg-3 col-form-label form-control-label" for="placa">No. Placa</label>
									<div class="col-lg-9">
										<input class="form-control" type="text" class="txt" style="width:81%; text-align: center;" name="placa" id="placa"  oninvalid="this.setCustomValidity('Ingresa correo')" oninput="setCustomValidity('')" required>
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
				</div>
				<div class="card">
					<div class="card-header" id="headingTwo">
						<h2 class="mb-0">
							<button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
								Alta Destino
							</button>
						</h2>
					</div>
					<div id="collapseThree" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionAltaDestino">
						<div class="card-body">
							<form class="form" role="form" autocomplete="off" method='post' action="<?php echo site_url('administrador/recolector_alta_destino');?>">
								
								<div class="form-row">

									<div class="form-group col-lg-6">
										<label class="col-lg-6 col-form-label form-control-label" for="nombre_destino">Nombre Empresa Destino</label>
										<div class="col-lg-12">
											<input class="form-control" type="text" class="txt " name="nombre_destino" id="nombre_destino"  oninvalid="this.setCustomValidity('Ingresa moodelo de la Empresa Destino')" oninput="setCustomValidity('')"  required>
										</div>
									</div>

									<div class="form-group col-lg-6">
										<label class="col-lg-6 col-form-label form-control-label" for="numero_autorizacion">Numero de autorización</label>
										<div class="col-lg-12">
											<input class="form-control" type="text" class="txt" style="text-align: center;" name="Número de Autorización" id="numero_autorizacion" name="numero_autorizacion" oninvalid="this.setCustomValidity('Ingresa No de autorización. ej: 06-09-ll-01-2011')" oninput="setCustomValidity('')" required>
										</div>
									</div>

								</div>

								<div class="form-row">

									<div class="form-group col-lg-6">
										<label class="col-lg-6 col-form-label form-control-label" for="calle">Calle</label>
										<div class="col-lg-12">
											<input class="form-control" type="text" class="txt" style="text-align: center;" name="calle" id="calle" oninvalid="this.setCustomValidity('Ingresa calle')" oninput="setCustomValidity('')" required>
										</div>
									</div>
									
									<div class="form-group col-lg-3">
										<label class="col-lg-4 col-form-label form-control-label" for="num_ext">Núm. Ext.</label>
										<div class="col-lg-12">
											<input class="form-control" type="text" class="txt" style="text-align: center;" name="num_ext" id="num_ext" oninvalid="this.setCustomValidity('Ingresa el número exteriror')" oninput="setCustomValidity('')" required>
										</div>
									</div>

									<div class="form-group col-lg-3">
										<label class="col-lg-4 col-form-label form-control-label" for="num_int">Núm. Int.</label>
										<div class="col-lg-12">
											<input class="form-control" type="text" class="txt" style="text-align: center;" name="num_int" id="num_int" oninvalid="this.setCustomValidity('Ingresa el número exteriror')" oninput="setCustomValidity('')" required>
										</div>
									</div>

								</div>

								<div class="form-group row">
									<label class="col-lg-3 col-form-label form-control-label" for="cp">Código Postal</label>
									<div class="col-lg-9">
										<input class="form-control" type="text" class="txt" style="text-align: center;" name="cp" id="cp" oninvalid="this.setCustomValidity('Ingresa el número exteriror')" oninput="setCustomValidity('')" required>
									</div>
								</div>

								<div class="form-group row">
									<label class="col-lg-3 col-form-label form-control-label" for="colonia">Colonia</label>
									<div class="col-lg-9">
										<input class="form-control" type="text" class="txt" style="text-align: center;" name="colonia" id="colonia" oninvalid="this.setCustomValidity('Ingresa el número exteriror')" oninput="setCustomValidity('')" required>
									</div>
								</div>

								<div class="form-group row">
									<label class="col-lg-3 col-form-label form-control-label" for="municipio">Municipio</label>
									<div class="col-lg-9">
										<input class="form-control" type="text" class="txt" style="text-align: center;" name="municipio" id="municipio" oninvalid="this.setCustomValidity('Ingresa el número exteriror')" oninput="setCustomValidity('')" required>
									</div>
								</div>

								<div class="form-group row">
									<label class="col-lg-3 col-form-label form-control-label" for="estado">Estado</label>
									<div class="col-lg-9">
										<input class="form-control" type="text" class="txt" style="text-align: center;" name="estado" id="estado" oninvalid="this.setCustomValidity('Ingresa el número exteriror')" oninput="setCustomValidity('')" required>
									</div>
								</div>

								<div class="form-group row">
									<label class="col-lg-3 col-form-label form-control-label" for="telefono">Télefono</label>
									<div class="col-lg-9">
										<input class="form-control" type="text" class="txt" style="text-align: center;" name="telefono" id="telefono" oninvalid="this.setCustomValidity('Ingresa el número exteriror')" oninput="setCustomValidity('')" required>
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



