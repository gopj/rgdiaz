				<div class="span9">
					<div class="row-fluid">
						<div class="span3"></div>
						<div class="span6">
							<center><legend>Cambiar Contraseña</legend></center>
							<form id="act_password" method="post" action="">
								<div class="well">
									<center>
										<br>
										Ingresa nueva contraseña
										<div class='input-prepend'>
											<span class='add-on'>
												<img src='img/glyphicons_203_lock.png' height='18' width='18'>
											</span>
											<input type="password" name="password" id="password" class="txt-well" required/>
										</div>
										Confirma contraseña
										<div class='input-prepend'>
											<span class='add-on'>
												<img src='img/glyphicons_203_lock.png' height='18' width='18'>
											</span>
											<input type="password" name="password2" id="password2" class="txt-well" required/>
										</div>
										<br>
									</center>
								</div>
								<input type="hidden" id="id_persona" name="id_persona" value="<?php echo $this->session->userdata('id');?>">
								<input type="button" onclick="valida_form_password()" value="Guardar Contraseña" class="btn btn-primary pull-right" />
							</form>	
						</div>
						<div class="span3"></div>
					</div>
				</div>
			</div>
		</div>