<!DOCTYPE html>
<html lang="en">
<head>
	<!-- base_url -->
	<base href="<?=base_url()?>"/>

	<!-- metas -->
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<meta name="keywords" content="admin,dashboard" />
	<meta name="description" content="RDíaz - Servicios Integrales en Materia Ambiental" />

	<!-- title  -->
	<title>RD&iacute;az - Servicios Integrales en Materia Ambiental</title>

	<!-- favicon -->
	<link rel="shortcut icon" href="<?=base_url('img/minilogo.png')?>">
	<link rel="apple-touch-icon" href="<?=base_url('img/crizal/logos/apple-touch-icon-57x57.png')?>">
	<link rel="apple-touch-icon" sizes="72x72" href="<?=base_url('img/crizal/logos/apple-touch-icon-72x72.png')?>">
	<link rel="apple-touch-icon" sizes="114x114" href="<?=base_url('img/crizal/logos/apple-touch-icon-114x114.png')?>">

	<!-- common plugins -->
	<link rel="stylesheet" href="<?=base_url('css/crizal/bootstrap.min.css')?>" />
	<link rel="stylesheet" href="<?=base_url('css/crizal/plugins/font-awesome/css/font-awesome.min.css')?>" />
	<link rel="stylesheet" href="<?=base_url('css/style.css')?>" />
	<link rel="stylesheet" href="<?=base_url('css/estilos.css')?>" />
	<link rel="stylesheet" href="<?=base_url('css/crizal/plugins/icomoon/style.css')?>" />
	<link rel="stylesheet" href="<?=base_url('css/crizal/style/styles.css')?>" />
	<link rel="stylesheet" href="<?=base_url('css/crizal/plugins/uniform/css/default.css')?>" />
	<link rel="stylesheet" href="<?=base_url('css/crizal/plugins/switchery/switchery.min.css')?>" />

	<!-- summernote-master plugin -->
	<link rel="stylesheet" href="<?=base_url('css/crizal/plugins/summernote-master/summernote.css')?>" />

	<!-- bootstrap-datepicker plugin -->
	<link rel="stylesheet" href="<?=base_url('css/crizal/plugins/bootstrap-datepicker/datepicker.css')?>" />

	<!-- datatables plugin -->
	<link rel="stylesheet" href="<?=base_url('css/crizal/plugins/datatables/jquery.datatables.min.css')?>" />
	
	<!-- datatables plugin -->
	<link rel="stylesheet" href="<?=base_url('css/crizal/plugins/datatables/jquery.datatables_themeroller.css')?>" />

	<!-- bootstrap-colorpicker plugin -->
	<link rel="stylesheet" href="<?=base_url('css/crizal/plugins/bootstrap-colorpicker/bootstrap-colorpicker.css')?>" />

	<!-- bootstrap-tagsinput plugin -->
	<link rel="stylesheet" href="<?=base_url('css/crizal/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css')?>" />

	<!-- bootstrap-clockpicker plugin -->
	<link rel="stylesheet" href="<?=base_url('css/crizal/plugins/bootstrap-clockpicker/bootstrap-clockpicker.min.css')?>" />

	<!-- custom css -->
	<link rel="stylesheet" href="<?=base_url('css/crizal/admin-template/styles.css')?>" />

	<link href="<?=base_url('css/custom.css')?>" rel="stylesheet" />
	<title>Recolector</title>
