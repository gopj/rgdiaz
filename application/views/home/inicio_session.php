				<div class="row-fluid">
					<div class="span4"></div>
					<div class="span4">
						<center><legend>Inicio de Sesión</legend></center>	
							<form id="formSesion" method="post" action="<?php echo site_url('home/login');?>" >
							<div class="well">
							<center>
								<br>
								Correo de Usuario
								<div class='input-prepend'>
									<span class='add-on'>
										<img src='img/glyphicons_003_user.png' height='18' width='18'>
									</span>
									<input class='txt-modal' type='text' id="correo_session" name="correo"/>
								</div>
								Contraseña
								<div class='input-prepend'>
									<span class='add-on'>
										<img src='img/glyphicons_203_lock.png' height='18' width='18'>
									</span>
									<input class='txt-modal' type='password' id="password_session" name="password"/>
								</div>
								<br/>
							<a href="<?php echo site_url('home/recupera_password');?>">¿Olvidaste tu contraseña?</a>
							</center>
							</div>
							<button style="margin-left:10px;" type="button" class='btn btn-primary pull-right' onclick="validarFormSesion()">Iniciar</button>
							</form>
						</div>
					</div>
					<div class="span4"></div>
				</div>
			</div>