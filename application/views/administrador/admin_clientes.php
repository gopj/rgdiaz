
<script type="text/javascript">
	window.onload = refresh;

	function refresh(){
		var select = document.getElementById('id_persona').value;
		
		var prev_selected_client = document.getElementById('prev_selected').value;
		console.log(prev_selected_client + "<-Dato de la persona");

		compruebausuario(prev_selected_client);

		$("#id_persona option[value='" + prev_selected_client + "']").attr("selected","selected");

		if(prev_selected_client){select=1;}

		if(select == 0){
			$("#btn_expediente").attr('disabled','disabled');
			$("#btn_bitacora").attr('disabled','disabled');
			$("#btn_guardar").attr('disabled','disabled');
		}else{
			$("#btn_expediente").removeAttr('disabled');
			$("#btn_bitacora").removeAttr('disabled');
			$("#btn_guardar").removeAttr('disabled');
		}
	}						
</script>

<div class="page-title">
	<h3 class="breadcrumb-header"> Consulta Clientes </h3>
</div>
<input type="hidden" id="prev_selected" name="prev_selected" value="<?=$id_persona;?>">
<div id="main-wrapper">
	<div class="row">
		
		<div class="col-md-12">
			<div class="card card-white">
				<div class="card-heading clearfix">
					<h4 class="card-title">Consulta</h4>
				</div>
				<div class="card-body">
			
					<div class="form-row align-items-center">
						<div class="col-sm-6">
							<label class="sr-only" for="id_persona">Clientes</label>
							<select class="form-control" onchange="compruebausuario(this.value);lock_inputs();copy_id_persona();" id="id_persona" name="id_persona" style="width: 100%;">
								<option value="" class="form-control">Selecciona Cliente</option>
								<?php foreach($todosclientes->result() as $row){ ?>
									<option value="<?php echo $row->id_persona;?>"><?php echo $row-> nombre_empresa; ?></option>
								<?php } ?>
							</select>
						</div>	

						<div class="col-sm-2">							
							<form method='post' action="<?=base_url('administrador/versubcarpeta');?>">
								<input type="hidden" id="id_persona_ver_sub" name="id_persona">
								<input type="hidden" id="ruta" name="ruta_carpeta" >
								<input type="hidden" id="persona_expediente" name="id_persona_expediente" >
								
								<button type="submit" class="btn btn-primary mb-2" id="btn_expediente" disabled><i class="far fa-folder"></i> Ver Expediente </button>
							</form>
						</div>
						
						<div class="col-sm-2">
							<form id="ver_bitacora" method='post' action="<?=base_url('administrador/bitacora/');?>">
								<input type="hidden" id="persona_bitacora" name="id_persona">
								<button class="btn btn-primary mb-2" id="btn_bitacora" disabled type="submit"> <i class="far fa-file-alt"></i> Ver Bitacora </button>
							</form>
						</div>

						<div class="col-sm-2">
							<button class="btn btn-primary mb-2" id="btn_guardar" disabled type="button" onclick="confir_act_admin();"> <i class="far fa-save"></i> Guardar Cambios</button>
						</div>
					</div>
				</div>
			</div>		
		</div>
	</div>

	<form class="form-row" id="act_datos_admin" action="<?=base_url('administrador/actualiza_datos_admin');?>" method="POST">
	 	<div class="col-md-6">
			<div class="card card-white">
				<div class="card-heading clearfix">
					<h4 class="card-title">Datos de Cliente</h4>
				</div>
				<div class="card-body">
				
					<div class="form-row" id="datosempresa" >
						<div class="col-md-8 mb-2">
							<label >Nombre | Razón social</label>
							<input type="text" class="form-control" id="nombre_empresa" name="nombre_empresa" readonly="true" >
							<input type="text" id="id_cliente" name="id_cliente" hidden>
						</div>
						<div class="col-md-4 mb-2">
							<label >Registro ambiental</label>
							<input class="form-control" id="numero_registro_ambiental" name="numero_registro_ambiental" type="text">
						</div>

						<div class="col-md-6 mb-2">
							<label >Email</label>
							<div class="input-group-prepend">
								<div class="input-group-prepend">
									<span class="input-group-text" id="inputGroupPrepend"><i class="far fa-envelope"></i></span>
								</div>
								<input class="form-control" id="email_empresa" name="email_empresa" type="text">
							</div>
						</div>

						<div class="col-md-3 mb-2">
							<label >Teléfono</label>
							<div class="input-group-prepend">
								<div class="input-group-prepend">
									<span class="input-group-text" id="inputGroupPrepend" onclick="gen_identificador_folio();"><i class="fas fa-phone"></i></span>
								</div>
								<input class="form-control" id="telefono_empresa" name="telefono_empresa" type="text">
							</div>
						</div>

						<div class="col-md-3 mb-2">
							<label >Identificador Fólio</label>
						
							<div class="input-group mb-2">
								<div class="input-group-prepend">
									<button class="btn btn-outline-primary" type="button" id="button-addon1" onclick="gen_identificador_folio();"><i class="fas fa-bolt"></i></button>
								</div>
								<input class="form-control" id="identificador_folio" name="identificador_folio" type="text">
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
							<input class="form-control" id="estado_empresa" name="estado" type="text">
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
								<input class="form-control" id="email_contacto" name="email_contacto" type="text">
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
						<div class="col-md-6 mb-2">
							<label >Contraseña</label>
							<div class="input-group-prepend">
								<div class="input-group-prepend">
									<span class="input-group-text" id="inputGroupPrepend"><i class="fas fa-key"></i></span>
								</div>
								<input class="form-control" id="password_contacto" name="password_contacto" type="text" readonly="true">
							</div>
						</div>
						<div class="col-md-6 mb-2">
							<label >Estado del usuario</label>
							<div class="input-group-prepend">
								<div class="input-group-prepend">
									<span class="input-group-text" id="inputGroupPrepend"><i class="fas fa-signal"></i></span>
								</div>
								<input class="form-control" id="estado_cuenta" name="estado_cuenta" type="text" readonly="true">
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-md-12">
						</div>
					</div>
					
					<div class="row" style="padding-top: 63px">
						<div class="col-md-6">
							<button type="button" id="activar_campos" value="Activar Campos" class="btn btn-primary "  data-toggle='modal' data-target='#modal_activa_campos'> <i class="far fa-check-circle"></i> Activar Campos</button>
						</div>
						<div class="col-md-6">
							<button type="button" id="update_status" value="Activar Usuario" onclick="update();" class="btn btn-primary" disabled> <i class="far fa-user-circle"></i> Activar Usuario </button>
						</div>
					</div>
				</div>
			</div>
		</div>

	</form>	

