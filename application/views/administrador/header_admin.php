<?php ob_start(); session_start(); 
header("Content-Type: text/html;charset=utf-8");
?>
<!DOCTYPE html>
	<html>
		<head>
			<base href="<?php echo base_url(); ?>"/>
			<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
			<meta http-equiv="cache-control" content="max-age=0" />
			<meta http-equiv="cache-control" content="no-cache" />
			<meta http-equiv="expires" content="-1" />
			<meta http-equiv="expires" content="Tue, 01 Jan 1980 1:00:00 GMT" />
			<meta http-equiv="pragma" content="no-cache" />
			<title>RDíaz</title>
			<link href="img/minilogo.png" type="image/x-icon" rel="shortcut icon" />
			<meta name="viewport" content="width=device-width, initial-scale=1.0">
			<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
			<link rel="stylesheet" type="text/css" href="css/bootstrap-responsive.css">
			<link rel="stylesheet" type="text/css" href="css/datepicker.css">
			<link rel="stylesheet" type="text/css" href="css/estilos.css">
			<link rel="stylesheet" type="text/css" href="css/demo_table_jui.css">
			<link rel="stylesheet" type="text/css" href="css/jquery-ui-1.8.4.custom.css">
			<link rel="stylesheet" type="text/css" href="css/glyphicons.css">
			<script type="text/javascript" src="js/jquery.js"></script>
			<script type="text/javascript" src="js/bootstrap.js"></script>
			<script type="text/javascript" src="js/jquery.dataTables.js"></script>
			<script type="text/javascript" src="js/tooltip.js"></script>
			<script type="text/javascript" src="js/popover.js"></script>
			<script type="text/javascript" src="js/transition.js"></script>
			<script type="text/javascript" src="js/dropdown.js"></script>
			<script type="text/javascript" src="js/swith.js"></script>
			<script type="text/javascript" src="js/bootstrap-datepicker.js"></script>
			<script type="text/javascript" src="js/formulario_bitacora.js"></script>
			<script type="text/javascript" src="js/jquery.validate.js"></script>
			<script type="text/javascript" src="js/jquery.validate.messages.js"></script>
			<script type="text/javascript" src="js/bitacora.js"></script>
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
							<a href="<?php echo site_url('administrador')?>" class="brand"><?php echo $this->session->userdata('nombre');?></a>
							<div class="collapse nav-collapse">
								<ul class="nav pull-right">
									<li class="divider-vertical"></li>
									<li><a href="<?php echo site_url('administrador')?>">Mi carpeta</a></li>
									<li class="divider-vertical"></li>
									<li class="dropdown">
										<a href="" class="dropdown-toggle" data-toggle="dropdown">Clientes<b class="caret"></b></a>
										<ul class="dropdown-menu">
											<li><a href="#alta" data-toggle="modal">Dar de alta</a></li>
											<li><a href="#baja" data-toggle="modal">Dar de baja</a></li>
											<li><a href="<?php echo site_url('administrador/admin_clientes') ?>">Consulta</a></li>
										</ul>
									</li>
									<li class="divider-vertical"></li>
									<li class="dropdown">
										<a href="" class="dropdown-toggle" data-toggle="dropdown">Recolectores<b class="caret"></b></a>
										<ul class="dropdown-menu">
												<li><a href="<?php echo site_url('administrador/recolector_alta')?>">Alta</a></li>
												<li><a href="<?php echo site_url('administrador/transportistas_destinos') ?>">Transportistas | Destinos</a></li>
												<li><a href="<?php echo site_url('administrador/recolector_index') ?>">Consultas</a></li>
										</ul>
									</li>
									
									<li class="divider-vertical"></li>
									<li><a href="<?php echo site_url('administrador/subir_archivo');?>">Administrar Carpetas</a></li>
									<li class="divider-vertical"></li>
									<li>
									<li><a href="<?php echo site_url('home/logout');?>" style="margin-top:-10px;"><button type="button" class="btn btn-primary">Cerrar Sesión</button></a></li>
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
						<img src="img/logo.png" height="300" width="300">
					</div>
			</div>

			<div class="row">
					<div class="span3">								
						<form  method="post" action="<?php echo site_url('administrador/mensajes_contacto')?>">
  							<button class="well-notificacion" type="submit">
  								<div style="inline:block;">
  									<img src="img/glyphicons_245_chat.png" style="float:left; margin-top:2px; height:18; width:18;"> 
  									<span style="float:left; margin-left:10px;">Mensajes de Contacto</span>
  									<span class="badge barrabackground" style="float:right; margin-top:2px;"><?php echo $mensajes; ?></span>
  								</div>
  							</button>
  						</form>
  						<br>
						<form>
							<button class="well-notificacion" href="#correo" data-toggle="modal">
								<div style="inline:block;">
									<img src="img/glyphicons_010_envelope.png" style="float:left; margin-top:2px; height:18; width:18;"> 
									<span style="float:left; margin-left:10px;">Enviar Correo</span>
								</div>
							</button>
						</form>
					</div>
