<div class="page-title">
	<h3 class="breadcrumb-header"> Datos de la Empresa </h3>
</div>

<pre>
<?= print_r($cliente); ?>
</pre>

<div id="main-wrapper">	
	<form class="form-row" id="act_datos_admin" action="<?=base_url('usuario/actualizadatos_persona');?>" method="POST">
		<input type="hidden" id="recibe" name="id_persona" value="<?=$id;?>" />
	 	<div class="col-md-6">
			<div class="card card-white">
				<div class="card-heading clearfix">
					<h4 class="card-title">Datos de Cliente</h4>
				</div>
				<div class="card-body">
				
					<div class="form-row" id="datosempresa" >
						<div class="col-md-8 mb-2">
							<label >Nombre | Razón social</label>
							<input type="text" class="form-control" id="nombre" name="nombre_empresa" readonly="true" value="<?php echo $cliente->nombre_empresa; ?>">
						</div>
						<div class="col-md-4 mb-2">
							<label >Registro ambiental</label>
							<input class="form-control" id="numero_registro_ambiental" name="numero_registro_ambiental" type="text" value="<?=$cliente->numero_registro_ambiental?>">
						</div>

						<div class="col-md-6 mb-2">
							<label >Email</label>
							<div class="input-group-prepend">
								<div class="input-group-prepend">
									<span class="input-group-text" id="inputGroupPrepend"><i class="far fa-envelope"></i></span>
								</div>
								<input class="form-control" id="email_empresa" name="email_empresa" type="text" value="<?=$cliente->correo?>">
							</div>
						</div>

						<div class="col-md-3 mb-2">
							<label >Teléfono</label>
							<div class="input-group-prepend">
								<div class="input-group-prepend">
									<span class="input-group-text" id="inputGroupPrepend" onclick="gen_identificador_folio();"><i class="fas fa-phone"></i></span>
								</div>
								<input class="form-control" id="telefono_empresa" name="telefono_empresa" type="text" value="<?=$cliente->telefono_personal?>">
							</div>
						</div>

						<div class="col-md-3 mb-2">
							<label >Identificador Fólio</label>
						
							<div class="input-group mb-2">
								<div class="input-group-prepend">
									<button class="btn btn-outline-primary" type="button" id="button-addon1" onclick="gen_identificador_folio();"><i class="fas fa-bolt"></i></button>
								</div>
								<input class="form-control" id="identificador_folio" name="identificador_folio" type="text" value="<?=$cliente->identificador_folio?>" readonly>
							</div>
						</div>

						<div class="col-md-7 mb-2">
							<label >Domicilio | Calle</label>
							<input type="text" class="form-control" id="calle_empresa" name="calle_empresa"  >
							<div class="invalid-feedback">
								Please provide a valid state.
							</div>
						</div>

						<div class="col-md-3 mb-3">
							<label >Número</label>
							<input class="form-control" id="numero_empresa" name="numero_empresa" type="text">
						</div>

						<div class="col-md-2 mb-3">
							<label for="validationCustom05">C. P.</label>
							<input class="form-control" id="cp_empresa" name="cp_empresa" type="text">
						</div>

						<div class="col-md-4 mb-2">
							<label >Colonia</label>
							<input class="form-control" id="colonia_empresa" name="colonia_empresa" type="text">
						</div>
						
						<div class="col-md-4 mb-3">
							<label >Estado</label>
							<input class="form-control" id="estado" name="estado" type="text">
						</div>

						<div class="col-md-4 mb-1">
							<label >Municipio</label>
							<input class="form-control" id="municipio_empresa" name="municipio" type="text">
						</div>
					</div>	
				</div>
			</div>
		</div>

		<div class="col-md-6">
			<div class="card card-white">
				<div class="card-heading clearfix">
					<h4 class="card-title">Datos de Contacto</h4>
				</div>
				<div class="card-body">

					<div class="row">
						<div class="col-md-6 mb-2">
							<label >Nombre del contacto</label>
							<input class="form-control" id="nombre_contacto" name="nombre_contacto" type="text">
						</div>

						<div class="col-md-6 mb-2">
							<label >Email Alternativo</label>
							<div class="input-group-prepend">
								<div class="input-group-prepend">
									<span class="input-group-text" id="inputGroupPrepend"><i class="fas fa-envelope"></i></span>
								</div>
								<input class="form-control" id="correo" name="correo" type="text">
							</div>
						</div>
					</div>
					
					<div class="row" id="datoscontacto">
						<div class="col-md-6 mb-2">
							<label >Teléfono</label>
							<div class="input-group-prepend">
								<div class="input-group-prepend">
									<span class="input-group-text" id="inputGroupPrepend"><i class="fas fa-envelope"></i></span>
								</div>
								<input class="form-control" type="text" id="telefono_contacto" name="telefono_contacto">
							</div>
						</div>

						<div class="col-md-6 mb-2">
							<label >Teléfono Alternativo</label>
							<div class="input-group-prepend">
								<div class="input-group-prepend">
									<span class="input-group-text" id="inputGroupPrepend"><i class="fas fa-phone"></i></span>
								</div>
								<input class="form-control" id="telefono_contacto_alt" name="telefono_contacto_alt" type="text">
							</div>
						</div>
						
					</div>


					<div class="row">
						<div class="col-md-12">
							<input type="button"  onclick="actualiza_datos();" value="Guardar Cambios" id="enviar" class="btn btn-primary pull-right"/>
						</div>
					</div>
					
			
				</div>
			</div>
		</div>

	</form>	

</div>
<!-- / Main wrapper-->