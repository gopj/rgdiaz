
					<script type="text/javascript">
						window.onload = refresh;

						function refresh(){
							var select = document.getElementById('id_persona').value;
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
					<div class="span9">
						<center><legend>Consulta de Clientes</legend></center>
						<div class="row">
							<div class="span3">
								<div class='input-prepend'>
									<span class='add-on'>
										<img src="img/glyphicons_003_user.png" class="icon-form">
									</span>
									<select onchange="compruebausuario(this.value)"  id="id_persona" name="id_persona">
										<option value="">Selecciona Cliente</option>
										<?php
		                                    foreach($todosclientes->result() as $row){ 
		                                ?>
										<option value="<?php echo $row->id_persona;?>"><?php echo $row->nombre_empresa; ?></option>
										<?php } ?>
									</select>
								</div>
							</div><br/>
							<div style="float:right;" class="span2">
								<form method='post' action="<?php echo site_url('administrador/versubcarpeta');?>">
		                            <input type="hidden" id="persona" name="ruta_carpeta">
		                            <input type="hidden" id="ruta" name="ruta_carpeta" >
		                            <input type="hidden" id="persona_expediente" name="id_persona" >
		                            <input class="btn btn-primary" id="btn_expediente" disabled type="submit" value="Ver Expediente">
		                        </form>
							</div>
							<div style="float:right;" class="span2">
								<form id="ver_bitacora" method='post' action="<?php echo site_url('administrador/bitacora');?>">
		                            <input type="hidden" id="persona_bitacora" name="id_persona">
		                            <input class="btn btn-primary" id="btn_bitacora" disabled type="submit" value="Ver Bitacora">
		                        </form>
							</div>
						</div>
						
						<br/>
						<form id="act_datos_admin" action="<?php echo site_url('administrador/actualiza_datos_admin')?>" method="POST">
						<div class="row">
							<div class="span4">
								<legend>Datos de la empresa</legend>
								<div id="datosempresa" class="well">
									<br>
									<center>
									Nombre o Razón Social
									<div class='input-prepend'>
										<span class='add-on'>
											<img src="img/glyphicons_450_factory.png" class="icon-form">
										</span>
										<input class="txt-well" id="nombre_empresa" name="nombre_empresa" type='text' readonly>
									</div>
									Calle
									<div class='input-prepend'>
										<span class='add-on'>
											<img src="img/glyphicons_242_google_maps.png" class="icon-form">
										</span>
										<input class="txt-well" id="calle_empresa" name="calle_empresa" type='text'>
									</div>
									Número
									<div class='input-prepend'>
										<span class='add-on'>
											<img src="img/glyphicons_242_google_maps.png" class="icon-form">
										</span>
										<input class="txt-well" id="numero_empresa" name="numero_empresa" type='text'>
									</div>
									Colonia
									<div class='input-prepend'>
										<span class='add-on'>
											<img src="img/glyphicons_242_google_maps.png" class="icon-form">
										</span>
										<input class="txt-well" id="colonia_empresa" name="colonia_empresa" type='text'>
									</div>
									Municipio
									<div class='input-prepend'>
										<span class='add-on'>
											<img src="img/glyphicons_242_google_maps.png" class="icon-form">
										</span>
										<input class="txt-well" id="municipio_empresa" name="municipio" type='text'>
									</div>
									Código Postal
									<div class='input-prepend'>
										<span class='add-on'>
											<img src="img/glyphicons_242_google_maps.png" class="icon-form">
										</span>
										<input class="txt-well" id="cp_empresa" name="cp_empresa" type='text'>
									</div>
									Estado
									<div class='input-prepend'>
										<span class='add-on'>
											<img src="img/glyphicons_242_google_maps.png" class="icon-form">
										</span>
										<input class="txt-well" id="estado_empresa" name="estado" type='text'>
									</div>
									Teléfono
									<div class='input-prepend'>
										<span class='add-on'>
											<img src="img/glyphicons_242_google_maps.png" class="icon-form">
										</span>
										<input class="txt-well" id="telefono_empresa" name="telefono_empresa" type='text'>
									</div>
									Dirección de Email
									<div class='input-prepend'>
										<span class='add-on'>
											<img src="img/glyphicons_010_envelope.png" class="icon-form">
										</span>
										<input class="txt-well" id="email_empresa" name="email_empresa" type='text'>
									</div>
									</center>
									<br>
								</div>		
							</div>
							<div class="span1"></div>
							<div class="span4">
								<legend>Datos del contacto</legend>
								<div id="datoscontacto" class="well">
									<br>
									<center>
									Nombre
									<div class='input-prepend'>
										<span class='add-on'>
											<img src="img/glyphicons_003_user.png" class="icon-form">
										</span>
										<input class="txt-well" id="nombre_contacto" name="nombre_contacto" type='text'>
									</div>
									Teléfono
									<div class='input-prepend'>
										<span class='add-on'>
											<img src="img/glyphicons_442_earphone.png" class="icon-form">
										</span>
										<input class="txt-well" id="telefono_contacto" name="telefono_contacto" type='text'>
									</div>
									Teléfono Alternativo
									<div class='input-prepend'>
										<span class='add-on'>
											<img src="img/glyphicons_442_earphone.png" class="icon-form">
										</span>
										<input class="txt-well" id="telefono_contacto_alt" name="telefono_contacto_alt" type='text'>
									</div>
									Dirección de Email
									<div class='input-prepend'>
										<span class='add-on'>
											<img src="img/glyphicons_010_envelope.png" class="icon-form">
										</span>
										<input class="txt-well" id="email_contacto" name="email_contacto" type='text'>
									</div>
									Contraseña
									<div class='input-prepend'>
										<span class='add-on'>
											<img src="img/glyphicons_203_lock.png" class="icon-form">
										</span>
										<input class="txt-well" id="password_contacto" name="password_contacto" type='text' readonly>
									</div>
									Estado del Usuario
									<div id="estado" class="input-prepend">
										<span class="add-on">
											<img src="img/glyphicons_267_credit_card.png" class="icon-form">
										</span>
										<input class="txt-well" id="estado_cuenta" name="estado_cuenta" type="text" readonly><br>
										<input type="hidden" id="persona3" name="id_persona"/><br>
									</div>
										<input type="button" id="update_status" value="Activar Usuario" onclick="update();" class="btn btn-primary pull-right" disabled><br>
									</center>
									<br>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="span9">
								<input class="btn btn-primary pull-right" id="btn_guardar" disabled type="button" onclick="confir_act_admin();" value="Guardar Cambios">
							</div>
						</div>
						</form>
					</div>

			