</head>
<body>

	<!-- start page loading -->
	<div id="preloader">
		<div class="row loader">
			<div class="loader-icon"></div>
		</div>
	</div>
	<!-- end page loading -->

	<!-- start page container -->
	<div class="page-container">
		<!-- start page content -->
		<div class="page-content">
			<!-- start page header -->
			<div class="page-header">
			<nav class="navbar navbar-default">
                    <div class="container-fluid">
                        <!-- Brand and toggle get grouped for better mobile display -->
                        <div class="navbar-header">
                            <div class="logo-sm">
                                <a href="#!" id="sidebar-toggle-button"><i class="fa fa-bars"></i></a>
                                <a class="logo-box" href="index.html"><span>Crizal</span></a>
                            </div>
                            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                                <i class="fa fa-angle-down"></i>
                            </button>
                        </div>

                        <!-- Collect the nav links, forms, and other content for toggling -->

                        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                            <ul class="nav navbar-nav">
                                <li><a href="#!" id="toggle-fullscreen"><i class="fa fa-expand"></i></a></li>
                                <li><a href="#!" id="search-button"><i class="fa fa-search"></i></a></li>
                            </ul>
                            <ul class="nav navbar-nav navbar-right px-10">
								<li><a  href="<?=base_url('admin/recolector_consulta')?>" data-toggle="tooltip" data-placement="bottom" title="Recolector"><i class="menu-icon icon-truck"></i></a></li>
                                <li><a href="<?=base_url('administrador/mensajes_contacto')?>" class="right-sidebar-toggle" data-sidebar-id="main-right-sidebar" data-toggle="tooltip" data-placement="bottom" title="Correo"><i class="fa fa-envelope"></i></a></li>
								<li><a href="<?=base_url('administrador/subir_archivo');?>" data-toggle="tooltip" data-placement="bottom" title="Mi carpeta"><i class="menu-icon icon-folder"></i></a></li>
                                <li class="dropdown user-dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><img src="img/avatars/user-dropdown.jpg" alt="" class="rounded-circle"></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="#"  data-toggle="modal" data-target="#modal_nuevo_cliente">Nuevo Cliente</a></li>
                                        <li><a href="#" data-toggle="modal" data-target="#modal_baja_cliente" onclick="get_baja_clientes()">Baja de Cliente</a></li>
                                        <li><a href="<?=base_url('administrador/admin_clientes')?>">Directorio</a></li>
                                        <li role="separator" class="divider"></li>
                                        <li><a href="#">Configuración</a></li>
                                        <li><a href="<?=base_url('home/logout')?>">Cerrar sesión</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <!-- /.navbar-collapse -->
                    </div>
                    <!-- /.container-fluid -->
                </nav>
			</div>

			<!-- end page header -->
			<div class="page-inner workspace ">

				<?=$output?>

				<div class="page-footer" style="padding-right: 18%;">
					<p>Todos los derechos reservados &copy; <script>document.write(new Date().getFullYear())</script> RDíaz.</p>
				</div>
			</div>
		</div>		
	</div>

	<!-- Modal Agrega Cliente Start-->
	<div class="modal" id="modal_nuevo_cliente">
		<div class="modal-dialog modal-md"> 
			<div class="modal-content"> 
				<div class="modal-header"> 
					<h5 class="modal-title" >Nuevo cliente </h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div> 
				<div class=modal-body>
					<div class="form-row">
						<div class="form-group col-md-12">
							<form id="form_alta_cliente2" method="post" action="<?=base_url('administrador/alta_cliente')?>">
								<div class="modal-body">
									Correo Electrónico:
									<div class="input-prepend">
										<span class="add-on">
											<img src="img/glyphicons_003_user.png" class="icon-form">
										</span>
										<input class="form-control" type="text" id="alta_correo" name="correo" oninput="alta_correo_post();" />
									</div>
									Nota: se le enviara automáticamente al cliente un correo con su usuario y contraseña.
								</div>
							</form>
						</div>	
					</div>
				</div>
				<div class="modal-footer">
					<input type="button" class="btn btn-primary"  onclick="alta_cliente()" value="Dar de Alta">

					<form id="form_admin_alta" method="post"  action="<?=base_url('administrador/alta_cliente_admin')?>">
						<input type="hidden" name="alta_correo_hidd" id="alta_correo_hidd" value="What">
						<button type="submit" class="btn btn-primary"> Dar de alta y registrar datos </button>
					</form>

				</div>
			</div> 
		</div>
	</div>
	<!-- Modal Agrega Cliente End-->

	<!-- Modal Baja Cliente Start-->
	<div class="modal" id="modal_baja_cliente">
		<div class="modal-dialog modal-md"> 
			<div class="modal-content"> 
				<div class="modal-header"> 
					<h5 class="modal-title">Baja cliente </h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div> 
				<div class=modal-body>
					<div class="form-group col-md-12">
						<form id="baja_cliente" method="post" action="<?=site_url('administrador/baja_cliente')?>">
							Usuario:
							<div class="input-prepend">
								<span class="add-on">
									<img src="img/glyphicons_003_user.png" class="icon-form">
								</span>
								<select class="form-control" name="id_persona" id="id_persona_baja"> <!--Mandamos una bandera para ver si ingreso un cliente-->
								</select>
							</div> <br />
							Razón:
							<div class="input-prepend">
								<span class="add-on">
									<img src="img/glyphicons_030_pencil.png" class="icon-form">
								</span>
								<input type="text" class="form-control" id="razon" name="razon" >
							</div> <br />
							Nota: se le enviara automáticamente al cliente un correo notificandole que a sido dado de baja.
						</form>
					</div>
				</div>
				<div class="modal-footer">
					<input type="button" class="btn btn-primary" onclick="cliente_baja()" value="Dar de Baja">
				</div>
			</div> 
		</div>
	</div>

	<!-- Modal Baja Cliente End-->

	<!-- start scroll to top -->
	<a href="#!" class="scroll-to-top"><i class="fas fa-angle-up" aria-hidden="true"></i></a>
	<!-- end scroll to top -->

	<!-- all js include start -->

	<!-- jQuery -->
	<script src="<?=base_url('js/crizal/plugins/jquery/jquery-3.1.0.min.js')?>"></script>

	<!-- popper -->
	<script src="<?=base_url('js/crizal/plugins/popper/js/popper.min.js')?>"></script>

	<!-- bootstrap -->
	<script src="<?=base_url('js/crizal/plugins/bootstrap/bootstrap.min.js')?>"></script>

	<!-- slimscroll -->
	<script src="<?=base_url('js/crizal/plugins/jquery-slimscroll/jquery.slimscroll.min.js')?>"></script>

	<!-- uniform -->
	<script src="<?=base_url('js/crizal/plugins/uniform/js/jquery.uniform.standalone.js')?>"></script>

	<!-- switchery -->
	<script src="<?=base_url('js/crizal/plugins/switchery/switchery.min.js')?>"></script>

	<!-- datatable -->
	<script src="<?=base_url('js/crizal/plugins/datatables/jquery.datatables.js')?>"></script>

	<!-- summernote -->
	<script src="<?=base_url('js/crizal/plugins/summernote-master/summernote.min.js')?>"></script>

	<!-- datepicker -->
	<script src="<?=base_url('js/crizal/plugins/bootstrap-datepicker/bootstrap-datepicker.js')?>"></script>
	<script src="<?=base_url('js/crizal/plugins/bootstrap-datepicker/locales/bootstrap-datepicker.es.js')?>"></script>

	<!-- colorpicker -->
	<script src="<?=base_url('js/crizal/plugins/bootstrap-colorpicker/bootstrap-colorpicker.js')?>"></script>

	<!-- tagsinput -->
	<script src="<?=base_url('js/crizal/plugins/bootstrap-tagsinput/bootstrap-tagsinput.min.js')?>"></script>

	<!-- clockpicker -->
	<script src="<?=base_url('js/crizal/plugins/bootstrap-clockpicker/bootstrap-clockpicker.min.js')?>"></script>


	<!-- form elements -->
	<script src="<?=base_url('js/crizal/pages/form-elements.js')?>"></script>

	<!-- table data-->
	<script src="<?=base_url('js/crizal/pages/table-data.js')?>"></script>

	<!-- custom scripts -->
	<script src="<?=base_url('js/crizal/main.js')?>"></script>

	<!-- all js include end -->		
	<script> 
	$(function () {
        $('[data-toggle="tooltip"]').tooltip()
      })
    </script>
	<!-- Custom -->
	<script type="text/javascript" src="<?=base_url('js/recolector.js')?>"></script>

	<script type="text/javascript" src="<?=base_url('js/bitacora.js')?>"></script>

	<script type="text/javascript" src="<?=base_url('js/formulario_bitacora.js')?>"></script>

	<script type="text/javascript" src="<?=base_url('js/swith.js')?>"></script>

</body>


</html>