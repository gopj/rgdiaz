
    	<div class="col-md-8" style="padding-top:15px;" >
			<!-- form user info -->
			<div class="accordion" id="accordionAltaRecolector">
				<div class="card">
					<div class="card-header" id="headingOne">
						<h2 class="mb-0">
							<button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
								Recolector
							</button>
						</h2>
					</div>

					<div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionAltaRecolector">
						<div class="card-body">
							<form class="form" role="form" autocomplete="off" method='post' action="<?php echo site_url('administrador/recolector_consulta');?>">

								<div class="form-group row">
									<label class="col-lg-3 col-form-label form-control-label" for="id_persona"> Selecciona Correo </label>
									<div class="col-lg-9">
										<select class="form-control" style="width:81%;" onclick="get_recolector(this.value)" id="id_persona" name="id_persona">
											<option value=""> Nuevo </option>
											<?php foreach($recolectores->result() as $row){ ?>
												<option value="<?php echo $row->id_persona;?>"><?php echo $row->correo; ?></option>
											<?php } ?>
										</select>
									</div>
								</div>

								<div class="form-group row">
									<label class="col-lg-3 col-form-label form-control-label" for="nombre_recolector">Nombre</label>
									<div class="col-lg-9">
										<input class="form-control" type="text" class="txt " style="width:81%; text-align: center;" name="nombre_recolector" id="nombre_recolector" oninvalid="this.setCustomValidity('Ingresa nombre del recolector'); " oninput="setCustomValidity(''); onchange_recolector()"  required>
									</div>
								</div>

								<div class="form-group row">
									<label class="col-lg-3 col-form-label form-control-label" for="correo">Correo Electronico</label>
									<div class="col-lg-9">
										<input class="form-control" type="email" class="txt" style="width:81%; text-align: center;" name="correo" id="correo" oninvalid="this.setCustomValidity('Ingresa correo')" oninput="setCustomValidity(''); onchange_recolector()" required>
									</div>
								</div>

								<div class="form-inline row">
									<label class="col-lg-3 col-form-label form-control-label" for="clave" style="justify-content: left;">Contraseña</label>
									<div class="col-lg-9">
										<input class="form-control" type="text" class="txt" style="width:54%; text-align: center;" name="clave" id="clave" oninvalid="this.setCustomValidity('Ingresa una clave')" oninput="setCustomValidity(''); onchange_recolector()" onchange="input_pass()" required> &nbsp; &nbsp; &nbsp;

										<input type="hidden" class="txt" name="clave2" id="clave2">

										<div class="custom-control custom-checkbox custom-control-inline">
											<input type="checkbox" class="custom-control-input" id="clave_automatica" value="Toxico" name="clave_automatica" onclick="automatic_pass(); onchange_recolector()" checked>
											<label class="custom-control-label" for="clave_automatica">Aleatoria</label>
										</div>
									</div>
								</div>
								<br>
								<div class="form-group row">
									<label class="col-lg-3 col-form-label form-control-label"></label>
									<div class="col-lg-9">
										<input type="submit" class="btn btn-primary" value="Guardar" name="guarda_recolector" id="guarda_recolector">
										<input type="button" class="btn btn-primary" value="Editar" name="edita_recolector" id="edita_recolector" onclick="update_recolector()">
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
								Vehículo
							</button>
						</h2>
					</div>
					<div id="collapseTwo" class="collapse show" aria-labelledby="headingTwo" data-parent="#accordionAltaVehiculo">
						<div class="card-body">
							<form class="form" role="form" autocomplete="off" method='post' action="<?php echo site_url('administrador/recolector_vehiculo');?>">

								<div class="form-group row">
									<label class="col-lg-3 col-form-label form-control-label" for="id_vehiculo"> Selecciona Vehículo</label>
									<div class="col-lg-9">
										<select class="form-control" style="width:81%;" onclick="get_vehiculo(this.value)" id="id_vehiculo" name="id_vehiculo">
											<option value=""> Nuevo </option>
											<?php foreach($vehiculos->result() as $row){ ?>
												<option value="<?php echo $row->id_vehiculo;?>"><?php echo $row->numero_placa; ?></option>
											<?php } ?>
										</select>
									</div>
								</div>

								<div class="form-group row">
									<label class="col-lg-3 col-form-label form-control-label" for="modelo">Modelo</label>
									<div class="col-lg-9">
										<input class="form-control" type="text" class="txt " style="width:81%; text-align: center;" name="modelo" id="modelo"  oninvalid="this.setCustomValidity('Ingresa modelo del vehiculo')" oninput="setCustomValidity(''); onchange_vehiculo()"  required>
									</div>
								</div>

								<div class="form-group row">
									<label class="col-lg-3 col-form-label form-control-label" for="marca">Marca</label>
									<div class="col-lg-9">
										<input class="form-control" type="text" class="txt" style="width:81%; text-align: center;" name="marca" id="marca"  oninvalid="this.setCustomValidity('Ingresa marca')" oninput="setCustomValidity(''); onchange_vehiculo()" required>
									</div>
								</div>

								<div class="form-group row">
									<label class="col-lg-3 col-form-label form-control-label" for="tipo">Tipo</label>
									<div class="col-lg-9">
										<input class="form-control" type="text" class="txt" style="width:81%; text-align: center;" name="tipo" id="tipo"  oninvalid="this.setCustomValidity('Ingresa tipo de vehículo. Ej: Caja seca')" oninput="setCustomValidity(''); onchange_vehiculo()" required>
									</div>
								</div>

								<div class="form-group row">
									<label class="col-lg-3 col-form-label form-control-label" for="placa">No. Placa</label>
									<div class="col-lg-9">
										<input class="form-control" type="text" class="txt" style="width:81%; text-align: center;" name="placa" id="placa"  oninvalid="this.setCustomValidity('Ingresa número de placa')" oninput="setCustomValidity(''); onchange_vehiculo()" required>
									</div>
								</div>

								<br>

								<div class="form-group row">
									<label class="col-lg-3 col-form-label form-control-label"></label>
									<div class="col-lg-9">
										<input type="submit" class="btn btn-primary" value="Guardar" name="guarda_vehiculo" id="guarda_vehiculo">
										<input type="button" class="btn btn-primary" value="Editar" name="edita_vehiculo" id="edita_vehiculo" onclick="update_vehiculo()">
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
								Destino
							</button>
						</h2>
					</div>
					<div id="collapseThree" class="collapse show" aria-labelledby="headingTwo" data-parent="#accordionAltaDestino">
						<div class="card-body">
							<form class="form" role="form" autocomplete="off" method='post' action="<?php echo site_url('administrador/recolector_destino');?>">


								<div class="form-row">

									<div class="form-group col-lg-9">
										<label class="col-lg-6 col-form-label form-control-label" for="id_emp_dest"> Selecciona Empresa Destino</label>
										<div class="col-lg-12">
											<select class="form-control" style="width:81%;" onclick="get_destino(this.value)" id="id_emp_dest" name="id_emp_dest">
												<option value=""> Nuevo </option>

												<?php foreach($destinos->result() as $row){ ?>
													<option value="<?php echo $row->id_tipo_emp_destino;?>"><?php echo $row->nombre_destino; ?></option>
												<?php } ?>
											</select>
										</div>
									</div>

								</div>
								
								<div class="form-row">

									<div class="form-group col-lg-6">
										<label class="col-lg-6 col-form-label form-control-label" for="nombre_destino">Nombre Empresa Destino</label>
										<div class="col-lg-12">
											<input class="form-control" type="text" class="txt " name="nombre_destino" id="nombre_destino"  oninvalid="this.setCustomValidity('Ingresa Nombre de Empresa Destino')" oninput="setCustomValidity('')"  required>
										</div>
									</div>

									<div class="form-group col-lg-6">
										<label class="col-lg-6 col-form-label form-control-label" for="numero_autorizacion">Numero de autorización</label>
										<div class="col-lg-12">
											<input class="form-control" type="text" class="txt" style="text-align: center;" name="numero_autorizacion" id="numero_autorizacion" name="numero_autorizacion" oninvalid="this.setCustomValidity('Ingresa No de autorización. ej: 06-09-ll-01-2011')" oninput="setCustomValidity('')" required>
										</div>
									</div>

								</div>

								<div class="form-row">

									<div class="form-group col-lg-8">
										<label class="col-lg-6 col-form-label form-control-label" for="calle">Calle</label>
										<div class="col-lg-12">
											<input class="form-control" type="text" class="txt" style="text-align: center;" name="calle" id="calle" oninvalid="this.setCustomValidity('Ingresa calle')" oninput="setCustomValidity('')" required>
										</div>
									</div>
									
									<div class="form-group col-lg-1">
										<label class="col-lg-12 col-form-label form-control-label" for="num_ext"># Ext.</label>
										<div class="col-lg-12">
											<input class="form-control" type="text" class="txt" style="text-align: center;" name="num_ext" id="num_ext" oninvalid="this.setCustomValidity('Ingresa el número exteriror')" oninput="setCustomValidity('')" required>
										</div>
									</div>

									<div class="form-group col-lg-1">
										<label class="col-lg-12 col-form-label form-control-label" for="num_int"># Int.</label>
										<div class="col-lg-12">
											<input class="form-control" type="text" class="txt" style="text-align: center;" name="num_int" id="num_int" oninvalid="this.setCustomValidity('Ingresa el número interior')" oninput="setCustomValidity('')" required>
										</div>
									</div>

									<div class="form-group col-lg-2">
										<label class="col-lg-12 col-form-label form-control-label" for="cp">Código Postal</label>
										<div class="col-lg-12">
											<input class="form-control" type="text" class="txt" style="text-align: center;" name="cp" id="cp" oninvalid="this.setCustomValidity('Ingresa el código postal')" oninput="setCustomValidity('')" required>
										</div>
									</div>
								
								</div>

								<div class="form-row">

									<div class="form-group col-lg-4">
										<label class="col-lg-3 col-form-label form-control-label" for="colonia">Colonia</label>
										<div class="col-lg-12">
											<input class="form-control" type="text" class="txt" style="text-align: center;" name="colonia" id="colonia" oninvalid="this.setCustomValidity('Ingresa colonia')" oninput="setCustomValidity('')" required>
										</div>
									</div>

									<div class="form-group col-lg-3">
										<label class="col-lg-12 col-form-label form-control-label" for="municipio">Municipio</label>
										<div class="col-lg-12">
											<input class="form-control" type="text" class="txt" style="text-align: center;" name="municipio" id="municipio" oninvalid="this.setCustomValidity('Ingresa el municipio')" oninput="setCustomValidity('')" required>
										</div>
									</div>

									<div class="form-group col-lg-3">
										<label class="col-lg-4 col-form-label form-control-label" for="estado">Estado</label>
										<div class="col-lg-12">
											<input class="form-control" type="text" class="txt" style="text-align: center;" name="estado" id="estado" oninvalid="this.setCustomValidity('Ingresa el estado')" oninput="setCustomValidity('')" required>
										</div>
									</div>

									<div class="form-group col-lg-2">
										<label class="col-lg-12 col-form-label form-control-label" for="telefono">Télefono</label>
										<div class="col-lg-12">
											<input class="form-control" type="text" class="txt" style="text-align: center;" name="telefono" id="telefono" oninvalid="this.setCustomValidity('Ingresa el télefono')" oninput="setCustomValidity('')" required>
										</div>
									</div>

								</div>

								<br>

								<div class="form-group row">
									<label class="col-lg-3 col-form-label form-control-label"></label>
									<div class="col-lg-9">
										<input type="submit" class="btn btn-primary" value="Guardar" name="guarda_destino" id="guarda_destino">
										<input type="button" class="btn btn-primary" value="Editar" name="edita_destino" id="edita_destino" onclick="update_destino()">
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>

				<div class="modal" id="myModal">
					<div class="modal-dialog modal-lg">
						<div class="modal-content">

							<!-- Modal Header -->
							<div class="modal-header">
								<h4 class="modal-title">Ingresa Residuo</h4>
								<button type="button" class="close" data-dismiss="modal">&times;</button>
							</div>

							<!-- Modal body -->
							<div class="modal-body">
								<div class="form-row">
									<div class="form-group col-md-8">
										<label class="col-form-label" for="nombre_residuo"> Residuo Peligroso </label>
										<select class="form-control" onchange="update_clave(this.value);" name="residuo_peligroso" required>
											<option value="">Selecciona Residuo</option>
											<?php foreach ($residuos as $key) { ?>
												<option value="<?= $key->id_tipo_residuo; ?>"> <?= mb_strimwidth($key->residuo, 0, 55, '...', 'UTF-8'); ?></option>
											<?php } ?>
										</select>
										<div class="invalid-feedback">
											Selecciona residuo peligroso.
										</div>
									</div>	

									<div class="form-group col-md-3">
										<label class="col-form-label" for="clave"> Clave </label>
										<input type="text" class="form-control" id="clave" name="clave" value="Clave" disabled> 
									</div>	
									<div class="form-group col-md-1">
										<label class="col-form-label" for="otro_resdiuo"> Otro </label>
										<br>
										<label class="switch">
											<input type="checkbox">
											<span class="slider round"></span>
										</label>
									</div>	
								</div>

								<div class="form-row">
									<div class="form-group col-md-4">
										<label class="col-form-label" for="nombre_residuo"> Cantidad Residuo </label>
										<input readonly type="number" class="form-control" id="cantidad" name="cantidad" min="1" style="text-align:center" value="1" required>
									</div>	

									<div class="form-group col-md-8">
										<label class="col-form-label"> Unidad </label>
										<br>
										<div class="custom-control custom-radio custom-control-inline">
											<input type="radio" class="custom-control-input" id="unidad_radio1" value="Kg" name="unidadRadio" required>
											<label class="custom-control-label" for="unidad_radio1">Kg</label>
										</div>
										<div class="custom-control custom-radio custom-control-inline">
											<input type="radio" class="custom-control-input" id="unidad_radio2" value="Ton" name="unidadRadio" required>
											<label class="custom-control-label" for="unidad_radio2">Ton</label>
											<div class="invalid-feedback"> &nbsp; Selecciona unidad de medida.</div>
										</div>
									</div>	
								</div>
			
								<!-- Modal footer -->
								<div class="modal-footer">
									<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
									<button type="submit" class="btn btn-primary">Guardar</button>
								</div>
							</div>
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



