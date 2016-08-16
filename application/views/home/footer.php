			

			<div id="sesion" class="modal hide fade">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<big style="font-weight:bold;">Iniciar sesión</big>
				</div>
				<div class="modal-body">
					<div class="span2">
						<img src="img/logo.png" style="width:auto;padding-top:35px;">
					</div>
					<div class="span3">
						<form id="formSesion" method="post" action="<?php echo site_url('home/login');?>" >
							<center>
								Correo de Usuario
								<div class='input-prepend'>
									<span class='add-on'>
										<img src='img/glyphicons_003_user.png' height='18' width='18'>
									</span>
									<input class='txt-modal' type='text' id="correo_session" name="correo"/>
								</div>
								<br/>
								Contraseña
								<div class='input-prepend'>
									<span class='add-on'>
										<img src='img/glyphicons_203_lock.png' height='18' width='18'>
									</span>
									<input class='txt-modal' type='password' id="password_session" name="password"/>
								</div>
							</center>
							<br/>
							<a href="<?php echo site_url('home/recupera_password');?>">¿Olvidaste tu contraseña?</a>
							<button style="margin-left:10px;" type="button" class='btn btn-primary btn-small pull-right' onclick="validarFormSesion()">Iniciar</button>
						</form>
					</div>
				</div>
			</div>

			<footer>
				<div class="footer" style="color:#fff; font-weight:bold; ">
					<div class="container">
						<div style="">
							Derechos reservados &copy;2014 RDíaz
						</div>
						<div class="pull-right" style="font-weight:normal; font-size:14px;">
							Desarrollado por: <a href="http://sharksoft.com.mx" style="color:#fff;" target="_blank">Shark Soft</a>
						</div>
					</div>
				</div>
			</footer>
		</body>
	</html>


