<!-- start login section -->
<section class="page-title-section2 bg-img cover-background" data-overlay-dark="3" data-background="img/portada/login_e.jpg">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-10 col-lg-7 col-xl-6">

				<div class="common-block bg-white padding-30px-all sm-padding-20px-all border border-width-5">

					<div class="line-title">
						<h3>Inicio de Sesión</h3>
					</div>

					<form method="post"  id="formSesion" action="<?=base_url('home/login')?>">

						<div class="row">

							<div class="col-sm-12 margin-10px-bottom">

								<div class="form-group">
									<label>Correo</label>
									<input type="text" id="correo_session" name="correo" placeholder="Correo de Usuario"  required>
								</div>

							</div>

							<div class="col-sm-12 margin-10px-bottom">

								<div class="form-group">
									<label>Password </label>
									<input type="password" id="password_session" name="password" placeholder="Contraseña *" required>
								</div>

							</div>

						</div>

						<div class="row">
							
							<div class="col-sm-6 text-left text-sm-right">
								<a href="<?=base_url('home/session/#')?>" class="m-link-muted">¿Olvidaste tu contraseña?</a>
							</div>

						</div>

						<button type="submit" class="butn theme btn-block margin-20px-top" id="iniciar" onclick="validarFormSesion()" class="butn white-hover theme"><span>Iniciar Sesión</span></button>
						<div class="text-center text-small margin-20px-top">
							<span>¿Aún no tienes cuenta? <a href="<?=base_url('home/session/#')?>">Registrate</a></span>
						</div>

					</form>

				</div>

			</div>
		</div>

	</div>
</section>