</div>
<!-- / Main wrapper-->


<!-- Modal Activar Campos Start-->
<div class="modal" id="modal_activa_campos">
	<div class="modal-dialog modal-md"> 
		<div class="modal-content"> 
			<div class="modal-header"> 
				<h5 class="modal-title" >Activar Campos </h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div> 
			<div class=modal-body>
				<div class="form-group col-md-12">
					¿Deseas habilitar los campos <b> Nombre o Razón Social y Contraseña</b>?
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
				<button type="button" id='activar_campos_modal' class='btn btn-primary' onclick="enable_fields();" role='button' data-dismiss="modal"> Habilitar</button>
			</div>
		</div> 
	</div>
</div>
<!-- Modal Activar Campos End-->

<div class="modal fade" id="modal_folio_identificador" tabindex="-1" role="dialog" aria-labelledby="label_folio_identificador" aria-hidden="true"> <!-- modal Identificador folio -->
	<div class="modal-dialog modal-sm" role="document"> 
		<div class="modal-content"> 
			<div class="modal-header">
				<h5 class="modal-title" id="label_folio_identificador">Identificador de Folio Duplicado </h5> 
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button> 
			</div> 
			<div class=modal-body>
				Favor de elejir un identificador de folio diferente a <span id="folio_identificador_modal_span"></span> .
			</div>
			<div class=modal-footer>
				<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
			</div>
		</div> 
	</div>
</div><!-- Modal -->

<!-- Modal Folio Modificar Start-->
<div class="modal" id="modal_folio_identificador">
	<div class="modal-dialog modal-md"> 
		<div class="modal-content"> 
			<div class="modal-header"> 
				<h5 class="modal-title" >Identificador de Folio Duplicado</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div> 
			<div class=modal-body>
				<div class="form-group col-md-12">
					Favor de elejir un identificador de folio diferente a <span id="folio_identificador_modal_span"></span> .
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
			</div>
		</div> 
	</div>
</div>
<!-- Modal Folio Modificar End-->