 <!-- start page title section -->
<section class="page-title-section2 bg-img cover-background" data-overlay-dark="7" data-background="img/bg/bg9.jpg">
    <div class="container">

        <div class="row">
            <div class="col-md-12">
                <h1>Login</h1>
            </div>
            <div class="col-md-12">
                <ul>
                    <li><a href="index.php/home/index2/">Inicio</a></li>
                    <li><a href="javascript:void(0)">Login</a></li>
                </ul>
            </div>
        </div>

    </div>
</section>
<!-- end page title section -->

 
<!-- start login section -->
<section>
    <div class="container">
        <div class="row">
            <div class="col-lg-6 center-col">
                <div class="bg-white padding-30px-all sm-padding-20px-all border border-width-5">
                    <div class="text-center section-heading">
                        <h4>Inicio de Sesión</h4>

                    </div>
                    <form class="login-form" id="formSesion" method="post" action="<?php echo site_url('home/login');?>">
                        <div class="row">
                            <div class="col-md-12">
                                <input type="text" name="correo" id="correo_session" required="required" placeholder="Correo de Usuario" maxlength="70" class="medium-input">
                            </div>
                            <div class="col-12">
                                <input type="password" name="password" id="password_session" required="required" placeholder="Password *" maxlength="70" class="medium-input">
                            </div>
                            <div class="col-12">
                                <button class="butn theme medium" type="button" class='btn btn-primary pull-right' onclick="validarFormSesion()">Iniciar</button>
                                
                                <p class="no-margin float-right">
                                    <a href="<?php echo site_url('home/recupera_password');?>">¿Olvidaste tu contraseña?</a>
                                </p>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</section>
<!-- end under construction section -->