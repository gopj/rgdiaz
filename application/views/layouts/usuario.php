<!DOCTYPE html>
<html lang="en">
<head>
	<!-- base_url -->
	<base href="<?=base_url()?>"/>

	<!-- metas -->
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="keywords" content="cliente,dashboard" />
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
	<link rel="stylesheet" href="<?=base_url('css/crizal/style/styles.css')?>" />
	<link rel="stylesheet" href="<?=base_url('css/crizal/plugins/icomoon/style.css')?>" />
	<link rel="stylesheet" href="<?=base_url('css/crizal/plugins/uniform/css/default.css')?>" />
	<link rel="stylesheet" href="<?=base_url('css/crizal/plugins/switchery/switchery.min.css')?>" />

	<!-- nvd3 plugin -->
    <link rel="stylesheet" href="<?=base_url('css/crizal/plugins/nvd3/nv.d3.min.css')?>" />

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

	<title>Cliente</title>
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
		<!-- start page sidebar -->
		<div class="page-sidebar">
			<a class="logo-box" href="<?=base_url('usuario')?>">
				<span>RDiaz</span>
				<i class="fas fa-unlock-alt" id="fixed-sidebar-toggle-button"></i>
				<i class="icon-close" id="sidebar-toggle-button-close"></i>
			</a>
			<div class="page-sidebar-inner">
				<div class="page-sidebar-menu">
					<ul class="accordion-menu">
						<li>
							<a href="<?=base_url('usuario')?>">
								<i class="menu-icon icon-home4"></i><span>Mi Carpeta</span>
							</a>
						</li>
						<li>
							<a href="<?=base_url('usuario/carpeta_compartida');?>">
								<i class="menu-icon icon-folder"></i><span>Documentos de RDíaz</span>
							</a>
						</li>
						<li>
							<a href="<?=base_url('usuario/ver_bitacora')?>">
								<i class="menu-icon fas fa-file-export"></i><span>Bitacora</span>
							</a>
						</li>
						<li>
							<a href="<?=base_url('usuario/mis_datos')?>">
								<i class="menu-icon icon-user"></i><span>Mis Datos</span>
							</a>
						</li>
						
						<li class="menu-divider"></li>
						
						<li>
							<a href="#!">
								<i class="menu-icon icon-settings"></i><span>Configuración</span><i class="accordion-icon fa fa-angle-left"></i>
							</a>
							<ul>
								<li><a href="<?=base_url('usuario/terminar_sesion');?>">Cerrar Sesión</a></li>
							</ul>
						</li>
					</ul>

				</div>
			</div>
		</div>
		<!-- end page sidebar -->
	
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
								<a class="logo-box" href="<?=base_url('usuario')?>"><span>RDIAZ</span></a>
							</div>
						</div>
						<!-- Collect the nav links, forms, and other content for toggling -->

						<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
							<ul class="nav navbar-nav">
								<li><a href="#!" id="collapsed-sidebar-toggle-button"><i class="fa fa-bars"></i></a></li>
							</ul>

							<ul class="nav navbar-nav navbar-right">
								<li class="dropdown">
									<a href="#!" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" onclick="read_notifications()"><i class="far fa-bell" id="bell"></i></a>
									<ul class="dropdown-menu dropdown-lg dropdown-content">
										<li class="drop-title"> <span id="count_noti" class="badge float-right badge-danger"></span> Notificaciones<a href="<?=current_url().'#'?>" class="drop-title-link"><i class="fa fa-angle-right"></i> </a></li>
										<li class="slimscroll dropdown-notifications">
											<ul class="list-unstyled dropdown-oc">
												<li id="notifications">

												</li>
											</ul>
										</li>
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
			<div class="page-inner">
				<?=$output?>
				<div class="page-footer" style="padding-right: 18%;">
					<p>Todos los derechos reservados &copy; <script>document.write(new Date().getFullYear())</script> RDíaz.</p>
				</div>
			</div>
		</div>		
	</div>

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

	<!-- d3.min -->
	<script src="<?=base_url('js/crizal/plugins/d3/d3.min.js')?>"></script>

	<!-- nv.d3.min -->
	<script src="<?=base_url('js/crizal/plugins/nvd3/nv.d3.min.js')?>"></script>

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

	<!-- float time -->
	<script src="<?=base_url('js/crizal/plugins/flot/jquery.flot.time.min.js')?>"></script>

	<!-- float symbol -->
	<script src="<?=base_url('js/crizal/plugins/flot/jquery.flot.symbol.min.js')?>"></script>

	<!-- float resize -->
	<script src="<?=base_url('js/crizal/plugins/flot/jquery.flot.resize.min.js')?>"></script>

	<!-- float tooltip -->
	<script src="<?=base_url('js/crizal/plugins/flot/jquery.flot.tooltip.min.js')?>"></script>

	<!-- float pie -->
	<script src="<?=base_url('js/crizal/plugins/flot/jquery.flot.pie.min.js')?>"></script>

	<!-- float pie -->
	<script src="<?=base_url('js/crizal/plugins/pages/dashboard.js')?>"></script>

	<!-- custom scripts -->
	<script src="<?=base_url('js/crizal/admin-template/main.js')?>"></script>

	<!-- all js include end -->		

	<!-- Custom -->

	<script type="text/javascript" src="<?=base_url('js/bitacora.js')?>"></script>

	<script type="text/javascript" src="<?=base_url('js/formulario_bitacora.js')?>"></script>

	<script type="text/javascript" src="<?=base_url('js/notificaciones.js')?>"></script>
	
	<script type="text/javascript" src="<?=base_url('js/swith_usuario.js')?>"></script>

</body>

</html>