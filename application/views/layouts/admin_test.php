<!DOCTYPE html>
<html lang="en">
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
								<i class="menu-icon icon-inbox"></i><span><span class="badge float-right badge-danger" id="message_count"></span> Correo</span>
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
								<li><a href="" data-toggle="modal" data-target="#modal_nuevo_cliente">+ Nuevo Cliente</a></li>
								<li><a href="" data-toggle="modal" data-target="#modal_baja_cliente" onclick="get_baja_clientes()">- Baja Cliente</a></li>
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
								<a class="logo-box" href="index.html"><span>Crizal</span></a>
							</div>
							<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
								<i class="fa fa-angle-down"></i>
							</button>
						</div>

						<!-- Collect the nav links, forms, and other content for toggling -->

						<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
							<ul class="nav navbar-nav">
								<li><a href="#!" id="collapsed-sidebar-toggle-button"><i class="fa fa-bars"></i></a></li>
							</ul>
							<ul class="nav navbar-nav navbar-right">
								<li class="dropdown">
									<a href="#!" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-bell"></i></a>
									<ul class="dropdown-menu dropdown-lg dropdown-content">
										<li class="drop-title">Notifications<a href="#" class="drop-title-link"><i class="fa fa-angle-right"></i></a></li>
										<li class="slimscroll dropdown-notifications">
											<ul class="list-unstyled dropdown-oc">
												<li>
													<a href="#"><span class="notification-badge bg-primary"><i class="fa fa-photo"></i></span>
															<span class="notification-info">Finished uploading photos to gallery <b>"South Africa"</b>.
																<small class="notification-date">20:00</small>
															</span></a>
												</li>
												<li>
													<a href="#"><span class="notification-badge bg-primary"><i class="fa fa-at"></i></span>
															<span class="notification-info"><b>John Doe</b> mentioned you in a post "Update v1.5".
																<small class="notification-date">06:07</small>
															</span></a>
												</li>
												<li>
													<a href="#"><span class="notification-badge bg-danger"><i class="fa fa-bolt"></i></span>
															<span class="notification-info">4 new special offers from the apps you follow!
																<small class="notification-date">Yesterday</small>
															</span></a>
												</li>
												<li>
													<a href="#"><span class="notification-badge bg-success"><i class="fa fa-bullhorn"></i></span>
															<span class="notification-info">There is a meeting with <b>Ethan</b> in 15 minutes!
																<small class="notification-date">Yesterday</small>
															</span></a>
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

			<!-- start page inner -->
			<div class="page-inner">

				<?=$output?>

			<!-- end page main wrapper -->
				<div class="page-footer">
					<p>Copyright &copy; <script>document.write(new Date().getFullYear())</script> Crizal All rights reserved.</p>
				</div>
			</div>
			<!-- end page inner -->

			 <!-- start main right sidebar -->
			<div class="page-right-sidebar" id="main-right-sidebar">
				<div class="page-right-sidebar-inner">
					<div class="right-sidebar-top">
						<div class="right-sidebar-tabs">
							<!-- Nav tabs -->
							<ul class="nav nav-tabs" role="tablist">
								<li role="presentation" class="active" id="chat-tab"><a href="#chat" aria-controls="chat" role="tab" data-toggle="tab">chat</a></li>
								<li role="presentation" id="settings-tab"><a href="#settings" aria-controls="settings" role="tab" data-toggle="tab">settings</a></li>
							</ul>
						</div>
						<a href="#!" class="right-sidebar-toggle right-sidebar-close" data-sidebar-id="main-right-sidebar"><i class="icon-close"></i></a>
					</div>
					<div class="right-sidebar-content">
						<!-- start tab panes -->
						<div class="tab-content">
							<div class="tab-pane active" id="chat">
								<div class="chat-list">
									<span class="chat-title">Recent</span>
									<a href="#!" class="right-sidebar-toggle chat-item unread" data-sidebar-id="chat-right-sidebar">
										<div class="user-avatar">
											<img src="<?=base_url('img/crizal/avatars/chat01.jpg')?>" alt="" />
										</div>
										<div class="chat-info">
											<span class="chat-author">David</span>
											<span class="chat-text">where u at?</span>
											<span class="chat-time">08:50</span>
										</div>
									</a>
									<a href="#!" class="right-sidebar-toggle chat-item unread active-user" data-sidebar-id="chat-right-sidebar">
										<div class="user-avatar">
											<img src="<?=base_url('img/crizal/avatars/chat02.jpg')?>" alt="" />
										</div>
										<div class="chat-info">
											<span class="chat-author">Daisy</span>
											<span class="chat-text">Daisy sent a photo.</span>
											<span class="chat-time">11:34</span>
										</div>
									</a>
								</div>
								<div class="chat-list">
									<span class="chat-title">Older</span>
									<a href="#!" class="right-sidebar-toggle chat-item" data-sidebar-id="chat-right-sidebar">
										<div class="user-avatar">
											<img src="<?=base_url('img/crizal/avatars/chat03.jpg')?>" alt="" />
										</div>
										<div class="chat-info">
											<span class="chat-author">Tom</span>
											<span class="chat-text">You: ok</span>
											<span class="chat-time">2d</span>
										</div>
									</a>
									<a href="#!" class="right-sidebar-toggle chat-item active-user" data-sidebar-id="chat-right-sidebar">
										<div class="user-avatar">
											<img src="<?=base_url('img/crizal/avatars/chat04.jpg')?>" alt="" />
										</div>
										<div class="chat-info">
											<span class="chat-author">Anna</span>
											<span class="chat-text">asdasdasd</span>
											<span class="chat-time">4d</span>
										</div>
									</a>
									<a href="#!" class="right-sidebar-toggle chat-item active-user" data-sidebar-id="chat-right-sidebar">
										<div class="user-avatar">
											<img src="<?=base_url('img/crizal/avatars/chat05.jpg')?>" alt="" />
										</div>
										<div class="chat-info">
											<span class="chat-author">Liza</span>
											<span class="chat-text">asdasdasd</span>
											<span class="chat-time">&nbsp;</span>
										</div>
									</a>
									<a href="#!" class="load-more-messages" data-toggle="tooltip" data-placement="bottom" title="Load More">&bull;&bull;&bull;</a>
								</div>
							</div>
							<div class="tab-pane" id="settings">
								<div class="right-sidebar-settings">
									<span class="settings-title">General Settings</span>
									<ul class="sidebar-setting-list list-unstyled">
										<li>
											<span class="settings-option">Notifications</span>
											<input type="checkbox" class="js-switch" checked />
										</li>
										<li>
											<span class="settings-option">Activity log</span>
											<input type="checkbox" class="js-switch" checked />
										</li>
										<li>
											<span class="settings-option">Automatic updates</span>
											<input type="checkbox" class="js-switch" />
										</li>
										<li>
											<span class="settings-option">Allow backups</span>
											<input type="checkbox" class="js-switch" />
										</li>
									</ul>
									<span class="settings-title">Account Settings</span>
									<ul class="sidebar-setting-list list-unstyled">
										<li>
											<span class="settings-option">Chat</span>
											<input type="checkbox" class="js-switch" checked />
										</li>
										<li>
											<span class="settings-option">Incognito mode</span>
											<input type="checkbox" class="js-switch" />
										</li>
										<li>
											<span class="settings-option">Public profile</span>
											<input type="checkbox" class="js-switch" />
										</li>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- end main right sidebar -->

			<!-- start chat right sidebar -->
			<div class="page-right-sidebar" id="chat-right-sidebar">
				<div class="page-right-sidebar-inner">
					<div class="right-sidebar-top">
						<div class="chat-top-info">
							<span class="chat-name">Noah</span>
							<span class="chat-state">2h ago</span>
						</div>
						<a href="#!" class="right-sidebar-toggle chat-sidebar-close float-right" data-sidebar-id="chat-right-sidebar"><i class="icon-keyboard_arrow_right"></i></a>
					</div>
					<div class="right-sidebar-content">
						<div class="right-sidebar-chat slimscroll">
							<div class="chat-bubbles">
								<div class="chat-start-date">02/03/2019 5:58PM</div>
								<div class="chat-bubble them">
									<div class="chat-bubble-img-container">
										<img src="<?=base_url('img/crizal/avatars/chat06.jpg')?>" alt="" />
									</div>
									<div class="chat-bubble-text-container">
										<span class="chat-bubble-text">Hello</span>
									</div>
								</div>
								<div class="chat-bubble me">
									<div class="chat-bubble-text-container">
										<span class="chat-bubble-text">Hello!</span>
									</div>
								</div>
								<div class="chat-start-date">03/02/2019 5:18AM</div>
								<div class="chat-bubble me">
									<div class="chat-bubble-text-container">
										<span class="chat-bubble-text">lorem</span>
									</div>
								</div>
								<div class="chat-bubble them">
									<div class="chat-bubble-img-container">
										<img src="<?=base_url('img/crizal/avatars/chat07.jpg')?>" alt="" />
									</div>
									<div class="chat-bubble-text-container">
										<span class="chat-bubble-text">ipsum dolor sit amet</span>
									</div>
								</div>
							</div>
						</div>
						<div class="chat-write">
							<form class="form-horizontal" action="javascript:void(0);">
								<input type="text" class="form-control" placeholder="Say something">
							</form>
						</div>
					</div>
				</div>
			</div>
			<!-- end chat right sidebar -->

			<!-- end page right sidebar -->
			
		</div>
		<!-- end page content -->
	</div>
	<!-- end page container -->

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

	<!-- custom scripts -->
	<script src="<?=base_url('js/crizal/admin-template/main.js')?>"></script>

	<!-- all js include end -->		

	<!-- Custom -->
	<script type="text/javascript" src="<?=base_url('js/recolector.js')?>"></script>

	<script type="text/javascript" src="<?=base_url('js/bitacora.js')?>"></script>

	<script type="text/javascript" src="<?=base_url('js/formulario_bitacora.js')?>"></script>

	<script type="text/javascript" src="<?=base_url('js/swith.js')?>"></script>

</body>	

</html>