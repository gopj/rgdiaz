
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

<main role="main" class="container col-md-12">
	<div class="page-title">
		<h3 class="breadcrumb-header"> Consulta Clientes </h3>
	</div>
	<input type="hidden" id="prev_selected" name="prev_selected" value="<?=$id_persona;?>">
	<div class="card card-white">
		<div id="main-wrapper">
			<div class="card-body">
				<div class="card-heading clearfix">
					<ul class="nav nav-tabs justify-content-left mb-4" id="myTab4" role="tablist">
						<li class="nav-item">
							<a class="nav-link active" id="home-tab4" data-toggle="tab" href="#home4" role="tab" aria-controls="home4" aria-selected="true">Datos del Cliente</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" id="profile-tab4" data-toggle="tab" href="#profile4" role="tab" aria-controls="profile4" aria-selected="false">Datos de Contacto</a>
						</li>
					</ul>
					
					<div class="row">
						<div class="col-md-6 mb-2">
									<label >Clientes</label>
								<select class="form-control" onchange="compruebausuario(this.value);" id="id_persona" name="id_persona" >
									<option value="">Selecciona Cliente</option>
									<?php foreach($todosclientes->result() as $row){ ?>
										<option value="<?php echo $row-> id_persona;?>"><?php echo $row-> nombre_empresa; ?></option>
									<?php } ?>
								</select>
						</div>
						<div class="col-md-2 ">
							<label></label>
							<form method='post' action="<?=base_url('administrador/versubcarpeta');?>">
								<input type="hidden" id="persona" name="ruta_carpeta">
								<input type="hidden" id="ruta" name="ruta_carpeta" >
								<input type="hidden" id="persona_expediente" name="id_persona_expediente" >
								
								<input class="btn btn-primary" id="btn_expediente" disabled type="submit" value="Ver Expediente">
							</form>
						</div>
						<div class="col-md-2 ">
							 <label></label>
							<form id="ver_bitacora" method='post' action="<?=base_url('administrador/bitacora/');?>">
								<input type="hidden" id="persona_bitacora" name="id_persona">
								<input class="btn btn-primary" id="btn_bitacora" disabled type="submit" value="Ver Bitacora">
							</form>
						</div>
						<div class="col-md-2">
							<label for=""></label>
							<input class="btn btn-primary" id="btn_guardar" disabled type="button" onclick="confir_act_admin();" value="Guardar Cambios">
						</div>
					</div>
				</div>

				<div class="tab-content" id="myTabContent4">
					<div class="tab-pane fade show active" id="home4" role="tabpanel" aria-labelledby="home-tab4">
						<form id="act_datos_admin" action="<?=base_url('administrador/actualiza_datos_admin')?>" method="POST">
							<div class="">
								<div class="form-row" id="datosempresa" >
									<div class="col-md-4 mb-2">
										<label >Nombre | Razón social</label>
										<input type="text" class="form-control"id="nombre_empresa" name="nombre_empresa" type='text' >
										
									</div>
									<div class="col-md-2 mb-2">
										<label >Registro ambiental</label>
										<input class="form-control" id="numero_registro_ambiental" name="numero_registro_ambiental" type='text'>
									
									</div>
									<div class="col-md-3 mb-3">
										<label >Estado</label>
										<input class="form-control" id="estado_empresa" name="estado" type='text'>
									</div>
									<div class="col-md-3 mb-1">
										<label >Municipio</label>
										<input class="form-control" id="municipio_empresa" name="municipio" type='text'>
									</div>
								</div>
								<div class="form-row">
									<div class="col-md-4 mb-3">
										<label >Domicilio/Calle</label>
										<input type="text" class="form-control" id="calle_empresa" name="calle_empresa"  >
										<div class="invalid-feedback">
											Please provide a valid state.
										</div>
									</div>
									<div class="col-md-2 mb-3">
										<label >Colonia</label>
										<input class="form-control" id="colonia_empresa" name="colonia_empresa" type='text'>
									</div>
									<div class="col-md-2 mb-3">
										<label for="validationCustom05">Código postal</label>
										<input class="form-control" id="cp_empresa" name="cp_empresa" type='text'>
									</div>
									<div class="col-md-2 mb-3">
										<label >Teléfono</label>
										<div class="input-group-prepend">
											<div class="input-group-prepend">
												<span class="input-group-text" id="inputGroupPrepend"><i class="fas fa-phone"></i></span>
											</div>
											<input class="form-control" id="telefono_empresa" name="telefono_empresa" type='text'>
										</div>
									</div>
									<div class="col-md-2 mb-3">
										<label >Email</label>
										<div class="input-group-prepend">
											<div class="input-group-prepend">
												<span class="input-group-text" id="inputGroupPrepend"><i class="far fa-envelope"></i></span>
											</div>
											<input class="form-control" id="email_empresa" name="email_empresa" type='text'>
										</div>
									</div>
								</div>   
							</div>
						</form>
					</div>

			<div class="tab-pane fade" id="profile4" role="tabpanel" aria-labelledby="profile-tab4">
				
					<div class="row">
						<div class="col-md-6 mb-2">
							<label >Nombre del contacto</label>
							<input class="form-control" id="nombre_contacto" name="nombre_contacto" type='text'>
						</div>
						<div class="col-md-2">
							<label for=""></label>
							<input type="button" id="activar_campos" value="Activar Campos" class="btn btn-primary "  data-toggle='modal' data-target='.bs-modal-enable'>
						</div>
						<div class="col-md-1">
							<label for=""></label>
							<input type="button" id="update_status" value="Activar Usuario" onclick="update();" class="btn btn-primary" disabled><br>     
						</div>
					</div>

					<div class="row" id="datoscontacto">
						<div class="col-md-3 mb-2">
							<label >Télefono Alternativo</label>
							<div class="input-group-prepend">
								<div class="input-group-prepend">
									<span class="input-group-text" id="inputGroupPrepend"><i class="fas fa-phone"></i></span>
								</div>
								<input class="form-control" id="telefono_contacto_alt" name="telefono_contacto_alt" type='text'>
							</div>
						</div>
						<div class="col-md-3 mb-2">
							<label >Email Alternativo</label>
							<div class="input-group-prepend">
								<div class="input-group-prepend">
									<span class="input-group-text" id="inputGroupPrepend"><i class="fas fa-envelope"></i></span>
								</div>
								<input class="form-control" id="email_contacto" name="email_contacto" type='text'>
							</div>
						</div>
						
					</div>

					<div class="row">
						<div class="col-md-3 mb-2">
							<label >Contraseña</label>
							<div class="input-group-prepend">
								<div class="input-group-prepend">
									<span class="input-group-text" id="inputGroupPrepend"><i class="fas fa-key"></i></span>
								</div>
								<input class="form-control" id="password_contacto" name="password_contacto" type='text'>
							</div>
						</div>
						<div class="col-md-3 mb-2">
							<label >Estado del usuario</label>
							<div class="input-group-prepend">
								<div class="input-group-prepend">
									<span class="input-group-text" id="inputGroupPrepend"><i class="fas fa-signal"></i></span>
								</div>
								<input class="form-control" id="estado_cuenta" name="estado_cuenta" type='text'>
							</div>
						</div>
					</div>
				</div>
			</div>  
		</div>
	</div>

</main>

<div class="modal fade bs-modal-enable" tabindex=-1 role=dialog aria-labelledby=mySmallModalLabel> <!-- modal bs-modal-del -->
	<div class="modal-dialog modal-sm"> 
		<div class="modal-content"> 
			<div class="modal-header"> 
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button> <h5 class="modal-title" id="mySmallModalLabel">Activar Campos </h5>
			</div> 
			<div class=modal-body>
				¿Deseas habilitar los campos <strong> Nombre o Razón Social y Contraseña</strong>?
			</div>
			<div class=modal-footer>
				<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
				<button type="button" id='activar_campos_modal' class='btn btn-primary' onclick="enable_fields();" role='button' data-dismiss="modal"> Habilitar</button>
			</div>
		</div> 
	</div>
</div><!-- Modal -->

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

			