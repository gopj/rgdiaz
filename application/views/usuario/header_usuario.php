<?php
	session_start();
?>
<!DOCTYPE html>
<html>
	<head>
		<base href="<?php echo base_url(); ?>">
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>RDíaz</title>
		<link href="img/minilogo.png" type="image/x-icon" rel="shortcut icon">
		<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="css/bootstrap-responsive.css">
		<link rel="stylesheet" type="text/css" href="css/datepicker.css">
		<link rel="stylesheet" type="text/css" href="css/estilos.css">
		<link rel="stylesheet" type="text/css" href="css/demo_table_jui.css">
		<link rel="stylesheet" type="text/css" href="css/jquery-ui-1.8.4.custom.css">
		<script type="text/javascript" src="js/jquery.js"></script>
		<script type="text/javascript" src="js/bootstrap.js"></script>
		<script type="text/javascript" src="js/jquery.dataTables.js"></script>
		<script type="text/javascript" src="js/tooltip.js"></script>
		<script type="text/javascript" src="js/popover.js"></script>
		<script type="text/javascript" src="js/transition.js"></script>
		<script type="text/javascript" src="js/dropdown.js"></script>
		<script type="text/javascript" src="js/notificaciones.js"></script>
		<script type="text/javascript" src="js/bootstrap-datepicker.js"></script>
		<script type="text/javascript" src="js/formulario_bitacora.js"></script>
		<!--[if lt IE 9]>
				<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
			< ![endif]-->
	</head>
	<body>
		<nav>
			<div class="navbar navbar-fixed-top">
				<div class="navbar-inner">
					<div class="container">
						<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</a>
						<a href="<?php echo site_url('cliente'); ?>" class="brand"><?php echo $this->session->userdata('empresa'); ?></a>
						<div class="collapse nav-collapse">
							<ul class="nav pull-right">
								<li class="divider-vertical"></li>
								<li><a href="<?php echo site_url('cliente'); ?>">Mi Carpeta</a></li>
								<li class="divider-vertical"></li>
								<li><a href="<?php echo site_url('cliente/ver_bitacora'); ?>">Bitácora</a></li>
								<li class="divider-vertical"></li>
								<li><a href="<?php echo site_url('cliente/mis_datos'); ?>">Mis Datos</a></li>
								<li class="divider-vertical"></li>
								<li><form action="<?php echo site_url('home/logout'); ?>"><input type="submit" id="sesion" class="btn btn-primary" value="Cerrar Sesión"></form></li>
								<li class="divider-vertical"></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</nav>

		<div class="container" style="padding-top:50px;">
			<div class="row">
				<div class="span12">
					<img src="img/logo.png" style="width:300px;">
				</div>
			</div>
			<div class="row">
				<div class="span3">
					<button onclick="actualiza_noti();" id="notificaciones" class="well-notificacion" data-toggle="popover">
						<div style="inline:block;">
							<img src="img/glyphicons_157_show_thumbnails_with_lines.png" style="float:left; margin-top:4px; width:18px;">
							<span style="float:left; margin-left:10px;">Notificaciones</span>
							<span class="badge barrabackground" style="float:right; margin-top:2px;"><?php echo $numnoti;?></span>
						</div>
						<input type="hidden" id="recibe" name="recibe" value="<?php echo $id;?>" />
					</button>
				</div>			