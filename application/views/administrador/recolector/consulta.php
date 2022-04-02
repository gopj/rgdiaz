<div class="container">
	<div class="card card-white">
	<ul class="nav nav-tabs justify-content-left mb-4" id="myTab4" role="tablist">
	<li class="nav-item">
		<a class="nav-link active" id="home-tab4" data-toggle="tab" href="#home4" role="tab" aria-controls="home4" aria-selected="true">Recolector</a>
	</li>
	<li class="nav-item">
		<a class="nav-link" id="profile-tab4" data-toggle="tab" href="#profile4" role="tab" aria-controls="profile4" aria-selected="false">Vehículo</a>
	</li>
	<li class="nav-item">
		<a class="nav-link" id="contact-tab4" data-toggle="tab" href="#contact4" role="tab" aria-controls="contact4" aria-selected="false">Destino</a>
	</li>
</ul>
<div class="tab-content" id="myTabContent4">
	<div class="tab-pane fade show active" id="home4" role="tabpanel" aria-labelledby="home-tab4">		
		<form class="form" role="form" autocomplete="off" method='post' action="<?php echo site_url('admin/recolector_consulta');?>">
			<div class="form-group row">
				<label class="col-md-2 form-control-label" for="id_persona"> Selecciona Correo </label>
				<div class="col-md-6">
					<select class="form-control" onchange="get_recolector(this.value)" id="id_persona" name="id_persona">
						<option value=""> Nuevo </option>
						<?php foreach($recolectores->result() as $row){ ?>
							<option value="<?php echo $row->id_persona;?>"><?php echo $row->correo; ?></option>
						<?php } ?>
					</select>
				</div>
			</div>

			<div class="form-group row">
				<label class="col-md-2 form-control-label" for="nombre_recolector">Nombre</label>
				<div class="col-md-6">
					<input class="form-control" type="text" class="txt " style=" text-align: center;" name="nombre_recolector" id="nombre_recolector" oninvalid="this.setCustomValidity('Ingresa nombre del recolector'); " oninput="setCustomValidity(''); onchange_recolector()"  required>
				</div>
			</div>

			<div class="form-group row">
				<label class="col-md-2 form-control-label" for="correo">Correo Electronico</label>
				<div class="col-md-6">
					<input class="form-control" type="email"  style=" text-align: center;" name="correo" id="correo" oninvalid="this.setCustomValidity('Ingresa correo')" oninput="setCustomValidity(''); onchange_recolector()" required>
				</div>
			</div>

			<div class="form-group	 row">
				<label class="col-md-2 form-control-label" for="clave" style="justify-content: left;">Contraseña</label>
				<div class="col-md-6">
					<input class="form-control" type="text"  name="clave" id="clave" oninvalid="this.setCustomValidity('Ingresa una clave')" oninput="setCustomValidity(''); onchange_recolector()" onchange="input_pass()" required> &nbsp; &nbsp; &nbsp;
					
				</div>
				<div class="col-md-1 custom-control custom-checkbox custom-control-inline">
						<input type="hidden"  name="clave2" id="clave2">
						<input type="checkbox" class="custom-control-input" id="clave_automatica" value="Toxico" name="clave_automatica" onclick="automatic_pass(); onchange_recolector()" checked>
						<label class="custom-control-label" for="clave_automatica">Aleatoria</label>
				</div>
			</div>
			<br>

			<div class="form-group row">
				<label class="col-md-2 form-control-label" for="vehiculo_asignado"> Vehiculo asignado </label>
				<div class="col-md-6">
					<select class="form-control"  id="vehiculo_asignado" name="vehiculo_asignado" onchange="onchange_recolector()">
						<?php foreach($vehiculos->result() as $row){ ?>
							<option value="<?php echo $row->id_vehiculo;?>">
								<?php 
									echo 'Alias: ' . $row->alias . ', Placa: ' . $row->numero_placa . ', Marca: ' . $row->marca; 
								?>
							</option>
						<?php } ?> 
					</select>
				</div>
			</div>
			<br>
			<div class="form-group row">
				<label class="col-md-2 form-control-label"></label>
				<div class="col-lg-9">
					<input type="button" class="btn btn-primary" value="Guardar" name="guarda_recolector" id="guarda_recolector" data-toggle="modal" data-target="#modal_guarda_recolector">
					<input type="button" class="btn btn-primary" value="Editar" name="edita_recolector" id="edita_recolector" onclick="update_recolector()">
					<?php $url = site_url("admin/recolector_delete") . "/"; ?>
					<input type="button" class="btn btn-danger" value="Eiminar" name="elimina_recolector" id="elimina_recolector" onclick="delete_recolector(<?=@$row->id_persona?>, '<?=$url?>')" data-toggle="modal" data-target="#modal_elimina_recolector">
				</div>
			</div>

			<!-- Modal Guarda Recolector Begin -->
			<div class="modal" id="modal_guarda_recolector">
				<div class="modal-dialog modal-sm">
					<div class="modal-content">
						<!-- Modal Header -->
						<div class="modal-header">
							<h4 class="modal-title">Guarda Recolector</h4>
							<button type="button" class="close" data-dismiss="modal">&times;</button>
						</div>
						<!-- Modal body -->
						<div class="modal-body">
							<div class="form-row">
								<div class="form-group col-md-12">
									<label>Deseas guardar recolector?</label>
								</div>	
							</div>
							<!-- Modal footer -->
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
								<button type="submit" class="btn btn-primary">Sí</button>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- Modal End -->

			<!-- Modal Elimina Recolector Begin -->
			<div class="modal" id="modal_elimina_recolector">
				<div class="modal-dialog modal-sm">
					<div class="modal-content">
						<!-- Modal Header -->
						<div class="modal-header">
							<h4 class="modal-title">Elimina Recolector</h4>
							<button type="button" class="close" data-dismiss="modal">&times;</button>
						</div>
						<!-- Modal body -->
						<div class="modal-body">
							<div class="form-row">
								<div class="form-group col-md-12">
									<label>Deseas <strong>Eliminar</strong> recolector?</label>
								</div>	
							</div>
							<!-- Modal footer -->
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
								<a href=""  id='btn_delete_recolector' class="btn btn-primary" role="button"> Sí </a> 
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- Modal End -->

		</form>
	</div>
	<div class="tab-pane fade" id="profile4" role="tabpanel" aria-labelledby="profile-tab4">
		<form class="form" role="form" autocomplete="off" method='post' action="<?php echo site_url('admin/recolector_vehiculo');?>">

			<div class="form-row">
				<div class="form-group col-lg-6">
					<label class="col-lg-6 col-form-label form-control-label" for="id_vehiculo"> Selecciona Vehículo</label>
					<div class="col-lg-12">
						<select class="form-control" onchange="get_vehiculo(this.value)" id="id_vehiculo" name="id_vehiculo">
							<option value="nuevo"> Nuevo </option>
							<?php foreach($vehiculos->result() as $row){ ?>
								<option value="<?php echo $row->id_vehiculo;?>"><?php echo $row->alias; ?></option>
							<?php } ?>
						</select>
					</div>
				</div>

				<div class="form-group col-lg-6">
					<label class="col-lg-6 col-form-label form-control-label" for="alias">Alias</label>
					<div class="col-lg-12">
						<input class="form-control" type="text"  style="text-align: center;" name="alias" id="alias"  oninvalid="this.setCustomValidity('Ingresa alias')" oninput="setCustomValidity(''); onchange_vehiculo()" required>
					</div>
				</div>
			</div>

			<div class="form-row">
				<div class="form-group col-lg-4">
					<label class="col-lg-6 col-form-label form-control-label" for="placa">No. Placa</label>
					<div class="col-lg-12">
						<input class="form-control" type="text"  style="text-align: center; text-transform: uppercase;" name="placa" id="placa"  oninvalid="this.setCustomValidity('Ingresa número de placa')" oninput="setCustomValidity(''); onchange_vehiculo()" required>
					</div>
				</div>

				<div class="form-group col-lg-4">
					<label class="col-lg-6 col-form-label form-control-label" for="modelo">Modelo</label>
					<div class="col-lg-12">
						<input class="form-control" type="text" class="txt " style="text-align: center;" name="modelo" id="modelo"  oninvalid="this.setCustomValidity('Ingresa modelo del vehiculo')" oninput="setCustomValidity(''); onchange_vehiculo()"  required>
					</div>
				</div>

				<div class="form-group col-lg-4">
					<label class="col-lg-6 col-form-label form-control-label" for="marca">Marca</label>
					<div class="col-lg-12">
						<input class="form-control" type="text"  style="text-align: center;" name="marca" id="marca"  oninvalid="this.setCustomValidity('Ingresa marca')" oninput="setCustomValidity(''); onchange_vehiculo()" required>
					</div>
				</div>
			</div>			

			<div class="form-row">
				<div class="form-group col-lg-6">
					<label class="col-lg-6 col-form-label form-control-label" for="id_tipo_vehiculo">Tipo de Vehículo</label>
					<div class="col-lg-12">
						<select class="form-control" id="id_tipo_vehiculo" name="id_tipo_vehiculo" onclick="update_tipo_vehiculo(this.value);" onchange="update_tipo_vehiculo(this.value); onchange_vehiculo()" required>
							<option value="" selected disabled> Selecciona Vehículo </option>
							<option value="otro_vehiculo"> Otro </option>
							<?php foreach($tipo_vehiculos->result() as $row){ ?>
								<option value="<?php echo $row->id_tipo_vehiculo;?>"><?php echo $row->nombre_tipo; ?></option>
							<?php } ?>
						</select>
					</div>
				</div>

				<div class="form-group col-lg-6">
					<label class="col-lg-6 col-form-label form-control-label" for="tipo_vehiculo">Nuevo tipo</label>
					<div class="col-lg-12">
						<input class="form-control" type="text"  style="text-align: center;" id="tipo_vehiculo" name="tipo_vehiculo" oninvalid="this.setCustomValidity('Ingresa Tipo de Vehículo')" oninput="setCustomValidity('');" disabled required> 
					</div>
				</div>
			</div>

			<br>

			<div class="form-group row">
				<label class="col-md-2 form-control-label"></label>
				<div class="col-lg-9">
					<input type="button" class="btn btn-primary" value="Guardar" name="guarda_vehiculo" id="guarda_vehiculo" data-toggle="modal" data-target="#modal_guarda_vehiculo">
					<input type="button" class="btn btn-primary" value="Editar" name="edita_vehiculo" id="edita_vehiculo" onclick="update_vehiculo()">
					<?php $url = site_url("admin/recolector_vehiculo_delete") . "/"; ?>
					<input type="button" class="btn btn-danger" value="Eliminar" name="elimina_vehiculo" id="elimina_vehiculo" onclick="delete_vehiculo('<?=$url?>')" data-toggle="modal" data-target="#modal_elimina_vehiculo">
				</div>
			</div>

			<!-- Modal Begin -->
			<div class="modal" id="modal_guarda_vehiculo">
				<div class="modal-dialog modal-sm">
					<div class="modal-content">
						<!-- Modal Header -->
						<div class="modal-header">
							<h4 class="modal-title">Guarda Vehículo</h4>
							<button type="button" class="close" data-dismiss="modal">&times;</button>
						</div>
						<!-- Modal body -->
						<div class="modal-body">
							<div class="form-row">
								<div class="form-group col-md-12">
									<label>Deseas guardar vehículo?</label>
								</div>	
							</div>
							<!-- Modal footer -->
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
								<button type="submit" class="btn btn-primary">Sí</button>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- Modal End -->

			<!-- Modal Elimina Recolector Begin -->
			<div class="modal" id="modal_elimina_vehiculo">
				<div class="modal-dialog modal-sm">
					<div class="modal-content">
						<!-- Modal Header -->
						<div class="modal-header">
							<h4 class="modal-title">Elimina Vehículo</h4>
							<button type="button" class="close" data-dismiss="modal">&times;</button>
						</div>
						<!-- Modal body -->
						<div class="modal-body">
							<div class="form-row">
								<div class="form-group col-md-12">
									<label>Deseas <strong>Eliminar</strong> vehículo?</label>
								</div>	
							</div>
							<!-- Modal footer -->
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
								<a href=""  id='btn_delete_vehiculo' class="btn btn-primary" role="button"> Sí </a> 
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- Modal End -->

		</form>						
	</div>
	<div class="tab-pane fade" id="contact4" role="tabpanel" aria-labelledby="contact-tab4">
		<form class="form" role="form" autocomplete="off" method='post' action="<?php echo site_url('admin/recolector_destino');?>">


			<div class="form-row">

				<div class="form-group col-lg-9">
					<label class="col-lg-6 col-form-label form-control-label" for="id_emp_dest"> Selecciona Empresa Destino</label>
					<div class="col-lg-12">
						<select class="form-control" style="width:81%;" onchange="get_destino(this.value)" id="id_emp_dest" name="id_emp_dest">
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
						<input class="form-control" type="text" class="txt " name="nombre_destino" id="nombre_destino"  oninvalid="this.setCustomValidity('Ingresa Nombre de Empresa Destino')" oninput="setCustomValidity(''); onchange_destino()"  required>
					</div>
				</div>

				<div class="form-group col-lg-6">
					<label class="col-lg-6 col-form-label form-control-label" for="numero_autorizacion">Numero de autorización</label>
					<div class="col-lg-12">
						<input class="form-control" type="text"  style="text-align: center;" name="numero_autorizacion" id="numero_autorizacion" name="numero_autorizacion" oninvalid="this.setCustomValidity('Ingresa No de autorización. ej: 06-09-ll-01-2011')" oninput="setCustomValidity(''); onchange_destino()" required>
					</div>
				</div>

			</div>

			<div class="form-row">

				<div class="form-group col-lg-6">
					<label class="col-lg-6 col-form-label form-control-label" for="calle">Calle</label>
					<div class="col-lg-12">
						<input class="form-control" type="text"  style="text-align: center;" name="calle" id="calle" oninvalid="this.setCustomValidity('Ingresa calle')" oninput="setCustomValidity(''); onchange_destino()" required>
					</div>
				</div>
				
				<div class="form-group col-lg-2">
					<label class="col-lg-12 col-form-label form-control-label" for="num_ext"># Ext.</label>
					<div class="col-lg-12">
						<input class="form-control" type="text"  style="text-align: center;" name="num_ext" id="num_ext" oninvalid="this.setCustomValidity('Ingresa el número exteriror')" oninput="setCustomValidity(''); onchange_destino()" maxlength="5" required>
					</div>
				</div>

				<div class="form-group col-lg-2">
					<label class="col-lg-12 col-form-label form-control-label" for="num_int"># Int.</label>
					<div class="col-lg-12">
						<input class="form-control" type="text"  style="text-align: center;" name="num_int" id="num_int" oninput="setCustomValidity(''); onchange_destino()" maxlength="5">
					</div>
				</div>

				<div class="form-group col-lg-2">
					<label class="col-lg-12 col-form-label form-control-label" for="cp">Código Postal</label>
					<div class="col-lg-12">
						<input class="form-control" type="text"  style="text-align: center;" name="cp" id="cp" oninvalid="this.setCustomValidity('Ingresa el código postal')" oninput="setCustomValidity(''); onchange_destino()" maxlength="5" required>
					</div>
				</div>

			</div>

			<div class="form-row">
				<div class="form-group col-lg-4">
					<label class="col-lg-6 col-form-label form-control-label" for="colonia">Colonia</label>
					<div class="col-lg-12">
						<input class="form-control" type="text"  style="text-align: center;" name="colonia" id="colonia" oninvalid="this.setCustomValidity('Ingresa colonia')" oninput="setCustomValidity(''); onchange_destino()" required>
					</div>
				</div>

				<div class="form-group col-lg-3">
					<label class="col-lg-12 col-form-label form-control-label" for="municipio">Municipio</label>
					<div class="col-lg-12">
						<input class="form-control" type="text"  style="text-align: center;" name="municipio" id="municipio" oninvalid="this.setCustomValidity('Ingresa el municipio')" oninput="setCustomValidity(''); onchange_destino()" required>
					</div>
				</div>

				<div class="form-group col-lg-3">
					<label class="col-lg-6 col-form-label form-control-label" for="estado">Estado</label>
					<div class="col-lg-12">
						<input class="form-control" type="text"  style="text-align: center;" name="estado" id="estado" oninvalid="this.setCustomValidity('Ingresa el estado')" oninput="setCustomValidity(''); onchange_destino()" required>
					</div>
				</div>

				<div class="form-group col-lg-2">
					<label class="col-lg-12 col-form-label form-control-label" for="telefono">Télefono</label>
					<div class="col-lg-12">
						<input class="form-control" type="text"  style="text-align: center;" name="telefono" id="telefono" oninvalid="this.setCustomValidity('Ingresa el télefono')" oninput="setCustomValidity(''); onchange_destino()" maxlength="12" required>
					</div>
				</div>

			</div>

			<br>

			<div class="form-group row">
				<label class="col-md-2 form-control-label"></label>
				<div class="col-lg-9">
					<input type="button" class="btn btn-primary" value="Guardar" name="guarda_destino" id="guarda_destino" data-toggle="modal" data-target="#modal_guarda_destino">
					<input type="button" class="btn btn-primary" value="Editar" name="edita_destino" id="edita_destino" onclick="update_destino()">
					<?php $url = site_url("admin/recolector_destino_delete") . "/"; ?>
					<input type="button" class="btn btn-danger" value="Eliminar" name="elimina_destino" id="elimina_destino" onclick="delete_destino(<?=@$row->id_tipo_emp_destino;?>, '<?=$url?>')" data-toggle="modal" data-target="#modal_elimina_destino">
				</div>
			</div>

			<!-- Modal Begin -->
			<div class="modal" id="modal_guarda_destino">
				<div class="modal-dialog modal-sm">
					<div class="modal-content">
						<!-- Modal Header -->
						<div class="modal-header">
							<h4 class="modal-title">Guarda Destino</h4>
							<button type="button" class="close" data-dismiss="modal">&times;</button>
						</div>
						<!-- Modal body -->
						<div class="modal-body">
							<div class="form-row">
								<div class="form-group col-md-12">
									<label>Deseas guardar destino?</label>
								</div>	
							</div>
							<!-- Modal footer -->
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
								<button type="submit" class="btn btn-primary">Sí</button>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- Modal End -->

			<!-- Modal Elimina Recolector Begin -->
			<div class="modal" id="modal_elimina_destino">
				<div class="modal-dialog modal-sm">
					<div class="modal-content">
						<!-- Modal Header -->
						<div class="modal-header">
							<h4 class="modal-title">Elimina destino</h4>
							<button type="button" class="close" data-dismiss="modal">&times;</button>
						</div>
						<!-- Modal body -->
						<div class="modal-body">
							<div class="form-row">
								<div class="form-group col-md-12">
									<label>Deseas <strong>Eliminar</strong> destino?</label>
								</div>	
							</div>
							<!-- Modal footer -->
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
								<a href=""  id='btn_delete_destino' class="btn btn-primary" role="button"> Sí </a> 
							</div>
						</div>
					</div>
				</div>
			</div>
		<!-- Modal End -->
		</form>
	
	</div>
</div>
	</div>
</div>