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
		<link rel="stylesheet" href="<?=base_url('css/estilos.css')?>" />
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
								<li><a href="#"  data-toggle="modal" data-target="#modal_nuevo_cliente">+ Nuevo Cliente</a></li>
								<li><a href="#"  data-toggle="modal" data-target="#modal_baja_cliente">- Baja Cliente</a></li>
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
			<div class="footer" style="padding-right: 18%;">
				<p>Todos los derechos reservados &copy; <script>document.write(new Date().getFullYear())</script> RDíaz.</p>
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
										<input class="form-control" type="text" id="alta_correo" name="correo"/>
									</div>
									Nota: se le enviara automáticamente al cliente un correo con su usuario y contraseña.
								</div>
							</form>
						</div>	
					</div>
				</div>
				<div class="modal-footer">
					<input type="button" class="btn btn-primary"  onclick="alta_cliente()" value="Dar de Alta">
					<a href="<?=site_url('administrador/alta_cliente_admin')?>" class="btn btn-primary"> Dar de alta y registrar datos </a>
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