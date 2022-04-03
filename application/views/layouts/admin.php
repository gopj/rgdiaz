<!DOCTYPE html>
<html>
	<head>
		<!-- base_url -->
		<base href="<?php echo base_url(); ?>"/>

		<!-- metas -->
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
		<meta name="keywords" content="admin,dashboard" />

		<!-- common plugins -->
		<link rel="stylesheet" href="<?=base_url('css/crizal/bootstrap.min.css')?>" />
		<link rel="stylesheet" href="<?=base_url('css/crizal/plugins/font-awesome/css/font-awesome.min.css')?>" />
		<link rel="stylesheet" href="<?=base_url('css/crizal/plugins/icomoon/style.css')?>" />
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

		<title>Recolector</title>
	</head>
	<body>
	<div class="page-container">
		<div class="page-sidebar">
			<a class="logo-box" href="<?=base_url('administrador/index')?>">
				<span>RDiaz</span>
				<i class="fas fa-unlock-alt" id="fixed-sidebar-toggle-button"></i>
				<i class="icon-close" id="sidebar-toggle-button-close"></i>
			</a>
			<div class="page-sidebar-inner">
				<div class="page-sidebar-menu">
					<ul class="accordion-menu">
						<li>
							<a href="<?=base_url('administrador/index')?>">
								<i class="menu-icon icon-home4"></i><span>Mi Carpeta</span>
							</a>
						</li>
						<li>
							<a href="<?=base_url('administrador/mensajes_contacto')?>">
								<i class="menu-icon icon-inbox"></i><span>Correo</span>
							</a>
						</li>
						<li>
							<a href="#!">
								<i class="menu-icon icon-truck"></i><span>Recolectores</span><i class="accordion-icon fa fa-angle-left"></i>
							</a>
							<ul>
								<li><a href="<?=base_url('admin/recolector_consulta')?>">Consultas</a></li>
								<li><a href="<?=base_url('admin/recolector_index')?>">Manifiestos</a></li>
								<li><a href="<?=base_url('admin/recolector_bitacora')?>">Bítacora</a></li>
							</ul>
						</li>
						<li>
							<a href="#!">
								<i class="menu-icon icon-user"></i><span>Clientes</span><i class="accordion-icon fa fa-angle-left"></i>
							</a>
							<ul>
								<li><a href="#">+ Nuevo Cliente</a></li>
								<li><a href="<?=base_url('administrador/admin_clientes')?>">Directorio de Clientes</a></li>
							</ul>
						</li>
						<li>
							<a href="#!">
								<i class="menu-icon icon-folder"></i><span>Carpetas</span><i class="accordion-icon fa fa-angle-left"></i>
							</a>
							<ul>
								<li><a href="<?=base_url('administrador/subir_archivo');?>">Mis Documentos</a></li>
								<li><a href="<?=base_url('administrador/subir_archivo');?>">Subir Archivos</a></li>
								
							</ul>
						</li>
						
						<li class="menu-divider"></li>
						<li>
							<a href="#!">
								<i class="menu-icon icon-settings"></i><span>Configuración</span><i class="accordion-icon fa fa-angle-left"></i>
							</a>
							<ul>
								<li><a href="#">Ajustes</a></li>
								<li><a href="<?=base_url();?>">Cerrar Sesión</a></li>
								
							</ul>
						</li>
					</ul>
				</div>
			</div>
		</div>
		<div class="page-content">
			<div class="page-inner">
				<?php echo $output; ?>

			</div>
			<div class="page-footer" style="padding-left: 10%;">
				<p>Todos los derechos reservados &copy; <script>document.write(new Date().getFullYear())</script> RDíaz.</p>
			</div>
		</div>


		
	</div>	

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

	<!-- Custom -->
	<script type="text/javascript" src="<?=base_url('js/recolector.js')?>"></script>

	<script type="text/javascript" src="<?=base_url('js/formulario_bitacora.js')?>"></script>

	<script type="text/javascript" src="<?=base_url('js/swith.js')?>"></script>

</body>	

</html>